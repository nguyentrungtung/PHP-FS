<?php
    namespace App\Services;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Auth;
    use App\Repositories\Contracts\RepositoryInterface\CustomersRepositoryInterface;

    class UserService{
        private $customerRepository;
        public function __construct(CustomersRepositoryInterface $customerRepository){
            $this->customerRepository = $customerRepository;
        }
        // 
        public function regit(Request $request){
            $request->validate([            // Kiểm tra định dạng email hợp lệ
                'customer_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                'password' => 'required|min:8', // Kiểm tra định dạng số điện thoại
            ]);
            $data=$request->except('_token','password');
            $data['password']=Hash::make($request->input('password'));
            // dd($data);
            return $user= $this->customerRepository->create($data);
        }
        // 
        public function login(Request $request){
            $credentials = $request->only('customer_phone', 'password');

            // Kiểm tra thông tin đăng nhập
            if (Auth::attempt($credentials)) {
                return true;
            }
            return false;
        }
    }