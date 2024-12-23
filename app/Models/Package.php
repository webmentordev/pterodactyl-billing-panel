<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'user_id',
        'stripe_id',
        'name',
        'image',
        'price',
        'body',
        'players',
        'storage',
        'storage_type',
        'cores',
        'ram',
        'ram_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
