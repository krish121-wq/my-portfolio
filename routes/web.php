<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainAuthController;
use App\Http\Controllers\MainadminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminAuth;

Route::controller(MainAuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::get('signup', 'signup')->name('signup');
    Route::post('post_login', 'post_login')->name('post_login');
    Route::post('post_registration', 'post_registration')->name('post_registration');
    Route::post('logout', 'logout')->name('logout');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('index', [HomeController::class, 'index'])->name('index');

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'show')->name('contact');
    Route::post('/contact', 'contactadd')->name('contact.store');
});

Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/product/category/{id}', 'ProductByCategory')->name('category.shop');
});

Route::get('carts', [CartsController::class, 'index'])->name('carts');
Route::post('/carts/add', [CartsController::class, 'addtocart'])->name('cart.add');
Route::get('/deletecarts/{id}', [CartsController::class, 'deleteCarts'])->middleware('auth');

Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/add', [WishlistController::class, 'addtowishlist'])->name('wishlist.add');
Route::get('/delete-wishlist/{id}', [WishlistController::class, 'deleteWishlist'])->name('deleteWishlist');

Route::patch('/update-cart-ajax', [CartController::class, 'updateCartAjax'])->name('cart.update.ajax');
Route::get('single-product', function () {
    return view('main.single-product');
})->name('single-product');


Route::prefix('admin')->group(function () {

    Route::controller(MainadminController::class)->group(function () {
        Route::get('login', 'login')->name('admin.auth.login'); 
        Route::get('signup', 'signup')->name('admin.auth.signup');
        Route::post('post_login', 'post_login')->name('admin.post_login');
        Route::post('post_registration', 'post_registration')->name('admin.post_registration');
        Route::post('logout', 'logout')->name('admin.logout');
    });

    Route::middleware([AdminAuth::class])->group(function () {
        Route::view('/', 'admin.index')->name('admin.dashboard');
        Route::resource('category', CategoryController::class);
        Route::resource('product', ProductController::class);
    });

});