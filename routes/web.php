<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\Categories;
use App\Http\Controllers\admin\DiscountCodeController;
use App\Http\Controllers\admin\HomeConroller;
use App\Http\Controllers\admin\shippingController;
use App\Http\Controllers\admin\tempImagesController;
use App\Http\Controllers\admin\subCategoryController;
use App\Http\Controllers\admin\brandsController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\ProductSubcategoryController;
use App\Http\Controllers\admin\productImageController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\frontController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\admin\orderController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\adminSettingsController;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/test', function () {
//    orderEmail(27);
// });

Route::controller(stripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});


Route::get('/', [frontController::class, 'index'])->name('home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [shopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [shopController::class, 'product'])->name('front.product');
Route::get('/cart', [cartController::class, 'cart'])->name('front.cart');
Route::post('/add-to-cart', [cartController::class, 'addToCart'])->name('front.addToCart');
Route::post('/update-cart', [cartController::class, 'updateCart'])->name('front.updateCart');
Route::delete('/remove-cart', [cartController::class, 'removeFromCart'])->name('front.remove');
Route::get('/checkout', [cartController::class, 'checkout'])->name('front.checkout');
Route::post('/process-checkout', [cartController::class, 'processCheckout'])->name('front.processCheckout');
Route::get('/thanks/{orderId}', [cartController::class, 'thankyou'])->name('front.thankyou');
Route::post('/get-order-summary', [cartController::class, 'getOrderSummary'])->name('front.summary');
Route::post('/applyDiscount', [cartController::class, 'applyDiscount'])->name('front.discount');
Route::post('/removeDiscount', [cartController::class, 'removeCoupon'])->name('remove.discount');
Route::post('/add-to-wish', [frontController::class, 'addToWishlist'])->name('front.addToWishlist');
Route::delete('/remove-product', [AuthController::class, 'removeFromWish'])->name('front.removeWish');
Route::get('/page/{slug}', [frontController::class, 'page'])->name('front.page');
Route::post('/send-contact-email', [frontController::class, 'sendContactEmail'])->name('front.sendContactEmail');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('account.forgot-password');
Route::post('/process-forgot-password', [AuthController::class, 'processForgotPassword'])->name('account.process-forgot-password');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('account.reset-password');
Route::post('/process-reset-password', [AuthController::class, 'processRestPassword'])->name('account.process-reset-password');
Route::post('/process-ratings/{id}', [HomeConroller::class, 'ratings'])->name('front.ratings');



Route::group(['prefix' => 'account'], function () { 
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::post('/processRegister', [AuthController::class, 'processRegister'])->name('account.processRegister');
        Route::get('/login', [AuthController::class, 'login'])->name('account.login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');

    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('account.logout');
        Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile');
        Route::get('/orders', [AuthController::class, 'orders'])->name('account.orders');
        Route::get('/orderDetail/{orderId}', [AuthController::class, 'orderDetail'])->name('account.orderDetail');
        Route::get('/wishlist', [AuthController::class, 'wishlists'])->name('account.wishlists');
        Route::post('/updatePersonalInfo', [AuthController::class, 'updatePersonalInfo'])->name('account.updatePersonalInfo');
        Route::post('/updateAddressInfo', [AuthController::class, 'updateAddressInfo'])->name('account.updateAddressInfo');
        Route::get('/changePassword', [AuthController::class, 'changePassword'])->name('account.changePassword');
        Route::post('/changePasswordPost', [AuthController::class, 'changePasswordPost'])->name('account.changePasswordPost');
        
    });
});


Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');

    });
    Route::group(['middleware' => 'admin.auth'], function () {

        Route::get('/dashboard', [HomeConroller::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeConroller::class, 'logout'])->name('admin.logout');

        //subcategory routes
        Route::get('/subCategory', [subCategoryController::class, 'index'])->name('subCat.index');
        Route::get('/subCategory/create', [subCategoryController::class, 'create'])->name('subCat.create');
        Route::post('/subCategory', [subCategoryController::class, 'store'])->name('subCat.store');
        Route::get('/subCategory/edit/{id}', [subCategoryController::class, 'edit'])->name('subCat.edit');
        Route::put('/subCategory/update/{id}', [subCategoryController::class, 'update'])->name('subCat.update');
        Route::delete('/subCategory/delete/{id}', [subCategoryController::class, 'destroy'])->name('subCat.destroy');

        //brands routes
        Route::get('/brands', [brandsController::class, 'index'])->name('brands.index');
        Route::get('/brands/create', [brandsController::class, 'create'])->name('brands.create');
        Route::post('/brands', [brandsController::class, 'store'])->name('brands.store');
        Route::get('/brands/edit/{id}', [brandsController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/update/{id}', [brandsController::class, 'update'])->name('brands.update');
        Route::delete('/brands/delete/{id}', [brandsController::class, 'destroy'])->name('brands.destroy');

        //products routes
        Route::get('/product', [ProductController::class, 'index'])->name('product.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/product-subCategories', [ProductSubcategoryController::class, 'index'])->name('product-sub.index');
        Route::get('/get-products', [ProductController::class, 'getProducts'])->name('products.getProducts');
        Route::get('/get-ratings', [ProductController::class, 'productRatings'])->name('products.ratings');
        Route::get('/change-rating-status', [ProductController::class, 'changeRatingStatus'])->name('admin.rating.changeStatus');


        //productimage contriller
        Route::post('/product-images/update', [productImageController::class, 'update'])->name('product-images.update');
        Route::delete('/product-images/delete', [productImageController::class, 'destroy'])->name('product-images.delete');

        //categories routes
        Route::get('/category', [Categories::class, 'index'])->name('categories.index');
        Route::get('/category/create', [Categories::class, 'create'])->name('categories.create');
        Route::post('/category', [Categories::class, 'store'])->name('categories.store');
        Route::get('/category/edit/{id}', [Categories::class, 'edit'])->name('categories.edit');
        Route::put('/category/update/{id}', [Categories::class, 'update'])->name('categories.update');
        Route::delete('/category/delete/{id}', [Categories::class, 'destroy'])->name('categories.destroy');
        Route::post('/upload-temp', [tempImagesController::class, 'create'])->name('temp-image.create');

        Route::get('/shipping/create', [shippingController::class, 'create'])->name('shipping.create');
        Route::get('/shipping', [shippingController::class, 'index'])->name('shipping.index');
        Route::post('/shipping', [shippingController::class, 'store'])->name('shipping.store');
        Route::delete('/shipping/delete/{id}', [shippingController::class, 'destroy'])->name('shipping.destroy');
        Route::get('/shipping/edit/{id}', [shippingController::class, 'edit'])->name('shipping.edit');
        Route::post('/shipping/update/{id}', [shippingController::class, 'update'])->name('shipping.update');

        //coupons
        Route::get('/coupons/create', [DiscountCodeController::class, 'create'])->name('coupons.create');
        Route::get('/coupons', [DiscountCodeController::class, 'index'])->name('coupons.index');
        Route::post('/coupons', [DiscountCodeController::class, 'store'])->name('coupons.store');
        Route::delete('/coupons/delete/{id}', [DiscountCodeController::class, 'destroy'])->name('coupons.destroy');
        Route::get('/coupons/edit/{id}', [DiscountCodeController::class, 'edit'])->name('coupons.edit');
        Route::post('/coupons/update/{id}', [DiscountCodeController::class, 'update'])->name('coupons.update');
        
        //orders
        Route::get('/orders', [orderController::class, 'index'])->name('admin.orders');
        Route::get('/order-detail/{id}', [orderController::class, 'detail'])->name('admin.orderDetail');
        Route::post('/changeOrderStatus/{id}', [orderController::class, 'changeOrderStatus'])->name('admin.changeOrderStatus');
        Route::post('/send-invoice/{id}', [orderController::class, 'sendInvoiceEmail'])->name('admin.sendInvoice');

        //users
        Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');


        //pages
        Route::get('/page/create', [PageController::class, 'create'])->name('page.create');
        Route::get('/page', [PageController::class, 'index'])->name('page.index');
        Route::post('/page/store', [PageController::class, 'store'])->name('page.store');
        Route::delete('/page/delete/{id}', [PageController::class, 'destroy'])->name('page.destroy');
        Route::get('/page/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
        Route::post('/page/update/{id}', [PageController::class, 'update'])->name('page.update');

        Route::get('/settings', [adminSettingsController::class, 'showChangePasswordForm'])->name('settings.change');
        Route::post('/password-setting', [adminSettingsController::class, 'changeAdminPasswordSettings'])->name('settings.changeP');

        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty ($request->title)) {
                $slug = Str::slug($request->title);
            }

            return response()->json([
                'status' => true,
                'slug' => $slug,
            ]);
        })->name('getSlug');

    });
});