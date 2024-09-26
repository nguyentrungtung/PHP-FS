<?php
    namespace App\Services;
    use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
    use Illuminate\Support\Facades\File;
    use Illuminate\Http\Request;

    class BrandsService {
        private $brandRepository;
        public function __construct(BrandRepositoryInterface $brandRepository){
            $this->brandRepository = $brandRepository;
        }
        public function index($per){
            return $this->brandRepository->index($per);
        }
        // 
        public function store(Request $request){
            
            $request->validate([
                'logo' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Giới hạn kích thước và định dạng
            ]);
            // dd($request->file('logo'));
            $data=$this->createData($request);
            if($data){
                $brand=$this->brandRepository->create($data);
                return $brand;
            }
        }
        public function show($id){
            return $this->brandRepository->find($id);
        }
        // 
        public function destroy($id){
            $brand= $this->brandRepository->delete($id);
            if (!$brand) {
                return true;
            }
            return false;
        }
        // 
        public function update(Request $request, $id){
            // kiem tra co upload file moi hay khong
            $data=$this->createData($request);
            if($data){
                $brand=$this->brandRepository->update($id,$data);
                return $brand;
            }
            return false;
        }
        // ham tao data dau vao cho repo
        private function createData(Request $request){
            // dd($request->input("logo_name"));
            $name=$request->input("name");
            $logo_name=$request->input("logo_name")===null?$name:$request->input("logo_name");
            // trang thai kiem tra update xem nguoi dung co thay doi anh hay khong
            // neu khong thay doi anh se lay duong dan cu tu curren
            if(!$request->hasFile('logo')&&$request->input('current_logo')){
                $current=$request->input('current_logo');
                // kiem tra ten anh co duoc thay doi hay khong
                if($logo_name!==pathinfo($current, PATHINFO_FILENAME)){
                    // Đổi tên file cũ nếu tồn tại và cập nhật tên file mới
                    $newImageName = $logo_name . '.' . pathinfo($current, PATHINFO_EXTENSION);
                    $newLogoPath = public_path('img/brands/' . $newImageName);
                    return ['brand_name'=>$name,'brand_logo'=>"img/brands/".$newImageName,'move'=>['current'=>$current,'new'=>$newLogoPath]];
                    
                }else{
                    return ['brand_name'=>$name,'brand_logo'=>$current];
                }
            }
            // neu nguoi dung upload anh moi len se lay file do va chuyen vao data
            if($request->hasFile('logo')){
                $request->validate([
                    'logo' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Giới hạn kích thước và định dạng
                ]);
                $logo=$request->file("logo");
                $fileName = $logo_name.'.'. $logo->getClientOriginalExtension();
                return ['brand_name'=>$name,'brand_logo'=>"img/brands/".$fileName,'create'=>['file'=>$logo,'fileName'=>$fileName]];
            }
            return false;
        }
    }
