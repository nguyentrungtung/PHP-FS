<?php
    namespace App\Repositories\Constracts\Repository;
    use App\Repositories\BaseRepository;
    use App\Repositories\Constracts\RepositoryInterface\CategoryRepositoryInterface;
    use App\Models\Categories;
    class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{
        public function __construct(Categories $categories){
            $this->model = $categories;
        }
        public function getParents(){
            return $this->model->whereNull("categories_parent_id")->get();
        }
        public function index(){
            return $this->model::paginate(10);
        }
    }