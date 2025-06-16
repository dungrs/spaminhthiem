<?php

use Illuminate\Support\Facades\Route;

// BACKEND CONTROLLER
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\Backend\User\UserCatalogueController;
use App\Http\Controllers\Backend\Post\PostCatalogueController;
use App\Http\Controllers\Backend\Post\PostController;
use App\Http\Controllers\Backend\Product\ProductCatalogueController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Attribute\AttributeCatalogueController;
use App\Http\Controllers\Backend\Attribute\AttributeController;
use App\Http\Controllers\Backend\Menu\MenuCatalogueController;
use App\Http\Controllers\Backend\Menu\MenuController;
use App\Http\Controllers\Backend\Customer\CustomerCatalogueController;
use App\Http\Controllers\Backend\Customer\CustomerController;


use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\SystemController;
use App\Http\Controllers\Backend\SourceController;
use App\Http\Controllers\Backend\SlideController;
use App\Http\Controllers\Backend\WidgetController;
use App\Http\Controllers\Backend\PromotionController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReviewController;

// FRONTEND CONTROLLER
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\RouterController;
use App\Http\Controllers\Frontend\AuthController as AuthCustomerController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\MomoController;
use App\Http\Controllers\Frontend\PaypalController;
use App\Http\Controllers\Frontend\VnpayController;


// AJAX CONTROLLER
use App\Http\Controllers\Ajax\User\UserCatalogueController as AjaxUserCatalogueController;
use App\Http\Controllers\Ajax\User\UserController as AjaxUserController;
use App\Http\Controllers\Ajax\Post\PostCatalogueController as AjaxPostCatalogueController;
use App\Http\Controllers\Ajax\Post\PostController as AjaxPostController;
use App\Http\Controllers\Ajax\Product\ProductCatalogueController as AjaxProductCatalogueController;
use App\Http\Controllers\Ajax\Product\ProductController as AjaxProductController;
use App\Http\Controllers\Ajax\Attribute\AttributeCatalogueController as AjaxAttributeCatalogueController;
use App\Http\Controllers\Ajax\Attribute\AttributeController as AjaxAttributeController;
use App\Http\Controllers\Ajax\Menu\MenuCatalogueController as AjaxMenuCatalogueController;
use App\Http\Controllers\Ajax\Menu\MenuController as AjaxMenuController;
use App\Http\Controllers\Ajax\Customer\CustomerCatalogueController as AjaxCustomerCatalogueController;
use App\Http\Controllers\Ajax\Customer\CustomerController as AjaxCustomerController;

use App\Http\Controllers\Ajax\LanguageController as AjaxLanguageController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Ajax\LocationController as AjaxLocationController;
use App\Http\Controllers\Ajax\PermissionController as AjaxPermissionController;
use App\Http\Controllers\Ajax\SystemController as AjaxSystemController;
use App\Http\Controllers\Ajax\SourceController as AjaxSourceController;
use App\Http\Controllers\Ajax\SlideController as AjaxSlideController;
use App\Http\Controllers\Ajax\WidgetController as AjaxWidgetController;
use App\Http\Controllers\Ajax\PromotionController as AjaxPromotionController;
use App\Http\Controllers\Ajax\CartController as AjaxCartController;
use App\Http\Controllers\Ajax\OrderController as AjaxOrderController;
use App\Http\Controllers\Ajax\ReviewController as AjaxReviewController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('tai-khoan' . config('apps.general.suffix'), [FrontendCustomerController::class, 'profile'])->name('customer.profile');
Route::get('gio-hang' . config('apps.general.suffix'), [CartController::class, 'cart'])->name('cart');
Route::get('thanh-toan' . config('apps.general.suffix'), [CartController::class, 'checkout'])->name('checkout');
Route::get('tim-kiem-hoa-don'  . config('apps.general.suffix'), [FrontendOrderController::class, 'lookup'])->name('lookup');
Route::get('tinh-trang-thanh-toan/{code}', [CartController::class, 'success'])->name('cart.success')->where(['code' => '[0-9]+']);
Route::post('tim-kiem-hoa-don' . config('apps.general.suffix'), [FrontendOrderController::class, 'getOrder'])->name('getOrder');
Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');

Route::post('customer/update/{id}', [FrontendCustomerController::class, 'update'])->name('customer.update')->where(['id' => '[0-9]+']);

Route::post('product-details', [AjaxProductController::class, 'loadProduct'])->name('product.loadProduct');

Route::get('dang-nhap' . config('apps.general.suffix'), [AuthCustomerController::class, 'showLogin'])->name('customer.showLogin');
Route::get('dang-ki' . config('apps.general.suffix'), [AuthCustomerController::class, 'showRegister'])->name('customer.showRegister');
Route::post('login' . config('apps.general.suffix'), [AuthCustomerController::class, 'login'])->name('customer.login');
Route::post('register' . config('apps.general.suffix'), [AuthCustomerController::class, 'register'])->name('customer.register');
Route::get('logout' . config('apps.general.suffix'), [AuthCustomerController::class, 'logout'])->name('customer.logout');

Route::get('{canonical}' . config('apps.general.suffix'), [RouterController::class, 'index'])->name('router.index')->where('canonical', '[a-zA-Z0-9\-]+');

// VNPAY
Route::get('return/vnpay' . config('apps.general.suffix'), [VnpayController::class, 'vnpay_return']) -> name('vnpay.vnpay_return');
Route::get('return/vnpay_ipn' . config('apps.general.suffix'), [VnpayController::class, 'vnpay_ipn']) -> name('vnpay.vnpay_ipn');

// MOMO
Route::get('return/momo' . config('apps.general.suffix'), [MomoController::class, 'momo_return']) -> name('momo.momo_return');
Route::get('return/momo_ipn' . config('apps.general.suffix'), [MomoController::class, 'momo_ipn']) -> name('momo.momo_ipn');

// PAYPAL
Route::get('paypal/success' . config('apps.general.suffix'), [PaypalController::class, 'success']) -> name('paypal.success');
Route::get('paypal/cancel' . config('apps.general.suffix'), [PaypalController::class, 'cancel']) -> name('paypal.cancel');

// AJAX
Route::prefix('ajax')->group(function () {
    // CART
    Route::prefix('cart')->group(function() {
        Route::post('/create', [AjaxCartController::class, 'create'])->name('ajax.cart.create');
        Route::post('/update', [AjaxCartController::class, 'update'])->name('ajax.cart.update');
        Route::post('/delete', [AjaxCartController::class, 'delete'])->name('ajax.cart.delete');
        Route::get('/deleteAll', [AjaxCartController::class, 'deleteAll'])->name('ajax.cart.deleteAll');
    });
});


/*
|--------------------------------------------------------------------------
| BACKEND ROUTES
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['admin']], function() {
    Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');

    // SOURCES
    Route::prefix('source')->group(function() {
        Route::get('/index', [SourceController::class, 'index'])->name('source.index');
    });
    
    // USER CATALOGUE
    Route::prefix('user/catalogue')->group(function() {
        Route::get('index', [UserCatalogueController::class, 'index'])->name('user.catalogue.index');
        Route::get('permission', [UserCatalogueController::class, 'permission']) -> name('user.catalogue.permission');
    });
    
    // USER
    Route::prefix('user')->group(function() {
        Route::get('/index', [UserController::class, 'index'])->name('user.index');
    });

    // CUSTOMER CATALOGUE
    Route::prefix('customer/catalogue')->group(function() {
        Route::get('index', [CustomerCatalogueController::class, 'index'])->name('customer.catalogue.index');
        Route::get('permission', [CustomerCatalogueController::class, 'permission']) -> name('customer.catalogue.permission');
    });
    
    // CUSTOMER
    Route::prefix('customer')->group(function() {
        Route::get('/index', [CustomerController::class, 'index'])->name('customer.index');
    });

    // PERMISSION
    Route::prefix('permission')->group(function() {
        Route::get('/index', [PermissionController::class, 'index'])->name('permission.index');
    });

    // POST CATALOGUE
    Route::prefix('post/catalogue')->group(function() {
        Route::get('index', [PostCatalogueController::class, 'index'])->name('post.catalogue.index');
        Route::get('/create', [PostCatalogueController::class, 'create'])->name('post.catalogue.create');
        Route::get('/store', [PostCatalogueController::class, 'store'])->name('post.catalogue.store');
        Route::get('/edit/{id}/{language_id}', [PostCatalogueController::class, 'edit'])->name('post.catalogue.edit')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // POST
    Route::prefix('post')->group(function() {
        Route::get('index', [PostController::class, 'index'])->name('post.index');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::get('/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/edit/{id}/{language_id}', [PostController::class, 'edit'])->name('post.edit')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // PRODUCT CATALOGUE
    Route::prefix('product/catalogue')->group(function() {
        Route::get('index', [ProductCatalogueController::class, 'index'])->name('product.catalogue.index');
        Route::get('/create', [ProductCatalogueController::class, 'create'])->name('product.catalogue.create');
        Route::get('/store', [ProductCatalogueController::class, 'store'])->name('product.catalogue.store');
        Route::get('/edit/{id}/{language_id}', [ProductCatalogueController::class, 'edit'])->name('product.catalogue.edit')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // PRODUCT
    Route::prefix('product')->group(function() {
        Route::get('index', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::get('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}/{language_id}', [ProductController::class, 'edit'])->name('product.edit')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // ATTRIBUTE CATALOGUE
    Route::prefix('attribute/catalogue')->group(function() {
        Route::get('index', [AttributeCatalogueController::class, 'index'])->name('attribute.catalogue.index');
        Route::get('/create', [AttributeCatalogueController::class, 'create'])->name('attribute.catalogue.create');
        Route::get('/store', [AttributeCatalogueController::class, 'store'])->name('attribute.catalogue.store');
        Route::get('/edit/{id}/{language_id}', [AttributeCatalogueController::class, 'edit'])->name('attribute.catalogue.edit')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // ATTRIBUTE
    Route::prefix('attribute')->group(function() {
        Route::get('index', [AttributeController::class, 'index'])->name('attribute.index');
        Route::get('/create', [AttributeController::class, 'create'])->name('attribute.create');
        Route::get('/store', [AttributeController::class, 'store'])->name('attribute.store');
        Route::get('/edit/{id}/{language_id}', [AttributeController::class, 'edit'])->name('attribute.edit')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // MENU
    Route::prefix('menu')->group(function() {
        Route::get('index', [MenuController::class, 'index'])->name('menu.index');
        Route::get('/create', [MenuController::class, 'create'])->name('menu.create');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit')->where(['id' => '[0-9]+']);
        Route::get('{id}/editMenu', [MenuController::class, 'editMenu']) -> name('menu.editMenu') -> where(['id' => '[0-9]+']);
        Route::get('{parent_id}/{menu_catalogue_id}/children', [MenuController::class, 'children']) -> name('menu.children') -> where(['parent_id' => '[0-9]+', 'menu_catalogue_id' => '[0-9]+']);
        Route::get('{id}/{language_id}/translate', [MenuController::class, 'translate'])->name('menu.translate')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // MENU CATALOGUE
    Route::prefix('menu/catalogue')->group(function() {
        Route::get('index', [MenuCatalogueController::class, 'index'])->name('menu.catalogue.index');
        Route::get('/create', [MenuCatalogueController::class, 'create'])->name('menu.catalogue.create');
    });

    // SLIDE
    Route::prefix('slide')->group(function() {
        Route::get('index', [SlideController::class, 'index'])->name('slide.index');
        Route::get('/create', [SlideController::class, 'create'])->name('slide.create');
        Route::get('/store', [SlideController::class, 'store'])->name('slide.store');
        Route::get('/edit/{id}', [SlideController::class, 'edit'])->name('slide.edit')->where(['id' => '[0-9]+']);
    });

    // ORDER
    Route::prefix('order')->group(function() {
        Route::get('index', [OrderController::class, 'index'])->name('order.index');
        Route::get('/details/{code}', [OrderController::class, 'details'])->name('order.details')->where(['code' => '[0-9]+']);
    });

    // LANGUAGE
    Route::prefix('language')->group(function() {
        Route::get('index', [LanguageController::class, 'index'])->name('language.index');
        Route::get('{id}/switch', [LanguageController::class, 'switchBackendLanguage'])->name('language.backend.switch')->where(['id' => '[0-9]+']);
        Route::get('{id}/{language_id}/{modelParent}/{model}/translate', [LanguageController::class, 'translate'])->name('language.translate')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // SYSTEM
    Route::prefix('system')->group(function() {
        Route::get('index', [SystemController::class, 'index'])->name('system.index');
    });

    // REVIEW
    Route::prefix('review')->group(function() {
        Route::get('index', [ReviewController::class, 'index'])->name('review.index');
    });

    // WIDGET
    Route::prefix('widget')->group(function() {
        Route::get('index', [WidgetController::class, 'index'])->name('widget.index');
        Route::get('/create', [WidgetController::class, 'create'])->name('widget.create');
        Route::get('/store', [WidgetController::class, 'store'])->name('widget.store');
        Route::get('/edit/{id}/{language_id}', [WidgetController::class, 'edit'])->name('widget.edit')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/translate/{id}/{language_id}', [WidgetController::class, 'translate'])->name('widget.translate')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // PROMOTION
    Route::prefix('promotion')->group(function() {
        Route::get('index', [PromotionController::class, 'index'])->name('promotion.index');
        Route::get('/create', [PromotionController::class, 'create'])->name('promotion.create');
        Route::get('/store', [PromotionController::class, 'store'])->name('promotion.store');
        Route::get('/edit/{id}', [PromotionController::class, 'edit'])->name('promotion.edit')->where(['id' => '[0-9]+']);
    });
});

// AJAX
Route::prefix('ajax')->group(function() {
    // SOURCE
    Route::prefix('source')->group(function() {
        Route::post('/create', [AjaxSourceController::class, 'create'])->name('ajax.source.create');
        Route::post('/update/{id}', [AjaxSourceController::class, 'update'])->name('ajax.source.update')->where(['id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxSourceController::class, 'delete'])->name('ajax.source.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxSourceController::class, 'filter'])->name('ajax.source.filter');
        Route::get('/getAllSource', [AjaxSourceController::class, 'getAllSource'])->name('ajax.source.getAllSource');
        Route::get('/edit/{id}', [AjaxSourceController::class, 'edit'])->name('ajax.source.edit')->where(['id' => '[0-9]+']);
    });

    // USER CATALOGUE
    Route::prefix('user/catalogue')->group(function() {
        Route::post('/create', [AjaxUserCatalogueController::class, 'create'])->name('ajax.user.catalogue.create');
        Route::post('/update/{id}', [AjaxUserCatalogueController::class, 'update'])->name('ajax.user.catalogue.update')->where(['id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxUserCatalogueController::class, 'delete'])->name('ajax.user.catalogue.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxUserCatalogueController::class, 'filter'])->name('ajax.user.catalogue.filter');
        Route::get('/edit/{id}', [AjaxUserCatalogueController::class, 'edit'])->name('ajax.user.catalogue.edit')->where(['id' => '[0-9]+']);
        Route::get('/details/{id}/', [AjaxUserCatalogueController::class, 'details'])->name('ajax.user.catalogue.details')->where(['id' => '[0-9]+']);
        Route::get('updatePermission', [UserCatalogueController::class, 'updatePermission'])->name('user.catalogue.updatePermission');
    });

    // USER
    Route::prefix('user')->group(function() {
        Route::post('/create', [AjaxUserController::class, 'create'])->name('ajax.user.create');
        Route::post('/update/{id}', [AjaxUserController::class, 'update'])->name('ajax.user.update')->where(['id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxUserController::class, 'delete'])->name('ajax.user.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxUserController::class, 'filter'])->name('ajax.user.filter');
        Route::get('/edit/{id}', [AjaxUserController::class, 'edit'])->name('ajax.user.edit')->where(['id' => '[0-9]+']);
    });

    // CUSTOMER CATALOGUE
    Route::prefix('customer/catalogue')->group(function() {
        Route::post('/create', [AjaxCustomerCatalogueController::class, 'create'])->name('ajax.customer.catalogue.create');
        Route::post('/update/{id}', [AjaxCustomerCatalogueController::class, 'update'])->name('ajax.customer.catalogue.update')->where(['id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxCustomerCatalogueController::class, 'delete'])->name('ajax.customer.catalogue.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxCustomerCatalogueController::class, 'filter'])->name('ajax.customer.catalogue.filter');
        Route::get('/edit/{id}', [AjaxCustomerCatalogueController::class, 'edit'])->name('ajax.customer.catalogue.edit')->where(['id' => '[0-9]+']);
        Route::get('/details/{id}/', [AjaxCustomerCatalogueController::class, 'details'])->name('ajax.customer.catalogue.details')->where(['id' => '[0-9]+']);
    });

    // CUSTOMER
    Route::prefix('customer')->group(function() {
        Route::post('/create', [AjaxCustomerController::class, 'create'])->name('ajax.customer.create');
        Route::post('/update/{id}', [AjaxCustomerController::class, 'update'])->name('ajax.customer.update')->where(['id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxCustomerController::class, 'delete'])->name('ajax.customer.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxCustomerController::class, 'filter'])->name('ajax.customer.filter');
        Route::get('/edit/{id}', [AjaxCustomerController::class, 'edit'])->name('ajax.customer.edit')->where(['id' => '[0-9]+']);
    });

    // PERMISSION
    Route::prefix('permission')->group(function() {
        Route::post('/create', [AjaxPermissionController::class, 'create'])->name('ajax.permission.create');
        Route::post('/update/{id}', [AjaxPermissionController::class, 'update'])->name('ajax.permission.update')->where(['id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxPermissionController::class, 'delete'])->name('ajax.permission.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxPermissionController::class, 'filter'])->name('ajax.permission.filter');
        Route::get('/edit/{id}', [AjaxPermissionController::class, 'edit'])->name('ajax.permission.edit')->where(['id' => '[0-9]+']);
    });

    // POST CATALOGUE
    Route::prefix('post/catalogue')->group(function() {
        Route::post('/create', [AjaxPostCatalogueController::class, 'create'])->name('ajax.post.catalogue.create');
        Route::post('/update/{id}/{language_id}', [AjaxPostCatalogueController::class, 'update'])->name('ajax.post.catalogue.update')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxPostCatalogueController::class, 'delete'])->name('ajax.post.catalogue.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxPostCatalogueController::class, 'filter'])->name('ajax.post.catalogue.filter');
        Route::get('{id}/{language_id}/{modelParent}/{model}/translate', [LanguageController::class, 'translate'])->name('language.translate')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // POST
    Route::prefix('post')->group(function() {
        Route::post('/create', [AjaxPostController::class, 'create'])->name('ajax.post.create');
        Route::post('/update/{id}/{language_id}', [AjaxPostController::class, 'update'])->name('ajax.post.update')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxPostController::class, 'delete'])->name('ajax.post.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxPostController::class, 'filter'])->name('ajax.post.filter');
        Route::get('{id}/{language_id}/{modelParent}/{model}/translate', [LanguageController::class, 'translate'])->name('language.translate')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // PRODUCT CATALOGUE
    Route::prefix('product/catalogue')->group(function() {
        Route::post('/create', [AjaxProductCatalogueController::class, 'create'])->name('ajax.product.catalogue.create');
        Route::post('/update/{id}/{language_id}', [AjaxProductCatalogueController::class, 'update'])->name('ajax.product.catalogue.update')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxProductCatalogueController::class, 'delete'])->name('ajax.product.catalogue.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxProductCatalogueController::class, 'filter'])->name('ajax.product.catalogue.filter');
        Route::get('{id}/{language_id}/{modelParent}/{model}/translate', [LanguageController::class, 'translate'])->name('language.translate')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // PRODUCT
    Route::prefix('product')->group(function() {
        Route::post('/create', [AjaxProductController::class, 'create'])->name('ajax.product.create');
        Route::post('/update/{id}/{language_id}', [AjaxProductController::class, 'update'])->name('ajax.product.update')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxProductController::class, 'delete'])->name('ajax.product.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxProductController::class, 'filter'])->name('ajax.product.filter');
        Route::get('/filterUser', [AjaxProductController::class, 'filterUser'])->name('ajax.product.filterUser');
        Route::get('{id}/{language_id}/{modelParent}/{model}/translate', [LanguageController::class, 'translate'])->name('language.translate')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/loadProductAnimation', [AjaxProductController::class, 'loadProductAnimation'])->name('ajax.product.loadProductAnimation');
        Route::get('/loadVariant', [AjaxProductController::class, 'loadVariant'])->name('ajax.product.loadVariant');
    });

    // ATTRIBUTE CATALOGUE
    Route::prefix('attribute/catalogue')->group(function() {
        Route::post('/create', [AjaxAttributeCatalogueController::class, 'create'])->name('ajax.attribute.catalogue.create');
        Route::post('/update/{id}/{language_id}', [AjaxAttributeCatalogueController::class, 'update'])->name('ajax.attribute.catalogue.update')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxAttributeCatalogueController::class, 'delete'])->name('ajax.attribute.catalogue.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxAttributeCatalogueController::class, 'filter'])->name('ajax.attribute.catalogue.filter');
        Route::get('{id}/{language_id}/{modelParent}/{model}/translate', [LanguageController::class, 'translate'])->name('language.translate')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
    });

    // ATTRIBUTE
    Route::prefix('attribute')->group(function() {
        Route::post('/create', [AjaxAttributeController::class, 'create'])->name('ajax.attribute.create');
        Route::post('/update/{id}/{language_id}', [AjaxAttributeController::class, 'update'])->name('ajax.attribute.update')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxAttributeController::class, 'delete'])->name('ajax.attribute.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxAttributeController::class, 'filter'])->name('ajax.attribute.filter');
        Route::get('{id}/{language_id}/{modelParent}/{model}/translate', [LanguageController::class, 'translate'])->name('language.translate')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/getAttribute', [AjaxAttributeController::class, 'getAttribute'])->name('attribute.getAttribute');
        Route::get('/loadAttribute/{language_id}', [AjaxAttributeController::class, 'loadAttribute'])->name('attribute.loadAttribute')->where(['language_id' => '[0-9]+']);
    });

    // MENU
    Route::prefix('menu')->group(function() {
        Route::get('/filter', [AjaxMenuController::class, 'filter'])->name('ajax.menu.filter');
        Route::post('/create', [AjaxMenuController::class, 'create'])->name('ajax.menu.create');
        Route::get('/getMenu', [AjaxMenuController::class, 'getMenu'])->name('ajax.menu.getMenu');
        Route::post('/store', [AjaxMenuController::class, 'store'])->name('ajax.menu.store');
        Route::post('/drag', [AjaxMenuController::class, 'drag'])->name('ajax.menu.drag');
        Route::post('/saveChildren/{id}', [AjaxMenuController::class, 'saveChildren'])->name('ajax.menu.save.children')->where(['id' => '[0-9]+']);
        Route::post('/saveTranslate/{language_id}', [AjaxMenuController::class, 'saveTranslate'])->name('menu.translate.save')->where(['language_id' => '[0-9]+']);
    });

    // MENU CATALOGUE
    Route::prefix('menu/catalogue')->group(function() {
        Route::post('/create', [AjaxMenuCatalogueController::class, 'create'])->name('ajax.menu.catalogue.create');
        Route::get('/delete/{id}', [AjaxMenuCatalogueController::class, 'delete'])->name('ajax.menu.catalogue.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxMenuCatalogueController::class, 'filter'])->name('ajax.menu.catalogue.filter');
    });

    // SLIDE
    Route::prefix('slide')->group(function() {
        Route::post('/create', [AjaxSlideController::class, 'create'])->name('ajax.slide.create');
        Route::post('/update/{id}', [AjaxSlideController::class, 'update'])->name('ajax.slide.update')->where(['id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxSlideController::class, 'delete'])->name('ajax.slide.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxSlideController::class, 'filter'])->name('ajax.slide.filter');
    });

    // ORDER
    Route::prefix('order')->group(function() {
        Route::post('/create', [AjaxOrderController::class, 'create'])->name('ajax.order.create');
        Route::post('/update/{id}', [AjaxOrderController::class, 'update'])->name('ajax.order.update')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxOrderController::class, 'filter'])->name('ajax.order.filter');
        Route::get('/chart', [AjaxOrderController::class, 'chart']) -> name('ajax.order.chart');
        Route::get('/donutChart', [AjaxOrderController::class, 'donutChart']) -> name('ajax.order.donutChart');
    });

    // LANGUAGE
    Route::prefix('language')->group(function() {
        Route::post('/create', [AjaxLanguageController::class, 'create'])->name('ajax.language.create');
        Route::post('/update/{id}', [AjaxLanguageController::class, 'update'])->name('ajax.language.update')->where(['id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxLanguageController::class, 'delete'])->name('ajax.language.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxLanguageController::class, 'filter'])->name('ajax.language.filter');
        Route::get('/edit/{id}', [AjaxLanguageController::class, 'edit'])->name('ajax.language.edit')->where(['id' => '[0-9]+']);
        Route::post('/storeTranslate', [AjaxLanguageController::class, 'storeTranslate']) -> name('language.storeTranslate');
    });

    // SYSTEM
    Route::prefix('system')->group(function() {
        Route::post('/create', [AjaxSystemController::class, 'create'])->name('ajax.system.create');
    });

    // REVIEW
    Route::prefix('review')->group(function() {
        Route::post('/create', [AjaxReviewController::class, 'create'])->name('ajax.review.create');
        Route::get('/delete/{id}', [AjaxReviewController::class, 'delete'])->name('ajax.review.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxReviewController::class, 'filter'])->name('ajax.review.filter');
    });

    // WIDGET
    Route::prefix('widget')->group(function() {
        Route::post('/create', [AjaxWidgetController::class, 'create'])->name('ajax.widget.create');
        Route::post('/update/{id}/{language_id}', [AjaxWidgetController::class, 'update'])->name('ajax.widget.update')->where(['id' => '[0-9]+', 'language_id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxWidgetController::class, 'delete'])->name('ajax.widget.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxWidgetController::class, 'filter'])->name('ajax.widget.filter');
        Route::get('/findModelObject', [AjaxWidgetController::class, 'findModelObject'])->name('ajax.widget.findModelObject');
        Route::post('/saveTranslate', [AjaxWidgetController::class, 'saveTranslate'])->name('ajax.widget.saveTranslate');
    });

    // PROMOTION
    Route::prefix('promotion')->group(function() {
        Route::post('/create', [AjaxPromotionController::class, 'create'])->name('ajax.promotion.create');
        Route::post('/update/{id}', [AjaxPromotionController::class, 'update'])->name('ajax.promotion.update')->where(['id' => '[0-9]+']);
        Route::get('/delete/{id}', [AjaxPromotionController::class, 'delete'])->name('ajax.promotion.delete')->where(['id' => '[0-9]+']);
        Route::get('/filter', [AjaxPromotionController::class, 'filter'])->name('ajax.promotion.filter');
        Route::get('/getPromotionConditionValue', [AjaxPromotionController::class, 'getPromotionConditionValue'])->name('ajax.promotion.getPromotionConditionValue');
    });

    // CONFIG
    Route::prefix('dashboard')->group(function() {
        Route::post('/changeStatus/{id}', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changePublish')->where(['id' => '[0-9]+']);
        Route::post('/changeStatusAll', [AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll');
    });

    // LOCATION
    Route::get('/location/getLocation', [AjaxLocationController::class, 'getLocation'])->name('location.getLocation');
});

Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');