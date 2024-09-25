<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Coupon;
use App\Repositories\Contracts\RepositoryInterface\CouponRepositoryInterface;
use App\Repositories\BaseRepository;

class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{
    protected $model;

    public function __construct(Coupon $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
}
