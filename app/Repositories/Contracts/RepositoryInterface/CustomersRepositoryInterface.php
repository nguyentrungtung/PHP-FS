<?php
    namespace App\Repositories\Contracts\RepositoryInterface;
    use App\Repositories\BaseRepositoryInterface;
    // 
    interface CustomersRepositoryInterface extends BaseRepositoryInterface{
        public function index($per);
    }