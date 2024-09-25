<?php
    namespace App\Repositories\Constracts\RepositoryInterface;
    use App\Repositories\BaseRepositoryInterface;
    // 
    interface CategoryRepositoryInterface extends BaseRepositoryInterface{
        public function getParents();
        public function index();
    }