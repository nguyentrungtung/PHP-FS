<?php

use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Home\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\AdminUnitController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\ViewController;
use App\Http\Controllers\Home\CartController as HomeCartController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [CategoriesController::class,'index'])->name('categories.index');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::group(['prefix' => 'admin/coupons'], function () {
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


Route::group(['prefix' => 'admin/products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');                 // Danh sách các sản phẩm
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');         // Hiển thị form tạo sản phẩm
    Route::post('/', [ProductController::class, 'store'])->name('products.store');                // Lưu sản phẩm mới
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');      // Hiển thị form chỉnh sửa sản phẩm
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');       // Cập nhật sản phẩm
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');  // Xóa sản phẩm
});


//
Route::prefix('admin/units')->group(function () {
    Route::get('/', [AdminUnitController::class,'index'])->name('admin.units');
    Route::get('/create', [AdminUnitController::class,'create'])->name('admin.units.create');
    Route::post('/store',[AdminUnitController::class,'store'])->name('admin.units.store');
    Route::get('/detail/{id}', [AdminUnitController::class,'edit'])->name('admin.units.edit');
    Route::delete('/delete/{id}', [AdminUnitController::class,'destroy'])->name('admin.units.destroy');
    Route::put('/update/{id}',[AdminUnitController::class,'update'])->name('admin.units.update');
});
//
Route::prefix('admin/customers')->group(function () {
    Route::get('/', [AdminCustomerController::class,'index'])->name('admin.customers');
    Route::get('/create', [AdminCustomerController::class,'create'])->name('admin.customers.create');
    Route::post('/store',[AdminCustomerController::class,'store'])->name('admin.customers.store');
    Route::get('/detail/{id}', [AdminCustomerController::class,'edit'])->name('admin.customers.edit');
    Route::delete('/delete/{id}', [AdminCustomerController::class,'destroy'])->name('admin.customers.destroy');
    Route::put('/update/{id}',[AdminCustomerController::class,'update'])->name('admin.customers.update');
});
// nhom route cho trang web chinh
Route::group([], function () {
    Route::get('/',[ViewController::class,'index'])->name('web.home');
    Route::get('/category/{id}', [ViewController::class,'show'])->name('web.category');
});
// route lay danh sach san pham phia client ajax
Route::prefix('client/products')->group(function () {
    Route::get('/{cat}/{start}/{limit}', [ViewController::class,'render'])->name('client.products.render');
});
// nhom route tuong tac voi cart
Route::prefix('client/cart')->group(function () {
    Route::get('add/{id}', [HomeCartController::class,'store'])->name('client.add.cart');
    Route::get('show', [HomeCartController::class,'show'])->name('client.add.cart.show');
});
//Home
// Route cho trang chi tiết sản phẩm
Route::get('/product/{id}', [HomeProductController::class, 'productDetail'])->name('product.show');
// Route::get('/cart', [Carttemp::class, 'showCart'])->name('cart.show');
Route::get('/cart', [HomeCartController::class, 'showCart'])->name('cart.show');
