<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class clientProductController extends Controller
{

    private $ProductService;
    public function __construct(ProductService $ProductService){
        $this->ProductService = $ProductService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($cat,$start,$limit)
    {   
        // dd($this->ProductService->render($cat,$start,$limit));
        return $this->ProductService->render($cat,$start,$limit);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
