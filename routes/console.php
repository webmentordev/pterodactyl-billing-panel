<?php

use App\Models\Order;
use App\Jobs\OrderDeleteJob;
use App\Jobs\OrderSuspendJob;
use App\Jobs\OrderRenewReminderJob;
use App\Jobs\TrialOrderDeleteJob;
use Illuminate\Support\Facades\Schedule;

// Delete in-complete orders older than 3 hours
Schedule::call(function () {
    Order::where('status', 'pending')
        ->where('created_at', '<', now()->subHours(3))
        ->delete();
})->hourly();


// Delete canceled orders older than 2 days
Schedule::call(function () {
    Order::where('status', 'cancel')
        ->where('created_at', '<', now()->subDays(2))
        ->delete();
})->hourly();


// Cancel orders older than 3 hours if not paid
Schedule::call(function () {
    Order::where('status', 'pending')
        ->where('created_at', '<', now()->subHours(3))
        ->update(['status' => 'cancel']);
})->hourly();


// Suspend servers that have not been renewed
Schedule::call(function () {
    $orders = Order::where('status', 'paid')
        ->where('expire_at', '<', now())
        ->where('is_trial', false)
        ->get();
    if ($orders->isNotEmpty()) {
        foreach ($orders as $order) {
            OrderSuspendJob::dispatch($order)->onQueue('suspend');
        }
    }
})->hourly();


// Delete servers that were not renewed and had been suspended
Schedule::call(function () {
    $orders = Order::where('status', 'suspend')
        ->where('expire_at', '<', now()->subDays(2))
        ->where('is_trial', false)
        ->get();
    if ($orders->isNotEmpty()) {
        foreach ($orders as $order) {
            OrderDeleteJob::dispatch($order)->onQueue('suspend');
        }
    }
})->hourly();


// Delete Trial Orders
Schedule::call(function () {
    $orders = Order::where('status', 'trial')
        ->where('expire_at', '<', now())
        ->where('is_trial', true)
        ->get();
    if ($orders->isNotEmpty()) {
        foreach ($orders as $order) {
            TrialOrderDeleteJob::dispatch($order)->onQueue('trial');
        }
    }
})->hourly();
