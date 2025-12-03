<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Upload;
use App\Livewire\Uploads;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Billing;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'panel_user_id',
        'lemon_user_id',
        'subscribed',
        'password',
        'ip_address',
        'is_admin',
        'google_id',
        'google_token',
        'google_refresh_token',
        'google_avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function active_orders()
    {
        return $this->hasMany(Order::class)->where('status', 'paid');
    }

    public function trials()
    {
        return $this->hasMany(Order::class)->where('is_trial', true);
    }

    public function billings(){
        return $this->hasManyThrough(Billing::class, Order::class);
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
}