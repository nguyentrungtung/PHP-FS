<?php
    namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductImageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitValueRepositoryInterface;
use Illuminate\Http\Request;

    class ViewService{
        private $productRopository;
        private $brandRepository;
        private $unitRepository;
        private $unitValueRepository;
        private $productImageRepository;
        private $categoryRepository;

        public function __construct(
            ProductRepositoryInterface $productRopository,
            BrandRepositoryInterface $brandRepository,
            UnitRepositoryInterface $unitRepository,
            ProductImageRepositoryInterface $productImageRepository,
            UnitValueRepositoryInterface $unitValueRepository,
            CategoryRepositoryInterface $categoryRepository
        ) {
            $this->productRopository = $productRopository;
            $this->brandRepository = $brandRepository;
            $this->unitRepository = $unitRepository;
            $this->productImageRepository = $productImageRepository;
            $this->unitValueRepository = $unitValueRepository;
            $this->categoryRepository = $categoryRepository;
        }
        // 
        public function index(){
            $data=$this->productRopository->getToday();
            // dd($data);
            $todays=$this->setData($data);
            // dd($todays);
            $brands= $this->brandRepository->all();
            return compact('todays','brands');
        }
        // chuyen doi du lieu truoc khi tra ve controller 
        private function setData($data){
            $response=[];
            foreach ($data as $product) {
                if(isset($product->product_price_old)){
                    $sale=round(round($product->product_price_old / $product->product_price, 2)-1,1)*100;  
                    $old=number_format($product->product_price_old, 0, ',', '.') . ' ₫';
                }else{
                    $sale= 0;
                    $old=0;
                }
                $price=number_format($product->product_price, 0, ',', '.') . ' ₫';
                $response[]=['id'=>$product->id,
                    'product_name'=> $product->product_name,
                    'sale'=>$sale,
                    'brand_id'=>$product->brand_id,
                    'product_price'=>$price,
                    'product_old_price'=>$old,
                    'product_unit'=>$this->getUnit($product->id),
                    'product_image'=>$this->getMainImg($product->id)
                ];
            }
            return $response;
        }
        // lay anh chinh cua san pham
        public function getMainImg($productId){
            $mainImage = $this->productImageRepository->getMainImg($productId);
            return asset($mainImage?$mainImage->image_url:'img/product.png');
        }
        // lay unit cua san pham
        public function getUnit($productId){
            $unitValue=$this->unitValueRepository->getByProductID($productId);
            $unit=$this->unitRepository->find($unitValue->unit_id);
            return $unit->unit_name;
        }
        //
        // 
        public function getByCat(Request $request){
            $data = $this->productRopository->fill($request);
            // dd($data);
            $products=$this->setData($data['products']);
            $remain=$data['remain'];
            $brands= $this->brandRepository->getByProductIds($products);
            return compact('products','remain','brands');
        }
        // 
        public function fill($request){
            $data= $this->productRopository->fill($request);
            $products=$this->setData($data['products']);
            $remain=$data['remain'];
            // dd($data);
            return response()->json(['products'=> $products,'remain'=> $remain]);
        }
        // tim kiem san pham theo ten
        public function search($request){
            $value=$request->input('search');
            $data=$this->productRopository->search($value);
            $products=$this->setData($data['products']);
            $remain=$data['remain'];
            return compact('remain','products');
        }
    }