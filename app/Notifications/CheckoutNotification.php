<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CheckoutNotification extends Notification
{
    use Queueable;

    protected $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Segera lakukan pembayaran pesananmu!',
            'detail' => 'Pesananmu sudah dibuat. Selesaikan pembayaran sebelum batas waktu agar pesanan dapat diproses.',
            'transaction_id' => $this->transaction->id,
        ];
    }
}