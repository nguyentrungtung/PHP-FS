<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class customers extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'customer_address',
        'customer_email',
        'customer_phone',
        'customer_gender',
        'city',
        'state',
        'country',
        'date_of_birth',
        'password'
    ];
    protected $hidden = [
        'password',
        // 'remember_token',
    ];
}
