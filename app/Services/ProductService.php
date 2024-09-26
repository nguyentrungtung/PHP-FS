<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;

class ProductService
{
    private $productRepositoryInterface;

    /**
     * @param ProductRepositoryInterface $productRepositoryInterface
     */
    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface
    )
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function getAllProductsPaginate($limit)
    {
        return $this->productRepositoryInterface->paginate($limit);
    }

    public function createProduct(array $data)
    {
        return $this->productRepositoryInterface->create($data);
    }

    public function getAllProducts()
    {
        return $this->productRepositoryInterface->all();
    }

    public function getProductById($id)
    {
        return $this->productRepositoryInterface->find($id);
    }

    // Hàm cập nhật thông tin Product
    public function updateProduct(int $id, array $data)
    {
        return $this->productRepositoryInterface->update($id, $data);
    }

    // Hàm xóa Product
    public function deleteProduct(int $id)
    {
        return $this->productRepositoryInterface->delete($id);
    }
}
