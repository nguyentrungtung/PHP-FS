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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartSummary = $this->cartService->getCartSummary();

        return view('client.pages.cart-detail', [
            'subtotal' => $cartSummary['subtotal'],
            'totalSaving' => $cartSummary['totalSaving'],
            'totalPrice' => $cartSummary['totalPrice'],
        ]);
    }

    public function store(Request $request, $id)
    {
        return $this->cartService->store($request, $id);
    }

    public function update(Request $request)
    {
        return $this->cartService->update($request);
    }

    public function delete()
    {
        return $this->cartService->delete();
    }

}
