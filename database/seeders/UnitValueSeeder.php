<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Unit;
use App\Models\UnitValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $units=Unit::all();
        $products=Product::all();
        // 
        foreach ($products as $product) {
            $value=new UnitValue;
            $unit=$units->random();
            $value->unit_id=$unit->id;
            $value->product_id=$product->id;
            $value->value=rand(1,12);
            $value->save();
        }
    }
}
