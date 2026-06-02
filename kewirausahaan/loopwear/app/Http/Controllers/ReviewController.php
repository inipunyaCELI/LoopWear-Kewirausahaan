<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user', 'order')
            ->latest()
            ->get();

        return view('review', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        // Pastikan pesanan milik user yang login dan statusnya selesai
        $order = Order::where('id', $request->order_id)
            ->where('user_id', auth()->id())
            ->where('status_delivery', 'selesai')
            ->firstOrFail();

        // Cek jika sudah pernah mengulas order ini
        $alreadyReviewed = Review::where('user_id', auth()->id())
            ->where('order_id', $order->id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'Kamu sudah memberikan ulasan untuk pesanan ini.');
        }

        Review::create([
            'user_id'  => auth()->id(),
            'order_id' => $order->id,
            'rating'   => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success_review', 'Ulasan berhasil dikirim! Terima kasih 😊');
    }
}
