<?php
    namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\CustomersRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

    class CustomersService{
        protected $customersRepository;
        public function __construct(CustomersRepositoryInterface $customersRepository){
            $this->customersRepository = $customersRepository;
        }
        public function index($per){
            return $this->customersRepository->index($per);
        }
        public function store(Request $request){
            $request->validate([
                'customer_email' => 'required|email',             // Kiểm tra định dạng email hợp lệ
                'customer_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                'password' => 'required|min:8', // Kiểm tra định dạng số điện thoại
            ]);
            $data=$request->except('_token','password');
            $data['password']=Hash::make($request->input('password'));
            // dd($data);
            return $this->customersRepository->create($data);
        }
        // 
        public function edit($id){
            return $this->customersRepository->find($id);
        }
        // 
        public function update(Request $request, $id){
            $request->validate([
                'customer_email' => 'required|email',             // Kiểm tra định dạng email hợp lệ
                'customer_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            ]);
            return $this->customersRepository->update($id,$request->except('_token','_method'));
        }
    }   