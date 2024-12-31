<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Usage;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'name',
        'processor',
        'ip',
        'domain',
        'cores',
        'threads',
        'swap',
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

    public function usage()
    {
        return $this->hasMany(Usage::class);
    }
}
