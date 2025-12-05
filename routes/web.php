<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RiwayatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view ('welcome');
});

Route::get('/daftar', [UserController::class, 'showDaftarForm'])->name('daftar.form');
Route::post('/daftar', [UserController::class, 'daftar'])->name('daftar');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

Route::get('/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/kalender', [KalenderController::class, 'showKalender'])->name('kalender');

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

Route::get('/send-event', function(){
    broadcast(new \App\Events\EventPertama());
});  

Route::get('/etalase-obat', function () {
    return view ('user.etalase-obat');
});

Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');

Route::get('/detail', [ObatController::class, 'detail'])->name('obat.detail');

Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
Route::post('/add-to-cart', [KeranjangController::class, 'addToCart'])->name('add.to.cart');
Route::post('/update-cart', [KeranjangController::class, 'updateCart'])->name('update.cart');
Route::post('/update-note', [KeranjangController::class, 'updateNote'])->name('update.note');
Route::post('/remove-from-cart', [KeranjangController::class, 'removeFromCart'])->name('remove.from.cart');
Route::get('/clear-cart', [KeranjangController::class, 'clearCart'])->name('clear.cart');

Route::get('/alamat', [AlamatController::class, 'index'])->name('alamat');
Route::get('/alamat/tambah', [AlamatController::class, 'formTambahAlamat'])->name('alamat.tambah.form');
Route::post('/alamat/tambah', [AlamatController::class, 'tambahAlamat'])->name('alamat.tambah');
Route::post('/alamat/gunakan-lokasi', [AlamatController::class, 'gunakanLokasiSaatIni'])->name('alamat.gunakan.lokasi');
Route::post('/alamat/simpan-peta', [AlamatController::class, 'simpanAlamatPeta'])->name('alamat.simpan.peta');
Route::get('/alamat/api-key', [AlamatController::class, 'getMapApiKey'])->name('alamat.api.key');
Route::get('/alamat/set-utama/{id}', [AlamatController::class, 'setUtama'])->name('alamat.set.utama');
Route::get('/alamat/hapus/{id}', [AlamatController::class, 'hapusAlamat'])->name('alamat.hapus');

Route::get('/daftar-admin', [AdminController::class, 'showForm'])->name('admin.daftar');

Route::post('/daftar-admin', [AdminController::class, 'store'])->name('admin.store');

Route::get('/login-admin', [AdminController::class, 'showLogin'])->name('admin.login');

Route::post('/login-admin', [AdminController::class, 'login'])->name('admin.login.submit');

Route::get('/password-admin', [AdminController::class, 'showForgotPassword'])->name('admin.password');

Route::post('/password-admin', [AdminController::class, 'updatePassword'])->name('admin.password.update');

Route::get('/dashboard-admin', function () {
    return view('admin.dashboard');
});

Route::get('/user-admin', function () {
    return view('admin.user', [
        'users' => DB::table('user')->get()
    ]);
});
Route::get('/transaksi-admin', function () {
    return view('admin.transaksi', [
        't' => DB::table('transaksi')->get()
    ]);
});

Route::get('/riwayat-admin', [RiwayatController::class, 'index'])->name('admin.riwayat');
Route::get('/riwayat-create', [RiwayatController::class, 'create'])->name('riwayat.create');
Route::post('/riwayat-store', [RiwayatController::class, 'store'])->name('riwayat.store');
Route::delete('/riwayat-delete/{id}', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');