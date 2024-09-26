<?php
    namespace App\Repositories\Contracts\Repository;

use App\Models\customers;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\RepositoryInterface\CustomersRepositoryInterface;

    class CustomersRepository extends BaseRepository implements CustomersRepositoryInterface{
        public function __construct(customers $customers){
            parent::__construct($customers);
        }
        public function index($per){
            return $this->model::paginate($per);
        }
    }