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

}
