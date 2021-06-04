<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BackendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/error', [HomeController::class, 'error'])->name('error');

Route::get('/backend/login', [BackendController::class, 'login'])->name('backend.login');
Route::post('/backend/login/do', [BackendController::class, 'loginDo'])->name('backend.login.do');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['login.check:0'])->group(function () {
        // Route untuk SuperAdmin
        Route::get('/backend/superadmin', [BackendController::class, 'superadmin'])->name('backend.superadmin');
        // User CRUD
        Route::get('/backend/superadmin/user', [BackendController::class, 'user'])->name('backend.superadmin.user');
        Route::get('/backend/superadmin/user/add', [BackendController::class, 'userAdd'])->name('backend.superadmin.user.add');
        Route::post('/backend/superadmin/user/add/do', [BackendController::class, 'userAddDo'])->name('backend.superadmin.user.add.do');
        Route::get('/backend/superadmin/user/edit/{id}', [BackendController::class, 'userEdit'])->name('backend.superadmin.user.edit');
        Route::post('/backend/superadmin/user/edit/{id}/do', [BackendController::class, 'userEditDo'])->name('backend.superadmin.user.edit.do');
        Route::get('/backend/superadmin/user/delete/{id}', [BackendController::class, 'userDeleteDo'])->name('backend.superadmin.user.delete');
        // Menu CRUD
        Route::get('/backend/superadmin/menu', [BackendController::class, 'menu'])->name('backend.superadmin.menu');
        Route::get('/backend/superadmin/menu/add', [BackendController::class, 'menuAdd'])->name('backend.superadmin.menu.add');
        Route::post('/backend/superadmin/menu/add/do', [BackendController::class, 'menuAddDo'])->name('backend.superadmin.menu.add.do');
        Route::get('/backend/superadmin/menu/edit/{id}', [BackendController::class, 'menuEdit'])->name('backend.superadmin.menu.edit');
        Route::post('/backend/superadmin/menu/edit/{id}/do', [BackendController::class, 'menuEditDo'])->name('backend.superadmin.menu.edit.do');
        Route::get('/backend/superadmin/menu/delete/{id}', [BackendController::class, 'menuDeleteDo'])->name('backend.superadmin.menu.delete');
        // Kategori CRUD
        Route::get('/backend/superadmin/kategori', [BackendController::class, 'kategori'])->name('backend.superadmin.kategori');
        Route::get('/backend/superadmin/kategori/add', [BackendController::class, 'kategoriAdd'])->name('backend.superadmin.kategori.add');
        Route::post('/backend/superadmin/kategori/add/do', [BackendController::class, 'kategoriAddDo'])->name('backend.superadmin.kategori.add.do');
        Route::get('/backend/superadmin/kategori/edit/{id}', [BackendController::class, 'kategoriEdit'])->name('backend.superadmin.kategori.edit');
        Route::post('/backend/superadmin/kategori/edit/{id}/do', [BackendController::class, 'kategoriEditDo'])->name('backend.superadmin.kategori.edit.do');
        Route::get('/backend/superadmin/kategori/delete/{id}', [BackendController::class, 'kategoriDeleteDo'])->name('backend.superadmin.kategori.delete');
        // Pelanggan CRUD
        Route::get('/backend/superadmin/pelanggan', [BackendController::class, 'pelanggan'])->name('backend.superadmin.pelanggan');
        Route::get('/backend/superadmin/pelanggan/add', [BackendController::class, 'pelangganAdd'])->name('backend.superadmin.pelanggan.add');
        Route::post('/backend/superadmin/pelanggan/add/do', [BackendController::class, 'pelangganAddDo'])->name('backend.superadmin.pelanggan.add.do');
        Route::get('/backend/superadmin/pelanggan/edit/{id}', [BackendController::class, 'pelangganEdit'])->name('backend.superadmin.pelanggan.edit');
        Route::post('/backend/superadmin/pelanggan/edit/{id}/do', [BackendController::class, 'pelangganEditDo'])->name('backend.superadmin.pelanggan.edit.do');
        Route::get('/backend/superadmin/pelanggan/delete/{id}', [BackendController::class, 'pelangganDeleteDo'])->name('backend.superadmin.pelanggan.delete');
        // Status CRUD
        Route::get('/backend/superadmin/status', [BackendController::class, 'status'])->name('backend.superadmin.status');
        Route::get('/backend/superadmin/status/add', [BackendController::class, 'statusAdd'])->name('backend.superadmin.status.add');
        Route::post('/backend/superadmin/status/add/do', [BackendController::class, 'statusAddDo'])->name('backend.superadmin.status.add.do');
        Route::get('/backend/superadmin/status/edit/{id}', [BackendController::class, 'statusEdit'])->name('backend.superadmin.status.edit');
        Route::post('/backend/superadmin/status/edit/{id}/do', [BackendController::class, 'statusEditDo'])->name('backend.superadmin.status.edit.do');
        Route::get('/backend/superadmin/status/delete/{id}', [BackendController::class, 'statusDeleteDo'])->name('backend.superadmin.status.delete');
        // Pemesanan CRUD
        Route::get('/backend/superadmin/pemesanan', [BackendController::class, 'pemesanan'])->name('backend.superadmin.pemesanan');
        Route::get('/backend/superadmin/pemesanan/add', [BackendController::class, 'pemesananAdd'])->name('backend.superadmin.pemesanan.add');
        Route::post('/backend/superadmin/pemesanan/add/do', [BackendController::class, 'pemesananAddDo'])->name('backend.superadmin.pemesanan.add.do');
        Route::get('/backend/superadmin/pemesanan/edit/{id}', [BackendController::class, 'pemesananEdit'])->name('backend.superadmin.pemesanan.edit');
        Route::post('/backend/superadmin/pemesanan/edit/{id}/do', [BackendController::class, 'pemesananEditDo'])->name('backend.superadmin.pemesanan.edit.do');
        Route::get('/backend/superadmin/pemesanan/delete/{id}', [BackendController::class, 'pemesananDeleteDo'])->name('backend.superadmin.pemesanan.delete');
    });
    Route::middleware(['login.check:1'])->group(function () {
        // Route untuk Admin
        Route::get('/backend/admin', [BackendController::class, 'admin'])->name('backend.admin');
    });
    // Route untuk semua login
    Route::get('/backend/logout', [BackendController::class, 'logout'])->name('backend.logout');
});