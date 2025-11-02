<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Upload;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('has-upload-space', function ($user) {
            if(!$user->is_admin){
                $maxSizeKB = 61440;
                $currentSize = Upload::where('user_id', $user->id)->sum('size');
                $orders_active = Order::where('user_id', $user->id)->where('status', 'paid')->get();
                return $currentSize < $maxSizeKB && count($orders_active) > 0;
            }else{
                return true;
            }
        });

        Gate::define('manage-upload', function ($user, Upload $upload) {
            return $upload->user_id === $user->id;
        });
    }
}