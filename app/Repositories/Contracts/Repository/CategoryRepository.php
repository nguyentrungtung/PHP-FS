<?php
    namespace App\Repositories\Contracts\Repository;
<<<<<<< Updated upstream
    use App\Repositories\BaseRepository;
    use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
=======
>>>>>>> Stashed changes
    use App\Models\Categories;
    use App\Repositories\BaseRepository;
    use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;

    class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{
<<<<<<< Updated upstream
        public function __construct(Categories $categories){
            parent::__construct($categories);
=======
        protected $model;
        public function __construct(Categories $model){
            $this->model = $model;
            parent::__construct($model);
>>>>>>> Stashed changes
        }
        public function getParents(){
            return $this->model->whereNull("categories_parent_id")->get();
        }
        public function index(){
            return $this->model::paginate(10);
        }
    }
