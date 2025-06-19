<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Signature\Algorithm\RS256;
use Jose\Component\Encryption\Algorithm\KeyEncryption\RSAOAEP;
use Jose\Component\Encryption\Algorithm\ContentEncryption\A128CBCHS256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Encryption\JWEBuilder;
use Jose\Component\Signature\Serializer\CompactSerializer as JWSSerializer;
use Jose\Component\Encryption\Serializer\CompactSerializer as JWESerializer;
use Jose\Component\KeyManagement\JWKFactory;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PaymentGateway2C2PService
{
    protected $privateKeyPath;
    protected $publicKeyPath;

    public function __construct()
    {
        $this->privateKeyPath = storage_path('keys/Merchant_Signing_Private_key.pem');
        $this->publicKeyPath = storage_path('keys/PACO_Encryption_Public.pem');
        
    }

    public function getPaymentPageUrl($orderNo, $amount)
    {
        $privateKey = file_get_contents($this->privateKeyPath);
        $publicKeyPath = $this->publicKeyPath;
        $publicKeyContent = file_get_contents($publicKeyPath);

        // log::info('getPaymentPageUrl called', [
        //     'privateKey' => $privateKey,
        //     'publicKeyContent' => $publicKeyContent
        // ]);

        // Format amount
        $amount_value = number_format((float)$amount, 2, '.', '');
        $amount_value = str_replace('.', '', $amount_value);
        $amountText = str_pad($amount_value, 12, '0', STR_PAD_LEFT);

        // Prepare payload
        $apiKey = '37b6f89d431f465abce941811a74c34d';
        $off_id = 'PWT';
        $time_iso = (new \DateTime('now', new \DateTimeZone('UTC')))
            ->format('Y-m-d\TH:i:s.uP');

        $payload = [
            'iss' => $apiKey,
            'aud' => 'PacoAudience',
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 3600,
            'request' => [
                'apiRequest' => [
                    'requestMessageID' => (string) Str::uuid(),
                    'requestDateTime' => $time_iso,
                ],
                'officeId' => $off_id,
                'orderNo' => $orderNo,
                'paymentType' => 'CC',
                'mcpFlag' => 'N',
                'transactionAmount' => [
                    'currencyCode' => 'THB',
                    'decimalPlaces' => 2,
                    'amount' => $amount,
                    'amountText' => $amountText
                ],
                // 'notificationURLs' => [
                //     'confirmationURL' => 'http://apex-capable.thddns.net:6885/view',
                //     'failedURL' => 'http://apex-capable.thddns.net:6885/failed',
                //     'cancellationURL' => 'http://cancellation-url2c2p.com',
                //     'backendURL' => 'http://apex-capable.thddns.net:6885/webhook'
                // ],
                'notificationURLs' => [
                    'confirmationURL' => url('/payment/confirmation'),
                    'failedURL' => url('/payment/failed'),
                    'cancellationURL' => url('/payment/cancelled'),
                    'backendURL' => url('/payment/webhook')
                    // 'backendURL' => 'https://new.orangeworkshop.info/powertex/payment/webhook'

                ],
                'installmentPaymentDetails' => [
                    'ippFlag' => 'N'
                ],
                'paymentCategory' => 'ECOM',
                'channelCode' => 'WEBPAY',
                'request3dsFlag' => 'N',
                'productDescription' => 'Payment credit card merchant test'
            ]
        ];

        // 1. Create JWT
        $jwt = JWT::encode($payload, $privateKey, 'RS256');

        // 2. JWE encrypt 
        $keyEncryptionAlgorithmManager = new AlgorithmManager([
            new RSAOAEP()
        ]);
        $contentEncryptionAlgorithmManager = new AlgorithmManager([
            new A128CBCHS256()
        ]);
        $jweBuilder = new JWEBuilder(
            $keyEncryptionAlgorithmManager,
            $contentEncryptionAlgorithmManager
        );

        $publicKey = JWKFactory::createFromKeyFile($publicKeyPath);
        $protectedHeader = [
            'alg' => 'RSA-OAEP',
            'enc' => 'A128CBC-HS256',
            'kid' => '7664a2ed0dee4879bdfca0e8ce1ac313', // 2C2P require
            'type' => 'JWT'
        ];
        $jwe = $jweBuilder
            ->create()
            ->withPayload($jwt)
            ->withSharedProtectedHeader($protectedHeader)
            ->addRecipient($publicKey)
            ->build();

        $jweSerializer = new JWESerializer();
        $jweToken = $jweSerializer->serialize($jwe, 0);

        // 3. Call Payment Gateway
        $gatewayUrl = 'https://core.demo-paco.2c2p.com/api/2.0/Payment/prePaymentUI?apiKey='.$apiKey;

        $ch = curl_init($gatewayUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apiKey: ' . $apiKey,
            'Content-Type: application/jose',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jweToken);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new Exception('cURL Error: ' . $error);
        }
        $result = json_decode($response, true);

        if (
            isset($result['data']['paymentPage']['paymentPageURL']) &&
            $result['data']['paymentPage']['paymentPageURL']
        ) {
            return $result['data']['paymentPage']['paymentPageURL'];
        }
        \Log::error('[2C2P][API ERROR]', ['payload' => $payload, 'jwt' => $jwt, 'jweToken' => $jweToken, 'response' => $response]);
        throw new Exception('Cannot get paymentPageURL: ' . $response);
    }

}
