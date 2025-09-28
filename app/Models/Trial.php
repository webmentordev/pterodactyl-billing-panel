<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Trial extends Model
{
    protected $fillable = [
        'email',
        'ip_address',
        'status',
        'will_delete',
        'token',
        'viewed_email',
        'user_agent'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}