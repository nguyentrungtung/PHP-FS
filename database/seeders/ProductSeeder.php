<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Lấy tất cả categories và brands
        $catModel = new Categories();
        $cats = $catModel::all();
        
        $brandModel = new Brand();
        $brands = $brandModel::all();

        // Duyệt qua từng category
        foreach ($cats as $cat) {
            // Tạo ngẫu nhiên từ 10 đến 20 sản phẩm cho mỗi category
            $productCount = rand(10, 20);

            for ($i = 0; $i < $productCount; $i++) {
                // Tạo một sản phẩm mới
                $product = new Product();
                $product->product_name = 'Product ' . $i;  // Hoặc tên ngẫu nhiên
                $product->category_id = $cat->id;  // Gán category_id cho sản phẩm
                // Tạo giá sản phẩm ngẫu nhiên
                $product->product_price = rand(30000, 200000); // Ví dụ: giá ngẫu nhiên từ 100 đến 1000
                
                // Xác suất có old price (50%) và old price phải lớn hơn product_price
                if (rand(0, 1)) {
                    $product->product_price_old = rand($product->product_price *1.2, $product->product_price * 1.5);
                } else {
                    $product->product_price_old = null;
                }

                // Tạo SKU ngẫu nhiên (ví dụ: sử dụng Faker hoặc cách bạn muốn)
                $product->product_sku = strtoupper($faker->bothify('???-###-###'));

                // Tạo mô tả ngẫu nhiên
                $product->product_description = $faker->sentence;

                // Tạo số lượng ngẫu nhiên từ 0 đến 20
                $product->product_quantity = rand(0, 20);
                // Chọn một brand ngẫu nhiên
                $randomBrand = $brands->random();
                $product->brand_id = $randomBrand->id;  // Gán brand_id cho sản phẩm
                // Lưu sản phẩm
                $product->save();
            }
        }
    }
}
