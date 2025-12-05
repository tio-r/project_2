<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;

class TransaksiController extends Controller
{
    // ===========================================
    // FORM TAMBAH TRANSAKSI (jika diperlukan)
    // ===========================================
    public function showTransaksiForm()
    {
        $users = User::all(); // dropdown user
        return view('transaksi.create', compact('users'));
    }

    // ===========================================
    // INSERT TRANSAKSI BARU (VERSI MIRIP USER)
    // ===========================================
    public function tambahTransaksi(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required|string|max:50',
            'status_transaksi' => 'required|string|max:50',
        ]);

        // Tentukan id_transaksi baru (manual increment)
        $maxId = Transaksi::max('id_transaksi');
        $newId = $maxId ? $maxId + 1 : 1;

        // Ambil nama user dari tabel users otomatis
        $namaUser = User::where('id_user', $request->id_user)->value('nama');

        // Simpan transaksi
        Transaksi::create([
            'id_transaksi' => $newId,
            'id_user' => $request->id_user,
            'nama' => $namaUser, // simpan nama user
            'total_harga' => $request->total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_transaksi' => $request->status_transaksi,
            'tanggal_transaksi' => now(),
        ]);

        return redirect('/transaksi-admin')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // ===========================================
    // TAMPILKAN TABEL TRANSAKSI
    // ===========================================
    public function index()
    {
        $t = Transaksi::with('user')->paginate(10);
        return view('transaksi.transaksi-admin', compact('transaksi'));
    }

    // ===========================================
    // HAPUS TRANSAKSI
    // ===========================================
    public function destroy($id)
    {
        Transaksi::destroy($id);
        return redirect('/transaksi-admin')->with('success', 'Transaksi berhasil dihapus!');
    }
}
