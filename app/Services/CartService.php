<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Http\Request;

class CartService
{
    private $productRepositoryInterface;

    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface,
    )
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    //Thêm mới sản phẩm vào giỏ hàng
    public function addToCart($request, $id)
    {
        // Lấy hình ảnh sản phẩm, nếu có
        $product = $this->productRepositoryInterface->find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại.',
            ], 404);
        }

        $cart = session()->get('carts', []);
        $productImage = $product->productImage->first()->image_url;

        // Cập nhật hoặc thêm mới sản phẩm vào giỏ hàng
        $productQuantity = isset($cart[$id]) ? $cart[$id]['product_quantity'] + $request->quantity : $request->quantity;
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
            'product_unit' => $request->unitName,
            'product_quantity' => $productQuantity,
            'product_total' => $request->price * $productQuantity,
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
    public function updateCart($request)
    {
        // Lấy thông tin sản phẩm từ request
        $productId = $request->id;
        $quantity = $request->quantity;

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $cart = session()->get('carts', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['product_quantity'] = $quantity;
            session()->put('carts', $cart);
        }

        return response()->json([
            'status' => true,
            'message' => 'Số lượng đã được cập nhật!',
            'data' => [
                'carts' => $cart,
                'cartListIcon' => view('client.components.cart-icon', ['carts' => $cart])->render(),
                'cartList' => view('client.components.cart-list', ['carts' => $cart])->render(),
                'count_number' => count($cart),
            ]
        ], 200);
    }


    //Xóa giỏ hàng
    public function clearCart()
    {
        // Xóa toàn bộ giỏ hàng
        session()->forget('carts');

        return response()->json([
            'status' => true,
            'message' => 'Giỏ hàng đã được xóa thành công'
        ], 200);
    }

}
