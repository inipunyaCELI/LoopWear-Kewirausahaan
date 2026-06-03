<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'total_price', 
        'status_payment', 'status_delivery', 'snap_token', 'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function syncMidtransStatus()
    {
        if ($this->status_payment !== 'pending') return;

        \Midtrans\Config::$serverKey = config('midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;

        try {
            $status = \Midtrans\Transaction::status($this->order_number);
            
            if ($status->transaction_status == 'capture' || $status->transaction_status == 'settlement') {
                $this->update(['status_payment' => 'success']);
            } else if (in_array($status->transaction_status, ['expire', 'cancel', 'deny'])) {
                $this->update(['status_payment' => 'dibatalkan', 'status_delivery' => 'dibatalkan']);
            }
        } catch (\Exception $e) {
            // Abaikan jika order_id belum ada di midtrans atau error jaringan
        }
    }
}
