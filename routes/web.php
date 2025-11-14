<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AdminController;

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
    return view ('welcome');
});

Route::get('/daftar', [UserController::class, 'showDaftarForm'])->name('daftar.form');
Route::post('/daftar', [UserController::class, 'user.daftar'])->name('daftar');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'user.login'])->name('login.perform');

Route::get('/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/kalender', [KalenderController::class, 'showKalender'])->name('kalender');

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

Route::get('/send-event', function(){
    broadcast(new \App\Events\EventPertama());
});  

Route::get('/etalase-obat', function () {
    return view ('user.etalaseobat');
});

Route::get('/obat', [ObatController::class, 'index']);

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
        'users' => DB::table('user')->get() // ambil semua data dari tabel user
    ]);
});