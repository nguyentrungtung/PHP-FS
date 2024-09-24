<?php
    namespace App\Repositories\Constracts\Repository;
    use App\Repositories\BaseRepository;
    use App\Repositories\Constracts\RepositoryInterface\CategoriesRepositoryInterface;
    use App\Models\Categories;
    class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface{
        public function __construct(Categories $categories){
            $this->model = $categories;
        }
    }