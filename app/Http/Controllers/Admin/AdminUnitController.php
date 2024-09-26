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
    public function edit(Request $request){
        return view('admin.unit.edit');
    }
}
