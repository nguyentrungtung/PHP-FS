<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private $productRepositoryInterface;
    private $productService;
    private $cartService;

    public function __construct(
        ProductService             $productService,
        CartService                $cartService,
        ProductRepositoryInterface $productRepositoryInterface,
    )
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->cartService = $cartService;
        $this->productRepositoryInterface = $productRepositoryInterface;
    }
    // 
    public function count(){
        $cart= $this->cartService->getCart();
        $count=0;
        foreach($cart as $item){
            $count+=$item['product_quantity'];
        }
        return $count;
    }
    /**
     * Display a listing of the resource.
     */
    public function showCart()
    {
        $carts = $this->cartService->getCart();
        return view('client.pages.cart-detail', compact('carts'));
    }
    // 
    // Them san pham vao trong cart
    public function store($id){
        return $this->cartService->addCart($id);
    }
    // 
    // lay du lieu cart de show trong short cart detail
    // 
    public function show(){

        return $this->cartService->show();
    }
}
