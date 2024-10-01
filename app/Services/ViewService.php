<?php
    namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CustomersRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductImageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitValueRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

    class ViewService{
        private $productRopository;
        private $brandRepository;
        private $unitRepository;
        private $unitValueRepository;
        private $productImageRepository;
        private $categoryRepository;
        // 
        private $customerRepository;
        // 
        private $orderRepository;

        public function __construct(
            ProductRepositoryInterface $productRopository,
            BrandRepositoryInterface $brandRepository,
            UnitRepositoryInterface $unitRepository,
            ProductImageRepositoryInterface $productImageRepository,
            UnitValueRepositoryInterface $unitValueRepository,
            CategoryRepositoryInterface $categoryRepository,
            OrderRepositoryInterface $orderRepository,
            CustomersRepositoryInterface $customerRepository
        ) {
            $this->productRopository = $productRopository;
            $this->brandRepository = $brandRepository;
            $this->unitRepository = $unitRepository;
            $this->productImageRepository = $productImageRepository;
            $this->unitValueRepository = $unitValueRepository;
            $this->categoryRepository = $categoryRepository;
            $this->orderRepository = $orderRepository;
            $this->customerRepository = $customerRepository;
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
            // dd($data);
            foreach ($data as $product) {
                if(isset($product->product_price_old)){
                    $sale=round(round($product->product_price_old / $product->product_price, 2)-1,1)*100;
                    $old=number_format($product->product_price_old, 2, '.') ;
                }else{
                    $sale=0;
                    $old=0;
                }
                $response[]=['id'=>$product->id,
                    'product_name'=> $product->product_name,
                    'sale'=>$sale,
                    'brand_id'=>$product->brand_id,
                    'product_price'=>$product->product_price,
                    'product_old_price'=>$old,
                    'detail_url'=>route('product.show',['id' => $product->id]),
                    'add_url'=>route('cart.store',['id' => $product->id]),
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
            // lay ra history search
            $searchHistory = session()->get('search', []);
            // 
            if (!empty($value) && !in_array($value, $searchHistory)) {
                // Thêm giá trị tìm kiếm vào mảng
                $searchHistory[] = $value;
        
                // Nếu mảng có nhiều hơn 5 phần tử, loại bỏ phần tử đầu tiên
                if (count($searchHistory) > 5) {
                    array_shift($searchHistory); // Loại bỏ phần tử đầu tiên
                }
        
                // Cập nhật session với mảng tìm kiếm mới
                session()->put('search', $searchHistory);
            }
            $data=$this->productRopository->search($value);
            $products=$this->setData($data);
            // dd($products);
            return $products;
        }
        // 
        public function getOrders(){
            return $this->customerRepository->getOrders();
        }
        // 
        public function getProductsByOrders(){
            $id=Auth::user()->id;
            $products=$this->productRopository->getByOrderIds();
            // $products=$this->setData($data);
            // dd($products);
            return $products;
        }
        //
        public function getProductsByOrder($id){
            $products=$this->productRopository->getByOrderId($id);
            return $products;
        }
        // 
        // /checking
        public function checking(){
            return $this->customerRepository->getProductsByOrderIdS();
        }
    }
