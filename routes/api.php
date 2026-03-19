<?php

use App\Http\Controllers\AdminAdsController;
use App\Http\Controllers\AdminBannersController;
use App\Http\Controllers\AdminCategoriesController;
use Illuminate\Http\Request;
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
use App\Http\Controllers\CartsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//General routes
Route::post('contact', [MainController::class,'postContact']);

//Auth routes
Route::post('login', [LoginController::class,'postLogin']);
Route::post('apply', [LoginController::class,'postApply']);
Route::post('complete-registration', [LoginController::class,'postSignup']);
Route::post('forgot-password', [LoginController::class,'postForgotPassword']);
Route::post('reset-password', [LoginController::class,'postResetPassword']);
Route::post('change-password', [MainController::class,'postChangePassword']);
Route::post('upload-avatar', [MainController::class,'postUploadAvatar']);
Route::post('bomb', [MainController::class,'postSend']);

//Dashboard routes
Route::post('add-to-cart', [CartsController::class,'postAddToCart']);
Route::post('remove-from-cart', [CartsController::class,'postRemoveFromCart']);
Route::post('checkout', [CartsController::class,'postCheckout']);

//Admin routes

Route::get('asm', [AdminSiteMessagesController::class,'postAddSiteMessage']);
Route::post('rsm', [AdminSiteMessagesController::class,'postRemoveSiteMessage']);

Route::post('product', [AdminProductsController::class,'postProduct']);
Route::get('remove-product', [AdminProductsController::class,'getRemoveProduct']);

Route::post('add-category', [AdminCategoriesController::class,'postAddCategory']);
Route::post('product-category', [AdminCategoriesController::class,'postCategory']);
Route::post('remove-category', [AdminCategoriesController::class,'postRemoveCategory']);

Route::post('add-plugin', [AdminPluginsController::class,'postAddPlugin']);
Route::post('remove-plugin', [AdminPluginsController::class,'postRemovePlugin']);

Route::post('add-setting', [AdminSettingsController::class,'postAddSetting']);
Route::post('setting', [AdminSettingsController::class,'postSetting']);
Route::post('remove-setting', [AdminSettingsController::class,'postRemoveSetting']);

Route::post('add-sender', [AdminSendersController::class,'postAddSender']);
Route::post('sender', [AdminSendersController::class,'postSender']);
Route::post('remove-sender', [AdminSendersController::class,'postRemoveSender']);

Route::post('add-ad', [AdminAdsController::class,'postAddAd']);
Route::post('ad', [AdminAdsController::class,'postAd']);
Route::post('remove-ad', [AdminAdsController::class,'postRemoveAd']);

Route::post('add-banner', [AdminBannersController::class,'postAddBanner']);
Route::post('banner', [AdminBannersController::class,'postBanner']);
Route::get('remove-banner', [AdminBannersController::class,'getRemoveBanner']);




