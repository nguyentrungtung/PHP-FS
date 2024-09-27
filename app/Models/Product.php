<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\ProductImage;
use App\Models\UnitValue;
use App\Models\Unit;

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

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function unitValues()
    {
        return $this->hasMany(UnitValue::class, 'product_id');
    }
    public function units(){
        return $this->hasMany(Unit::class);
    }
}
