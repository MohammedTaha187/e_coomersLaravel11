<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SlideController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('user.home.index');

//shop routes
Route::get('/shop', [ShopController::class, 'index'])->name('user.shop.index');
Route::get('/shop/{product_slug}', [ShopController::class, 'productDetails'])->name('user.shop.product-details');

//cart routes
Route::get('/cart', [CartController::class, 'index'])->name('user.cart.index');
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('user.cart.add');
Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('user.cart.qty.increase');
Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('user.cart.qty.decrease');
Route::delete('/cart/remove', [CartController::class, 'remove_to_cart'])->name('user.cart.remove');
Route::delete('/cart/remove', [CartController::class, 'remove_to_cart'])->name('user.cart.remove');
Route::delete('/cart/empty', [CartController::class, 'empty_cart'])->name('user.cart.empty');
Route::post('/cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name('user.cart.coupon.apply');
Route::delete('/cart/remove-coupon', [CartController::class, 'remove_coupon_code'])->name('user.cart.coupon.remove');


Route::middleware(['auth'])->group(function () {
    //user routes
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');

    //user wishlist routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('user.wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('user.wishlist.store');
    Route::delete('/wishlist/remove/{rowId}', [WishlistController::class, 'destroy'])->name('user.wishlist.destroy');
    Route::delete('/wishlist/empty', [WishlistController::class, 'empty'])->name('user.wishlist.empty');
    Route::post('/wishlist/move-to-cart/{rowId}', [WishlistController::class, 'moveToCart'])->name('user.wishlist.move.to.cart');

    //user checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('user.checkout.index');
    Route::post('/place-order', [CheckoutController::class, 'place_order'])->name('user.checkout.place_order');

    //user orders routes
    Route::get('/orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/orders/{order_id}', [UserController::class, 'show'])->name('user.orders.show');
    Route::put('/orders/cancel-order', [UserController::class, 'cancel_order'])->name('user.order.cancel');
    Route::put('/orders/return-item', [UserController::class, 'return_item'])->name('user.order.item.return');
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

    // coupon routes
    Route::get('/admin/coupons', [CouponController::class, 'index'])->name('admin.coupons');
    Route::get('/admin/coupons/create', [CouponController::class, 'create'])->name('admin.coupons.create');
    Route::post('/admin/coupons/store', [CouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/admin/coupons/edit/{coupon}', [CouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::put('/admin/coupons/update/{coupon}', [CouponController::class, 'update'])->name('admin.coupons.update');
    Route::delete('/admin/coupons/destroy/{coupon}', [CouponController::class, 'destroy'])->name('admin.coupons.destroy');
    Route::get('/admin/coupons/search', [CouponController::class, 'search'])->name('admin.coupons.search');

    // order routes
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{order_id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/admin/orders/update-status', [OrderController::class, 'update_status'])->name('admin.orders.status.update');

    // slide routes
    Route::get('/admin/slides', [SlideController::class, 'index'])->name('admin.slides');
    Route::get('/admin/slides/create', [SlideController::class, 'create'])->name('admin.slides.create');
    Route::post('/admin/slides/store', [SlideController::class, 'store'])->name('admin.slides.store');
    Route::get('/admin/slides/edit/{id}', [SlideController::class, 'edit'])->name('admin.slides.edit');
    Route::put('/admin/slides/update', [SlideController::class, 'update'])->name('admin.slides.update');
    Route::delete('/admin/slides/{id}', [SlideController::class, 'destroy'])->name('admin.slides.destroy');
});
