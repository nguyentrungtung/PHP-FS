<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Services\BrandsService;
use App\Services\ProductService;
use App\Services\ViewService;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    private $service;

    public function __construct(ViewService $service){
        $this->service = $service;
    }
    public function index(){
        $data=$this->service->index();
        $todays=$data['todays'];
        $brands=$data['brands'];
        return view('client.home.home',compact('todays','brands'));
    }
    // 
    public function render($cat,$start,$limit){
       return $this->service->render($cat,$start,$limit);
    }
    // 
    public function show($id){
        // $respont=$this->ProductService->render($id,0,8)->getData(true);
        // $products=$respont['products'];
       
        // // dd($products);
        // return view('client.search.search',compact('products','id'));
    }
    // 
    public function search(Request $request){

    }
}
