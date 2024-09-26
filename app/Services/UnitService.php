<?php
    namespace App\Services;
use App\Repositories\Contracts\RepositoryInterface\PromotionsRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

    class UnitService {
        private $unitRepository;
        public function __construct(UnitRepositoryInterface $unitRepository){
            $this->unitRepository = $unitRepository;
        }
        public function index($per){
            return $this->unitRepository->index($per);
        }
        // 

    }
