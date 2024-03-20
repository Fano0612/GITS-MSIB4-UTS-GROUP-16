<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasscodeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\LaporanKriminalitasController;

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

// Additional
Route::post('/editProfile/{id}', [UserController::class, 'editProfile'])->name('editProfile');
Route::get('/showProfile/{id}', [UserController::class, 'showProfile'])->name('showProfile');
Route::get('/deleteProfile/{id}', [UserController::class, 'deleteProfile'])->name('deleteProfile');



// GENERAL USER
Route::get('', function () {
    return view('login');
});
Route::get('/', function () {
    return view('login');
});
Route::get('login', [UserController::class, 'login'])->name('login');
Route::POST('login', [UserController::class, 'loginacc'])->name('loginacc');
Route::get('/forgotpassword', function () {
    return view('forgotpassword');
})->name('lupapassword');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::POST('forgotPassword', [UserController::class, 'forgotPassword'])->name('forgotPassword');


// GENERAL MANAGER OPERASIONAL + KARYAWAN
Route::POST('registerstaff', [UserController::class, 'registeraccstaff'])->name('registeraccstaff');
Route::get('registerstaff', [UserController::class, 'registerstaff'])->name('registerstaff');
Route::get('/password', function () {
    return view('password');
});
Route::post('/check-password', [PasscodeController::class, 'checkPassword'])->name('checkPassword');



// GENERAL MANAGER OPERASIONAL
Route::get('/dashboardgeneralmanageroperasional', function () {
    return view('dashboardgeneralmanageroperasional');
})->name('dashboardgeneralmanageroperasional');

Route::get('/category', [CategoryController::class, 'create'])->name('category');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::post('/editlaporan/{id_pelaporankegiatankriminalitas}', [LaporanKriminalitasController::class, 'editlaporan'])->name('editlaporan');
Route::get('/showlaporan/{id_pelaporankegiatankriminalitas}', [LaporanKriminalitasController::class, 'showlaporan'])->name('showlaporan');
Route::get('/deletelaporan/{id_pelaporankegiatankriminalitas}', [LaporanKriminalitasController::class, 'deletelaporan'])->name('deletelaporan');

Route::get('/viewProductTransaction/{transactionId}', [ProductController::class, 'viewProductTransaction'])->name('viewProductTransaction');
Route::get('/printTransaction/{transactionId}', [ProductController::class, 'printTransaction'])->name('printTransaction');
Route::post('/paymentProductCart', [App\Http\Controllers\ProductController::class, 'paymentProductCart'])->name('paymentProductCart');
Route::post('/incrementProductCart', [App\Http\Controllers\ProductController::class, 'incrementProductCart'])->name('incrementProductCart');
Route::post('/decrementProductCart', [App\Http\Controllers\ProductController::class, 'decrementProductCart'])->name('decrementProductCart');
Route::delete('/removeProductCart/{id}', [App\Http\Controllers\ProductController::class, 'removeProductCart'])->name('removeProductCart');
Route::post('/buyProduct2', [App\Http\Controllers\ProductController::class, 'buyProduct2'])->name('buyproduct2');
Route::get('/showProductCart2', [App\Http\Controllers\ProductController::class, 'showProductCart2'])->name('showProductCart2');

Route::get('/product_menu', [ProductController::class, 'index'])->name('product_menu');
Route::post('/insertproduct', [ProductController::class, 'insertproduct'])->name('insertproduct');
Route::get('/showproduct/{id_barang}', [ProductController::class, 'showproduct'])->name('showproduct');
Route::post('/editproduct/{id_barang}', [ProductController::class, 'editproduct'])->name('editproduct');
Route::get('/deleteproduct/{id_barang}', [ProductController::class, 'deleteproduct'])->name('deleteproduct');
Route::get('/productlist', [ProductListController::class, 'index'])->name('productlist');
Route::get('/product_list5', [ProductListController::class, 'index5'])->name('product_list5');

Route::get('/daftarlaporankriminalitas', function () {
    return view('daftarlaporankriminalitas');
})->name('daftarlaporankriminalitas');
Route::get('/shopwithhelp', function () {
    return view('shopwithhelp');
})->name('shopwithhelp');
Route::get('/daftarpelanggan', function () {
    return view('daftarpelanggan');
})->name('daftarpelanggan');
Route::get('/transaction_list', function () {
    return view('transaction_list');
})->name('transaction_list');





// KARYAWAN
Route::get('/dashboardkaryawan', function () {
    return view('dashboardkaryawan');
})->name('dashboardkaryawan');

Route::post('/editlaporan2/{id_pelaporankegiatankriminalitas}', [LaporanKriminalitasController::class, 'editlaporan2'])->name('editlaporan2');
Route::get('/showlaporan2/{id_pelaporankegiatankriminalitas}', [LaporanKriminalitasController::class, 'showlaporan2'])->name('showlaporan2');
Route::get('/deletelaporan2/{id_pelaporankegiatankriminalitas}', [LaporanKriminalitasController::class, 'deletelaporan2'])->name('deletelaporan2');

Route::get('/category2', [CategoryController::class, 'create2'])->name('category2');
Route::post('/category2', [CategoryController::class, 'store2'])->name('category.store2');
Route::get('/category2/{id}', [CategoryController::class, 'show2'])->name('category.show2');
Route::get('/category2/{id}/edit', [CategoryController::class, 'edit2'])->name('category.edit2');
Route::post('/category2/{id}', [CategoryController::class, 'update2'])->name('category.update2');
Route::delete('/category2/{id}', [CategoryController::class, 'destroy2'])->name('category.destroy2');

Route::get('/viewProductTransaction2/{transactionId}', [ProductController::class, 'viewProductTransaction2'])->name('viewProductTransaction2');
Route::get('/printTransaction2/{transactionId}', [ProductController::class, 'printTransaction2'])->name('printTransaction2');

Route::post('/paymentProductCart2', [App\Http\Controllers\ProductController::class, 'paymentProductCart2'])->name('paymentProductCart2');
Route::post('/incrementProductCart2', [App\Http\Controllers\ProductController::class, 'incrementProductCart2'])->name('incrementProductCart2');
Route::post('/decrementProductCart2', [App\Http\Controllers\ProductController::class, 'decrementProductCart2'])->name('decrementProductCart2');
Route::delete('/removeProductCart2/{id}', [App\Http\Controllers\ProductController::class, 'removeProductCart2'])->name('removeProductCart2');
Route::post('/buyProduct3', [App\Http\Controllers\ProductController::class, 'buyProduct3'])->name('buyproduct3');
Route::get('/showProductCart3', [App\Http\Controllers\ProductController::class, 'showProductCart3'])->name('showProductCart3');

Route::get('/product_menu2', [ProductController::class, 'index2'])->name('product_menu2');
Route::post('/insertproduct2', [ProductController::class, 'insertproduct2'])->name('insertproduct2');
Route::get('/showproduct2/{id_barang}', [ProductController::class, 'showproduct2'])->name('showproduct2');
Route::post('/editproduct2/{id_barang}', [ProductController::class, 'editproduct2'])->name('editproduct2');
Route::get('/deleteproduct2/{id_barang}', [ProductController::class, 'deleteproduct2'])->name('deleteproduct2');
Route::get('/product_list2', [ProductListController::class, 'index2'])->name('product_list2');
Route::get('/product_list6', [ProductListController::class, 'index6'])->name('product_list6');

Route::get('/daftarlaporankriminalitas2', function () {
    return view('daftarlaporankriminalitas2');
})->name('daftarlaporankriminalitas2');
Route::get('/shopwithhelp2', function () {
    return view('shopwithhelp2');
})->name('shopwithhelp2');
Route::get('/transaction_list2', function () {
    return view('transaction_list2');
})->name('transaction_list2');




// PELANGGAN
Route::get('/dashboardpelanggan', function () {
    return view('dashboardpelanggan');
})->name('dashboardpelanggan');

Route::POST('register', [UserController::class, 'registeracc'])->name('registeracc');
Route::get('register', [UserController::class, 'register'])->name('register');


Route::get('/laporankriminalitas', [LaporanKriminalitasController::class, 'index'])->name('laporankriminalitas');
Route::post('/laporankriminalitas/insert', [LaporanKriminalitasController::class, 'insertlaporan'])->name('insertlaporan');

Route::get('/viewProductTransaction3/{transactionId}', [ProductController::class, 'viewProductTransaction3'])->name('viewProductTransaction3');
Route::get('/printTransaction3/{transactionId}', [ProductController::class, 'printTransaction3'])->name('printTransaction3');

Route::post('/paymentProductCart3', [App\Http\Controllers\ProductController::class, 'paymentProductCart3'])->name('paymentProductCart3');
Route::post('/incrementProductCart3', [App\Http\Controllers\ProductController::class, 'incrementProductCart3'])->name('incrementProductCart3');
Route::post('/decrementProductCart3', [App\Http\Controllers\ProductController::class, 'decrementProductCart3'])->name('decrementProductCart3');
Route::delete('/removeProductCart3/{id}', [App\Http\Controllers\ProductController::class, 'removeProductCart3'])->name('removeProductCart3');
Route::post('/buyProduct', [App\Http\Controllers\ProductController::class, 'buyProduct'])->name('buyproduct');
Route::get('/showProductCart', [App\Http\Controllers\ProductController::class, 'showProductCart'])->name('showProductCart');
Route::get('/product_list3', [ProductListController::class, 'index3'])->name('product_list3');
Route::get('/product_list4', [ProductListController::class, 'index4'])->name('product_list4');

Route::get('/transaction_list3', function () {
    return view('transaction_list3');
})->name('transaction_list3');
Route::get('/product_list_front', function () {
    return view('product_list_front');
})->name('product_list_front');
Route::get('/laporankriminalitas', function () {
    return view('laporankriminalitas');
})->name('laporankriminalitas');