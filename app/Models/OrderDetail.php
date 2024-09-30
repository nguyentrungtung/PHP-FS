<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Quan hệ với bảng Product (1-n: Một sản phẩm có nhiều chi tiết đơn hàng)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
