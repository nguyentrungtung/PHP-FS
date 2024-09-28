<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
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
        $todays=$this->ProductService->today();
        $brands= $this->brandService->all();
        return view('client.home.home',compact('todays','brands'));
    }
    public function show($id){
        $respont=$this->ProductService->render($id,0,8)->getData(true);
        $products=$respont['products'];
       
        // dd($products);
        return view('client.search.search',compact('products','id'));
    }
}
