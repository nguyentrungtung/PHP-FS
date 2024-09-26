<?php

namespace App\Repositories\Contracts\Repository;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Models\Categories;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected $model;

        public function __construct(Categories $model)
        {
            $this->model = $model;
            parent::__construct($model);

        }

        public function getParents()
        {
            return $this->model->whereNull("categories_parent_id")->get();
        }

        public function index()
        {
            return $this->model::paginate(10);
        }
    }
