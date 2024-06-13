<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardProductController;

use App\Http\Controllers\DashboardSettingsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductGalleryController as AdminProductGalleryController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [DetailController::class, 'add'])->name('detail-add');

Route::get('/success', [CartController::class, 'success'])->name('success');

Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout-callback');

Route::get('/register/success', [RegisterController::class, 'success'])->name('success');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/{id}', [CartController::class, 'destroy'])->name('cart-delete');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])->name('dashboard-products');

    Route::get('/dashboard/products/add', [DashboardProductController::class, 'create'])->name('dashboard-products-create');
    Route::post('/dashboard/products/store', [DashboardProductController::class, 'store'])->name('dashboard-products-store');
    Route::get('/dashboard/products/detail/{id}', [DashboardProductController::class, 'detail'])->name('dashboard-products-details');
    Route::post('/dashboard/products/{id}', [DashboardProductController::class, 'update'])->name('dashboard-products-update');

    Route::post('/dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])->name('dashboard-products-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [DashboardProductController::class, 'deleteGallery'])->name('dashboard-products-gallery-delete');

    Route::get('/dashboard/transactions', [TransactionsController::class, 'index'])->name('dashboard-transactions');
    Route::get('/dashboard/transactions/{id}', [TransactionsController::class, 'detail'])->name('dashboard-transactions-details');
    Route::post('/dashboard/transactions/{id}', [TransactionsController::class, 'update'])->name('dashboard-transactions-update');

    Route::get('/dashboard/account', [DashboardSettingsController::class, 'account'])->name('dashboard-settings-account');
    Route::get('/dashboard/settings', [DashboardSettingsController::class, 'store'])->name('dashboard-settings-store');

    Route::post('/dashboard/account/{redirect}', [DashboardSettingsController::class, 'update'])->name('dashboard-settings-redirect');
});

Route::prefix('admin')
// method middleware, berbentuk array yg isinya adalah auth dan nama alias dari middleware nya yg didapt dari file app.php
->middleware(['auth', 'isAdmin'])
->group(function(){
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('category', AdminCategoryController::class);
    Route::resource('user', AdminUserController::class);
    Route::resource('product', AdminProductController::class);
    Route::resource('product-gallery', AdminProductGalleryController::class);
    Route::resource('transaction', AdminTransactionController::class);
});
// Route::get('/admin', [AdminController::class, 'index'])->name('admin-dashboard');
Auth::routes();


