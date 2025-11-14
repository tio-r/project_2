<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $obats = [
            ['name' => 'Obat Pusing', 'category_id' => 1, 'image' => 'img/obat 1.jpg', 'price' => 50000000, 'rating' => 4.5,'stock' => 45],
            ['name' => 'Obat B', 'category_id' => 2, 'image' => 'img/dummy.jpg', 'price' => 75000, 'rating' => 4.0],
            ['name' => 'Obat C', 'category_id' => 3, 'image' => 'img/dummy.jpg', 'price' => 60000, 'rating' => 4.2],
            ['name' => 'Obat D', 'category_id' => 4, 'image' => 'img/dummy.jpg', 'price' => 80000, 'rating' => 4.8],
            ['name' => 'Obat E', 'category_id' => 5, 'image' => 'img/dummy.jpg', 'price' => 65000, 'rating' => 4.3],
            ['name' => 'Obat F', 'category_id' => 6, 'image' => 'img/dummy.jpg', 'price' => 55000, 'rating' => 4.1],
            ['name' => 'Obat G', 'category_id' => 7, 'image' => 'img/dummy.jpg', 'price' => 70000, 'rating' => 4.6],
            ['name' => 'Obat H', 'category_id' => 8, 'image' => 'img/dummy.jpg', 'price' => 72000, 'rating' => 4.4],
            ['name' => 'Obat I', 'category_id' => 9, 'image' => 'img/dummy.jpg', 'price' => 82000, 'rating' => 4.7],
            ['name' => 'Obat J', 'category_id' => 10, 'image' => 'img/dummy.jpg', 'price' => 48000, 'rating' => 4.0],
            ['name' => 'Obat K', 'category_id' => 11, 'image' => 'img/dummy.jpg', 'price' => 53000, 'rating' => 4.2],
            ['name' => 'Obat L', 'category_id' => 12, 'image' => 'img/dummy.jpg', 'price' => 90000, 'rating' => 4.9],
        ];

            // Filter obat berdasarkan category_id
            $obats = array_filter($obats, fn($obat) => $obat['category_id'] == $id);
            $obats = array_values($obats); // supaya indeks reset

if(count($obats) < 12){
    $dummyCount = 12 - count($obats);
    for($i=0; $i<$dummyCount; $i++){
        $obats[] = [
            'name' => 'Obat Dummy ' . ($i+1),
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
            'obats' => array_values($obats), // Pastikan array numerik
            'categoryName' => $categoryName,
        ]);
    }
}