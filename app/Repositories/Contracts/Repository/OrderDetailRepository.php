<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Orderdetail;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    protected $model;

    public function __construct(Orderdetail $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
    public function getProductIdsByTotalSold(){
        return $this->model
            ->select("product_id",DB::raw('SUM(order_details.quantity) as total_sold'))
            ->groupBy('product_id')->orderBy('total_sold','desc')->pluck('product_id');
    }
}
