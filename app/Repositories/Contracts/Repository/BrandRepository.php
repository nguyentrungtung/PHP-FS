<?php
    namespace App\Repositories\Contracts\Repository;

use App\Models\Brands;
use Illuminate\Support\Facades\File;
use App\Repositories\BaseRepository;
    use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
    class BrandRepository extends BaseRepository implements BrandRepositoryInterface{
        public function __construct(Brands $brand){
            parent::__construct($brand);
        }
        public function create(array $data){
            $filePath = public_path('img/brands/' . $data['brand_logo']);
            if(File::exists($filePath)){
                return false;
            }
            $this->createImg($data['create']['file'],$data['create']['fileName']);
            return $this->model::create($data);
        }
        // 
        public function index($per){
            return $this->model::paginate($per);
        }
        public function update($id, array $data){
            $brand= $this->model->find($id);
            if (!$brand) {
                return false;
            }
            if(isset($data['move'])){
                File::move($data['move']['current'], $data['move']['new']);
            }
            if(isset($data['create'])){
                $this->deleteImg($brand);
                $this->createImg($data['create']['file'],$data['create']['fileName']);
            }
            $brand->update($data);
            return $brand;
        }
        public function delete($id){
            $brand= $this->model->find($id);
            if ($brand) {
                $this->deleteImg($brand);
            }
            $brand->delete();
            return $brand;
        }
        // xoa anh cu
        private function deleteImg($brand){
            $imagePath = public_path($brand->brand_logo);
            // Kiểm tra nếu file tồn tại và xóa file ảnh
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        private function createImg($file,$path){
            $file->move(public_path('img/brands'), $path);
        }
    }