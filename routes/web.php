<?php

use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\AdminUnitController;

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

Route::prefix('admin/categories')->group(function () {
    Route::get('/', [AdminCategoriesController::class,'index'])->name('admin.categories');
    Route::get('/create', [AdminCategoriesController::class,'create'])->name('admin.categories.create');
    Route::post('/store',[AdminCategoriesController::class,'store'])->name('admin.categories.store');
    Route::get('/detail/{id}', [AdminCategoriesController::class,'edit'])->name('admin.categories.edit');
    Route::delete('/delete/{id}', [AdminCategoriesController::class,'destroy'])->name('admin.categories.destroy');
    Route::put('/update/{id}',[AdminCategoriesController::class,'update'])->name('admin.categories.update');
});
// 
Route::prefix('admin/brands')->group(function () {
    Route::get('/', [AdminBrandController::class,'index'])->name('admin.brands');
    Route::get('/create', [AdminBrandController::class,'create'])->name('admin.brands.create');
    Route::post('/store',[AdminBrandController::class,'store'])->name('admin.brands.store');
    Route::get('/detail/{id}', [AdminBrandController::class,'edit'])->name('admin.brands.edit');
    Route::delete('/delete/{id}', [AdminBrandController::class,'destroy'])->name('admin.brands.destroy');
    Route::put('/update/{id}',[AdminBrandController::class,'update'])->name('admin.brands.update');
});
// 
Route::prefix('admin/units')->group(function () {
    Route::get('/', [AdminUnitController::class,'index'])->name('admin.units');
    Route::get('/create', [AdminUnitController::class,'create'])->name('admin.units.create');
    // Route::post('/store',[AdminUnitController::class,'store'])->name('admin.units.store');
    Route::get('/detail/{id}', [AdminUnitController::class,'edit'])->name('admin.units.edit');
    // Route::delete('/delete/{id}', [AdminUnitController::class,'destroy'])->name('admin.units.destroy');
    // Route::put('/update/{id}',[AdminUnitController::class,'update'])->name('admin.units.update');
});