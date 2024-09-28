<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;

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
        
        $brandModel = new Brands();
        $brands = $brandModel::all();

        // Lấy tất cả các file ảnh trong thư mục public/upload
        $imageDirectory = public_path('uploads/products');
        $allImages = File::files($imageDirectory);

        // Duyệt qua từng category
        foreach ($cats as $cat) {
            // Tạo ngẫu nhiên từ 10 đến 20 sản phẩm cho mỗi category
            $productCount = rand(5,10 );

            for ($i = 0; $i < $productCount; $i++) {
                // Tạo một sản phẩm mới
                $product = new Product();
                $product->product_name = 'Product_cat_'.$cat->categories_name.'_'.$cat->id.'_per_' . $i;
                $product->category_id = $cat->id;
                $product->product_price = rand(30000, 200000);

                if (rand(0, 1)) {
                    $product->product_price_old = rand($product->product_price * 1.2, $product->product_price * 1.5);
                } else {
                    $product->product_price_old = null;
                }

                $product->product_sku = strtoupper($faker->bothify('???-###-###'));
                $product->product_description = $faker->sentence;
                $product->product_quantity = rand(0, 20);
                $randomBrand = $brands->random();
                $product->brand_id = $randomBrand->id;
                $product->save();

                // Tạo quan hệ với bảng product_images
                if (count($allImages) > 0) {
                    // Chọn một ảnh ngẫu nhiên cho ảnh chính
                    $mainImage = $faker->randomElement($allImages);
                    $mainImagePath = 'uploads/products/' . $mainImage->getFilename();

                    // Tạo record cho ảnh chính
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_url = $mainImagePath;
                    $productImage->image_type = 'main';
                    $productImage->save();

                    // Tạo một số ảnh phụ
                    $timelineImagesCount = rand(1, 3);
                    for ($j = 0; $j < $timelineImagesCount; $j++) {
                        $timelineImage = $faker->randomElement($allImages);
                        $timelineImagePath = 'uploads/products/' . $timelineImage->getFilename();
                        $timelineImageRecord = new ProductImage();
                        $timelineImageRecord->product_id = $product->id;
                        $timelineImageRecord->image_url = $timelineImagePath;
                        $timelineImageRecord->image_type = 'thumbnail';
                        $timelineImageRecord->save();
                    }
                }
            }
        }
    }
}
