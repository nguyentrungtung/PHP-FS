<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Coupon;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Coupon $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
}
