<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Brand;

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
        'product_quantity'
    ];

    // Mối quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    // Mối quan hệ với Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
