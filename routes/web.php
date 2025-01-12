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
use App\Livewire\Admin\Refunds;
use App\Livewire\Admin\Servers\Create as CreateServer;
use App\Livewire\Admin\Servers\Servers as AdminServer;
use App\Livewire\Admin\Servers\Update as UpdateServer;
use App\Livewire\FreeTrial;
use App\Livewire\PrivacyPolicy;
use App\Livewire\RefundPolicy;
use App\Livewire\TermsOfService;
use App\Livewire\User\Billings;
use App\Mail\OrderDeleted;
use App\Mail\OrderRefunded;
use App\Mail\OrderRenew;
use App\Mail\OrderRenewReminder;
use App\Mail\OrderSuspended;

// Open Routes
Route::get('/', Home::class)->name('home');
Route::get('/buy-dedicated-rust-server-hosting', SinglePackage::class)->name('package');
Route::get('/rent-free-trial-rust-server-hosting', FreeTrial::class)->name('free.trial');

// Customer Routes
Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billings', Billings::class)->name('billings');
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
    Route::get('/refunds', Refunds::class)->name('refunds');

    Route::get('/renew/{order}', function (Order $order) {
        return new OrderRenew($order);
    });
    Route::get('/success/{order}', function (Order $order) {
        return new OrderSuccess($order);
    });
    Route::get('/refunded/{order}', function (Order $order) {
        return new OrderRefunded($order);
    });
    Route::get('/deleted/{order}', function (Order $order) {
        return new OrderDeleted($order);
    });
    Route::get('/suspended/{order}', function (Order $order) {
        return new OrderSuspended($order);
    });
    Route::get('/renew-reminder/{order}', function (Order $order) {
        return new OrderRenewReminder($order);
    });
    Route::get('/reminder', function () {
        return new Reminder();
    });
});

// Policy Routes
Route::get('terms-of-service', TermsOfService::class)->name('terms');
Route::get('privacy-policy', PrivacyPolicy::class)->name('privacy');
Route::get('refund-policy', RefundPolicy::class)->name('refund');

// Google Auth Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/google/auth/redirect', [GoogleAuthController::class, 'index'])->name('google.redirect');
    Route::get('/google/oauth/callback-url', [GoogleAuthController::class, 'verify']);
});

// Order purchase status
Route::get('/order/{order}/success', SuccessOrder::class)->name('order.success');
Route::get('/order/{order}/cancel', CancelOrder::class)->name('order.cancel');
Route::get('/order/renew/{order}/{billing}', RenewOrder::class)->name('order.renew');


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
