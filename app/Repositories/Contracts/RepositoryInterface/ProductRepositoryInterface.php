<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function generateSKU($categoryId);
    public function render($cat,$start,$limit);
    // 
    public function getByList($data);
}
