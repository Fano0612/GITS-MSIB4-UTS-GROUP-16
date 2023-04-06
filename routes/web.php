<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::get('register', [UserController::class, 'register'])->name('register');
Route::POST('register', [UserController::class, 'registeracc'])->name('registeracc');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::POST('login', [UserController::class, 'loginacc'])->name('loginacc');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('AccountExist', [UserController::class, 'AccountExist'])->name('AccountExist');
Route::get('AccountUnexist', [UserController::class, 'AccountUnexist'])->name('AccountUnexist');
