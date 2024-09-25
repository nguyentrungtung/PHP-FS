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
Route::prefix('admin/categories')->group(function () {
    Route::get('/', [AdminCategoriesController::class,'index'])->name('admin.categories');
    Route::get('/create', [AdminCategoriesController::class,'create'])->name('admin.categories.create');
    Route::post('/store',[AdminCategoriesController::class,'store'])->name('admin.categories.store');
    Route::get('/detail/{id}', [AdminCategoriesController::class,'edit'])->name('admin.categories.edit');
    Route::delete('/delete/{id}', [AdminCategoriesController::class,'destroy'])->name('admin.categories.destroy');
    Route::put('/update/{id}',[AdminCategoriesController::class,'update'])->name('admin.categories.update');
});