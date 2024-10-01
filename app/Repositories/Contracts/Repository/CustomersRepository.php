<?php
    namespace App\Repositories\Contracts\Repository;

use App\Models\customers;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\RepositoryInterface\CustomersRepositoryInterface;
use Illuminate\Support\Facades\Auth;

    class CustomersRepository extends BaseRepository implements CustomersRepositoryInterface{
        public function __construct(customers $customers){
            parent::__construct($customers);
        }
        public function index($per){
            return $this->model::paginate($per);
        }
        // lay tat cac sac order cua nguoi dung
        public function getOrders(){
            $id=Auth::user()->id;
            return $this->model->find( $id )->orders()->paginate(5);
        }
        // lay ra tat ca cac san pham da duoc nguoi dung mua
        public function getProductsByOrderIdS(){
            $id=Auth::user()->id;
            return $this->model->find( $id )->orders()->paginate(5);
        }
    }