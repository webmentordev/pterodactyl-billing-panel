<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'name',
        'size',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}