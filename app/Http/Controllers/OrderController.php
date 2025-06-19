<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MemberAddress;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PaymentGateway2C2PService; // <<-- ใช้ Service นี้

class OrderController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('[OrderController@store] START', $request->all());

        DB::beginTransaction();
        try {
            $member = auth('member')->user();
            \Log::info('[OrderController@store] member', [$member]);
            
            $cart = session('cart', []);
            \Log::info('[OrderController@store] cart', $cart);

            if (empty($cart)) {
                \Log::warning('[OrderController@store] cart is empty');
                return back()->with('error', 'ไม่มีสินค้าในตะกร้า');
            }

            // 1. สร้างที่อยู่ (Shipping & Invoice)
            $shipping = MemberAddress::create([
                'member_id'    => $member->id,
                'type'         => 'shipping',
                'firstname'    => $request->input('shipping_firstname'),
                'lastname'     => $request->input('shipping_lastname'),
                'address'      => $request->input('shipping_address'),
                'province'     => $request->input('shipping_province'),
                'district'     => $request->input('shipping_district'),
                'sub_district' => $request->input('shipping_sub_district'),
                'postcode'     => $request->input('shipping_postcode'),
                'phone'        => $request->input('shipping_phone'),
            ]);
            \Log::info('[OrderController@store] shipping address created', $shipping->toArray());

            $invoice = MemberAddress::create([
                'member_id'    => $member->id,
                'type'         => 'invoice',
                'firstname'    => $request->input('invoice_firstname') ?: '',
                'lastname'     => $request->input('invoice_lastname') ?: '',
                'address'      => $request->input('invoice_address') ?: '',
                'province'     => $request->input('invoice_province') ?: '',
                'district'     => $request->input('invoice_district') ?: '',
                'sub_district' => $request->input('invoice_sub_district') ?: '',
                'postcode'     => $request->input('invoice_postcode') ?: '',
                'phone'        => $request->input('invoice_phone') ?: '',
                'company_name' => $request->input('invoice_type') ?: '',
                'tax_number'   => $request->input('invoice_tax_number') ?: '',
            ]);
            \Log::info('[OrderController@store] invoice address created', $invoice->toArray());

            // 2. สร้างเลข order_number
            // $date = now()->format('ymd');
            // $prefix = 'PTE' . $date;
            // $todayCount = Order::whereDate('order_date', now()->toDateString())->count() + 1;
            // $order_number = $prefix . str_pad($todayCount, 6, '0', STR_PAD_LEFT);
            $orderPrefix = 'DEV'; // เปลี่ยนเป็น 'PROD' หรืออะไรก็ได้ตามที่ต้องการ

            $date = now()->format('ymd');
            $prefix = $orderPrefix . 'PTE' . $date;
            $todayCount = Order::whereDate('order_date', now()->toDateString())->count() + 1;
            $order_number = $prefix . str_pad($todayCount, 6, '0', STR_PAD_LEFT);


            \Log::info('[OrderController@store] new order_number', ['order_number' => $order_number]);

            // 3. สร้าง Order (total_amount = 0 ไปก่อน)
            $order = Order::create([
                'order_number'        => $order_number,
                'member_id'           => $member->id,
                'order_date'          => now(),
                'total_amount'        => 0,
                'payment_status'      => 'pending',
                'shipping_status'     => 'processing',
                'shipping_address_id' => $shipping->id,
                'invoice_address_id'  => $invoice->id,
            ]);
            \Log::info('[OrderController@store] order created', $order->toArray());

            // 4. เพิ่ม OrderItem + คำนวณราคารวม
            $totalAmount = 0;
            $products = Product::whereIn('products_id', array_keys($cart))->get()->keyBy('products_id');
            \Log::info('[OrderController@store] products', $products->toArray());

            foreach ($cart as $pid => $qty) {
                $p = $products[$pid] ?? null;
                if (!$p) {
                    \Log::warning('[OrderController@store] product not found', ['pid' => $pid]);
                    continue;
                }
                $price = $p->products_price_promotion ?: $p->products_price_full;
                $totalAmount += $price * $qty;
                $orderItem = $order->items()->create([
                    'product_id'   => $p->products_id,
                    'product_name' => $p->products_name,
                    'product_code' => $p->products_code,
                    'price'        => $price,
                    'quantity'     => $qty,
                ]);
                \Log::info('[OrderController@store] order_item created', $orderItem->toArray());
            }

            // 5. อัพเดทยอดรวม
            $order->update(['total_amount' => $totalAmount]);
            \Log::info('[OrderController@store] order updated total_amount', ['order_id' => $order->id, 'total_amount' => $totalAmount]);

            // 6. ล้างตะกร้า
            session()->forget('cart');
            \Log::info('[OrderController@store] cart cleared');

            // 7. สร้าง Payment URL (2C2P)
            $paymentService = new PaymentGateway2C2PService();
            $paymentUrl = $paymentService->getPaymentPageUrl($order->order_number, $totalAmount);
            \Log::info('[OrderController@store] paymentUrl', ['paymentUrl' => $paymentUrl]);

            DB::commit();
            \Log::info('[OrderController@store] COMMIT');

            // 8. Redirect ไปหน้า Payment Gateway (ไม่ใช่ route ในเว็บเรา)
            return redirect()->away($paymentUrl);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('[OrderController@store] ERROR', [
                'msg' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    // public function confirmation(Request $request)
    // {
    //     \Log::info('[OrderController@confirmation] START', $request->all());
    //     // ตรวจสอบข้อมูลที่ได้รับจาก 2C2P
    //     $orderNo = $request->input('orderNo');
    //     $status = $request->input('status');
    //     $transactionId = $request->input('transactionId');
    //     \Log::info('[OrderController@confirmation] orderNo', ['orderNo' => $orderNo]);
    //     \Log::info('[OrderController@confirmation] status', ['status' => $status]);
    //     \Log::info('[OrderController@confirmation] transactionId', ['transactionId' => $transactionId]);
    //     if ($status !== 'SUCCESS') {
    //         \Log::warning('[OrderController@confirmation] Payment failed', ['orderNo' => $orderNo, 'status' => $status]);
    //         return redirect()->route('payment.failed')->with('error', 'การชำระเงินล้มเหลว');
    //     }
    //     // ค้นหา Order ตาม orderNo
    //     $order = Order::where('order_number', $orderNo)->first();
    //     if (!$order) {
    //         \Log::error('[OrderController@confirmation] Order not found', ['orderNo' => $orderNo]);
    //         return redirect()->route('payment.failed')->with('error', 'ไม่พบคำสั่งซื้อ');
    //     }
    //     // อัพเดตสถานะการชำระเงิน
    //     $order->update([
    //         'payment_status' => 'paid',
    //         'transaction_id' => $transactionId,
    //     ]);
    //     \Log::info('[OrderController@confirmation] Order updated', $order->toArray());
    //     // แสดงหน้าสำเร็จ
    //     return redirect()->route('payment.success')->with('success', 'การชำระเงินสำเร็จ');

    // }

}
