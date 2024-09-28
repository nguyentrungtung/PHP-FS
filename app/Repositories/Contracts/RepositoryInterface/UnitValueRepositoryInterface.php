<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface UnitValueRepositoryInterface extends BaseRepositoryInterface
{
    // 
    public function getByProductID($product_id);
    
}
