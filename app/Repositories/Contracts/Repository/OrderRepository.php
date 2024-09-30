<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Order;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
    // 
    public function getOrdersByUserId($userId){
        return $this->model->with(['customer'=>function($query)use ($userId){
            $query->where('id', $userId);
        }])->paginate(10);
    }
}
