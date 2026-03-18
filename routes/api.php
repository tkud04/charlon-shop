<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SchoolAdminController;

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
Route::post('contact', [MainController::class,'postContact']);;
Route::post('donate', [MainController::class,'postDonate']);
Route::post('cf', [MainController::class,'postCfDonate']);

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


//Admin routes

Route::get('asm', [AdminController::class,'postAddSiteMessage']);
Route::post('rsm', [AdminController::class,'postRemoveSiteMessage']);

Route::post('product', [AdminController::class,'postProduct']);
Route::get('remove-product', [AdminController::class,'getRemoveProduct']);

Route::post('add-category', [AdminController::class,'postAddCategory']);
Route::post('product-category', [AdminController::class,'postCategory']);
Route::post('remove-category', [AdminController::class,'postRemoveCategory']);

Route::post('add-plugin', [AdminController::class,'postAddPlugin']);
Route::post('remove-plugin', [AdminController::class,'postRemovePlugin']);

Route::post('add-setting', [AdminController::class,'postAddSetting']);
Route::post('setting', [AdminController::class,'postSetting']);
Route::post('remove-setting', [AdminController::class,'postRemoveSetting']);

Route::post('add-sender', [AdminController::class,'postAddSender']);
Route::post('sender', [AdminController::class,'postSender']);
Route::post('remove-sender', [AdminController::class,'postRemoveSender']);

Route::post('add-ad', [AdminController::class,'postAddAd']);
Route::post('ad', [AdminController::class,'postAd']);
Route::post('remove-ad', [AdminController::class,'postRemoveAd']);

Route::post('add-banner', [AdminController::class,'postAddBanner']);
Route::post('banner', [AdminController::class,'postBanner']);
Route::get('remove-banner', [AdminController::class,'getRemoveBanner']);




