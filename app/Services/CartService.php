<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\CouponRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductImageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitValueRepositoryInterface;
use Illuminate\Http\Request;

class CartService
{
    private $productRepositoryInterface;
    private $unitValueRepositoyInterface;
    private $productImageRopositoryInterface;
    private $uniRepositoryInterface;
    private $couponRepositoryInterface;

    public function __construct(
        UnitRepositoryInterface         $uniRepositoryInterface,
        ProductRepositoryInterface      $productRepositoryInterface,
        UnitValueRepositoryInterface    $unitValueRepositoyInterface,
        ProductImageRepositoryInterface $productImageRopositoryInterface,
        CouponRepositoryInterface $couponRepositoryInterface
    )
    {
        $this->uniRepositoryInterface = $uniRepositoryInterface;
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->productImageRopositoryInterface = $productImageRopositoryInterface;
        $this->unitValueRepositoyInterface = $unitValueRepositoyInterface;
        $this->couponRepositoryInterface = $couponRepositoryInterface;
    }

    //Thêm mới sản phẩm vào giỏ hàng
    public function store($request, $id)
    {
//        dd($request->all());
        $product = $this->productRepositoryInterface->find($id);
        $quantity = $request->quantity;
        // Kiểm tra tồn kho
        if ((int)$quantity > (int)$product->product_quantity) {
            return response()->json(['status' => false, 'message' => 'Số lượng vượt quá tồn kho!']);
        }

        $cart = session()->get('carts', []);
        $productImage = $product->productImage->first()->image_url;
        // Cập nhật hoặc thêm mới sản phẩm vào giỏ hàng
        $productQuantity = isset($cart[$id]) ? $cart[$id]['product_quantity'] + $quantity : $quantity;

        if ($productQuantity < 1) {
            return response()->json([
                'status' => false,
                'message' => 'Số lượng sản phẩm không hợp lệ.',
            ], 400);
        }

        $cart[$id] = [
            'product_name' => $product->product_name,
            'product_image' => $productImage,
            'product_price' => $request->price,
            'product_price_old' => $product->product_price_old,
            'product_unit' => $request->unitName,
            'product_quantity' => $productQuantity,
            'product_total' => $request->price * $productQuantity,
            'available_quantity' => $product->product_quantity,
        ];

        // Cập nhật giỏ hàng vào session
        session()->put('carts', $cart);

        return response()->json([
            'status' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng thành công',
            'data' => [
                'carts' => $cart,
                'cartListIcon' => view('client.components.cart-icon', ['carts' => $cart])->render(),
                'cartList' => view('client.components.cart-list', ['carts' => $cart])->render(),
                'count_number' => count($cart),
            ]
        ], 200);
    }

    //Cập nhật giỏ hàng
    public function update($request)
    {
        // Lấy thông tin sản phẩm từ request
        $productId = $request->id;
        $quantity = $request->quantity;

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $cart = session()->get('carts', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['product_quantity'] = $quantity;
            session()->put('carts', $cart);
            $cartSummary = $this->getCartSummary($cart);
        }

        return response()->json([
            'status' => true,
            'message' => 'Số lượng đã được cập nhật!',
            'data' => [
                'productId' => $productId,
                'carts' => $cart,
                'cartListIcon' => view('client.components.cart-icon', ['carts' => $cart])->render(),
                'cartList' => view('client.components.cart-list', ['carts' => $cart])->render(),
                'count_number' => count($cart),
                'cartSummary' => $cartSummary
            ]
        ], 200);
    }


    //Xóa giỏ hàng
    public function delete()
    {
        // Xóa toàn bộ giỏ hàng
        session()->forget('carts');
        session()->forget('cartSummary');

        return response()->json([
            'status' => true,
            'message' => 'Giỏ hàng đã được xóa thành công'
        ], 200);
    }

    //lấy thông tin giá đơn hàng
    public function getCartSummary($carts = null)
    {
        $subtotal = 0;  // Tạm tính giỏ hàng
        $totalSaving = 0; // Tiết kiệm được
        $totalPrice = 0;  // Tổng cộng

        foreach (array_reverse($carts) as $cart) {
            $productPrice = $cart['product_price'];
            $productQuantity = $cart['product_quantity'];

            if (isset($cart['product_price_old'])) {
                $subtotal += (int)$cart['product_price_old'] * (int)$productQuantity;
                $totalSaving += (int)($cart['product_price_old'] - (int)$productPrice) * (int)$productQuantity;
            } else {
                $subtotal += (int)$productPrice * (int)$productQuantity;
            }

            $totalPrice += (int)$productPrice * (int)$productQuantity;
        }

        return [
            'subtotal' => $subtotal,
            'totalSaving' => $totalSaving,
            'totalPrice' => $totalPrice,
        ];
    }

    // Xóa item cart
    public function removeItem(Request $request)
    {
        $productId = $request->id;

        // Lấy giỏ hàng từ session
        $cart = session()->get('carts', []);

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không và xóa
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('carts', $cart);
        }

        $cartSummary = $this->getCartSummary($cart);

        return response()->json([
            'status' => true,
            'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng',
            'data' => [
                'productId' => $productId,
                'carts' => $cart,
                'cartListIcon' => view('client.components.cart-icon', ['carts' => $cart])->render(),
                'count_number' => count($cart),
                'cartSummary' => $cartSummary ?? null
            ]
        ]);
    }

    // Lưu thong tin Summary(price) từ cart detail
    public function saveSummary($request)
    {
        // Lưu thông tin tóm tắt giỏ hàng vào session
        $cartSummary = [
            'subtotal' => $request->subtotal,
            'totalSaving' => $request->totalSaving,
            'totalPrice' => $request->totalPrice,
            'discount' => $request->discount
        ];

        session()->put('cartSummary', $cartSummary);
//        dd(session()->get('cartSummary'));

        return response()->json(
            [
                'status' => true,
                'message' => 'Lưu thông tin summary thành công',
            ]
        );
    }

    //Kiểm tra và cập nhật số lượng sản phẩm trong giỏ hàng so với số lượng sản phẩm có sẵn.
    public function checkAndUpdateCartQuantities($carts)
    {
        foreach ($carts as $productId => $item) {
            $product = $this->productRepositoryInterface->find($productId);
            if ($product) {
                // Kiểm tra số lượng trong giỏ hàng với tồn kho
                if ($item['product_quantity'] > $product->product_quantity) {
                    // nếu số lượng trong giỏ hàng vượt quá tồn kho
                    $carts[$productId]['product_quantity'] = $product->product_quantity; // Cập nhật lại số lượng trong mảng carts
                }
            }
        }

        return $carts; // Trả về giỏ hàng đã được cập nhật
    }

    public function applyCoupon($request)
    {
        $couponId = $request->coupon_id;
        $originalPrice = $request->totalPrice;
        $carts = session()->get('carts', []);
        $coupon = $this->couponRepositoryInterface->find($couponId);

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ.']);
        }

        // Kiểm tra nếu mã giảm giá chưa phát hành
        if ($coupon->start_date > now()) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá chưa được phát hành.']);
        }

        // Kiểm tra các điều kiện áp dụng mã giảm giá
        $totalAmount = $this->getCartSummary($carts)['totalPrice'];
        if ($totalAmount < $coupon->min_order_value) {
            return response()->json(['success' => false, 'message' => 'Đơn hàng không đủ điều kiện áp dụng mã giảm giá.']);
        }

//        $discount = isset($coupon->max_discount) ? $coupon->max_discount : $coupon->discount_value;
        $discount = isset($coupon->max_discount) ? round(($coupon->max_discount / $originalPrice) * 100, 2) : $coupon->discount_value;
//        dd($coupon->discount_value);

        // Cập nhật thông tin mã giảm giá vào session hoặc database
        session()->put('applied_coupon', $couponId);

        return response()->json([
            'status' => true,
            'message' => 'Mã giảm giá đã được áp dụng!',
            'discount' => $coupon->discount_value,
            'discount_type' => $coupon->discount_type,
        ]);
    }


}
