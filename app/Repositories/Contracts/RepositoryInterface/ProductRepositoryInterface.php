<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function generateSKU($categoryId);
    // 
    public function productRelate($productId);
    //
    public function getToday();
    //
    public function getByCatId($catId);
    //
    public function specialOffers();
    //
    public function fill($request);
    //
    public function search($value);
    // 
    public function getByOrderId($orderId);
    // 
    public function getByOrderIds();
}
