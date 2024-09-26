<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',//tieu de
        'description',//mo ta
        'discount_type',// hinh thuc giam gia
        'discount_value	',//gia tri giam
        'max_discount',//gia tri giam toi da
        'start_date ',//ngay bat dau ap dung
        'end_date',//ngay ket thuc 
        'status'//trang thai
    ];
}
