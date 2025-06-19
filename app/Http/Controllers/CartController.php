<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Provinces;
use App\Models\Amphures;
use App\Models\Districts;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function headerText()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('products_id', array_keys($cart))->get()->keyBy('products_id');
        $headerCartTotal = 0;
        $headerCartQty = 0;

        foreach ($cart as $pid => $qty) {
            $product = $products[$pid] ?? null;
            if (!$product) continue;
            $price = $product->products_price_promotion ?: $product->products_price_full;
            $headerCartTotal += $price * $qty;
            $headerCartQty += $qty;
        }

        // render html แบบเดียวกับใน inc_menu.blade.php
        $text = $headerCartQty
            ? '฿ ' . number_format($headerCartTotal, 2) . ' (' . $headerCartQty . ')'
            : '';

        return response($text);
    }

    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('products_id', array_keys($cart))->get();
        
        if ($request->has('partial')) {
            // render เฉพาะ cart box (สำหรับ AJAX)
            return view('frontend.partials.cart_box', compact('cart', 'products'))->render();
        }
        return view('frontend.cart', compact('cart', 'products'));
    }

    public function add(Request $request)
    {
        $id = $request->input('product_id');
        $qty = (int) $request->input('quantity', 1);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['status' => false, 'msg' => 'ไม่พบสินค้า']);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id] += $qty;
        } else {
            $cart[$id] = $qty;
        }

        session(['cart' => $cart]);
        return response()->json(['status' => true, 'cart_count' => array_sum($cart)]);
    }

    public function update(Request $request)
    {
        $id = $request->input('product_id');
        $qty = max(1, (int) $request->input('quantity', 1));
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id] = $qty;
            session(['cart' => $cart]);
        }
        return response()->json(['status' => true]);
    }

    public function remove(Request $request)
    {
        $id = $request->input('product_id');
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return response()->json(['status' => true]);
    }

    public function clear()
    {
        session()->forget('cart');
        return response()->json(['status' => true]);
    }

    //checkout
    public function checkout()
    {
        $cart = session('cart', []);
        $products = \App\Models\Product::whereIn('products_id', array_keys($cart))->get()->keyBy('products_id');
        $member = auth('member')->user();

        // ดึงรายการทั้งหมด หรือ filter เฉพาะที่ตรงกับ member ก็ได้
        $provinces = Provinces::all();
        $amphures = $member && $member->province
            ? Amphures::where('province_id', $member->province)->get()
            : collect();
        $districts = $member && $member->district
            ? Districts::where('amphure_id', $member->district)->get()
            : collect();

        return view('frontend.checkout', compact('cart', 'products', 'member', 'provinces', 'amphures', 'districts'));
    }
}
