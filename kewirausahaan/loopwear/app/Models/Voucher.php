<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'kode', 'tipe', 'nilai', 'min_belanja', 'kuota', 
        'terpakai', 'berlaku_hingga', 'aktif', 'khusus_pengguna_baru'
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'khusus_pengguna_baru' => 'boolean',
    ];

    public function isValid($totalBelanja, $userId = null) {
        if (!$this->aktif) return false;
        if ($this->berlaku_hingga && now()->gt($this->berlaku_hingga)) return false;
        if ($this->kuota !== null && $this->terpakai >= $this->kuota) return false;
        if ($totalBelanja < $this->min_belanja) return false;

        if ($this->khusus_pengguna_baru) {
            $idUser = $userId ?? auth()->id();

            if (!$idUser) return false;

            $sudahPernahBelanja = \App\Models\Order::where('user_id', $idUser)->exists();

            if ($sudahPernahBelanja) return false;
        }

        return true;
    }

    public function hitungDiskon($totalBelanja) {
        if ($this->tipe == 'persen') return round($totalBelanja * ($this->nilai / 100));
        if ($this->tipe == 'nominal') return min($this->nilai, $totalBelanja);
        return 0;
    }
}