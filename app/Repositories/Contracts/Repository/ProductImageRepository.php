<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\ProductImage;
use App\Repositories\Contracts\RepositoryInterface\ProductImageRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductImageRepository extends BaseRepository implements ProductImageRepositoryInterface
{
    protected $model;

    public function __construct(ProductImage $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
    // 
    public function getByProductId($productId){
        return $this->model->where("product_id",$productId)->get();
    }
    // 
    public function getMainImg($productId){
        return $this->model
        ->where("product_id",$productId)
        ->where('image_type','main')->first();
    }
}
