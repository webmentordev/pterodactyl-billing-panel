<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Trial extends Model
{
    protected $fillable = [
        'email',
        'ip_address',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
