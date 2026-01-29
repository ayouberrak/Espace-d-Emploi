<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NouvelleNotification extends Notification
{
    use Queueable;

    public string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Channels
     */
    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Stockage DB
     */
    public function toDatabase($notifiable): array
    {
        return [
            'message' => $this->message,
        ];
    }

    /**
     * Real-time
     */
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => $this->message,
        ]);
    }
}
