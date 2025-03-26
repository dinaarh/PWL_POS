<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka
 
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
 
Route::middleware(['auth'])->group(function() { // artinya semua route didalam group ini harus login dulu
    // masukkan semua route yang perlu autentikasi di sini
    Route::get('/', [WelcomeController::class, 'index']);
    //Route Level

    // Artinya semua route di dalam groupp ini harus punya role AD< (Amdinistrator)
    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/level', [LevelController::class, 'index']); // menampilkan halaman awal level
        Route::post('/level/list', [LevelController::class, 'list']); // menampilkan data level dalam bentuk json untuk datables
        Route::get('/level/create', [LevelController::class, 'create']); // menampilkan halaman form tambah level
        Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']);
        Route::post('/level', [LevelController::class, 'store']); // menyimpan data level baru
        Route::post('/level/ajax', [LevelController::class, 'store_ajax']);
        Route::get('/level/{id}', [LevelController::class, 'show']);
        Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']);
        Route::get('/level/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
        Route::put('/level/{id}', [LevelController::class, 'update']); // menyimpan data level yang diubah
        Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); 
        Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']);
        Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
        Route::delete('/level/{id}', [LevelController::class, 'destroy']); // menghapus data level
    });

    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/user', [UserController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/user/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/user/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
        Route::post('/user', [UserController::class, 'store']);         // menyimpan data user baru
        Route::get('/user/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
        Route::post('/user/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru Ajax
        Route::get('/user/{id}', [UserController::class, 'show']);       // menampilkan detail user
        Route::get('/user/{id}/show_ajax', [UserController::class, 'show_ajax']);
        Route::get('/user/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/user/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
        Route::get('/user/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user ajax
        Route::put('/user/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
        Route::get('/user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // menampilkan halaman konfirmasi delete user ajax
        Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
        Route::delete('/user/{id}', [UserController::class, 'destroy']); // menghapus data user
    });

    //kategori
    Route::middleware(['authorize:ADM,MNG'])->group(function () {
        Route::get('/kategori', [KategoriController::class, 'index']);
        Route::post('/kategori/list', [KategoriController::class, 'list']);
        Route::get('/kategori/create', [KategoriController::class, 'create']);
        Route::post('/kategori', [KategoriController::class, 'store']);
        Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/kategori/ajax', [KategoriController::class, 'store_ajax']);
        Route::get('/kategori/{id}', [KategoriController::class, 'show']);
        Route::get('/kategori/{id}/show_ajax', [KategoriController::class, 'show_ajax']);
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']); 
        Route::put('/kategori/{id}', [KategoriController::class, 'update']);
        Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); 
        Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
        Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
    });


    //supplier
    Route::middleware(['authorize:ADM,MNG'])->group(function () {
        Route::get('/supplier', [SupplierController::class, 'index']);
        Route::post('/supplier/list', [SupplierController::class, 'list']);
        Route::get('/supplier/create', [SupplierController::class, 'create']);
        Route::post('/supplier', [SupplierController::class, 'store']);
        Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']);
        Route::post('/supplier/ajax', [SupplierController::class, 'store_ajax']);
        Route::get('/supplier/{id}', [SupplierController::class, 'show']);
        Route::get('/supplier/{id}/show_ajax', [SupplierController::class, 'show_ajax']);
        Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']); 
        Route::put('/supplier/{id}', [SupplierController::class, 'update']);
        Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); 
        Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
        Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
        Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
        Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);
    });


    //barang
    // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager), & STF (Staff)
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
        Route::get('/barang', [BarangController::class, 'index']);
        Route::post('/barang/list', [BarangController::class, 'list']);
        Route::get('/barang/create', [BarangController::class, 'create']);
        Route::post('/barang', [BarangController::class, 'store']);
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/barang/ajax', [BarangController::class, 'store_ajax']); // Menyimpan data user baru Ajax
        Route::get('/barang/{id}', [BarangController::class, 'show']);
        Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']);
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/barang/{id}', [BarangController::class, 'update']);
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
        Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk hapus data user Ajax
        Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
    });
});