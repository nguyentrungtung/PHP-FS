<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionsTableSeeser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('promotions')->insert([
            ['title'=>'Ưu đãi 20-10',
            'description'=> 'Giảm giá các sản phẩm Chăm sóc phụ nữ, tóc, chăm sóc da từ ngày 25/9 đến hết ngày 20/10',
            'discount_type'=>'percent',
            'discount_value'=>'25%',
            'max_discount'=>'100000',
            'start_date'=>'2024/09/25',
            'end_date'=>'2024/10/20',
            'status'=>'active'],
            ['title'=>'Ưu đãi sản phẩm mới',
            'description'=> 'Giảm giá 50k cho các sản phẩm thuộc nhãn hàng omo từ 15/9 đến hết ngày 15/10',
            'discount_type'=>'default',
            'discount_value'=>'500000',
            'max_discount'=>'50000',
            'start_date'=>'2024/09/15',
            'end_date'=>'2024/10/15',
            'status'=>'active']
        ]);
    }
}
