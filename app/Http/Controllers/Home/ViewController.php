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
    public function fillter(Request $request){
        // return response()->json(['true']);   
        return $this->service->fill($request);
    }
    // 
    public function show($id){
        $request = new Request([
            'catId' => $id,
            'start'=>0,
            'limit'=>8,
        ]);
        $data=$this->service->getByCat($request);
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
    // 
    public function login(){
        return view('client.pages.login');
    }
    // 
    public function regit(){
        return view('client.pages.regit');
    }
}
