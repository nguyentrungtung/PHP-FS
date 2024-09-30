<?php
namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use Illuminate\Http\Request;

class OrderDetailService
{
    protected $orderDetailRepositoryInterface;

    public function __construct(OrderDetailRepositoryInterface $orderDetailRepositoryInterface)
    {
        $this->orderDetailRepositoryInterface = $orderDetailRepositoryInterface;
    }
}
