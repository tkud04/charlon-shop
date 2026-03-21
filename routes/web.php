<?php

use App\Http\Controllers\AdminAdsController;
use App\Http\Controllers\AdminBannersController;
use App\Http\Controllers\AdminBrandsController;
use App\Http\Controllers\AdminCategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrdersController;
use App\Http\Controllers\AdminPluginsController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AdminSendersController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminSiteMessagesController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;

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

//General routes
Route::get('/', [MainController::class,'getIndex']);
Route::get('about', [MainController::class,'getAbout']);
Route::get('contact', [MainController::class,'getContact']);
Route::get('terms', [MainController::class,'getTerms']);
Route::get('privacy', [MainController::class,'getPrivacyPolicy']);
Route::get('categories', [CategoriesController::class,'getCategories']);
Route::get('category', [CategoriesController::class,'getCategory']);


//Auth routes
Route::get('login', [LoginController::class,'getLogin']);
Route::get('apply', [LoginController::class,'getApply']);
Route::get('complete-registration', [LoginController::class,'getSignup']);
Route::get('signup', [LoginController::class,'getSignup']);
Route::get('forgot-password', [LoginController::class,'getForgotPassword']);
Route::get('reset-password', [LoginController::class,'getResetPassword']);
Route::get('change-password', [MainController::class,'getChangePassword']);
Route::get('bye', [LoginController::class,'getLogout']);

Route::get('dashboard', [MainController::class,'getDashboard']);
Route::get('profile', [MainController::class,'getProfile']);



Route::get('cart', [CartsController::class,'getCart']);
Route::get('checkout', [CartsController::class,'getCheckout']);
Route::get('order', [OrdersController::class,'getOrder']);


//Admin routes
Route::get('admin', [AdminController::class,'getDashboard']);

Route::get('site-messages', [AdminSiteMessagesController::class,'getSiteMessages']);
Route::get('users', [AdminUsersController::class,'getUsers']);

Route::get('products', [AdminProductsController::class,'getProducts']);
Route::get('add-product', [AdminProductsController::class,'getAddProduct']);
Route::get('product', [AdminProductsController::class,'getProduct']);

Route::get('categories2', [AdminCategoriesController::class,'getCategories']);
Route::get('add-category', [AdminCategoriesController::class,'getAddCategory']);
Route::get('product-category', [AdminCategoriesController::class,'getProductCategory']);

Route::get('brands2', [AdminBrandsController::class,'getBrands']);
Route::get('add-brand', [AdminBrandsController::class,'getAddBrand']);

Route::get('orders', [AdminOrdersController::class,'getOrders']);

Route::get('add-plugin', [AdminPluginsController::class,'getAddPlugin']);
Route::get('plugins', [AdminPluginsController::class,'getPlugins']);
Route::get('plugin', [AdminPluginsController::class,'getPlugin']);

Route::get('add-sender', [AdminSendersController::class,'getAddSender']);
Route::get('senders', [AdminSendersController::class,'getSenders']);
Route::get('sender', [AdminSendersController::class,'getSender']);

Route::get('settings', [AdminSettingsController::class,'getSettings']);
Route::get('add-setting', [AdminSettingsController::class,'getAddSetting']);
Route::get('setting', [AdminSettingsController::class,'getSetting']);

Route::get('ads', [AdminAdsController::class,'getAds']);
Route::get('add-ad', [AdminAdsController::class,'getAddAd']);
Route::get('ad', [AdminAdsController::class,'getAd']);

Route::get('banners', [AdminBannersController::class,'getBanners']);
Route::get('add-banner', [AdminBannersController::class,'getAddBanner']);
Route::get('banner', [AdminBannersController::class,'getBanner']);



