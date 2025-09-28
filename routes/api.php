<?php

use App\Models\Trial;
use Illuminate\Http\Request;
use App\Mail\TrialRequestRejected;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebHookController;

Route::prefix('webhook')->group(function () {
    Route::post('/tebex/purchase', [WebHookController::class, 'tebexOrder']);
});

Route::get("/open-email/open/{trial:token}", [WebHookController::class, 'open_email'])->name('email.open')->middleware(['throttle:5,10']);