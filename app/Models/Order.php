<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_phone',
        'status',
        'total',
        'customer_address',
        'payment_method',
        'order_date',
        'order_note'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function customer(){
        return $this->belongsTo(customers::class, 'customer_id', 'id');
    }
}
