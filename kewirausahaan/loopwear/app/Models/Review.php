<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'order_id', 
        'barang_id', 
        'rating', 
        'komentar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function mbarang()
    {
        return $this->belongsTo(Mbarang::class, 'barang_id', 'id_barang');
    }
}