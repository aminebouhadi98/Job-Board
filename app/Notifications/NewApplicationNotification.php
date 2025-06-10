<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApplicationNotification extends Notification
{
    use Queueable;

    public function __construct(public Application $application) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nuova candidatura ricevuta')
            ->line('Hai ricevuto una nuova candidatura per il job: ' . $this->application->job->title)
            ->line('Candidato: ' . $this->application->user->name)
            ->action('Vedi candidatura', route('company.jobs.applications.index', $this->application->job))
            ->line('Grazie per aver usato la nostra JobBoard!');
    }
}
