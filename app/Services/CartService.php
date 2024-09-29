<?php

namespace App\Services;

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

    public function __construct(
        UnitRepositoryInterface         $uniRepositoryInterface,
        ProductRepositoryInterface      $productRepositoryInterface,
        UnitValueRepositoryInterface    $unitValueRepositoyInterface,
        ProductImageRepositoryInterface $productImageRopositoryInterface)
    {
        $this->uniRepositoryInterface = $uniRepositoryInterface;
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->productImageRopositoryInterface = $productImageRopositoryInterface;
        $this->unitValueRepositoyInterface = $unitValueRepositoyInterface;
    }

    //Thêm mới sản phẩm vào giỏ hàng
    public function store($request, $id)
    {
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
            'product_price_old' => $product->product_price_old,
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
            $cartSummary = $this->getCartSummary();
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
                'cartSummary' => $cartSummary ?? null
            ]
        ], 200);
    }


    //Xóa giỏ hàng
    public function delete()
    {
        // Xóa toàn bộ giỏ hàng
        session()->forget('carts');

        return response()->json([
            'status' => true,
            'message' => 'Giỏ hàng đã được xóa thành công'
        ], 200);
    }

    //lấy tổng quan chi tiết về giỏ hàng.
    public function getCartSummary()
    {
        // Giả sử giỏ hàng của người dùng được lấy từ database
        $carts = session()->get('carts', []);
        $subtotal = 0;  // Tạm tính giỏ hàng
        $totalSaving = 0; // Tiết kiệm được
        $totalPrice = 0;  // Tổng cộng

        foreach (array_reverse($carts) as $cart) {
            $productPrice = $cart['product_price'];
            $productQuantity = $cart['product_quantity'];

            if (isset($cart['product_price_old'])) {
                $subtotal += (int)$cart['product_price_old'] * (int)$productQuantity;
                $totalSaving += (int)($cart['product_price_old'] - $productPrice) * (int)$productQuantity;
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

        $cartSummary = $this->getCartSummary();

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

    // Lưu thong tin Summary từ cart detail
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

    //-----------------------------------
    public function addCart($id)
    {
        $cart = $this->getCart();
        // kiem tra san pham da co trong cart hay chua neu co se tang quantity len
        if (isset($cart[$id])) {
            $cart[$id]['product_quantity'] = (int)$cart[$id]['product_quantity'] + 1;
            session()->put('cart', $cart);
            return;
        }
        // tao data cua san pham de luu vao cart
        $product = $this->productRepositoryInterface->find($id);
        if (!$product) {
            return false;
        }
        $img = $this->productImageRopositoryInterface->getMainImg($id);
        $unitValue = $this->unitValueRepositoyInterface->getByProductID($id);
        $unit = $this->uniRepositoryInterface->find($unitValue->unit_id);
        //
        $data = [
            'product_name' => $product->product_name,
            'product_price' => $product->product_price,
            'product_image' => $img->image_url,
            'product_unit' => $unit->unit_name,
            'product_quantity' => 1
        ];
        $cart[$id] = $data;
        session()->put('cart', $cart);
        return response()->json(['status' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng thành công',]);
    }

    // lay cart tu session
    public function getCart()
    {
        if (session()->has('cart')) {
            return session()->get('cart');
        }
        return [];
    }

    // lay thong tin san pham de show mini cart
    public function show()
    {
        $cart = $this->getCart();
        return array_map(function ($item) {
            $item['product_image'] = asset($item['product_image']);
            return $item;
        }, $cart);
    }

    //lấy tổng quan chi tiết về giỏ hàng

}
