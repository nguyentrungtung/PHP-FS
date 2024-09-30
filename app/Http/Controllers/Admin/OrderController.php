<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\OrderDetailService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;
    private $orderDetailService;
    public function __construct(
        OrderService  $orderService,
        OrderDetailService  $orderDetailService
    )
    {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->orderService->getAllOrder();
//        dd($orders);
        return view('admin.orders.index', compact('orders'));
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
