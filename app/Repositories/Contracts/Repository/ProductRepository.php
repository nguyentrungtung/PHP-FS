<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function generateSKU($categoryId)
    {
        // Lấy ID danh mục và chuyển thành chuỗi
        $categoryPart = str_pad($categoryId, 3, '0', STR_PAD_LEFT); // Ví dụ: danh mục ID là 5 sẽ thành 005

        // Tạo một số ngẫu nhiên 4 chữ số
        $randomPart = rand(1000, 9999);

        // Tạo mã SKU
        return $categoryPart.$randomPart;
    }

    public function productRelate($productId)
    {
        // Lấy thông tin của sản phẩm hiện tại
        $product = $this->model->find($productId);
        // Lấy các sản phẩm liên quan cùng danh mục nhưng không bao gồm sản phẩm hiện tại
        return $this->model->where('category_id', $product->category_id)
            ->where('id', '!=', $productId)  // Không lấy chính nó
            ->limit(5)
            ->get();
    }

    // 
    public function getToday(){
        return $this->model::whereDate('created_at', Carbon::today())
        ->take(10)
        ->get();
    }
    // 
    public function render($cat,$start,$limit){
        $categoryIds = Categories::where('categories_parent_id', $cat)->pluck('id');
        $count = $this->model::where('category_id', $cat)->orWhereIn('category_id', $categoryIds)->count();
        $remain=$count - (int)($start+$limit);
        $products = $this->model
        ->where('category_id', $cat)
        ->orWhereIn('category_id', $categoryIds)
        ->skip($start)
        ->take($limit)
        ->get();
        return compact('remain','products');
    }

}
