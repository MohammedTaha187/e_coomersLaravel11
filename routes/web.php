<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('user.home.index');

Route::get('/shop', [ShopController::class, 'index'])->name('user.shop.index');
Route::get('/shop/{product_slug}', [ShopController::class, 'productDetails'])->name('user.shop.product-details');

Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    // dashboard route
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // brand routes
    Route::get('/admin/brands', [BrandController::class, 'index'])->name('admin.brands');
    Route::get('/admin/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
    Route::post('/admin/brands/store', [BrandController::class, 'store'])->name('admin.brands.store');
    Route::get('/admin/brands/edit/{brand}', [BrandController::class, 'edit'])->name('admin.brands.edit');
    Route::put('/admin/brands/update/{brand}', [BrandController::class, 'update'])->name('admin.brands.update');
    Route::delete('/admin/brands/destroy/{brand}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');
    Route::get('/admin/brands/search', [BrandController::class, 'search'])->name('admin.brands.search');

    // category routes
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/update/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/admin/categories/search', [CategoryController::class, 'search'])->name('admin.categories.search');

    // product routes
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/update/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/destroy/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/admin/products/search', [ProductController::class, 'search'])->name('admin.products.search');
    Route::get('/admin/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    // gallery routes
    Route::post('admin/products/{product}/gallery', [GalleryController::class, 'store'])->name('admin.galleries.store');
    Route::delete('admin/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('admin.galleries.destroy');

    // order routes
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
});
