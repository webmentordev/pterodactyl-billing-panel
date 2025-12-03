<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Usage;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'node_id',
        'name',
        'processor',
        'ip',
        'domain',
        'cores',
        'threads',
        'threads_limit',
        'swap',
        'ram',
        'ram_type',
        'storage',
        'storage_type',
        'location',
        'is_active'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class)->where('is_trial', false);
    }

    public function trials()
    {
        return $this->hasMany(Order::class, 'server_id', 'id')->where('is_trial', true);
    }

    public function usage()
    {
        return $this->hasMany(Usage::class);
    }
}