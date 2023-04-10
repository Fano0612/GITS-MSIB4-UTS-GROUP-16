<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductListController;

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
Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');
Route::get('/productlist', [ProductListController::class, 'index'])->name('productlist');


Route::get('register', [UserController::class, 'register'])->name('register');
Route::POST('register', [UserController::class, 'registeracc'])->name('registeracc');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::POST('login', [UserController::class, 'loginacc'])->name('loginacc');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('AccountExist', [UserController::class, 'AccountExist'])->name('AccountExist');
Route::get('AccountUnexist', [UserController::class, 'AccountUnexist'])->name('AccountUnexist');


Route::get('/product_menu', [ProductController::class, 'index'])->name('product_menu');
Route::post('/insertproduct', [ProductController::class, 'insertproduct'])->name('insertproduct');
Route::get('/showproduct/{product_id}', [ProductController::class, 'showproduct'])->name('showproduct');
Route::post('/editproduct/{product_id}', [ProductController::class, 'editproduct'])->name('editproduct');
Route::get('/deleteproduct/{product_id}', [ProductController::class, 'deleteproduct'])->name('deleteproduct');

Route::get('/category', [CategoryController::class, 'create'])->name('category');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
