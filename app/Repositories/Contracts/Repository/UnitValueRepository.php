<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\UnitValue;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\RepositoryInterface\UnitValueRepositoryInterface;

class UnitValueRepository extends BaseRepository implements UnitValueRepositoryInterface
{
    protected $model;

    public function __construct(UnitValue $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
}
