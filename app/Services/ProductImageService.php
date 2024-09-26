<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\ProductImageRepositoryInterface;
use Illuminate\Http\Request;

class ProductImageService
{
    protected $productImageRepositoryInterface;

    public function __construct(ProductImageRepositoryInterface $productImageRepositoryInterface)
    {
        $this->productImageRepositoryInterface = $productImageRepositoryInterface;
    }

}
