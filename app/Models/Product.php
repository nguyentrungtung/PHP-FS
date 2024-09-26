<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'category_id',
        'product_name',
        'product_price',
        'product_price_old',
        'product_sku',
        'product_description',
        'brand_id',
        'coupon_id'
    ];
}
