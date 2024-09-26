<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\BrandsService;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    //
    private $brandsService;
    public function __construct(BrandsService $brandsService){
        $this->brandsService = $brandsService;
    }
    public function index(){
        $brands = $this->brandsService->index(10);
        return view("admin.brands.index",['brands'=>$brands]);
    }
    public function create(){
        return view("admin.brands.create");
    }
    // 
    public function store(Request $request){
        // dd('check');
        $brand=$this->brandsService->store($request);
        // dd($data);
        if($brand){
            return redirect()->route('admin.brands.edit',['id'=>$brand->id])->with("success","Add new brand success");
        }
        return back()->with('error', 'The file name already exists. Rename a different file!.');
    }
    public function edit($id){
        $brand=$this->brandsService->show($id);
        return view('admin.brands.edit',['brand'=>$brand]);
    }
    // 
    public function destroy($id){
        $this->brandsService->destroy($id);
        return redirect()->route('admin.brands')->with("success","Delete brand success");
    }
    // 
    public function update(Request $request, $id){
        // dd($request->input());
        $brand=$this->brandsService->update($request,$id);
        if($brand){
            return redirect()->route('admin.brands.edit',['id'=>$brand->id])->with("success","Update brand success");
        }
        return back()->with('error', 'The file name already exists. Rename a different file!.');

    }
}
