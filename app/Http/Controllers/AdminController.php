<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function showForm()
    {
        return view('admin.daftar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:admin,nama|max:255',
            'email' => 'required|email|unique:admin,email',
            'password' => 'required|min:6',
            'nomor_hp' => 'required|numeric',
        ]);

        DB::table('admin')->insert([
            'id_admin' => random_int(1000, 9999),
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nomor_hp' => $request->nomor_hp,
            'tanggal_daftar' => Carbon::now(),
        ]);

        return redirect()->route('admin.login')->with('success', 'Pendaftaran berhasil!');
    }
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = DB::table('admin')->where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        // Simpan sesi login (sederhana)
        Session::put('admin', $admin);

        return redirect('/dashboard-admin')->with('success', 'Login berhasil!');
    }

    // --- FORM LUPA PASSWORD ---
    public function showForgotPassword()
    {
        return view('admin.password');
    }

    // --- PROSES UPDATE PASSWORD ---
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admin,email',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::table('admin')
            ->where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password),
            ]);

        return redirect()->route('admin.login')->with('success', 'Password berhasil diubah! Silakan login ulang.');
    }
}
