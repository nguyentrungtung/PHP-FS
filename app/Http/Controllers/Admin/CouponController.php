<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Services\CouponService;

class CouponController extends Controller
{
    private $limit = 5;
    private $couponService;

    public function __construct(
        CouponService $couponService
    )
    {
        $this->couponService = $couponService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = $this->couponService->getAllCoupons();
        return view('admin.coupons.index', ['coupons' => $coupons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->couponService->createCoupon($request->all());
        return redirect()->back()->with('success', 'Coupon created successfully!');
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
        $coupon = $this->couponService->getCouponById($id);
        return view('admin.coupons.edit', ['coupon' => $coupon]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->couponService->updateCoupon($id, $request->all());
        return redirect()->back()->with('success', 'Coupon created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->couponService->deleteCoupon($id);
        return redirect()->back()->with('success', 'Coupon deleted successfully!');
    }
}
