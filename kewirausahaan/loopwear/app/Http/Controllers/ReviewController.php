<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'order'])
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

        $userId = auth()->id();

        $order = Order::where('id', $request->order_id)
            ->where('user_id', $userId)
            ->where('status_delivery', 'selesai')
            ->firstOrFail();

        $alreadyReviewed = Review::where('user_id', $userId)
            ->where('order_id', $order->id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'Kamu sudah memberikan ulasan untuk pesanan ini.');
        }

        Review::create([
            'user_id'  => $userId,
            'order_id' => $order->id,
            'rating'   => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success_review', 'Ulasan berhasil dikirim! Terima kasih 😊');
    }
}