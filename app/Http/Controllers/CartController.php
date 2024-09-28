<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    private $service;
    public function __construct(ProductService $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session()->has('user_carts')){
            return session('user_carts');
        }
        return [];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        if (!Session::has('user_carts')) {
            // Nếu chưa tồn tại, khởi tạo mảng
            Session::put('user_carts', []);
        }
        // Lấy mảng user_carts từ session
        $userCarts = session('user_carts');
        // Duyệt qua từng sản phẩm trong giỏ hàng
        $found = false;
        for( $i = 0; $i < count($userCarts); $i++ ){
            if( $userCarts[$i]['id'] == $id ){
                $found = true;
                $userCarts[$i]['count']=(int)$userCarts[$i]['count']+1;
                break;
            }
        }
        // Nếu không tìm thấy sản phẩm với $id, thêm sản phẩm mới vào giỏ hàng
        if (!$found) {
            $userCarts[] = ['id' => $id, 'count' => 1];
        }
        // Lưu lại giỏ hàng đã cập nhật vào session
        Session::put('user_carts', $userCarts);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // dd($this->index());
        return $this->service->getByList($this->index());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
