<?php

namespace App\Http\Controllers;

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
}
