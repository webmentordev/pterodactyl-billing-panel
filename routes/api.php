<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LemonOrdersController;
use App\Http\Controllers\WebHookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('webhook')->group(function () {
    // Store Lemon Squeezy Orders
    Route::post('/lemon-squeezy/order/store', [LemonOrdersController::class, 'store']);
    Route::post('/tebex/purchase', [WebHookController::class, 'order']);
});
