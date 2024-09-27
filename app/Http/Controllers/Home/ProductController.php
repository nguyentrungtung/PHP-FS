<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(
        ProductService $productService,
    )
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Display the specified resource.
     */
    public function productDetail(string $id)
    {
        $product = $this->productService->getProductById($id);
        $productRelates = $this->productService->productRelate($id);

        return view('client.pages.product-detail', compact('product', 'productRelates'));
    }
}
