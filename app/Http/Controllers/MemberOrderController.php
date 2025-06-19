<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MemberOrderController extends Controller
{
    // แสดงรายการออเดอร์ทั้งหมดของสมาชิกปัจจุบัน
    public function index()
    {
        $memberId = auth('member')->id();

        $orders = Order::where('member_id', $memberId)
                       ->orderBy('order_date', 'desc')
                       ->get();

        return view('frontend.member-order', compact('orders'));
    }

    // แสดงรายละเอียดออเดอร์แต่ละชิ้น
    public function show(Order $order)
    {
        // ป้องกันไม่ให้ดูออเดอร์คนอื่น
        $this->authorize('view', $order);

        // eager load items
        $order->load('items');

        return view('frontend.member-order-detail', compact('order'));
    }
}
