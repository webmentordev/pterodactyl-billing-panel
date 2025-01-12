<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'avatar_url',
        'review_url',
        'reviewed_at',
        'platform',
        'stars',
        'content'
    ];
}
