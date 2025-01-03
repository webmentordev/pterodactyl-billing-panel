<?php

use App\Models\Order;
use App\Models\Usage;
use App\Livewire\Home;
use App\Models\Server;
use App\Mail\OrderSuccess;
use App\Livewire\Admin\Users;
use App\Livewire\User\Dashboard;
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
Route::get('/email/{order}', function (Order $order) {
    return new OrderSuccess($order, null);
    // Mail::to($order->user->email)->send(new OrderSuccess($order));
    // return "Email Sent!";
});


Route::get('/ports/', function () {
    $server = Server::where('id', 1)->first();
    $assignedThreads = Usage::where('server_id', $server->id)
        ->pluck('cpu_pin_1', 'cpu_pin_2')
        ->flatten()
        ->toArray();
    for ($index = 0; $index < $server->threads; $index += 2) {
        $firstThread = $index;
        $secondThread = $index + 1;
        if (!in_array($firstThread, $assignedThreads) && !in_array($secondThread, $assignedThreads)) {
            return [$firstThread, $secondThread];
        }
    }
    $newThreadStart = max($server->threads, max($assignedThreads) + 2);
    return [$newThreadStart, $newThreadStart + 1];
});
require __DIR__ . '/auth.php';
