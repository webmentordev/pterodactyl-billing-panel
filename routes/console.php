<?php

use App\Models\Order;
use App\Jobs\OrderDeleteJob;
use App\Jobs\OrderSuspendJob;
use App\Jobs\OrderRenewReminderJob;
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
        ->where('expired_at', '<', now())
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
        ->where('expired_at', '<', now()->subDays(2))
        ->get();
    if ($orders->isNotEmpty()) {
        foreach ($orders as $order) {
            OrderDeleteJob::dispatch($order)->onQueue('suspend');
        }
    }
})->hourly();


// Send Order Renew Reminder Emails
Schedule::call(function () {
    $orders = Order::where('status', 'paid')
        ->where('has_emailed', false)
        ->where('expired_at', '>', now())
        ->where('expired_at', '<=', now()->addDays(2))
        ->get();
    if ($orders->isNotEmpty()) {
        foreach ($orders as $order) {
            OrderRenewReminderJob::dispatch($order)->onQueue('emailing');
        }
    }
})->hourly();
