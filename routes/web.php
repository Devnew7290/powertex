<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Member\LoginController;
use App\Http\Controllers\Member\RegisterController;
use App\Services\PaymentGateway2C2PService;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MemberOrderController;
use App\Http\Controllers\MemberAddressController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "All is cleared";
});
// Route::get('/test-payment-2c2p', function() {
//     $service = new PaymentGateway2C2PService();
//     // ทดสอบด้วยเลข order และยอดเงินสมมติ (เปลี่ยนค่าได้)
//     $orderNo = 'PTE' . date('ymdHis');
//     $amount = 3000.00;
//     try {
//         $url = $service->getPaymentPageUrl($orderNo, $amount);
//         return redirect()->away($url); // ทดสอบจริง (จะถูก redirect ไปหน้า payment gateway)
//     } catch (\Exception $e) {
//         return $e->getMessage();
//     }
// });

Route::get('/payment/confirmation', [PaymentController::class, 'confirmation'])->name('payment.confirmation');
Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
Route::get('/payment/cancelled', [PaymentController::class, 'cancelled'])->name('payment.cancelled');
Route::post('/payment/webhook', [PaymentController::class, 'webhook'])->name('payment.webhook');

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('index');
Route::get('about-us/{text_url}', [App\Http\Controllers\FrontendController::class, 'aboutUs'])->name('aboutUs');
Route::get('products/{id}/{text_url}', [App\Http\Controllers\FrontendController::class, 'product'])->name('product');
Route::get('products/{text_url}', [App\Http\Controllers\FrontendController::class, 'product_new_promotion'])->name('product.new.promotion');
// Route::post('product/search/', [App\Http\Controllers\FrontendController::class, 'product_search'])->name('product.search');
Route::get('/search', [App\Http\Controllers\FrontendController::class, 'search'])->name('search');
Route::get('product/detail/{id}/{text_url}', [App\Http\Controllers\FrontendController::class, 'product_detail'])->name('product.detail');
// Route::get('product-detail', [App\Http\Controllers\FrontendController::class, 'product_detail'])->name('product.detail');

// Route::get('promotion-detail/{id}/{text_url}', [App\Http\Controllers\FrontendController::class, 'promotion_detail'])->name('promotion.detail');
Route::get('news/{type}', [App\Http\Controllers\FrontendController::class, 'news'])->name('news');
Route::get('news-detail/{type}/{id}/{text_url}', [App\Http\Controllers\FrontendController::class, 'newsDetail'])->name('news.detail');

Route::get('one-stop-service', [App\Http\Controllers\FrontendController::class, 'service'])->name('service');
Route::post('one-stop-service/create/', [App\Http\Controllers\FrontendController::class, 'service_create'])->name('service.create');

Route::get('distributor', [App\Http\Controllers\FrontendController::class, 'distributor'])->name('distributor');
Route::get('contact/{text_url}', [App\Http\Controllers\FrontendController::class, 'contact'])->name('contact');

Route::get('warranty', [App\Http\Controllers\FrontendController::class, 'warranty'])->name('warranty');
Route::post('warranty/create/', [App\Http\Controllers\FrontendController::class, 'warranty_create'])->name('warranty.create');

// Route::get('frontend/login', [App\Http\Controllers\FrontendController::class, 'login'])->name('login');
// Route::get('register/customer', [App\Http\Controllers\FrontendController::class, 'register'])->name('register');
Route::get('/cart/header-text', [\App\Http\Controllers\CartController::class, 'headerText'])->name('cart.header_text');


Route::get('privacy_policy', [App\Http\Controllers\FrontendController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('terms_service', [App\Http\Controllers\FrontendController::class, 'terms_service'])->name('terms_service');

Route::prefix('member')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('member.login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('member.logout');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('member.register');
    Route::post('/register', [RegisterController::class, 'register']);


    Route::middleware('auth:member')->group(function () {
        //cart
        Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/update', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
        Route::post('/cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');

        Route::get('checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
        Route::post('order/store', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');

        // หน้าแสดงรายการออเดอร์ทั้งหมดของสมาชิก
        Route::get('orders', [MemberOrderController::class, 'index'])->name('member.orders');
        // หน้าแสดงรายละเอียดออเดอร์ (รับพารามิเตอร์ id)
        Route::get('orders/{order}', [MemberOrderController::class, 'show'])->name('member.orders.show');
        
        // Route::get('member-address', [App\Http\Controllers\FrontendController::class, 'member_address'])->name('member.address');
        // Route::get('member-address-edit', [App\Http\Controllers\FrontendController::class, 'member_address_edit'])->name('member.address.edit');
        Route::get('member-change-password', [App\Http\Controllers\FrontendController::class, 'showChangePasswordForm'])->name('member.password.form');
        Route::post('member-change-password', [App\Http\Controllers\FrontendController::class, 'changePassword'])->name('member.password.update');

        Route::get ('member-address', [MemberAddressController::class,'index'])->name('member.address');
        Route::get ('member-address/add', [MemberAddressController::class,'create'])->name('member.address.add');
        Route::post('member-address', [MemberAddressController::class,'store'])->name('member.address.store');
        Route::get ('member-address/{address}/edit', [MemberAddressController::class,'edit'])->name('member.address.edit');
        Route::put ('member-address/{address}', [MemberAddressController::class,'update'])->name('member.address.update');
        Route::delete('member-address/{address}', [MemberAddressController::class,'destroy'])->name('member.address.destroy');
        Route::post('member-address/{address}/default', [MemberAddressController::class,'setDefault'])->name('member.address.default');
    });
});

Route::get('/ajax/amphures/{province_id}', [\App\Http\Controllers\LocationController::class, 'getAmphures']);
Route::get('/ajax/districts/{amphure_id}', [\App\Http\Controllers\LocationController::class, 'getDistricts']);
Route::get('/ajax/zipcode/{district_id}', [\App\Http\Controllers\LocationController::class, 'getZipcode']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

include('backend.php');
