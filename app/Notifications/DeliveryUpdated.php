<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class DeliveryUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($delivery, $message, $modelo)
    {
        $this->delivery = $delivery;
        $this->message = $message;
        $this->modelo = $modelo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        switch ($this->modelo) {
            case 'Teacher':
                return new DatabaseMessage([
                    'message' => $this->message . ' | ' . $this->delivery->student->name . ' | ' . $this->delivery->job->title,
                    'delivery_id' => $this->delivery->id
                ]);
                break;

            case 'Student':
                return new DatabaseMessage([
                    'message' => $this->message . ' | ' . $this->delivery->student->name . ' | ' . $this->delivery->job->title,
                    'job_id' => $this->delivery->job_id
                ]);
                break;
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
