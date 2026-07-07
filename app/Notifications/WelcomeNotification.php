<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * The channels the notification is delivered on.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Build the confirmation e-mail sent after registration.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welkom bij TicketSystem')
            ->greeting("Hallo {$notifiable->first_name},")
            ->line('Je account is aangemaakt. Je kunt nu inloggen en tickets aanmaken.')
            ->action('Naar het portaal', config('app.url'))
            ->line('Bedankt!');
    }
}
