<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Billing extends Model
{
    use HasUuids;

    protected $fillable = [
        'order_id',
        'gateway_order_id',
        'gateway',
        'checkout_url',
        'has_paid',
        'status',
        'expire_at'
    ];

    protected $casts = [
        'expire_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
