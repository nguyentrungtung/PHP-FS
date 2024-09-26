<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create data for units table
        DB::table('units')->insert([
            ['unit_name'=>'Thùng'],
            ['unit_name'=>'Hộp'],
            ['unit_name'=>'Túi'],
            ['unit_name'=>'Gói'],
            ['unit_name'=>'Cân'],
            ['unit_name'=>'Lạng'],
        ]);
    }
}
