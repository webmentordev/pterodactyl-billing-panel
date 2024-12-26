<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'name',
        'ip',
        'cores',
        'ram',
        'ram_type',
        'storage',
        'storage_type',
        'location'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
