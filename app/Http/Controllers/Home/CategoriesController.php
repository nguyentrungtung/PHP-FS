<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    private $service;
    public function __construct(CategoriesService $service){
        $this->service = $service;
    }
    public function index(){
        return $this->service->all();
    }
}
