<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Support\Facades\Log;

class NouvelleNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
        Log::info("NouvelleNotification constructed with message: {$message}");
    }

    public function via($notifiable): array
    {
        Log::info("NouvelleNotification via called for user: {$notifiable->id}");
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => $this->message,
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        Log::info("NouvelleNotification toBroadcast called for user: {$notifiable->id}");
        return new BroadcastMessage([
            'message' => $this->message,
        ]);
    }
}
