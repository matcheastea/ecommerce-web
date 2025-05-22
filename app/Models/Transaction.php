<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'username',
        'product_name',
        'product_category',
        'quantity',
        'total',
        'transaction_datetime',
    ];
}
