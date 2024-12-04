<?php



namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TransactionStatusNotification extends Notification
{
    use Queueable;

    private $transaction;
    private $status;

    public function __construct($transaction, $status)
    {
        $this->transaction = $transaction;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // Save in DB and broadcast real-time
    }

    public function toArray($notifiable)
    {
        return [
            'transaction_id' => $this->transaction->id,
            'status' => $this->status,
            'message' => "Transaction #{$this->transaction->id} has been {$this->status}.",
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'transaction_id' => $this->transaction->id,
            'status' => $this->status,
            'message' => "Transaction #{$this->transaction->id} has been {$this->status}.",
        ]);
    }
}
