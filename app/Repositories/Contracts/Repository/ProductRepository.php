<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    public function getByCatId($catId){
        return $this->model->where('category_id', $catId)->get();
    }
    // lay cac san pham co brand tuong ung
    public function fill($request){
        $brands=$request->input('brands');
        $sort=$request->input('sort');
        $start=$request->input('start');
        $limit=$request->input('limit');
        $catId=$request->input('catId');
        // $brands=['1'];
        // $sort='sale';
        // $cart=13;
        // $start=0;
        // $limit= 20;
        // lay danh sach cac cat con cua cat hien tai
        $categoryIds = Categories::where('categories_parent_id', $catId)->pluck('id');
        // Khởi tạo query với điều kiện category_id là $catId hoặc nằm trong danh sách category con
        $query = $this->model->where(function($query) use ($catId, $categoryIds) {
            $query->where('category_id', $catId)
                  ->orWhereIn('category_id', $categoryIds);
        });
        // kiem tran brands co rong hay khong
        if ($brands!==null) {
            // dd($brands);
            $query->whereIn('brand_id', $brands);
        }
        // kiem tra sort co rong hay khong
        if($sort!==null){
            if($sort==='sale'){
                $query= $query->orderBy(DB::raw('product_price_old / product_price'), 'desc');
            }
            // if($sort=== 'order'){
            //     $query= $query->join('orderdetail', 'products.id', '=', 'orderdetail.product_id') // Join bảng products và orderdetail
            //     ->select('products.*', DB::raw('SUM(orderdetail.quantity) as total_sold')) // Tính tổng số lượng bán
            //     ->groupBy('products.id') // Nhóm theo id sản phẩm
            //     ->orderBy('total_sold', 'desc'); // Sắp xếp theo tổng số lượng bán giảm dần
            // }
        }
        
        $count = $query->count();
        $remain=$count - (int)($start+$limit);
        $products= $query->skip($start)->take($limit)->get();
        return compact('products','remain');
    }
    // 
    // tim kiem san pham theo ten
    public function search($value){
        $count = $this->model->whereRaw('LOWER(product_name) like ?', ['%' . strtolower($value) . '%'])->count();
        $remain=$count - 8;
        $products = $this->model->whereRaw('LOWER(product_name) like ?', ['%' . strtolower($value) . '%'])
        ->get();
        return compact('remain','products');
    }
    // 
    public function getByOrderId($orderId){
        $userID = Auth::user()->id;
        $products = $this->model
        ->whereHas('orderDetails.order', function ($query) use ($userID, $orderId) {
        // Lọc theo orderId và customer_id
        $query->where('id', $orderId) // Lọc theo order_id
              ->where('customer_id', $userID); // Kiểm tra customer_id có trùng với userID
        })
        ->with([
            'productImage' => function ($query) {
                $query->where('image_type', 'main'); // Lấy ảnh có type là 'main'
            },
            'orderDetails' => function ($query) {
                $query->select('product_id', 'quantity'); // Lấy product_id và quantity từ order_details
            }
        ])
        ->paginate(10); // Phân trang 10 sản phẩm mỗi trang
        // dd($products);
        return $products;
    }
    // 
    public function getByOrderIds(){
        $userID=Auth::user()->id;
        $products = $this->model
        ->whereHas('orderDetails.order.customer', function ($query) use ($userID) {
            $query->where('id', $userID); // Lấy các đơn hàng mà customer_id bằng userID
        })
        ->with(['productImage' => function ($query) {
            $query->where('image_type', 'main'); // Lấy ảnh có type là 'main'
        }])
        ->paginate(10); // Phân trang 10 sản phẩm mỗi trang
        return $products;
    }
}
