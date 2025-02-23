<?php

use App\Models\Order;
use App\Models\Usage;
use App\Livewire\Home;
use App\Mail\Reminder;
use App\Models\Server;
use App\Mail\OrderRenew;
use App\Mail\OrderDeleted;
use App\Mail\OrderSuccess;
use App\Livewire\FreeTrial;
use App\Mail\OrderRefunded;
use App\Mail\OrderSuspended;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Trials;
use App\Livewire\RefundPolicy;
use App\Livewire\Admin\Refunds;
use App\Livewire\Admin\Reviews;
use App\Livewire\PrivacyPolicy;
use App\Livewire\User\Billings;
use App\Mail\TrialServerCreate;
use App\Mail\TrialServerDelete;
use App\Livewire\TermsOfService;
use App\Livewire\User\Dashboard;
use App\Mail\OrderRenewReminder;
use App\Livewire\Admin\Reminders;
use App\Livewire\About as AboutUs;
use App\Mail\TrialRequestRejected;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Livewire\Package as SinglePackage;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SiteMapController;
use App\Livewire\Order\Renew as RenewOrder;
use App\Livewire\Admin\Orders as AdminOrders;
use App\Livewire\Order\Cancel as CancelOrder;
use App\Http\Controllers\GoogleAuthController;
use App\Livewire\Admin\Billing as AdminBilling;
use App\Livewire\Order\Success as SuccessOrder;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Emails\Create as AdminCreateEmail;
use App\Livewire\Admin\Emails\Emails as AdminEmails;
use App\Livewire\Admin\Servers\Create as CreateServer;
use App\Livewire\Admin\Servers\Servers as AdminServer;
use App\Livewire\Admin\Servers\Update as UpdateServer;

// Open Routes
Route::get('/', Home::class)->name('home');
Route::get('/buy-dedicated-rust-server-hosting', SinglePackage::class)->name('package');
Route::get('/free-trial-rust-server-hosting', FreeTrial::class)->name('free.trial');
Route::get('/about-us', AboutUs::class)->name('about');

// Routes with Throttle
Route::post('/submit/trial-request', [RequestController::class, 'requestTrial'])
    ->middleware(['throttle:1,10'])
    ->name('request.trial');

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
    Route::get('/orders/{order?}', AdminOrders::class)->name('orders');
    Route::get('/reminders', Reminders::class)->name('reminders');
    Route::get('/refunds', Refunds::class)->name('refunds');
    Route::get('/reviews', Reviews::class)->name('reviews');
    Route::get('/trails', Trials::class)->name('trails');

    Route::get('/emails', AdminEmails::class)->name('emails');
    Route::get('/emails/create', AdminCreateEmail::class)->name('emails.create');

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
    Route::get('/rejected-trial', function () {
        return new TrialRequestRejected();
    });
    Route::get('/approved/{order}', function (Order $order) {
        return new TrialServerCreate($order, 'adsasddasadsdas');
    });
    Route::get('/trial-delete/{order}', function (Order $order) {
        return new TrialServerDelete($order);
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

// SEO Controller
Route::get('/sitemap.xml', [SiteMapController::class, 'index'])->name('sitemap');

require __DIR__ . '/auth.php';
