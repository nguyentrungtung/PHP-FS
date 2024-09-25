<?php

use App\Http\Controllers\Admin\AdminCategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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
Route::get('/admin/categories', [AdminCategoriesController::class,'index'])->name('admin.categories');
Route::get('/admin/categories/create', [AdminCategoriesController::class,'create'])->name('admin.categories.create');
Route::post('/admin/categories/store',[AdminCategoriesController::class,'store'])->name('admin.categories.store');
Route::get('/admin/categories/detail/{id}', [AdminCategoriesController::class,'edit'])->name('admin.categories.edit');
Route::delete('/admin/categories/delete/{id}', [AdminCategoriesController::class,'destroy'])->name('admin.categories.destroy');
Route::put('/admin/categories/update/{id}',[AdminCategoriesController::class,'update'])->name('admin.categories.update');