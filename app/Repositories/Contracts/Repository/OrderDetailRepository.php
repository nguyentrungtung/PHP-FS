<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Orderdetail;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\BaseRepository;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    protected $model;

    public function __construct(Orderdetail $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
}
