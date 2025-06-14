<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $fillable = ['original_url', 'short_code', 'expires_at'];
    protected $dates = ['expires_at'];
}
