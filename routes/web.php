<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminSearchController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminTaskController;
use App\Http\Controllers\User\AddresseController;
use App\Http\Controllers\Admin\AdminSupportController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('user.home.index');
Route::get('/about', [HomeController::class, 'about'])->name('user.about');

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
    Route::get('/account-details', [UserController::class, 'details'])->name('user.details');
    Route::put('/account-details', [UserController::class, 'updateDetails'])->name('user.details.update');

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
    Route::get('/orders', [OrderController::class, 'userOrders'])->name('user.orders');
    Route::get('/orders/{order_id}', [OrderController::class, 'userOrderDetails'])->name('user.orders.show');
    Route::put('/orders/cancel-order', [OrderController::class, 'cancelOrder'])->name('user.order.cancel');
    Route::put('/orders/return-item', [OrderController::class, 'returnItem'])->name('user.order.item.return');
    Route::put('/orders/received-item', [OrderController::class, 'receivedItem'])->name('user.order.item.received');

    //user contact routes
    Route::get('/contact', [ContactController::class, 'contactUser'])->name('user.contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('user.contact.store');
    Route::get('/contact/history', [ContactController::class, 'userMessages'])->name('user.contact.history');

    //user address routes
    Route::get('/address', [AddresseController::class, 'index'])->name('user.address');
    Route::get('/address/create', [AddresseController::class, 'create'])->name('user.address.create');
    Route::post('/address/store', [AddresseController::class, 'store'])->name('user.address.store');
    Route::get('/address/edit/{address}', [AddresseController::class, 'edit'])->name('user.address.edit');
    Route::put('/address/update/{address}', [AddresseController::class, 'update'])->name('user.address.update');
    Route::delete('/address/destroy/{address}', [AddresseController::class, 'destroy'])->name('user.address.destroy');
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
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{order_id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/admin/orders/update-status', [AdminOrderController::class, 'update_status'])->name('admin.orders.status.update');

    // slide routes
    Route::get('/admin/slides', [SlideController::class, 'index'])->name('admin.slides');
    Route::get('/admin/slides/create', [SlideController::class, 'create'])->name('admin.slides.create');
    Route::post('/admin/slides/store', [SlideController::class, 'store'])->name('admin.slides.store');
    Route::get('/admin/slides/edit/{id}', [SlideController::class, 'edit'])->name('admin.slides.edit');
    Route::put('/admin/slides/update', [SlideController::class, 'update'])->name('admin.slides.update');
    Route::delete('/admin/slides/{id}', [SlideController::class, 'destroy'])->name('admin.slides.destroy');

    // user routes
    Route::get('/admin/users', [AdminUserController::class, 'userAdmin'])->name('admin.users');
    Route::get('/admin/users/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.users.edit')->middleware('AuthOwner');
    Route::put('/admin/users/update/{id}', [AdminUserController::class, 'update'])->name('admin.users.update')->middleware('AuthOwner');

    Route::get('/admin/users/blocked', [AdminUserController::class, 'blockedUsers'])->name('admin.users.blocked');
    Route::get('/admin/users/block/{id}', [AdminUserController::class, 'block'])->name('admin.users.block');
    Route::put('/admin/users/block/{id}', [AdminUserController::class, 'storeBlock'])->name('admin.users.store-block');
    Route::put('/admin/users/unblock/{id}', [AdminUserController::class, 'unblock'])->name('admin.users.unblock');

    // setting routes
    Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings', [SettingController::class, 'store'])->name('admin.settings.store');
    // search routes
    Route::get('/admin/search', [AdminSearchController::class, 'search'])->name('admin.search');
    // profile routes
    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'store'])->name('admin.profile.store');
    // contact routes
    Route::get('/admin/contacts', [AdminContactController::class, 'index'])->name('admin.contacts');
    Route::get('/admin/contacts/{id}/reply', [AdminContactController::class, 'reply'])->name('admin.contacts.reply');
    Route::put('/admin/contacts/{id}/reply', [AdminContactController::class, 'updateReply'])->name('admin.contacts.reply.update');
    Route::delete('/admin/contacts/{id}/delete', [AdminContactController::class, 'destroy'])->name('admin.contacts.delete');
    //notification routes
    Route::get('/admin/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications');
    Route::get('/admin/notifications/{id}/read', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.read');
    //task routes
    Route::get('/admin/taskboard', [AdminTaskController::class, 'index'])->name('admin.taskboard');
    Route::post('/admin/taskboard/store', [AdminTaskController::class, 'store'])->name('admin.taskboard.store');
    Route::put('/admin/taskboard/{id}/update', [AdminTaskController::class, 'update'])->name('admin.taskboard.update');
    Route::delete('/admin/taskboard/{id}/delete', [AdminTaskController::class, 'destroy'])->name('admin.taskboard.delete');
    //support routes
    Route::get('/admin/support', [AdminSupportController::class, 'index'])->name('admin.support');
    Route::put('/admin/support/{id}/update', [AdminSupportController::class, 'update'])->name('admin.support.update');
    Route::delete('/admin/support/{id}/delete', [AdminSupportController::class, 'destroy'])->name('admin.support.delete');
});
