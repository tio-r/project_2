<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    public function index()
    {
        // Ambil data keranjang dari session
        $cartItems = Session::get('cart', []);
        
        // Jika keranjang kosong, tampilkan data dummy
        if (empty($cartItems)) {
            $cartItems = [
                [
                    'id' => 1,
                    'name' => 'Obat Pusing',
                    'image' => 'img/obat 1.jpg',
                    'price' => 29450,
                    'original_price' => 33000,
                    'discount' => 8,
                    'stock' => 3,
                    'quantity' => 2,
                    'note' => ''
                ]
            ];
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('user.keranjang', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function addToCart(Request $request)
    {
        $obatId = $request->input('obat_id');
        $quantity = $request->input('quantity', 1);

        // Data obat dari database atau array (sesuaikan dengan data Anda)
        $obats = [
            1 => [
                'id' => 1,
                'name' => 'Obat Pusing',
                'image' => 'img/obat 1.jpg',
                'price' => 29450,
                'original_price' => 33000,
                'discount' => 8,
                'stock' => 3,
                'category_id' => 1,
                'category_name' => 'Obat Intervensi dan Larutan Steril'
            ],
            2 => [
                'id' => 2,
                'name' => 'Obat Diabetes A',
                'image' => 'img/dummy.jpg',
                'price' => 75000,
                'original_price' => 80000,
                'discount' => 6,
                'stock' => 10,
                'category_id' => 2,
                'category_name' => 'Diabetes'
            ],
            // Tambahkan data obat lainnya sesuai kebutuhan
        ];

        // Cari obat berdasarkan ID
        $obat = $obats[$obatId] ?? null;

        if (!$obat) {
            return redirect()->back()->with('error', 'Obat tidak ditemukan');
        }

        // Ambil keranjang dari session
        $cart = Session::get('cart', []);

        // Cek apakah obat sudah ada di keranjang
        $existingItemKey = null;
        foreach ($cart as $key => $item) {
            if ($item['id'] == $obatId) {
                $existingItemKey = $key;
                break;
            }
        }

        if ($existingItemKey !== null) {
            // Update quantity jika sudah ada
            $cart[$existingItemKey]['quantity'] += $quantity;
        } else {
            // Tambah item baru ke keranjang
            $cart[] = [
                'id' => $obat['id'],
                'name' => $obat['name'],
                'image' => $obat['image'],
                'price' => $obat['price'],
                'original_price' => $obat['original_price'],
                'discount' => $obat['discount'],
                'stock' => $obat['stock'],
                'quantity' => $quantity,
                'note' => '',
                'category_id' => $obat['category_id'],
                'category_name' => $obat['category_name']
            ];
        }

        // Simpan ke session
        Session::put('cart', $cart);

        return redirect('/keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function updateCart(Request $request)
    {
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity');

        $cart = Session::get('cart', []);

        foreach ($cart as $key => &$item) {
            if ($item['id'] == $itemId) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        Session::put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function updateNote(Request $request)
    {
        $itemId = $request->input('item_id');
        $note = $request->input('note');

        $cart = Session::get('cart', []);

        foreach ($cart as $key => &$item) {
            if ($item['id'] == $itemId) {
                $item['note'] = $note;
                break;
            }
        }

        Session::put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function removeFromCart(Request $request)
    {
        $itemId = $request->input('item_id');

        $cart = Session::get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $itemId) {
                unset($cart[$key]);
                break;
            }
        }

        // Re-index array
        $cart = array_values($cart);

        Session::put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function clearCart()
    {
        Session::forget('cart');
        return redirect('/keranjang')->with('success', 'Keranjang berhasil dikosongkan');
    }
}