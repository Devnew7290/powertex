<?php

use Illuminate\Support\Facades\Route;

Route::prefix('backend')->group(function () {

    Route::get('/', function () {
        return redirect()->route('back.login');
    });

    // ฟอร์ม login
    Route::get('login', [App\Http\Controllers\backend\LoginController::class, 'showLoginForm'])->name('back.login');
    // process login
    Route::post('login', [App\Http\Controllers\backend\LoginController::class, 'login'])->name('login');
    // logout
    Route::post('logout', [App\Http\Controllers\backend\LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:Super Admin|Developer'])->prefix('backend')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\backend\UserController::class, 'index'])->name('backend.users.index');
        Route::get('/create', [App\Http\Controllers\backend\UserController::class, 'create'])->name('backend.users.create');
        Route::post('/', [App\Http\Controllers\backend\UserController::class, 'store'])->name('backend.users.store');
        Route::get('/{user}/edit', [App\Http\Controllers\backend\UserController::class, 'edit'])->name('backend.users.edit');
        Route::put('/{user}', [App\Http\Controllers\backend\UserController::class, 'update'])->name('backend.users.update');
        Route::delete('/{user}', [App\Http\Controllers\backend\UserController::class, 'destroy'])->name('backend.users.destroy');
    });
});

// Route::middleware(['auth', 'role:Editor'])->prefix('backend')->group(function () {
//     Route::prefix('users')->group(function () {
//         Route::get('/', [App\Http\Controllers\backend\UserController::class, 'index'])->name('backend.users.index');
//         Route::get('/create', [App\Http\Controllers\backend\UserController::class, 'create'])->name('backend.users.create');
//         Route::post('/', [App\Http\Controllers\backend\UserController::class, 'store'])->name('backend.users.store');
//         Route::get('/{user}/edit', [App\Http\Controllers\backend\UserController::class, 'edit'])->name('backend.users.edit');
//         Route::put('/{user}', [App\Http\Controllers\backend\UserController::class, 'update'])->name('backend.users.update');
//         Route::delete('/{user}', [App\Http\Controllers\backend\UserController::class, 'destroy'])->name('backend.users.destroy');
//     });
// });

Route::middleware(['auth', 'role:Super Admin|Developer|Editor'])->prefix('backend')->group(function() {

    // Route::prefix('backend')->group(function () {

        // Route::get('login', [App\Http\Controllers\backend\HomePageController::class, 'back_login'])->name('back.login');

        Route::prefix('home')->group(function () {

            Route::prefix('banner')->group(function () {
                Route::get('/', [App\Http\Controllers\backend\HomePageController::class, 'banner_index'])->name('home.banner.index');
                Route::get('/form', [App\Http\Controllers\backend\HomePageController::class, 'banner_form'])->name('home.banner.form');
                Route::post('/create', [App\Http\Controllers\backend\HomePageController::class, 'banner_create'])->name('home.banner.create');
                Route::get('/edit/{id}', [App\Http\Controllers\backend\HomePageController::class, 'banner_edit'])->name('home.banner.edit');
                Route::post('/update/{id}', [App\Http\Controllers\backend\HomePageController::class, 'banner_update'])->name('home.banner.update');
                Route::get('/delete/{id}', [App\Http\Controllers\backend\HomePageController::class, 'banner_delete'])->name('home.banner.delete');
                Route::post('/change/{id}', [App\Http\Controllers\backend\HomePageController::class, 'banner_change'])->name('home.banner.change');                
            });

            Route::prefix('powertex')->group(function () {
                Route::get('/', [App\Http\Controllers\backend\HomePageController::class, 'powertex_index'])->name('home.powertex.index');
                Route::get('/form', [App\Http\Controllers\backend\HomePageController::class, 'powertex_form'])->name('home.powertex.form');
                Route::post('/create', [App\Http\Controllers\backend\HomePageController::class, 'powertex_create'])->name('home.powertex.create');
                Route::get('/edit/{id}', [App\Http\Controllers\backend\HomePageController::class, 'powertex_edit'])->name('home.powertex.edit');
                Route::post('/update/{id}', [App\Http\Controllers\backend\HomePageController::class, 'powertex_update'])->name('home.powertex.update');
            });

            Route::prefix('why')->group(function () {
                Route::get('/', [App\Http\Controllers\backend\HomePageController::class, 'why_index'])->name('home.why.index');
                Route::get('/form', [App\Http\Controllers\backend\HomePageController::class, 'why_form'])->name('home.why.form');
                Route::post('/create', [App\Http\Controllers\backend\HomePageController::class, 'why_create'])->name('home.why.create');
                Route::get('/edit/{id}', [App\Http\Controllers\backend\HomePageController::class, 'why_edit'])->name('home.why.edit');
                Route::post('/update/{id}', [App\Http\Controllers\backend\HomePageController::class, 'why_update'])->name('home.why.update');
                Route::get('/warranty/delete/{id}', [App\Http\Controllers\backend\HomePageController::class, 'why_warranty_delete'])->name('home.why.warranty.delete');
                
            });

            Route::prefix('text-header')->group(function () {
                Route::get('/', [App\Http\Controllers\backend\HomePageController::class, 'text_index'])->name('home.text.index');
                Route::get('/form', [App\Http\Controllers\backend\HomePageController::class, 'text_form'])->name('home.text.form');
                Route::post('/create', [App\Http\Controllers\backend\HomePageController::class, 'text_create'])->name('home.text.create');
                Route::get('/edit/{id}', [App\Http\Controllers\backend\HomePageController::class, 'text_edit'])->name('home.text.edit');
                Route::post('/update/{id}', [App\Http\Controllers\backend\HomePageController::class, 'text_update'])->name('home.text.update');
                Route::post('/change/{id}', [App\Http\Controllers\backend\HomePageController::class, 'text_change'])->name('home.text.change');                
            });

        });

        Route::prefix('news_promotion')->group(function () {
            Route::prefix('{type}')->group(function () {
                Route::get('/', [App\Http\Controllers\backend\NewsController::class, 'news_promotion_index'])->name('back.news.promotion.index');
                Route::get('/form', [App\Http\Controllers\backend\NewsController::class, 'news_promotion_form'])->name('back.news.promotion.form');
                Route::post('/create', [App\Http\Controllers\backend\NewsController::class, 'news_promotion_create'])->name('back.news.promotion.create');
                Route::get('/edit/{id}', [App\Http\Controllers\backend\NewsController::class, 'news_promotion_edit'])->name('back.news.promotion.edit');
                Route::post('/update/{id}', [App\Http\Controllers\backend\NewsController::class, 'news_promotion_update'])->name('back.news.promotion.update');
                Route::get('/delete/{id}', [App\Http\Controllers\backend\NewsController::class, 'news_promotion_delete'])->name('back.news.promotion.delete');
                Route::get('/image/delete/{id}', [App\Http\Controllers\backend\NewsController::class, 'news_promotion_image_delete'])->name('back.news.promotion.image.delete');
            });
        });

        Route::prefix('promotion')->group(function () {
            Route::get('/', [App\Http\Controllers\backend\NewsController::class, 'promotion_index'])->name('back.promotion.index');
            Route::get('/form', [App\Http\Controllers\backend\NewsController::class, 'promotion_form'])->name('back.promotion.form');
            Route::post('/create', [App\Http\Controllers\backend\NewsController::class, 'promotion_create'])->name('back.promotion.create');
            Route::get('/edit/{id}', [App\Http\Controllers\backend\NewsController::class, 'promotion_edit'])->name('back.promotion.edit');
            Route::post('/update/{id}', [App\Http\Controllers\backend\NewsController::class, 'promotion_update'])->name('back.promotion.update');
            Route::get('/delete/{id}', [App\Http\Controllers\backend\NewsController::class, 'promotion_delete'])->name('back.promotion.delete');
            Route::get('/image/delete/{id}', [App\Http\Controllers\backend\NewsController::class, 'promotion_image_delete'])->name('back.promotion.image.delete');
            Route::post('/change/{id}', [App\Http\Controllers\backend\NewsController::class, 'promotion_change'])->name('back.promotion.change');
        });

        Route::prefix('promocode')->group(function () {
            Route::get('/', [App\Http\Controllers\backend\NewsController::class, 'promocode_index'])->name('back.promocode.index');
            Route::get('/form', [App\Http\Controllers\backend\NewsController::class, 'promocode_form'])->name('back.promocode.form');
            Route::post('/create', [App\Http\Controllers\backend\NewsController::class, 'promocode_create'])->name('back.promocode.create');
            Route::get('/edit/{id}', [App\Http\Controllers\backend\NewsController::class, 'promocode_edit'])->name('back.promocode.edit');
            Route::post('/update/{id}', [App\Http\Controllers\backend\NewsController::class, 'promocode_update'])->name('back.promocode.update');
            Route::get('image/delete/{id}', [App\Http\Controllers\backend\NewsController::class, 'promocode_image_delete'])->name('back.promocode.image.delete');
            Route::get('/delete/{id}', [App\Http\Controllers\backend\NewsController::class, 'promocode_delete'])->name('back.promocode.delete');
            Route::post('/change/{id}', [App\Http\Controllers\backend\NewsController::class, 'promocode_change'])->name('back.promocode.change');
        });

        Route::prefix('product')->group(function () {

            Route::prefix('brand')->group(function () {
                Route::get('/', [App\Http\Controllers\backend\ProductController::class, 'brand_index'])->name('product.brand.index');
                Route::get('/form', [App\Http\Controllers\backend\ProductController::class, 'brand_form'])->name('product.brand.form');
                Route::post('/create', [App\Http\Controllers\backend\ProductController::class, 'brand_create'])->name('product.brand.create');
                Route::get('/edit/{id}', [App\Http\Controllers\backend\ProductController::class, 'brand_edit'])->name('product.brand.edit');
                Route::post('/update/{id}', [App\Http\Controllers\backend\ProductController::class, 'brand_update'])->name('product.brand.update');
                Route::get('/delete/{id}', [App\Http\Controllers\backend\ProductController::class, 'brand_delete'])->name('product.brand.delete');
                Route::get('/image/delete/{id}', [App\Http\Controllers\backend\ProductController::class, 'brand_image_delete'])->name('product.brand.image.delete');
                Route::post('/change/{id}', [App\Http\Controllers\backend\ProductController::class, 'brand_change'])->name('product.brand.change');
            });

            Route::prefix('type')->group(function () {
                Route::get('/', [App\Http\Controllers\backend\ProductController::class, 'product_type_index'])->name('back.product.type.index');
                Route::get('/form', [App\Http\Controllers\backend\ProductController::class, 'product_type_form'])->name('back.product.type.form');
                Route::post('/create', [App\Http\Controllers\backend\ProductController::class, 'product_type_create'])->name('back.product.type.create');
                Route::get('/edit/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_edit'])->name('back.product.type.edit');
                Route::post('/update/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_update'])->name('back.product.type.update');
                Route::get('/delete/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_delete'])->name('back.product.type.delete');
                Route::post('/change/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_change'])->name('back.product.type.change');
                
                Route::prefix('sub')->group(function () {
                    Route::get('/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_sub_index'])->name('back.product.type.sub.index');
                    Route::get('/form/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_sub_form'])->name('back.product.type.sub.form');
                    Route::post('/create/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_sub_create'])->name('back.product.type.sub.create');
                    Route::get('/edit/{type}/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_sub_edit'])->name('back.product.type.sub.edit');
                    Route::post('/update/{type}/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_sub_update'])->name('back.product.type.sub.update');
                    Route::get('/delete/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_sub_delete'])->name('back.product.type.sub.delete');
                    Route::post('/change/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_sub_change'])->name('back.product.type.sub.change');
                    Route::get('/third/delete/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_type_third_delete'])->name('back.product.type.third.delete');
                });
            });

            Route::prefix('detail')->group(function () {
                Route::get('/', [App\Http\Controllers\backend\ProductController::class, 'product_index'])->name('back.product.index');
                Route::get('/form', [App\Http\Controllers\backend\ProductController::class, 'product_form'])->name('back.product.form');
                Route::post('/create', [App\Http\Controllers\backend\ProductController::class, 'product_create'])->name('back.product.create');
                Route::get('/edit/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_edit'])->name('back.product.edit');
                Route::post('/update/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_update'])->name('back.product.update');
                Route::get('/image/delete/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_image_delete'])->name('back.product.image.update');
                Route::get('/delete/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_delete'])->name('back.product.delete');
                Route::post('/change/{id}', [App\Http\Controllers\backend\ProductController::class, 'product_change'])->name('back.product.change');
            });
        });

        Route::prefix('dealer')->group(function () {
            Route::get('/', [App\Http\Controllers\backend\DealerController::class, 'dealer_index'])->name('back.dealer.index');
            Route::get('/form', [App\Http\Controllers\backend\DealerController::class, 'dealer_form'])->name('back.dealer.form');
            Route::post('/create', [App\Http\Controllers\backend\DealerController::class, 'dealer_create'])->name('back.dealer.create');
            Route::get('/edit/{id}', [App\Http\Controllers\backend\DealerController::class, 'dealer_edit'])->name('back.dealer.edit');
            Route::post('/update/{id}', [App\Http\Controllers\backend\DealerController::class, 'dealer_update'])->name('back.dealer.update');
            Route::get('/delete/{id}', [App\Http\Controllers\backend\DealerController::class, 'dealer_delete'])->name('back.dealer.delete');
            Route::post('/change/{id}', [App\Http\Controllers\backend\DealerController::class, 'dealer_change'])->name('back.dealer.change');
        });

        Route::prefix('contact')->group(function () {
            Route::get('/', [App\Http\Controllers\backend\ContactController::class, 'contact_index'])->name('back.contact.index');
            Route::get('/form', [App\Http\Controllers\backend\ContactController::class, 'contact_form'])->name('back.contact.form');
            Route::post('/create', [App\Http\Controllers\backend\ContactController::class, 'contact_create'])->name('back.contact.create');
            Route::get('/edit/{id}', [App\Http\Controllers\backend\ContactController::class, 'contact_edit'])->name('back.contact.edit');
            Route::post('/update/{id}', [App\Http\Controllers\backend\ContactController::class, 'contact_update'])->name('back.contact.update');
        });

        Route::prefix('repairs')->group(function () {
            Route::get('/', [App\Http\Controllers\backend\ServiceWarrantyController::class, 'repairs_index'])->name('back.repairs.index');
            Route::get('/{id}', [App\Http\Controllers\backend\ServiceWarrantyController::class, 'repairs_data'])->name('back.repairs.data');
            Route::post('/update/{id}', [App\Http\Controllers\backend\ServiceWarrantyController::class, 'repairs_update'])->name('back.repairs.update');
        });

        Route::prefix('warranty')->group(function () {
            Route::get('/', [App\Http\Controllers\backend\ServiceWarrantyController::class, 'warranty_index'])->name('back.warranty.index');
            Route::get('/{id}', [App\Http\Controllers\backend\ServiceWarrantyController::class, 'warranty_data'])->name('back.warranty.data');
            Route::post('/update/{id}', [App\Http\Controllers\backend\ServiceWarrantyController::class, 'warranty_update'])->name('back.warranty.update');
        });

        Route::prefix('catalog')->group(function () {
            Route::get('/', [App\Http\Controllers\backend\ProductController::class, 'catalog_index'])->name('back.catalog.index');
            Route::get('/form', [App\Http\Controllers\backend\ProductController::class, 'catalog_form'])->name('back.catalog.form');
            Route::post('/create', [App\Http\Controllers\backend\ProductController::class, 'catalog_create'])->name('back.catalog.create');
            Route::get('/edit/{id}', [App\Http\Controllers\backend\ProductController::class, 'catalog_edit'])->name('back.catalog.edit');
            Route::post('/update/{id}', [App\Http\Controllers\backend\ProductController::class, 'catalog_update'])->name('back.catalog.update');
            Route::get('/delete/{id}', [App\Http\Controllers\backend\ProductController::class, 'catalog_delete'])->name('back.catalog.delete');
        });

        Route::prefix('ajax')->group(function () {
            Route::post('/sub/category', [App\Http\Controllers\backend\ProductController::class, 'ajax_sub_category'])->name('ajax.sub.category');
            Route::post('/third/category', [App\Http\Controllers\backend\ProductController::class, 'ajax_third_category'])->name('ajax.third.category');

            Route::post('/amphures', [App\Http\Controllers\backend\DealerController::class, 'ajax_amphures'])->name('ajax.amphures');
            Route::post('/districts', [App\Http\Controllers\backend\DealerController::class, 'ajax_districts'])->name('ajax.districts');
        });
    // });
    

});


?>