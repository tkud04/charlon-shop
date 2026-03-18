<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

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
Route::get('gallery', [MainController::class,'getGallery']);
Route::get('about', [MainController::class,'getAbout']);
Route::get('contact', [MainController::class,'getContact']);
Route::get('terms', [MainController::class,'getTerms']);
Route::get('privacy', [MainController::class,'getPrivacyPolicy']);
Route::get('smtp', [MainController::class,'getSmtp']);
Route::get('add-smtp', [MainController::class,'getAddSmtp']);


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



Route::get('cart', [MainController::class,'getCart']);
Route::get('checkout', [MainController::class,'getCheckout']);


//Admin routes
Route::get('admin', [AdminController::class,'getDashboard']);

Route::get('site-messages', [AdminController::class,'getSiteMessages']);

Route::get('products', [AdminController::class,'getProducts']);
Route::get('add-product', [AdminController::class,'getAddProduct']);
Route::get('product', [AdminController::class,'getProduct']);

Route::get('categories', [AdminController::class,'getCategories']);
Route::get('add-category', [AdminController::class,'getAddCategory']);
Route::get('product-category', [AdminController::class,'getProductCategory']);

Route::get('orders', [AdminController::class,'getOrders']);

Route::get('add-plugin', [AdminController::class,'getAddPlugin']);
Route::get('plugins', [AdminController::class,'getPlugins']);
Route::get('plugin', [AdminController::class,'getPlugin']);

Route::get('add-sender', [AdminController::class,'getAddSender']);
Route::get('senders', [AdminController::class,'getSenders']);
Route::get('sender', [AdminController::class,'getSender']);

Route::get('settings', [AdminController::class,'getSettings']);
Route::get('add-setting', [AdminController::class,'getAddSetting']);
Route::get('setting', [AdminController::class,'getSetting']);

Route::get('ads', [AdminController::class,'getAds']);
Route::get('add-ad', [AdminController::class,'getAddAd']);
Route::get('ad', [AdminController::class,'getAd']);

Route::get('banners', [AdminController::class,'getBanners']);
Route::get('add-banner', [AdminController::class,'getAddBanner']);
Route::get('banner', [AdminController::class,'getBanner']);



