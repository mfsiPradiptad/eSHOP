<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $table = 'orderDetails';
    protected $fillable = [
        'textOrderId',
        'intUserid',
        'orderName',
        'orderMobile',
        'orderAddress',
        'intTotalAmount'
    ];

}
