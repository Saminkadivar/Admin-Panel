<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{

     use SoftDeletes,HasFactory;
    protected $fillable = [
        'p_name',
        'category',
        'price',
        'stock',
        'product_picture',


    ];
    protected $dates = ['delete_at'];
}
