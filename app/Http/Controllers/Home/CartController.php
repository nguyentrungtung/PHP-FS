<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartService;
    private $productService;

    public function __construct(
        ProductService             $productService,
        CartService                $cartService,
    )
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
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
