<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'date', 'notes',
        'package_id', 'package_title', 'package_price', 'total_price', 'status'
    ];

    protected $casts = [
        'date' => 'date',
        'package_price' => 'integer',
        'total_price' => 'integer',
    ];
}