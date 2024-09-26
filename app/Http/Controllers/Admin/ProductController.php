<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;

class ProductController extends Controller
{
    private $limit = 5;
    private $productService;
    private $productRepositoryInterface;
    private $categoryRepositoryInterface;
    private $brandRepositoryInterface;

    public function __construct(
        ProductService              $productService,
        ProductRepositoryInterface  $productRepositoryInterface,
        CategoryRepositoryInterface $categoryRepositoryInterface,
        BrandRepositoryInterface    $brandRepositoryInterface
    )
    {
        $this->productService = $productService;
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
        $this->brandRepositoryInterface = $brandRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepositoryInterface->all();
        $brands     = $this->brandRepositoryInterface->all();
        return view('admin.products.create', ['categories' => $categories, 'brands' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();
        $this->productService->createProduct($validatedData);
        return redirect()->back()->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
