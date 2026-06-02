<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderCancelledNotification extends Notification
{
    use Queueable;

    protected $order_number;

    public function __construct($order_number)
    {
        $this->order_number = $order_number;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Pesanan Dibatalkan',
            'message' => 'Pesanan kamu dengan nomor ' . $this->order_number . ' telah dibatalkan oleh Admin.',
            'order_number' => $this->order_number
        ];
    }
}
