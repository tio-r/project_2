<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showDaftarForm()
    {
        return view('user.daftar');
    }

    public function daftar(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:user,nama',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Tentukan id_user baru (misalnya dengan mencari max id dan tambah 1)
        $maxId = User::max('id_user');
        $newId = $maxId ? $maxId + 1 : 1;

        // Simpan data
        User::create([
            'id_user' => $newId,
            'nama' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'nomor_hp' => $request->input('phone'),
            'tanggal_daftar' => now(),
        ]);

        // Redirect ke login
        return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
}