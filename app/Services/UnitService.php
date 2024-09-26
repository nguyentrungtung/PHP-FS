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
        public function create(Request $request){
            $data=['unit_name'=>$request->input('name')];
            return $this->unitRepository->create($data);
        }
        // 
        public function edit($id){
            return $this->unitRepository->find($id);
        }
        // 
        public function update(Request $request, $id){
            $data=['unit_name'=>$request->input('name')];
            return $this->unitRepository->update($id,$data);
        }
        // 
        public function destroy($id){
            return $this->unitRepository->delete($id);
        }
    }
