<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    private $service;
    public function __construct(UserService $service){
        $this->service = $service;
    }
    // 
    public function regit(Request $request){
        // dd($request->input());
        $user=$this->service->regit($request);
        Session::put('user', $user);
        // Đăng nhập người dùng ngay lập tức
        auth()->login($user);
        return redirect()->route('web.home');
    }
    // 
    public function login(Request $request){
        
        if($this->service->login($request)){
            return redirect()->route('web.home');
        };
        return redirect()->back()->withErrors('Login failed! Please check your credentials.');
    }
    // 
    public function logout(){
        Auth::logout(); // Đăng xuất người dùng
        return redirect()->route('web.home');
    }
    //update thong tin tai khoan nguoi dung
    public function update(Request $request){
        $user=$this->service->update($request);
        if($user){
           return redirect()->back()->with('reload', true)->with('success', 'Dữ liệu đã được lưu thành công!');;
        }
        return redirect()->back();
    } 

}
