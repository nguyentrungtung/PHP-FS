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
        $todayProducts = $this->model::whereDate('created_at', Carbon::today())
        ->take(10)
        ->get();
        $data=$this->setShortData($todayProducts,true);
        for( $i = 0; $i < count($data); $i++ ){
            $mainImage = ProductImage::where('product_id', $data[$i]['id'])
                ->where('image_type', 'main')
                ->first();
            //  dd($mainImage);
            $data[$i]['img_url']=$mainImage?$mainImage->image_url:'img/product.png';
        }
        // dd($data);
        return $data;
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
        $reponseProdct=$this->setShortData($products,true);
        for( $i = 0; $i < count($reponseProdct); $i++ ){
            $mainImage = ProductImage::where('product_id', $reponseProdct[$i]['id'])
                ->where('image_type', 'main')
                ->first();
            //  dd($mainImage);
            $reponseProdct[$i]['img_url']=asset($mainImage?$mainImage->image_url:'img/product.png');
        }
        // dd($reponseProdct);
        return response()->json(['products'=>$reponseProdct,'remain'=>max(0, $remain)]);
    }
    
    // lay san pham theo list id
    public function getByList($data){
        $products = $this->model::whereIn('id', $data)->get();
        return $this->setShortData($products,false);
    }
    // 
    private function setShortData($products,$check){
        $reponseProdct=[];
        foreach ($products as $product) {
            if(isset($product->product_price_old)){
                $sale=round(round($product->product_price_old / $product->product_price, 2)-1,1)*100;
                
                if($check){
                    $old=number_format($product->product_price_old, 0, ',', '.') . ' ₫';
                    $price=number_format($product->product_price, 0, ',', '.') . ' ₫';
                }else{
                    $price=$product->product_price;
                    $old=$product->product_price_old;
                }
            }else{
                $price=$product->product_price;
                $sale= 0;
                $old= 0;
            }
            // number_format($product->product_price, 0, ',', '.') . ' ₫';
            $data=['id'=>$product->id,
                'name'=> $product->product_name,
                'price'=>$price,
                'sale'=>$sale,
                'old'=>$old,
                'img_url'=>asset('img/product.png')
            ];
            $reponseProdct[]=$data;
            
        }
        return $reponseProdct;
    }
}
