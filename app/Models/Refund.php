<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'refunded_at',
        'reason'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected $casts = [
        'refunded_at' => 'datetime'
    ];
}
