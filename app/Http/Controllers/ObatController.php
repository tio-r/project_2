<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');

        // Array kategori
        $categories = [
            1 => 'Obat Intervensi dan Larutan Steril',
            2 => 'Diabetes',
            3 => 'Darah Tinggi',
            4 => 'Kolestrol',
            5 => 'Jantung',
            6 => 'Asam Urat',
            7 => 'Disfungsi Ereksi',
            8 => 'Flu, Pusing dan Demam',
            9 => 'Anti Infeksi',
            10 => 'Alergi',
            11 => 'Gangguan Pencernaan',
            12 => 'Mata',
        ];
        
        // Data obat dengan ID yang unik
        $obats = [
            ['id' => 1, 'name' => 'Obat Pusing', 'category_id' => 1, 'image' => 'img/obat 1.jpg', 'price' => 50000, 'rating' => 4.5, 'stock' => 45],
            ['id' => 2, 'name' => 'Obat Diabetes A', 'category_id' => 2, 'image' => 'img/dummy.jpg', 'price' => 75000, 'rating' => 4.0, 'stock' => 10],
            ['id' => 3, 'name' => 'Obat Darah Tinggi B', 'category_id' => 3, 'image' => 'img/dummy.jpg', 'price' => 60000, 'rating' => 4.2, 'stock' => 15],
            ['id' => 4, 'name' => 'Obat Kolestrol C', 'category_id' => 4, 'image' => 'img/dummy.jpg', 'price' => 80000, 'rating' => 4.8, 'stock' => 20],
            ['id' => 5, 'name' => 'Obat Jantung D', 'category_id' => 5, 'image' => 'img/dummy.jpg', 'price' => 65000, 'rating' => 4.3, 'stock' => 8],
            ['id' => 6, 'name' => 'Obat Asam Urat E', 'category_id' => 6, 'image' => 'img/dummy.jpg', 'price' => 55000, 'rating' => 4.1, 'stock' => 12],
            ['id' => 7, 'name' => 'Obat Disfungsi F', 'category_id' => 7, 'image' => 'img/dummy.jpg', 'price' => 70000, 'rating' => 4.6, 'stock' => 5],
            ['id' => 8, 'name' => 'Obat Flu G', 'category_id' => 8, 'image' => 'img/dummy.jpg', 'price' => 72000, 'rating' => 4.4, 'stock' => 25],
            ['id' => 9, 'name' => 'Obat Infeksi H', 'category_id' => 9, 'image' => 'img/dummy.jpg', 'price' => 82000, 'rating' => 4.7, 'stock' => 18],
            ['id' => 10, 'name' => 'Obat Alergi I', 'category_id' => 10, 'image' => 'img/dummy.jpg', 'price' => 48000, 'rating' => 4.0, 'stock' => 30],
            ['id' => 11, 'name' => 'Obat Pencernaan J', 'category_id' => 11, 'image' => 'img/dummy.jpg', 'price' => 53000, 'rating' => 4.2, 'stock' => 22],
            ['id' => 12, 'name' => 'Obat Mata K', 'category_id' => 12, 'image' => 'img/dummy.jpg', 'price' => 90000, 'rating' => 4.9, 'stock' => 14],
        ];

        // Filter obat berdasarkan category_id
        $filteredObats = array_filter($obats, fn($obat) => $obat['category_id'] == $id);
        $filteredObats = array_values($filteredObats);

        // Jika obat kurang dari 12, tambahkan dummy
        if(count($filteredObats) < 12){
            $dummyCount = 12 - count($filteredObats);
            for($i = 0; $i < $dummyCount; $i++){
                $filteredObats[] = [
                    'id' => 100 + $i,
                    'name' => 'Obat Dummy ' . ($i + 1),
                    'category_id' => $id,
                    'image' => 'img/dummy.jpg',
                    'price' => 0,
                    'rating' => 'N/A',
                    'stock' => 0
                ];
            }
        }

        // Ambil nama kategori
        $categoryName = $categories[$id] ?? 'Kategori Tidak Ditemukan';

        return view('user.obat', [
            'obats' => $filteredObats,
            'categoryName' => $categoryName,
        ]);
    }

    public function detail(Request $request)
    {
        $id = $request->query('id');
        
        // Data kategori
        $categories = [
            1 => 'Obat Intervensi dan Larutan Steril',
            2 => 'Diabetes',
            3 => 'Darah Tinggi',
            4 => 'Kolestrol',
            5 => 'Jantung',
            6 => 'Asam Urat',
            7 => 'Disfungsi Ereksi',
            8 => 'Flu, Pusing dan Demam',
            9 => 'Anti Infeksi',
            10 => 'Alergi',
            11 => 'Gangguan Pencernaan',
            12 => 'Mata',
        ];

        // Data obat lengkap dengan informasi produk
        $obats = [
            1 => [
                'id' => 1, 
                'name' => 'Obat Pusing', 
                'category_id' => 1, 
                'category_name' => 'Obat Intervensi dan Larutan Steril',
                'image' => 'img/obat 1.jpg', 
                'price' => 29450, 
                'rating' => 5.0, 
                'stock' => 105,
                'terjual' => 105,
                'golongan' => 'Obat Keras',
                'bentuk_sediaan' => 'Tablet',
                'kemasan' => 'Strip @ 10 tablet',
                'batas_pengiriman' => '5 gr'
            ],
            2 => [
                'id' => 2, 
                'name' => 'Obat Diabetes A', 
                'category_id' => 2, 
                'category_name' => 'Diabetes',
                'image' => 'img/dummy.jpg', 
                'price' => 75000, 
                'rating' => 4.0, 
                'stock' => 10,
                'terjual' => 25,
                'golongan' => 'Obat Bebas',
                'bentuk_sediaan' => 'Kapsul',
                'kemasan' => 'Botol @ 30 kapsul',
                'batas_pengiriman' => '10 gr'
            ],
            3 => [
                'id' => 3, 
                'name' => 'Obat Darah Tinggi B', 
                'category_id' => 3, 
                'category_name' => 'Darah Tinggi',
                'image' => 'img/dummy.jpg', 
                'price' => 60000, 
                'rating' => 4.2, 
                'stock' => 15,
                'terjual' => 40,
                'golongan' => 'Obat Keras',
                'bentuk_sediaan' => 'Tablet',
                'kemasan' => 'Strip @ 14 tablet',
                'batas_pengiriman' => '8 gr'
            ],
            // ... tambahkan data lainnya dengan struktur yang sama
        ];

        // Cari obat berdasarkan id
        $obat = $obats[$id] ?? null;

        if (!$obat) {
            return redirect('/etalase-obat')->with('error', 'Obat tidak ditemukan');
        }

        return view('user.detail', ['obat' => $obat]);
    }
}