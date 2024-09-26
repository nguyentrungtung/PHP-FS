<?php
    namespace App\Repositories\Contracts\RepositoryInterface;
    use App\Repositories\BaseRepositoryInterface;
    // 
    interface UnitRepositoryInterface extends BaseRepositoryInterface{
        public function index($per);
    }