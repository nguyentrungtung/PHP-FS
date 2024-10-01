<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    protected $fillable = [
        'town_name',
        'district_id'
    ];
    // 
    public function district(){
        return $this->belongsTo(District::class);
    }
}
