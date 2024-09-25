<?php
    namespace App\Repositories\Contracts\RepositoryInterface;
    use App\Repositories\BaseRepositoryInterface;
    // 
    interface CategoryRepositoryInterface extends BaseRepositoryInterface{
        public function getParents();
        public function index();
    }