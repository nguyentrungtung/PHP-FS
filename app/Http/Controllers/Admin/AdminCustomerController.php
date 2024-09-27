<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\CustomersService;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    //
    private $service;
    public function __construct(CustomersService $service){
        $this->service = $service;
    }
    public function index(){
        $customers= $this->service->index(10);
        return view('admin.customers.index',['customers'=>$customers]);
    }
    // 
    public function create(){
        return view('admin.customers.create');
    }
    // 
    public function store(Request $request){
        $customer=$this->service->store($request);
        return redirect()->route('admin.customers.edit',['id'=>$customer->id]);
    }
    // /
    public function edit($id){
        $customer=$this->service->edit($id);
        return view('admin.customers.edit',['customer'=>$customer]);
    }
    // 
    public function update(Request $request, $id){
        // dd($request->input());
        $customer=$this->service->update($request,$id);
        return view('admin.customers.edit',['customer'=>$customer]);
    }
    //
    public function destroy($id){
        $this->service->destroy($id);
    }
}
