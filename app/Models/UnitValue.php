<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'product_id',
        'value'
    ];
}
