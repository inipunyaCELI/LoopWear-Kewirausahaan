<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    public function index()
    {
        $latestProducts = Mbarang::where('status', 'available')->latest()->take(4)->get();
        
        $randomProducts = Mbarang::where('status', 'available')->inRandomOrder()->take(4)->get();

        return view('welcome', compact('latestProducts', 'randomProducts'));
    }

    public function center(Request $request)
    {
        // 1. Ambil semua barang yang available
        $all_items = Mbarang::where('status', 'available')->get();

        // 2. Ambil data review dan order_items untuk dihitung secara manual (Anti-Error Relasi)
        // Kita ambil review yang memiliki order_id, lalu hubungkan dengan produk lewat order_items
        $reviewsData = \DB::table('reviews')
            ->join('order_items', 'reviews.order_id', '=', 'order_items.order_id')
            ->select(
                'order_items.barang_id', // Kalau nanti error kolom, ganti jadi 'order_items.product_id'
                \DB::raw('COUNT(reviews.id) as total_review'),
                \DB::raw('AVG(reviews.rating) as rata_rating')
            )
            ->groupBy('order_items.barang_id') // Sesuaikan dengan kolom select di atas
            ->get()
            ->keyBy('barang_id'); // Sesuaikan dengan kolom select di atas

        // 3. Tempelkan data review ke masing-masing item secara dinamis
        foreach ($all_items as $item) {
            // Coba deteksi key berdasarkan primary key barangmu (id_barang)
            $reviewInfo = $reviewsData->get($item->id_barang);
            
            $item->total_review = $reviewInfo ? $reviewInfo->total_review : 0;
            $item->rata_rating = $reviewInfo ? $reviewInfo->rata_rating : 0;
        }

        // 4. Kelompokkan berdasarkan kategori seperti semula
        $data = [
            'hijab'  => $all_items->filter(function($item) { return strtolower($item->kategori) == 'hijab'; }),
            'baju'   => $all_items->filter(function($item) { 
                $kat = strtolower($item->kategori);
                return $kat == 'baju' || $kat == 'atasan'; 
            }),
            'celana' => $all_items->filter(function($item) { return strtolower($item->kategori) == 'celana'; }),
            'sepatu' => $all_items->filter(function($item) { return strtolower($item->kategori) == 'sepatu'; }),
        ];

        return view('products', compact('data'));
    }

    public function showDetail($id)
    {
        $product = Mbarang::where('id_barang', $id)->firstOrFail();
        
        $recommendations = Mbarang::where('kategori', $product->kategori)
                            ->where('id_barang', '!=', $id)
                            ->take(4)
                            ->get();

        if (\Schema::hasColumn('order_items', 'barang_id')) {
            $kolomBarang = 'barang_id';
        } elseif (\Schema::hasColumn('order_items', 'product_id')) {
            $kolomBarang = 'product_id';
        } else {
            $kolomBarang = 'id_barang'; 
        }

        $orderIds = \DB::table('order_items')
                        ->where($kolomBarang, $id)
                        ->pluck('order_id');

        // Hanya review dari produk ini, TANPA fallback
        $reviews = \App\Models\Review::whereIn('order_id', $orderIds)
                                    ->with('user')
                                    ->latest()
                                    ->get();

        $rata_rating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
        $total_review = $reviews->count();
        $total_terjual = \DB::table('order_items')->where($kolomBarang, $id)->sum('qty');

        return view('review', compact('product', 'recommendations', 'reviews', 'rata_rating', 'total_review', 'total_terjual'));
    }

    public function category($kategori)
    {
        $query = Mbarang::where('status', 'available');

        if (strtolower($kategori) == 'baju') {
            $query->where(function($q) {
                $q->where('kategori', 'like', '%baju%')
                  ->orWhere('kategori', 'like', '%atasan%');
            });
        } else {
            $query->where('kategori', 'like', '%' . $kategori . '%');
        }

        $items = $query->latest()->get();

        return view('category', compact('items', 'kategori'));
    }

    public function search(Request $request)
    {
        $query = trim($request->get('q', ''));

        if (empty($query)) {
            return redirect()->route('user.products');
        }

        // Cari berdasarkan nama produk, kategori, dan warna (termasuk kata warna di nama produk)
        $items = Mbarang::where('status', 'available')
            ->where(function($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%')
                  ->orWhere('kategori', 'like', '%' . $query . '%')
                  ->orWhere('warna', 'like', '%' . $query . '%');
            })
            ->orderBy('nama_barang')
            ->get();

        return view('search', compact('items', 'query'));
    }

    public function create() { }
    public function store(Request $request) { }

    // Fungsi show bawaan kamu
    public function show($id)
    {
        $item = Mbarang::findOrFail($id);
        return view('detail_barang', compact('item'));
    }
}