<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebHookController;

Route::prefix('webhook')->group(function () {
    Route::post('/tebex/purchase', [WebHookController::class, 'tebexOrder']);
});
