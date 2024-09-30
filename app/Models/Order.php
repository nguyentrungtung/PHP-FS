<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function customer(){
        return $this->belongsTo(customers::class, 'customer_id', 'id');
    }
}
