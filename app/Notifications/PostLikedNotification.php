<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLikedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $liker; // The user who liked the post

    public function __construct(User $liker)
    {
        $this->liker = $liker;

    }

    
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->name,
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     *
     */
    
}
