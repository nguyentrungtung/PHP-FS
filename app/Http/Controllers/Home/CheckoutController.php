<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CheckoutService;

class CheckoutController extends Controller
{
    private $checkoutService;

    public function __construct(
        CheckoutService $checkoutService,
    )
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(session()->get('cartSummary'));
//        dd(session()->get('carts'));

        // Lấy thông tin tosm tắt giỏ hàng từ session
        $checkoutCartSummary = session()->get('cartSummary', []);

        // Kiểm tra nếu session không tồn tại (người dùng chưa qua bước giỏ hàng)
        if (empty($checkoutCartSummary)) {
            return redirect()->route('cart.detail')->with('error', 'Bạn cần xem lại giỏ hàng trước khi thanh toán.');
        }

        // Truyền thông tin giỏ hàng cho view
        return view('client.pages.checkout', compact('checkoutCartSummary'));
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
        //processCheckout
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
