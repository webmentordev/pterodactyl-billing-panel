<?php

use App\Models\Order;
use App\Models\Usage;
use App\Livewire\Home;
use App\Mail\Reminder;
use App\Models\Server;
use App\Mail\OrderSuccess;
use Illuminate\Http\Request;
use App\Livewire\Admin\Users;
use App\Livewire\User\Dashboard;
use App\Livewire\Admin\Reminders;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Livewire\Package as SinglePackage;
use App\Livewire\Order\Renew as RenewOrder;
use App\Livewire\Admin\Orders as AdminOrders;
use App\Livewire\Order\Cancel as CancelOrder;
use App\Http\Controllers\GoogleAuthController;
use App\Livewire\Admin\Billing as AdminBilling;
use App\Livewire\Order\Success as SuccessOrder;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Servers\Create as CreateServer;
use App\Livewire\Admin\Servers\Servers as AdminServer;
use App\Livewire\Admin\Servers\Update as UpdateServer;

// Open Routes
Route::get('/', Home::class)->name('home');
Route::get('/buy-dedicated-rust-server', SinglePackage::class)->name('package');

// Customer Routes
Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

// Administartor Routes
Route::middleware(['auth', 'verified', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/users', Users::class)->name('users');

    Route::get('/servers', AdminServer::class)->name('servers');
    Route::get('/server/create', CreateServer::class)->name('server.create');
    Route::get('/server/update/{server}', UpdateServer::class)->name('server.update');

    Route::get('/billings/{order?}', AdminBilling::class)->name('billing');
    Route::get('/orders', AdminOrders::class)->name('orders');

    Route::get('/reminders', Reminders::class)->name('reminders');
});

// Google Auth Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/google/auth/redirect', [GoogleAuthController::class, 'index'])->name('google.redirect');
    Route::get('/google/oauth/callback-url', [GoogleAuthController::class, 'verify']);
});

// Order purchase status
Route::get('/order/{order}/success', SuccessOrder::class)->name('order.success');
Route::get('/order/{order}/cancel', CancelOrder::class)->name('order.cancel');
Route::get('/order/renew/{order}/{status}/{billing}', RenewOrder::class)->name('order.renew');

// Email Testing
// Route::get('/email/{order}', function (Order $order) {
//     return new OrderSuccess($order, null);
//     // Mail::to($order->user->email)->send(new OrderSuccess($order));
//     // return "Email Sent!";
// });

// Route::get('/email', function () {
//     return new Reminder();
// });


// Route::get('/product-varient', function () {
//     $apiToken = config('app.lemon_token');
//     $storeID =  config('app.lemon_store');
//     $productID = config('app.lemon_product');
//     $response = Http::withHeaders([
//         'Accept' => 'application/vnd.api+json',
//         'Content-Type' => 'application/vnd.api+json',
//         'Authorization' => 'Bearer ' . $apiToken,
//     ])->get('https://api.lemonsqueezy.com/v1/products/' . $productID . '/variants');

//     $variants = $response->json();
//     $variantID = $variants['data'][0]['id'] ?? null;

//     if (!$variantID) {
//         throw new Exception("No variants found for the product.");
//     }
//     return $variantID;
// });



require __DIR__ . '/auth.php';
