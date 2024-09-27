<?php
    namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use Illuminate\Http\Request;

    class CategoriesService{
        protected $catgoryRepository;
        public function __construct(CategoryRepositoryInterface $catgoryRepository){
            $this->catgoryRepository = $catgoryRepository;
        }
        public function index(){
            return $this->catgoryRepository->index();
        }
        public function getCatWithParent($id){
            $cat = $this->catgoryRepository->find($id);
            $parents = $this->getParents();
            // dd($cat, $parents);
            return ['cat'=>$cat,'parents'=>$parents];
        }
        public function getParents(){
            return $this->catgoryRepository->getParents();
        }
        public function create(Request $request){
            $name= $request->input('name');
            $parent_Id= $request->input('parent_id');
            $data=['categories_name'=>$name,'categories_parent_id'=>$parent_Id];
            $this->catgoryRepository->create($data);
        }
        // 
        public function update(Request $request, $id){
            $data=['categories_name'=>$request->input('name'),'categories_parent_id'=>$request->input('parent_id')];
            $this->catgoryRepository->update($id,$data);
        }
        // 
        public function destroy($id){
            $this->catgoryRepository->delete($id);
        }
        // lay ra list cat va phan loai de hien thi ra man hinh 
        public function all(){
            $categories= $this->catgoryRepository->all();
            $child=[];
            $root=[];
            foreach($categories as $category){
                if($category->categories_parent_id===null){
                    $root[]=['id'=>$category->id,'name'=>$category->categories_name,'child'=>[]];
                }else{
                    $child[]=['id'=>$category->id,'name'=>$category->categories_name,'parent_id'=> $category->categories_parent_id];
                }
            }
            for($i= 0;$i<count($root);$i++){
                foreach($child as $cat){
                    if($cat['parent_id']===$root[$i]['id']){
                        $root[$i]['child'][]=$cat;
                    }
                }
            }
            return $root;
        }
    }   