<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;
use App\Models\Transaksi;

class RiwayatController extends Controller
{
    // TAMPILKAN TABEL RIWAYAT
    public function index()
    {
        $riwayat = Riwayat::with('transaksi')->paginate(10);
        return view('admin.riwayat', compact('riwayat'));
    }

    // FORM TAMBAH RIWAYAT (opsional)
    public function create()
    {
        $transaksi = Transaksi::all();
        return view('riwayat.create', compact('transaksi'));
    }

    // SIMPAN DATA RIWAYAT
    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'status_pengiriman' => 'required|string|max:50',
            'no_resi' => 'nullable|string|max:100',
            'alamat_pengiriman' => 'required|string'
        ]);

        $maxId = Riwayat::max('id_riwayat');
        $newId = $maxId ? $maxId + 1 : 1;

        Riwayat::create([
            'id_riwayat' => $newId,
            'id_transaksi' => $request->id_transaksi,
            'status_pengiriman' => $request->status_pengiriman,
            'no_resi' => $request->no_resi,
            'alamat_pengiriman' => $request->alamat_pengiriman,
        ]);

        return redirect('/riwayat-admin')->with('success', 'Data riwayat berhasil ditambahkan!');
    }

    // HAPUS RIWAYAT
    public function destroy($id)
    {
        Riwayat::destroy($id);
        return redirect('/riwayat-admin')->with('success', 'Riwayat berhasil dihapus!');
    }
}
