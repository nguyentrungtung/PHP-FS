<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("categories")->insert([
            ['categories_name'=>'Giá siêu rẻ'],
            ['categories_name'=>'Sản phẩm khuyến mại'],
            ['categories_name'=>'Ưu đãi hội viên'],
            ['categories_name'=>'Điện gia dụng'],
            ['categories_name'=>'Văn phòng phẩm - Đồ chơi'],
        ]);
        $milkID=DB::table('categories')->insertGetId([
            'categories_name'=>'Giá siêu rẻ'
        ]);
        DB::table("categories")->insert([
            ['categories_name'=>'Sữa tươi',
            'categories_parent_id'=>$milkID],
            ['categories_name'=>'Sữa hạt - Sữa đậu',
            'categories_parent_id'=>$milkID],
            ['categories_name'=>'Sữa bột',
            'categories_parent_id'=>$milkID],
            ['categories_name'=>'Bơ sữa - Phô mai',
            'categories_parent_id'=>$milkID],
            ['categories_name'=>'Sữa Đặc ',
            'categories_parent_id'=>$milkID],
            ['categories_name'=>'Sữa chua - váng sữa',
            'categories_parent_id'=>$milkID],
        ]);
        $vegeID=DB::table('categories')->insertGetId([
            'categories_name'=>'Rau củ - Trái cây'
        ]);
        DB::table("categories")->insert([
            ['categories_name'=>'Rau lá',
            'categories_parent_id'=>$vegeID],
            ['categories_name'=>'Củ quả',
            'categories_parent_id'=>$vegeID],
            ['categories_name'=>'Trái cây tươi',
            'categories_parent_id'=>$vegeID],
        ]);
        $takeCareID=DB::table('categories')->insertGetId([
            'categories_name'=>'Chăm sóc cá nhân'
        ]);
        DB::table("categories")->insert([
            ['categories_name'=>'chăm sóc răng miệng',
            'categories_parent_id'=>$takeCareID],
            ['categories_name'=>'chăm sóc da',
            'categories_parent_id'=>$takeCareID],
            ['categories_name'=>'Chăm sóc tóc',
            'categories_parent_id'=>$takeCareID],
            ['categories_name'=>'Chăm sóc phụ nữ',
            'categories_parent_id'=>$takeCareID],
            ['categories_name'=>'Chăm sóc cá nhân khác',
            'categories_parent_id'=>$takeCareID],
            ['categories_name'=>'Mỹ phẩm',
            'categories_parent_id'=>$takeCareID],
            ['categories_name'=>'Khăn giấy - Khăn ướt',
            'categories_parent_id'=>$takeCareID],
        ]);

        $meadID=DB::table('categories')->insertGetId([
            'categories_name'=>'Thịt - Hải sản tươi'
        ]);
        DB::table("categories")->insert([
            ['categories_name'=>'Thịt',
            'categories_parent_id'=>$meadID],
            ['categories_name'=>'Hải sản',
            'categories_parent_id'=>$meadID]
        ]);
        $cakeID=DB::table('categories')->insertGetId([
            'categories_name'=>'Bánh kẹo'
        ]);
        DB::table("categories")->insert([
            ['categories_name'=>'Bánh xốp - Bánh quy',
            'categories_parent_id'=>$cakeID],
            ['categories_name'=>'Kẹo - Chocolate',
            'categories_parent_id'=>$cakeID],
            ['categories_name'=>'Bánh snack',
            'categories_parent_id'=>$cakeID],
            ['categories_name'=>'Hạt - Hoa quả sấy khô',
            'categories_parent_id'=>$cakeID],
        ]);
        $piaID=DB::table('categories')->insertGetId([
            'categories_name'=>'Đồ uống có cồn'
        ]);
        DB::table("categories")->insert([
            ['categories_name'=>'Bia',
            'categories_parent_id'=>$piaID],
        ]);
        $drinkID=DB::table('categories')->insertGetId([
            'categories_name'=>'Đồ uống giải khát'
        ]);
        DB::table("categories")->insert([
            ['categories_name'=>'Cà phê',
            'categories_parent_id'=>$drinkID],
            ['categories_name'=>'Nước suối',
            'categories_parent_id'=>$drinkID],
            ['categories_name'=>'Nước ngọt',
            'categories_parent_id'=>$drinkID],
            ['categories_name'=>'Trà - các loại khác',
            'categories_parent_id'=>$drinkID],
        ]);
        $fashID=DB::table('categories')->insertGetId([
            'categories_name'=>'Mì - Thực phẩm ăn liền'
        ]);
        DB::table("categories")->insert([
            ['categories_name'=>'Mì',
            'categories_parent_id'=>$fashID],
            ['categories_name'=>'Miến - Hủ tíu - Bánh canh',
            'categories_parent_id'=>$fashID],
            ['categories_name'=>'Cháo',
            'categories_parent_id'=>$fashID],
            ['categories_name'=>'Bún - Phở',
            'categories_parent_id'=>$fashID],
        ]);
        $dryID=DB::table('categories')->insertGetId([
            'categories_name'=>'Thực phẩm khô'
        ]);
        DB::table("categories")->insert([
            ['categories_name'=>'Gạo - Nông sản khô',
            'categories_parent_id'=>$dryID],
            ['categories_name'=>'Ngũ cốc - Yến mạch',
            'categories_parent_id'=>$dryID],
            ['categories_name'=>'Thực phẩm đóng hộp',
            'categories_parent_id'=>$dryID],
            ['categories_name'=>'Rong biển - Tảo biển',
            'categories_parent_id'=>$dryID],
            ['categories_name'=>'Bột các loại',
            'categories_parent_id'=>$dryID],
            ['categories_name'=>'Thực phẩm chay',
            'categories_parent_id'=>$dryID],
        ]);
    }
}
