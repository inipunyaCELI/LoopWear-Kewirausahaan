<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mbarang()
    {
        return $this->belongsTo(Mbarang::class, 'barang_id', 'id_barang');
    }
}