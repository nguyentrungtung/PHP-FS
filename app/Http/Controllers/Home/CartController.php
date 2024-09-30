<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\CouponRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private $productRepositoryInterface;
    private $productService;
    private $cartService;
    private $couponRepositoryInterface;

    public function __construct(
        ProductService             $productService,
        CartService                $cartService,
        ProductRepositoryInterface $productRepositoryInterface,
        CouponRepositoryInterface $couponRepositoryInterface,
    )
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->couponRepositoryInterface = $couponRepositoryInterface;
    }
    //

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = session()->get('carts', []);
        $cartSummary = $this->cartService->getCartSummary($carts);
        //Sản phẩm ưu đãi
        $specialOffers  = $this->productService->specialOffers();
        $coupons = $this->couponRepositoryInterface->all();
//        dd($coupons);

        return view('client.pages.cart-detail', [
            'subtotal' => $cartSummary['subtotal'],
            'totalSaving' => $cartSummary['totalSaving'],
            'totalPrice' => $cartSummary['totalPrice'],
            'specialOffers' => $specialOffers,
            'coupons' => $coupons,
        ]);
    }

    public function store(Request $request, $id)
    {
        return $this->cartService->store($request, $id);
    }

    public function update(Request $request)
    {
        return $this->cartService->update($request);
    }

    public function delete()
    {
        return $this->cartService->delete();
    }

    public function removeItem(Request $request)
    {
        return $this->cartService->removeItem($request);
    }

    //lưu thông tin summary
    public function saveSummary(Request $request)
    {
        return $this->cartService->saveSummary($request);
    }

}
