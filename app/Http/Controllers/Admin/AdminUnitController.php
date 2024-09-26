<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\UnitService;
use Illuminate\Http\Request;

class AdminUnitController extends Controller
{
    //
    private $service;
    public function __construct(UnitService $service){
        $this->service = $service;
    }
    // 
    public function index(){
        $units=$this->service->index(10);
        return view('admin.unit.index',['units'=>$units]);
    }
    // 
    public function create(){
        return view('admin.unit.crate');
    }
    // 
    public function edit($id){
        $unit=$this->service->edit($id);
        // dd($unit);
        return view('admin.unit.edit',['unit'=>$unit]);
    }
    // 
    public function store(Request $request){
        $unit= $this->service->create($request);
        if($unit){
            return redirect()->route('admin.units.edit',['id'=>$unit->id])->with('success','Create a new Unit success');
        }
        return redirect()->back()->with('error','False to create a new Unit');
    }
    // 
    public function update(Request $request, $id){
        $unit= $this->service->update($request,$id);
        return redirect()->route('admin.units.edit',['id'=>$unit->id])->with('success','Update a unit success!');
    }
    // 
    public function destroy($id){
        $this->service->destroy($id);
    }
}
