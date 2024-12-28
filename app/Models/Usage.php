<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Server;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    protected $fillable = [
        'order_id',
        'server_id',
        'cpu_pin_1',
        'cpu_pin_2',
        'ram',
        'storage',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}