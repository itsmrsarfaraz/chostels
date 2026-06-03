<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class SeekerInvitationNotification extends Notification
{
    use Queueable;

    public function __construct(
        private User $user
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = URL::temporarySignedRoute(
            'password.setup',
            now()->addDays(7),
            [
                'user' => $this->user->id
            ]
        );

        return (new MailMessage)
            ->subject('Welcome to SeeHostels')
            ->greeting("Hi {$this->user->name}")
            ->line('A hostel owner has assigned a bed to you.')
            ->action('Set Password', $url);
    }
}