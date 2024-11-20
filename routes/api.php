<?php

use App\Http\Controllers\Api\V1\AuthApiController;
use App\Http\Controllers\Api\V1\HomeApiController;
use App\Http\Controllers\Api\V1\PaymentApiController;
use App\Http\Controllers\Api\V1\ProductApiController;
use App\Http\Controllers\Api\V1\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/v1')->namespace('Api\V1')->group(function () {
    Route::post('send_sms', [AuthApiController::class, 'sendSms']);
    Route::post('verify_sms_code', [AuthApiController::class, 'verifySms']);
    Route::get('home', [HomeApiController::class, 'home']);

    Route::get('most_sold_products', [ProductApiController::class, 'mostSoldProduct']);
    Route::get('most_viewed_products', [ProductApiController::class, 'mostViewedProduct']);
    Route::get('newest_products', [ProductApiController::class, 'newestProduct']);
    Route::get('cheapest_products', [ProductApiController::class, 'cheapestProduct']);
    Route::get('most_expensive_products', [ProductApiController::class, 'mostExpensiveProduct']);
    Route::get('products_by_category/{id}', [ProductApiController::class, 'productsByCategory']);
    Route::get('products_by_brand/{id}', [ProductApiController::class, 'productsByBrand']);
    Route::get('product_details/{id}', [ProductApiController::class, 'productDetails']);
    Route::post('search_product', [ProductApiController::class, 'searchProduct']);

    Route::get('callback', [PaymentApiController::class, 'callback'])->name('callback');
});


Route::prefix('/v1')->namespace('Api\V1')->middleware('auth:sanctum')->group(function () {
    Route::post('register', [UserApiController::class, 'register']);
    Route::post('save_product_comment', [ProductApiController::class, 'saveComment']);
    Route::post('payment', [PaymentApiController::class, 'payment'])->name('payment');
    Route::get('profile', [UserApiController::class, 'profile'])->name('profile');
    Route::get('received_orders', [UserApiController::class, 'receivedOrders']);
});
