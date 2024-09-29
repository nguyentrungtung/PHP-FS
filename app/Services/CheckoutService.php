<?php

namespace App\Services;


use App\Models\OrderDetail;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;

class CheckoutService
{
    private $orderRepositoryInterface;
    private $orderDetailRepositoryInterface;

    public function __construct(
        OrderRepositoryInterface       $orderRepositoryInterface,
        OrderDetailRepositoryInterface $orderDetailRepositoryInterface,
    )
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
        $this->orderDetailRepositoryInterface = $orderDetailRepositoryInterface;
    }

    public function processCheckout($request, $carts)
    {
        // Dữ liệu cho đơn hàng
        $orderData = [
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
        }

        // Lưu chi tiết đơn hàng vào bảng 'order_details'
        $this->orderDetailRepositoryInterface->createMany($orderDetails);

        // Xóa giỏ hàng khỏi phiên
        session()->forget('carts');

        // Trả về phản hồi hoặc chuyển hướng
        return redirect()->route('checkout.success')->with('success', 'Đặt hàng thành công!');
    }


}
