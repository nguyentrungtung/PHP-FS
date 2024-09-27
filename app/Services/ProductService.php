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
        $data['product_sku'] = $this->productRepositoryInterface->generateSKU($data['category_id']);
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
    // 
    public function render($cat,$start,$limit){
        return $this->productRepositoryInterface->render($cat,$start,$limit);
    }
    // 
    // lay san pham theo list id
    public function getByList($data){
       $idArr=[];
       foreach ($data as $key => $value) {
        $idArr[] =$value['id'];
       }
       $products= $this->productRepositoryInterface->getByList($idArr);
       
    //    dd($products[0]['count']);
       for( $i= 0; $i<count($products); $i++ ){
        // dd($data[$i]);
        $products[$i]['count']=$data[$i]['count'];
       }
    //    dd($products);
       return response()->json(['products'=>$products]);
    }
}
