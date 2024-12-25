<?php

namespace App\Models;

use App\Models\User;
use App\Models\Billing;
use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'package_id',
        'stripe_order_id',
        'price',
        'has_paid',
        'status',
        'checkout_url',
        'expire_at',
        'total_payments'
    ];

    protected $casts = [
        'expire_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }
}
