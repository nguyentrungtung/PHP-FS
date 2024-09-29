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
    // ham lay san pham de render ra man hinh
    public function render($cat,$start,$limit){
       return $this->service->render($cat,$start,$limit);
    }
    // 
    public function fillter(Request $request){
        // return response()->json(['true']);   
        return $this->service->fill($request);
    }
    // 
    public function show($id){
        $data=$this->service->getByCat($id,0,8);
        $products=$data['products'];
        $brands=$data['brands'];
        $remain=$data['remain'];
        // dd($products);
        return view('client.pages.list',compact('id','products','brands','remain'));
    }
    // 
    public function search(Request $request){
        $data=$this->service->search($request);
        $products=$data['products'];
        $remain=$data['remain'];
        return view('client.pages.search',compact('products','remain'));
    }
}
