<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/v1')->namespace('Api\V1')->group(function () {
    Route::post('send_sms', [AuthController::class, 'sendSms']);
    Route::post('verify_sms_code', [AuthController::class, 'verifySms']);
});
