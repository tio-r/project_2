<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlamatController extends Controller
{
    public function index()
    {
        // Data alamat dari session atau database
        $alamat = Session::get('alamat', []);
        
        // Jika belum ada alamat, gunakan data default
        if (empty($alamat)) {
            $alamat = [
                [
                    'id' => 1,
                    'nama' => 'Q',
                    'alamat_lengkap' => 'Situ dano, Genagatan, GAMMA, Pulsawa, Parabahama, Bendung',
                    'tipe' => 'rumah',
                    'utama' => true
                ]
            ];
        }

        // Alamat saat ini dari GPS/lokasi
        $alamatSaatIni = Session::get('alamat_saat_ini', [
            'jalan' => 'Jl. Tangkuban Parahu',
            'detail' => 'Jl. Tangkuban Parahu, Cikahuripan, Lembang, Kabupaten Bandung Barat, Jawa Barat.'
        ]);

        return view('user.alamat', [
            'alamat' => $alamat,
            'alamatSaatIni' => $alamatSaatIni
        ]);
    }

    public function getMapApiKey()
    {
        return response()->json([
            'api_key' => env('GOOGLE_MAPS_API_KEY')
        ]);
    }

    public function simpanAlamatPeta(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'alamat' => 'required|string',
            'jalan' => 'required|string'
        ]);

        // Simpan ke session
        Session::put('alamat_peta', $validated);

        return response()->json([
            'success' => true,
            'message' => 'Alamat dari peta berhasil disimpan'
        ]);
    }

    public function gunakanLokasiSaatIni(Request $request)
    {
        $validated = $request->validate([
            'jalan' => 'required|string',
            'detail' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        Session::put('alamat_saat_ini', $validated);

        return redirect('/keranjang')->with('success', 'Alamat lokasi saat ini berhasil digunakan');
    }

    public function setUtama($id)
    {
        $alamat = Session::get('alamat', []);

        foreach ($alamat as &$item) {
            $item['utama'] = false;
        }

        foreach ($alamat as &$item) {
            if ($item['id'] == $id) {
                $item['utama'] = true;
                break;
            }
        }

        Session::put('alamat', $alamat);

        return redirect('/alamat')->with('success', 'Alamat utama berhasil diubah');
    }

    public function hapusAlamat($id)
    {
        $alamat = Session::get('alamat', []);

        $alamat = array_filter($alamat, function($item) use ($id) {
            return $item['id'] != $id;
        });

        $alamat = array_values($alamat);

        Session::put('alamat', $alamat);

        return redirect('/alamat')->with('success', 'Alamat berhasil dihapus');
    }

    public function tambahAlamat(Request $request)
    {
        $alamat = Session::get('alamat', []);
    
        $newId = count($alamat) > 0 ? max(array_column($alamat, 'id')) + 1 : 1;
    
        $alamat[] = [
            'id' => $newId,
            'nama' => $request->input('nama', 'Alamat Baru'),
            'alamat_lengkap' => $request->input('alamat_lengkap', $request->input('detail', '')),
            'jalan' => $request->input('jalan', ''),
            'tipe' => $request->input('tipe', 'rumah'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'utama' => empty($alamat)
        ];
    
        Session::put('alamat', $alamat);
    
        return response()->json(['success' => true, 'message' => 'Alamat berhasil ditambahkan']);
    }

    public function formTambahAlamat()
    {
        return view('user.tambah-alamat');
    }
}