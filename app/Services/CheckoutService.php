<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetail;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;

class CheckoutService
{
    private $orderRepositoryInterface;
    private $orderDetailRepositoryInterface;
    private $productRepositoryInterface;

    public function __construct(
        OrderRepositoryInterface       $orderRepositoryInterface,
        OrderDetailRepositoryInterface $orderDetailRepositoryInterface,
        ProductRepositoryInterface      $productRepositoryInterface,
    )
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
        $this->orderDetailRepositoryInterface = $orderDetailRepositoryInterface;
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function processCheckout($request, $carts)
    {
        $customerId = Auth::check() ? Auth::id() : null;

        // Dữ liệu cho đơn hàng
        $orderData = [
            'customer_id' => $customerId,
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'payment_method' => $request->payment_method,
            'order_note' => $request->order_note,
            'total' => $request->total,
        ];

        // Lưu đơn hàng vào bảng 'orders'
        $orderId = $this->orderRepositoryInterface->create($orderData); // Trả về một đối tượng đơn hàng

        // Khởi tạo mảng lưu trữ thông tin chi tiết đơn hàng
        $orderDetails = [];
        foreach ($carts as $productId => $cart) {
            $orderDetails[] = [
                'order_id' => $orderId->id, // Lấy ID của đơn hàng vừa tạo
                'product_id' => $productId,
                'quantity' => $cart['product_quantity'],
                'price' => $cart['product_price'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Cập nhât product quantity
            $product = $this->productRepositoryInterface->find($productId);
            if ($product) {
                $newQuantity = $product->product_quantity - $cart['product_quantity'];
                if ($newQuantity < 0) {
                    $newQuantity = 0; // Đảm bảo số lượng không âm
                }
                $product->update(['product_quantity' => $newQuantity]);
            }
        }

        // Lưu chi tiết đơn hàng vào bảng 'order_details'
        $this->orderDetailRepositoryInterface->createMany($orderDetails);

        // Xóa giỏ hàng khỏi phiên
        session()->forget('carts');
        session()->forget('cartSummary');

        // Trả về phản hồi hoặc chuyển hướng
        return redirect()->route('checkout.success')->with('success', 'Đặt hàng thành công!');
    }


}
