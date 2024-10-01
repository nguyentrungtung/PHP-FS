<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderService
{
    protected $orderRepositoryInterface;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    public function getAllOrder()
    {
        return $this->orderRepositoryInterface->all();
    }

    public function updateStatus($request, $id)
    {
        // Lấy ra đơn hàng và cập nhật trạng thái
        $order = $this->orderRepositoryInterface->find($id);
        $order->status = $request->newStatus;

        if ($order->save()) {
            return response()->json([
                'status' => true,
                'message' => 'Trạng thái đơn hàng đã được cập nhật',
                'order_status' => $request->newStatus,
                'order_id' => $id
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Cập nhật trạng thái thất bại']);
    }

}
