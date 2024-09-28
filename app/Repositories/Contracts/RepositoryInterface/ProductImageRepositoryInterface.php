<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface ProductImageRepositoryInterface extends BaseRepositoryInterface
{
    // lay tat ca anh cua san pham
    public function getByProductId($productId);
    // chi lay anh chinh cua san pham
    public function getMainImg($productId);
}
