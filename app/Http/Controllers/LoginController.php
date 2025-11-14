<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    // Cari user berdasarkan username
    $user = User::where('nama', $credentials['username'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {
        // Login berhasil
        Auth::login($user);

        // Hitung id_login baru
        $maxIdLogin = DB::table('login_user')->max('id_login');
        $newIdLogin = $maxIdLogin ? $maxIdLogin + 1 : 1;

        // Insert ke tabel login_user
        DB::table('login_user')->insert([
            'id_login' => $newIdLogin,
            'id_user' => $user->id_user,
            'nama' => $user->nama,
            'waktu_login' => now()
        ]);
        
        return redirect()->intended('/dashboard');
    } else {
        // Login gagal
        return back()->with('login_error', 'Username atau password salah')->withInput();
    }
}

}