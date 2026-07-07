<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketReplyNotification extends Notification
{
    use Queueable;

    public function __construct(public Ticket $ticket) {}

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
     * Build the e-mail telling the ticket creator a reply was added.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Nieuwe reactie op ticket #{$this->ticket->id}")
            ->greeting("Hallo {$notifiable->first_name},")
            ->line("Er is een reactie geplaatst op je ticket \"{$this->ticket->title}\".")
            ->action('Bekijk ticket', config('app.url')."/tickets/{$this->ticket->id}")
            ->line('Bedankt!');
    }
}
