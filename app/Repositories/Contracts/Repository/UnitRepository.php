<?php
    namespace App\Repositories\Contracts\Repository;
    use App\Repositories\BaseRepository;
use App\Models\Promotions;
use App\Models\Unit;
use App\Repositories\Contracts\RepositoryInterface\UnitRepositoryInterface;

    class UnitRepository extends BaseRepository implements UnitRepositoryInterface{
        public function __construct(Unit $unit){
            parent::__construct($unit);
        }
        public function index($per){
            return $this->model::paginate($per);
        }
    }