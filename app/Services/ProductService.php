<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductImageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitValueRepositoryInterface;

class ProductService
{
    private $productRepositoryInterface;
    private $productImageRepositoryInterface;
    private $unitValueRepositoryInterface;
    private $categoryRepositoryInterface;

    /**
     * @param ProductRepositoryInterface $productRepositoryInterface
     */
    public function __construct(
        ProductRepositoryInterface      $productRepositoryInterface,
        CategoryRepositoryInterface     $categoryRepositoryInterface,
        ProductImageRepositoryInterface $productImageRepositoryInterface,
        UnitValueRepositoryInterface    $unitValueRepositoryInterface,
    )
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
        $this->productImageRepositoryInterface = $productImageRepositoryInterface;
        $this->unitValueRepositoryInterface = $unitValueRepositoryInterface;
    }

    public function getAllProductsPaginate($limit)
    {
        return $this->productRepositoryInterface->paginate($limit);
    }

    public function createProduct(array $data)
    {
        // Tạo SKU cho sản phẩm
        $data['product_sku'] = $this->productRepositoryInterface->generateSKU($data['category_id']);

        // Tạo sản phẩm mới và lưu vào cơ sở dữ liệu
        $product = $this->productRepositoryInterface->create($data);

        // Lưu ảnh sản phẩm
        if (isset($data['product_images'])) {
            foreach ($data['product_images'] as $index => $image) {
                // Tạo dữ liệu cho bảng product_image
                $imageData = [
                    'product_id' => $product->id,
                    'image_type' => $data['image_types'][$index], // Lưu image_type tương ứng
                    'image_url' => uploadImage($image, 'products') // Sử dụng helper
                ];
                $this->productImageRepositoryInterface->create($imageData); // Lưu thông tin ảnh
            }
        }

        // Lưu giá trị đơn vị cho sản phẩm
        if (isset($data['units']) && isset($data['unit_values'])) {
            foreach ($data['units'] as $unitId) {
                $unitValueData = [
                    'product_id' => $product->id,
                    'unit_id' => $unitId,
                    'value' => $data['unit_values'][$unitId] // Giá trị tương ứng với unit_id
                ];
                $this->unitValueRepositoryInterface->create($unitValueData); // Lưu thông tin giá trị đơn vị
            }
        }

        return $product; // Trả về sản phẩm đã tạo
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


    public function productRelate($productId)
    {
        return $this->productRepositoryInterface->productRelate($productId);
    }
    // 
    public function render($cat,$start,$limit){
        return $this->productRepositoryInterface->render($cat,$start,$limit);
    }

}
