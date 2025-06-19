<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PaymentLog;
use Illuminate\Support\Facades\Log;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Encryption\JWEDecrypter;
use Jose\Component\Encryption\Serializer\CompactSerializer as JWESerializer;
use Jose\Component\Encryption\Algorithm\KeyEncryption\RSAOAEP;
use Jose\Component\Encryption\Algorithm\ContentEncryption\A128CBCHS256;
use Jose\Component\Core\JWK;
use Jose\Component\KeyManagement\JWKFactory;
use Jose\Component\Signature\JWSVerifier;
use Jose\Component\Signature\Algorithm\PS256;
use Jose\Component\Signature\Serializer\CompactSerializer as JWSSerializer;

class PaymentController extends Controller
{
    // 1. หน้าแสดงผลสำเร็จ
    public function confirmation(Request $request)
    {
        // รับ query string หรือข้อมูลที่ 2C2P ส่งมาก็ได้
        // เช่น transactionRef, status, amount, ฯลฯ
        $data = $request->all();
        return view('payment.confirmation', compact('data'));
    }

    // 2. หน้าแสดงผลล้มเหลว
    public function failed(Request $request)
    {
        $data = $request->all();
        return view('payment.failed', compact('data'));
    }

    // 3. หน้าแสดงผลยกเลิก
    public function cancelled(Request $request)
    {
        $data = $request->all();
        return view('payment.cancelled', compact('data'));
    }

        
    public function webhook(Request $request)
    {
        try {
            // Step 1: Read JWE from request
            $jwe = $request->getContent();
            // Log::info('[2C2P Webhook] JWE Payload', ['jwe' => $jwe]);

            // Step 2: Load Private Key (PEM) for JWE decryption
            $privateKeyPath = storage_path('keys/Merchant_Encrypt_Private_key.pem');
            $privateKey = JWKFactory::createFromKeyFile($privateKeyPath);

            // Step 3: Setup JWE decryption
            $jweSerializer = new JWESerializer();
            $jweObject = $jweSerializer->unserialize($jwe);

            $keyEncryptionAlgorithmManager = new AlgorithmManager([new RSAOAEP()]);
            $contentEncryptionAlgorithmManager = new AlgorithmManager([new A128CBCHS256()]);
            $jweDecrypter = new JWEDecrypter(
                $keyEncryptionAlgorithmManager,
                $contentEncryptionAlgorithmManager
            );

            // Step 4: Decrypt JWE to extract JWT
            if (!$jweDecrypter->decryptUsingKey($jweObject, $privateKey, 0)) {
                Log::error('[2C2P Webhook] Decrypt JWE failed');
                return response()->json(['error' => 'Decrypt JWE failed'], 400);
            }
            $jwt = $jweObject->getPayload();
            // Log::info('[2C2P Webhook] JWT (JWS)', ['jwt' => $jwt]);

            // Step 5: Verify JWT signature (PS256)
            $jwsSerializer = new JWSSerializer();
            $jws = $jwsSerializer->unserialize($jwt);

            $publicKeyPath = storage_path('keys/PACO_Signing_Public.pem');
            $publicKey = JWKFactory::createFromKeyFile($publicKeyPath);

            $jwsVerifier = new JWSVerifier(
                new AlgorithmManager([new PS256()])
            );

            if (!$jwsVerifier->verifyWithKey($jws, $publicKey, 0)) {
                Log::error('[2C2P Webhook] Invalid JWT signature');
                return response()->json(['error' => 'Invalid JWT signature'], 400);
            }

            // Step 6: Decode claims (payload)
            $claims = json_decode($jws->getPayload(), true);
            // Log::info('[2C2P Webhook] Decoded JWT', $claims);

            // แก้ไข: ใช้ข้อมูลจาก response -> data -> paymentResult แทน request
            $paymentResult = $claims['response']['data']['paymentResult'] ?? null;
            if (!$paymentResult) {
                Log::error('[2C2P Webhook] Missing paymentResult data in JWT');
                return response()->json(['error' => 'Invalid JWT payload: missing paymentResult'], 400);
            }

            // Step 7: Extract values
            $orderNo = $paymentResult['orderNo'] ?? null;
            // แก้ไขชื่อคีย์สถานะตาม payload จริง
            $statusCode = $paymentResult['paymentStatusInfo']['paymentStatus'] ?? null;
            // ใช้ pspReferenceNo เป็น transaction id ตามตัวอย่าง payload
            $transactionId = $paymentResult['pspReferenceNo'] ?? null;
            
            $statusMapping = [
                'A' => 'paid',
                'S' => 'paid',
                'V' => 'cancel',
                'R' => 'cancel',
                'F' => 'cancel',
                'E' => 'cancel',
                'C' => 'cancel',
                'I' => 'pending',
                'P' => 'pending',
                'PCPS' => 'pending',
            ];
            $paymentStatus = $statusMapping[$statusCode] ?? 'pending';


            PaymentLog::create([
                'order_no' => $orderNo,
                'payment_status' => $paymentStatus,
                'payment_status_code' => $paymentResult['paymentStatusInfo']['paymentStatus'] ?? null,
                'payment_step' => $paymentResult['paymentStatusInfo']['paymentStep'] ?? null,
                'psp_reference_no' => $paymentResult['pspReferenceNo'] ?? null,
                'psp_invoice_no' => $paymentResult['pspInvoiceNo'] ?? null,
                'approval_code' => $paymentResult['approvalCode'] ?? null,
                'amount' => $paymentResult['transactionAmount']['amount'] ?? null,
                'currency_code' => $paymentResult['transactionAmount']['currencyCode'] ?? null,
                'payment_type' => $paymentResult['paymentType'] ?? null,
                'channel_code' => $paymentResult['channelCode'] ?? null,
                'card_number_last4' => substr($paymentResult['creditCardAuthenticatedDetails']['cardNumber'] ?? '', -4),
                'payer_name' => $paymentResult['creditCardAuthenticatedDetails']['payerName'] ?? null,
                'card_holder_name' => $paymentResult['creditCardAuthenticatedDetails']['cardHolderName'] ?? null,
                'response_code' => $paymentResult['priorPaymentResponseDetails']['responseCode'] ?? null,
                'response_desc' => $paymentResult['priorPaymentResponseDetails']['responseDescription'] ?? null,
                'response_raw' => json_encode($paymentResult),
                'paid_at' => $paymentResult['transactionDateTime'] ?? null,
            ]);

            // Step 8: Update order
            $order = Order::where('order_number', $orderNo)->first();
            if (!$order) {
                Log::error('[2C2P Webhook] Order not found', ['orderNo' => $orderNo]);
                return response()->json(['error' => 'Order not found'], 404);
            }

            $order->update([
                'payment_status' => $paymentStatus,
                'transaction_id' => $transactionId,
            ]);

            // Log::info('[2C2P Webhook] Order updated', [
            //     'order_number' => $orderNo,
            //     'payment_status' => $paymentStatus,
            //     'transaction_id' => $transactionId,
            // ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('[2C2P Webhook] ERROR', [
                'msg' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



}
