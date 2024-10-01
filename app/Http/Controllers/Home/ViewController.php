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
        // dd($todays);
        $brands=$data['brands'];
        return view('client.home.home',compact('todays','brands'));
    }
    // 
    public function fillter(Request $request){
        // return response()->json(['true']);   
        return $this->service->fill($request);
    }
    // man hinh cac san pham phan loai theo cat id
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
        $products=$this->service->search($request);
        return view('client.pages.search',compact('products'));
    }
    // 
    public function login(){
        return view('client.pages.login');
    }
    // 
    public function regit(){
        return view('client.pages.regit');
    }
    // 
    public function account(){
        return view('client.pages.account.views.accountDetail');
    }
    // 
    public function orders(){
        $orders=$this->service->getOrders();
        return view('client.pages.account.views.bill',compact('orders'));
    }
    // 
    public function buys(){
        $products=$this->service->getProductsByOrders();
        return view('client.pages.account.views.buy',compact('products'));
    }
    // 
    public function orderDetail($id){
        $products=$this->service->getProductsByOrder($id);
        return view('client.pages.account.views.orderDetail',compact('products'));
    }
    // 
    // checking optimine query
    public function checking(){
        return $this->service->checking();
    }
}
