<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        ProductService             $productService,
        ProductRepositoryInterface $productRepositoryInterface,
    )
    {
        $this->productService = $productService;
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function showCart()
    {
        $cart[32] = [
            'product_name' => 'Lốc 6 chai nước tăng lực nhân sâm Sting 330ml',
            'product_image' => 'https://hcm.fstorage.vn/images/2023/05/ndfc_thumnail_web-10-1--20230526074339.jpg',
            'product_price' => 99000,
            'product_unit' => 'Gói',
            'product_quantity' => 7,
        ];
        $cart[33] = [
            'product_name' => 'Nước tăng lực nhân sâm Sting 330ml',
            'product_image' => 'https://hcm.fstorage.vn/images/2023/05/ndfc_thumnail_web-10-1--20230526074339.jpg',
            'product_price' => 19000,
            'product_unit' => 'chai',
            'product_quantity' => 7,
        ];

        session()->put('cart', $cart);
        $carts = session()->get('cart', []);

        return view('client.pages.cart-detail', compact('carts'));
    }
}
