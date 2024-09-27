<?php

namespace App\Http\Controllers;

use App\Services\BrandsService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    //
    private $ProductService;
    private $brandService;

    public function __construct(ProductService $productService,BrandsService $brandsService){
        $this->ProductService = $productService;
        $this->brandService = $brandsService;
    }
    public function index(){
        
        return view('client.home.home');
    }
}
