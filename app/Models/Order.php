<?php

namespace App\Models;

use App\Models\User;
use App\Models\Usage;
use App\Models\Server;
use App\Models\Billing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'stripe_order_id',
        'price',
        'has_paid',
        'status',
        'checkout_url',
        'expire_at',
        'total_payments',
        'server_id',
        'is_active'
    ];

    protected $casts = [
        'expire_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }

    public function server()
    {
        return $this->hasMany(Server::class);
    }

    public function usage()
    {
        return $this->hasMany(Usage::class);
    }
}
