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

Route::get('/error', [HomeController::class, 'error'])->name('error');

Route::get('/', [HomeController::class, 'index'])->name('home');

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
    });
    Route::middleware(['login.check:1'])->group(function () {
        // Route untuk Admin
        Route::get('/backend/admin', [BackendController::class, 'admin'])->name('backend.admin');
    });
    // Route untuk semua login
    Route::get('/backend/logout', [BackendController::class, 'logout'])->name('backend.logout');
});