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
            return redirect()->route('cart.show')->with('error', 'Bạn cần xem lại giỏ hàng trước khi thanh toán.');
        }

        // Truyền thông tin giỏ hàng cho view
        return view('client.pages.checkout', compact('checkoutCartSummary'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carts = session()->get('carts');
        return $this->checkoutService->processCheckout($request, $carts);
    }

    /**
     * Display the specified resource.
     */
    public function checkoutSuccess()
    {
//        return view('client.pages.cart-detail');
        return redirect()->route('web.home');
    }

}
