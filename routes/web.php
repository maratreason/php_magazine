<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Person\OrderController as PersonOrderController;
use App\Http\Controllers\ResetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');

Route::middleware(['auth'])->group(function() {
    Route::group([
        'prefix' => 'person',
        'as' => 'person.',
    ], function() {
        Route::get('/orders', [PersonOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [PersonOrderController::class, 'show'])->name('orders.show');
    });

    Route::group([
        'middleware' => 'auth',
        'prefix' => 'admin'
    ], function() {
        Route::group(['middleware' => 'is_admin'], function() {
            Route::get('/orders', [OrderController::class, 'index'])->name('home');
            Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
            Route::get('/reset', [ResetController::class, 'reset'])->name('reset');
        });
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
    });
});

Route::get('/', [MainController::class, 'index'])->name('index');

Route::get('/shop', [MainController::class, 'shop'])->name('shop');

Route::get('/shop/{category?}/{product?}', [MainController::class, 'product'])->name('shop-product');
Route::post('/shop/{category?}/{sortBy?}', [MainController::class, 'category'])->name('shop-category');

Route::get('/contact', [MainController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'basket'], function() {
    Route::post('/add/{id}', [BasketController::class, 'basketAdd'])->name('basket-add');
    Route::post('/confirm', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
    Route::get('/confirm', [BasketController::class, 'basketConfirmIndex'])->name('basket-confirm-index');

    Route::group([
        'middleware' => 'basket_not_empty'
    ], function() {
        Route::get('/', [BasketController::class, 'basket'])->name('basket');
        Route::get('/place', [BasketController::class, 'basketPlace'])->name('basket-place');
        Route::post('/remove/{id}', [BasketController::class, 'basketRemove'])->name('basket-remove');
        Route::get('/checkout', [BasketController::class, 'basketCheckout'])->name('basket-checkout');
    });

});
