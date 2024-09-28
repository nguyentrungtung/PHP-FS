<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\ProductImageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitValueRepositoryInterface;
use Illuminate\Http\Request;

class CartService{
    private $productRepositoryInterface;
    private $unitValueRepositoyInterface;
    private $productImageRopositoryInterface;
    private $uniRepositoryInterface;
    public function __construct(
        UnitRepositoryInterface $uniRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface, 
        UnitValueRepositoryInterface $unitValueRepositoyInterface, 
        ProductImageRepositoryInterface $productImageRopositoryInterface){
            $this->uniRepositoryInterface=$uniRepositoryInterface;
            $this->productRepositoryInterface = $productRepositoryInterface;
            $this->productImageRopositoryInterface = $productImageRopositoryInterface;
            $this->unitValueRepositoyInterface = $unitValueRepositoyInterface;
    }

    public function addToCart($request, $id)
    {
        // Lấy hình ảnh sản phẩm, nếu có
        $product = $this->productRepositoryInterface->find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại.',
            ], 404);
        }

        $cart = session()->get('cart', []);
        $productImage = $product->productImage->first()->image_url;

        // Cập nhật hoặc thêm mới sản phẩm vào giỏ hàng
        $productQuantity = isset($cart[$id]) ? $cart[$id]['product_quantity'] + $request->quantity : $request->quantity;
        if ($productQuantity < 1) {
            return response()->json([
                'status' => false,
                'message' => 'Số lượng sản phẩm không hợp lệ.',
            ], 400);
        }

        $cart[$id] = [
            'product_name' => $product->product_name,
            'product_image' => $productImage,
            'product_price' => $request->price,
            'product_unit' => $request->unitName,
            'product_quantity' => $productQuantity,
        ];

        // Cập nhật giỏ hàng vào session
        session()->put('cart', $cart);

        return response()->json([
            'status' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng thành công',
            'data' => [
                'cart' => $cart,
                'cartListIcon' => view('client.components.cart-icon', ['cart' => $cart])->render(),
                'cartList' => view('client.components.cart-list', ['cart' => $cart])->render(),
                'count_number' => count($cart),
            ]
        ], 200);
    }
    // 
    public function addCart($id){
        $cart=$this->getCart();
        // kiem tra san pham da co trong cart hay chua neu co se tang quantity len
        if(isset($cart[$id])){
            $cart[$id]['product_quantity']=(int)$cart[$id]['product_quantity']+1;
            session()->put('cart', $cart);
            return ;
        }
        // tao data cua san pham de luu vao cart
        $product = $this->productRepositoryInterface->find($id);
        if(!$product){
            return false;
        }
        $img= $this->productImageRopositoryInterface->getMainImg($id);
        $unitValue= $this->unitValueRepositoyInterface->getByProductID($id);
        $unit=$this->uniRepositoryInterface->find($unitValue->unit_id);
        // 
        $data=[
            'product_name'=> $product->product_name,
            'product_price'=> $product->product_price,
            'product_image'=>$img->image_url,
            'product_unit'=> $unit->unit_name,
            'product_quantity'=>1
        ];
        $cart[$id]=$data;
        session()->put('cart', $cart);
        return response()->json(['status' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng thành công',]);
    }
    // lay cart tu session
    public function getCart(){
        if(session()->has('cart')){
            return session()->get('cart');
        }
        return [];
    }
    // lay thong tin san pham de show mini cart
    public function show(){
        $cart=$this->getCart();
        return array_map(function($item){
            $item['product_image']=asset($item['product_image']);
            return $item;
        }, $cart);;
    }
}
