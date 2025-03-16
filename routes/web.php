<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\CartController;

use App\Http\Controllers\DiscountController;

use App\Http\Controllers\CouponController;

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\SelectionController;

use App\Http\Controllers\UnregisteredOrderController;



use App\Http\Controllers\ProductImageController;

use App\Http\Controllers\ContactController;

Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('send.email');

// Route::resource('product-images', ProductImageController::class);

Route::get('/product-selection', function () {
    return view('product_selection');
});

Route::post('/product/{id}/select', [SelectionController::class, 'handleProductSelection'])->name('handleProductSelection');

Route::post('/complete-purchase', [SelectionController::class, 'storeDirect'])->name('storeDirect');

Route::get('/my-orders/{id}', [OrderController::class, 'show'])->name('order.show')->middleware('auth');
Route::get('/my-orders', [OrderController::class, 'myorders'])->name('my.orders')->middleware('auth');

Route::group([], function () {
    Route::get('/coupons/create', function () {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return app(CouponController::class)->create();
    })->name('coupon.create');

    Route::post('/coupons/add', function () {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return app(CouponController::class)->store(request());
    })->name('coupon.store');

    Route::get('/coupons', function () {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return app(CouponController::class)->index();
    })->name('coupon.list');

    Route::get('/coupons/edit/{id}', function ($id) {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return app(CouponController::class)->edit($id);
    })->name('coupon.edit');

    Route::put('/coupons/update/{id}', function ($id) {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return app(CouponController::class)->update(request(), $id);
    })->name('coupon.update');

    Route::delete('/coupons/delete/{id}', function ($id) {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return app(CouponController::class)->destroy($id);
    })->name('coupon.delete');

    Route::post('/apply-coupon', function () {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return app(CouponController::class)->applyCoupon(request());
    })->name('apply.coupon');
});

    Route::post('/orders/{id}/update', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');

    // Route::post('/unregistered-orders /{id}/update', [UnregisteredOrderController::class, 'update'])->name('unregistered-orders.index');
    Route::post('/unregistered-orders/{id}/update', [UnregisteredOrderController::class, 'update'])->name('unregistered-orders.update');

    Route::get('/cart/add/', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeItemFromCart'])->name('cart.remove');
    Route::get('/cart/checkout', [CartController::class, 'viewCheckout'])->name('cart.viewcheckout');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/mycart', [CartController::class, 'showCart']);
    Route::post('/order', [CheckoutController::class, 'store'])->name('order.complete');


// BaseController's routes
Route::get('/', [BaseController::Class, 'home'])->name('home');
Route::get('/test', [BaseController::Class, 'test'])->name('test');

Route::get('/shop', [BaseController::Class, 'shop'])->name('shop');

Route::get('/aboutus', [BaseController::Class, 'aboutus'])->name('aboutus');

Route::get('/contactus', [BaseController::Class, 'contactus'])->name('contactus');
Route::get('user/login', [BaseController::Class, 'user_login'])->name('user_login');
Route::post('user/login', [BaseController::Class, 'loginCheck'])->name('loginCheck');
Route::post('user/register', [BaseController::Class, 'user_store'])->name('user_store');
Route::get('user/logout', [BaseController::Class, 'logout'])->name('user_logout');
// Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/productview/{id}', [BaseController::Class, 'productView'])->name('productview');
// AdminController's routes
Route::get('/admin/login', [AdminController::Class, 'login'])->name('admin.login');

Route::post('/admin/login', [AdminController::Class, 'makeLogin'])->name('admin.makeLogin');
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::group(['middleware' => 'auth'], function () {

    // ProductController routes
    Route::get('/orders', [OrderController::class, 'index'])->name('order.list');
    Route::get('/directorders', [OrderController::class, 'directorders'])->name('directorder.list');

    Route::get('/admin/dashboard', [AdminController::Class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::Class, 'logout'])->name('admin.logout');

    // CategoryController route
    Route::get('/categories', [CategoryController::Class, 'index'])->name('category.list');

    Route::get('/category/add', [CategoryController::Class, 'create'])->name('category.create');

    Route::post('/category/add', [CategoryController::Class, 'store'])->name('category.store');

    Route::get('/categories/edit/{id}', [CategoryController::Class, 'edit'])->name('category.edit');
    Route::put('/categories/update/{id}', [CategoryController::Class, 'update'])->name('category.update');
    Route::post('/category/delete', [CategoryController::Class, 'destroy'])->name('category.delete');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/delete', [UserController::class, 'delete'])->name('user.delete');

    // ProductController routes
    Route::get('/products', [ProductController::class, 'index'])->name('product.list');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/edit/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete.get');
    Route::post('/product/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete.post');
    Route::get('/product/details/{id}', [ProductController::class, 'extraDetails'])->name('product.extraDetails');
    Route::post('/product/details/{id}', [ProductController::class, 'extraDetailsStore'])->name('product.extraDetailsStore');

// ProductImageController routes
Route::resource('productimages', ProductImageController::class);
// Route::delete('productimages/{productImage}', [ProductImageController::class, 'destroy'])->name('productimages.destroy');
// Route::get('/productsimages', [CategoryController::Class, 'index'])->name('productimages.list');
// Route::post('/productimages/delete', [ProductImageController::Class, 'destroy'])->name('productimages.delete');
// Route::get('/productimages', [ProductImageController::class, 'index'])->name('productimage.list');
// Route::get('/productimage/create', [ProductImageController::class, 'create'])->name('productimage.create');
// Route::post('/productimage/create', [ProductImageController::class, 'store'])->name('productimage.store');
// Route::get('/productimage/edit/{id}', [ProductImageController::class, 'edit'])->name('productimage.edit');
// Route::post('/productimage/edit/{id}', [ProductImageController::class, 'update'])->name('productimage.update');
// Route::get('/productimage/delete/{id}', [ProductImageController::class, 'destroyproductimage'])->name('productimage.delete.get');
// // Route::post('/productimage/delete/{id}', [ProductImageController::class, 'imagedelete'])->name('productimage.delete.post');
// Route::get('/productimage/details/{id}', [ProductImageController::class, 'extraDetails'])->name('productimage.extraDetails');
// Route::post('/productimage/details/{id}', [ProductImageController::class, 'extraDetailsStore'])->name('productimage.extraDetailsStore');

    Route::get('/discounts', [DiscountController::class, 'index'])->name('discount.list');

    // Route to show the form for creating a new discount
    Route::get('/discount/create', [DiscountController::class, 'create'])->name('discount.create');

    // Route to store a newly created discount
    Route::post('/discount/create', [DiscountController::class, 'store'])->name('discount.store');

    // Route to show the form for editing a specific discount
    Route::get('/discount/edit/{id}', [DiscountController::class, 'edit'])->name('discount.edit');

    // Route to update a specific discount
    Route::put('/discount/edit/{id}', [DiscountController::class, 'update'])->name('discount.update');

    // Route to delete a specific discount


    Route::get('/discount/delete/{id}', [DiscountController::class, 'discountDelete'])->name('discount.delete');
    Route::post('/discount/delete/{id}', [DiscountController::class, 'discountDelete'])->name('discount.delete');
});
