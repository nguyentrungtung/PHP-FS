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

        $cart = session()->get('cart', []);
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
        ];

        // Cập nhật giỏ hàng vào session
        session()->put('cart', $cart);

        return response()->json([
            'status' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng thành công',
            'data' => [
                'cart' => $cart,
                'cartListIcon' => view('client.components.cart-icon', ['cart' => $cart])->render(),
                'cartList' => view('client.components.cart-list', ['cart' => $cart])->render(),
                'count_number' => count($cart),
            ]
        ], 200);
    }

}
