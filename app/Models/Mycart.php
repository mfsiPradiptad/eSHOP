<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mycart extends Model
{
    use HasFactory;
    public $table ='mycart';
    protected $fillable = [
        'id',
        'productId',
        'userId',
        'inCart'
    ];
    public $timestamps = false;
}
