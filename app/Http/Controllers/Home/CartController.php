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
//        $carts = session()->get('cart', []);

        return view('client.pages.cart-detail');
    }

    public function addToCart(Request $request, $id)
    {
        return $this->cartService->addToCart($request, $id);
    }

    public function updateCart(Request $request)
    {
        return $this->cartService->updateCart($request);
    }

    public function clearCart(){
        return $this->cartService->clearCart();
    }
}
