<?php
    namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\CustomersRepositoryInterface;
use Illuminate\Http\Request;

    class CustomersService{
        protected $customersRepository;
        public function __construct(CustomersRepositoryInterface $customersRepository){
            $this->customersRepository = $customersRepository;
        }
        public function index($per){
            return $this->customersRepository->index($per);
        }
    }   