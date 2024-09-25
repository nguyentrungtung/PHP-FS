<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CouponController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::prefix('coupons')->group(function () {
    Route::get('/', [CouponController::class, 'index'])->name('coupons.index');                 // Danh sách các coupon
    Route::get('/create', [CouponController::class, 'create'])->name('coupons.create');         // Hiển thị form tạo coupon
    Route::post('/', [CouponController::class, 'store'])->name('coupons.store');                // Lưu coupon mới
    Route::get('/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');      // Hiển thị form chỉnh sửa coupon
    Route::put('/{coupon}', [CouponController::class, 'update'])->name('coupons.update');       // Cập nhật coupon
    Route::delete('/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');  // Xóa coupon
});


