<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlamatController extends Controller
{
    public function index()
    {
        // Return view OpenStreetMap (GRATIS, no API key needed)
        return view('user.alamat');
    }
    
    public function save(Request $request)
    {
        try {
            $validated = $request->validate([
                'address' => 'required|string|max:1000',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'place_name' => 'nullable|string|max:255',
                'current_location' => 'nullable|string'
            ]);
            
            // Log data untuk debugging
            Log::info('Alamat disimpan via OSM:', $validated);
            
            // TODO: Simpan ke database
            // Contoh:
            // $address = new Address();
            // $address->fill($validated);
            // $address->user_id = auth()->id(); // jika menggunakan auth
            // $address->map_source = 'openstreetmap';
            // $address->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Alamat berhasil disimpan!',
                'data' => $validated,
                'map_source' => 'openstreetmap',
                'timestamp' => now()->toDateTimeString()
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error menyimpan alamat: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan alamat: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    // Optional: Untuk mendapatkan koordinat dari alamat (geocoding)
    public function geocode(Request $request)
    {
        $request->validate([
            'address' => 'required|string'
        ]);
        
        // Menggunakan Nominatim API (OpenStreetMap) - GRATIS
        $address = urlencode($request->address);
        $url = "https://nominatim.openstreetmap.org/search?format=json&q={$address}&countrycodes=id&limit=1";
        
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get($url, [
                'headers' => [
                    'User-Agent' => 'YourAppName/1.0 (your@email.com)'
                ]
            ]);
            
            $data = json_decode($response->getBody(), true);
            
            if (!empty($data)) {
                return response()->json([
                    'success' => true,
                    'latitude' => $data[0]['lat'],
                    'longitude' => $data[0]['lon'],
                    'display_name' => $data[0]['display_name']
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Alamat tidak ditemukan'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}