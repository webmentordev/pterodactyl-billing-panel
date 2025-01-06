<?php

use App\Models\Order;
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

// Cancel orders older than 3 hours
Schedule::call(function () {
    Order::where('status', 'pending')
        ->where('created_at', '<', now()->subHours(3))
        ->update(['status' => 'cancel']);
})->hourly();
