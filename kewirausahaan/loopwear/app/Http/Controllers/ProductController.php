<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $items = Mbarang::where('status', 'available')->latest()->take(4)->get();
        return view('welcome', compact('items'));
    }

    // INI HALAMAN PRODUCTS YANG ADA 4 KATEGORI
    public function center(Request $request)
    {
        // Tarik semua data yang available
        $all_items = \App\Models\Mbarang::where('status', 'available')->get();

        $data = [
            'hijab'  => $all_items->filter(function($item) { return strtolower($item->kategori) == 'hijab'; }),
            
            // Kita bikin fleksibel: mau nulis 'baju' atau 'atasan' di admin, bakal tetap masuk ke sini!
            'baju'   => $all_items->filter(function($item) { 
                $kat = strtolower($item->kategori);
                return $kat == 'baju' || $kat == 'atasan'; 
            }),
            
            'celana' => $all_items->filter(function($item) { return strtolower($item->kategori) == 'celana'; }),
            'sepatu' => $all_items->filter(function($item) { return strtolower($item->kategori) == 'sepatu'; }),
        ];

        return view('products', compact('data'));
    }

    // --- INI YANG KITA PERBAIKI ---
    public function showDetail($id)
    {
        // 1. Cari barang berdasarkan id_barang
        $product = Mbarang::where('id_barang', $id)->firstOrFail();
        
        // 2. Ambil rekomendasi produk dengan kategori yang sama (Maksimal 4)
        $recommendations = Mbarang::where('kategori', $product->kategori)
                            ->where('id_barang', '!=', $id) // Biar produk yg lagi dilihat ga muncul di rekomendasi
                            ->take(4)
                            ->get();

        // 3. Ambil review (Pakai try-catch sebagai pengaman kalau tabel review belum dibuat)
        try {
            $reviews = $product->reviews()->with('user')->latest()->get();
        } catch (\Exception $e) {
            $reviews = collect(); // Balikin kosong kalau error/belum ada tabelnya
        }
        
        // 4. Buka file review.blade.php dan bawa data product, recommendations, dan reviews
        return view('review', compact('product', 'recommendations', 'reviews'));
    }
    // -------------------------------------------------------------------

    public function category($kategori)
    {
        // Mulai pencarian barang yang available
        $query = Mbarang::where('status', 'available');

        // Kalau yang diklik adalah kategori "baju", kita suruh sistem nyari "baju" ATAU "atasan"
        if (strtolower($kategori) == 'baju') {
            $query->where(function($q) {
                $q->where('kategori', 'like', '%baju%')
                  ->orWhere('kategori', 'like', '%atasan%');
            });
        } else {
            // Untuk hijab, celana, dan sepatu
            $query->where('kategori', 'like', '%' . $kategori . '%');
        }

        // Ambil datanya dan urutkan dari yang terbaru
        $items = $query->latest()->get();

        return view('category', compact('items', 'kategori'));
    }

    public function create() { }
    public function store(Request $request) { }

    // Fungsi show bawaan kamu
    public function show($id)
    {
        $item = Mbarang::findOrFail($id);
        return view('detail_barang', compact('item'));
    }

    public function edit(string $id) { }
    public function update(Request $request, string $id) { }
    public function destroy(string $id) { }
}