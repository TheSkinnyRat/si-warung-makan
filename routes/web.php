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
Route::get('/kategori/{id}', [HomeController::class, 'kategori'])->name('home.kategori');
Route::get('/status', [HomeController::class, 'status'])->name('home.status');

Route::get('/register', [HomeController::class, 'register'])->name('home.register');
Route::post('/register/do', [HomeController::class, 'registerDo'])->name('home.register.do');
Route::get('/login', [HomeController::class, 'login'])->name('home.login');
Route::post('/login/do', [HomeController::class, 'loginDo'])->name('home.login.do');

Route::middleware(['pelanggan.check'])->group(function () {
    // Route untuk Pelanggan
    Route::get('/pelanggan', [HomeController::class, 'pelanggan'])->name('home.pelanggan');
    // Pesan
    Route::get('/pelanggan/pesan', [HomeController::class, 'pesan'])->name('home.pelanggan.pesan');
    Route::get('/pelanggan/pesan/do', [HomeController::class, 'pesanDo'])->name('home.pelanggan.pesan.do');
    Route::get('/pelanggan/pesan/kategori/{id}', [HomeController::class, 'pesanKategori'])->name('home.pelanggan.pesan.kategori');
    Route::get('/pelanggan/pesan/add/{id}', [HomeController::class, 'pesanAdd'])->name('home.pelanggan.pesan.add');
    Route::post('/pelanggan/pesan/add/{id}/do', [HomeController::class, 'pesanAddDo'])->name('home.pelanggan.pesan.add.do');
    Route::get('/pelanggan/pesan/delete/{id}/do', [HomeController::class, 'pesanDeleteDo'])->name('home.pelanggan.pesan.delete.do');
    // Pesanan
    Route::get('/pelanggan/pesanan', [HomeController::class, 'pesanan'])->name('home.pelanggan.pesanan');
    Route::get('/pelanggan/pesanan/do', [HomeController::class, 'pesananDo'])->name('home.pelanggan.pesanan.do');
    Route::get('/pelanggan/pesanan/delete/do', [HomeController::class, 'pesananDeleteDo'])->name('home.pelanggan.pesanan.delete.do');
    // Checkout
    Route::get('/pelanggan/checkout/{id}', [HomeController::class, 'checkout'])->name('home.pelanggan.checkout');
    Route::get('/pelanggan/checkout/{id}/do', [HomeController::class, 'checkoutDo'])->name('home.pelanggan.checkout.do');
    Route::get('/pelanggan/checkout/delete/{id}/do', [HomeController::class, 'checkoutDeleteDo'])->name('home.pelanggan.checkout.delete.do');
    // Bayar
    Route::get('/pelanggan/bayar/{id}', [HomeController::class, 'bayar'])->name('home.pelanggan.bayar');
    // Riwayat
    Route::get('/pelanggan/riwayat', [HomeController::class, 'riwayat'])->name('home.pelanggan.riwayat');
    Route::get('/pelanggan/riwayat/nota/{id}', [HomeController::class, 'nota'])->name('home.pelanggan.riwayat.nota');
    Route::get('/pelanggan/logout', [HomeController::class, 'logout'])->name('home.pelanggan.logout');
});

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
        // Detail CRUD
        Route::get('/backend/superadmin/detail', [BackendController::class, 'detail'])->name('backend.superadmin.detail');
        Route::get('/backend/superadmin/detail/add', [BackendController::class, 'detailAdd'])->name('backend.superadmin.detail.add');
        Route::post('/backend/superadmin/detail/add/do', [BackendController::class, 'detailAddDo'])->name('backend.superadmin.detail.add.do');
        Route::get('/backend/superadmin/detail/edit/{id}', [BackendController::class, 'detailEdit'])->name('backend.superadmin.detail.edit');
        Route::post('/backend/superadmin/detail/edit/{id}/do', [BackendController::class, 'detailEditDo'])->name('backend.superadmin.detail.edit.do');
        Route::get('/backend/superadmin/detail/delete/{id}', [BackendController::class, 'detailDeleteDo'])->name('backend.superadmin.detail.delete');
        // Pembayaran CRUD
        Route::get('/backend/superadmin/pembayaran', [BackendController::class, 'pembayaran'])->name('backend.superadmin.pembayaran');
        Route::get('/backend/superadmin/pembayaran/add', [BackendController::class, 'pembayaranAdd'])->name('backend.superadmin.pembayaran.add');
        Route::post('/backend/superadmin/pembayaran/add/do', [BackendController::class, 'pembayaranAddDo'])->name('backend.superadmin.pembayaran.add.do');
        Route::get('/backend/superadmin/pembayaran/edit/{id}', [BackendController::class, 'pembayaranEdit'])->name('backend.superadmin.pembayaran.edit');
        Route::post('/backend/superadmin/pembayaran/edit/{id}/do', [BackendController::class, 'pembayaranEditDo'])->name('backend.superadmin.pembayaran.edit.do');
        Route::get('/backend/superadmin/pembayaran/delete/{id}', [BackendController::class, 'pembayaranDeleteDo'])->name('backend.superadmin.pembayaran.delete');
        // Generate Laporan
        Route::get('/backend/superadmin/laporan', [BackendController::class, 'laporan'])->name('backend.superadmin.laporan');
        Route::post('/backend/superadmin/laporan/generate/do', [BackendController::class, 'laporanGenerateDo'])->name('backend.superadmin.laporan.generate.do');
    });
    Route::middleware(['login.check:1'])->group(function () {
        // Route untuk Admin
        Route::get('/backend/admin', [BackendController::class, 'admin'])->name('backend.admin');
        // Pembayaran
        Route::get('/backend/admin/bayar', [BackendController::class, 'bayar'])->name('backend.admin.bayar');
        Route::get('/backend/admin/bayar/{id}/do', [BackendController::class, 'bayarDo'])->name('backend.admin.bayar.do');
        // Proses
        Route::get('/backend/admin/proses', [BackendController::class, 'proses'])->name('backend.admin.proses');
        Route::get('/backend/admin/proses/{id}/do', [BackendController::class, 'prosesDo'])->name('backend.admin.proses.do');
        // Selesai
        Route::get('/backend/admin/selesai', [BackendController::class, 'selesai'])->name('backend.admin.selesai');
        Route::get('/backend/admin/selesai/{id}/do', [BackendController::class, 'selesaiDo'])->name('backend.admin.selesai.do');
    });
    // Route untuk semua login
    Route::get('/backend/logout', [BackendController::class, 'logout'])->name('backend.logout');
});