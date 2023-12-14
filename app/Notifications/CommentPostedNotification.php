<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\comment;

class CommentPostedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     * 
     * 
     */

     public function index()
{
    $notifications = auth()->user()->notifications;
    return view('notifications.index', compact('notifications'));
}

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
        return ['database'];
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
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'commented_by' => $this->comment->user->name,
            'commented_on' => $this->comment->post->title,
            'comment_id' => $this->comment->id,
            'comment_content' => $this->comment->content,
        ];
    }

    public function storeComment(Request $request, Post $post)
    {
        // Logic to save the comment
        $comment = // ... save the comment ...

        // Notify the post owner
        $postOwner = $post->user; // Assuming the post has a 'user' relationship for the owner
        $postOwner->notify(new CommentPostedNotification($comment));
        // ...
    }
        public function postComment(Request $request)
    {
        // Assume $comment is the comment instance being saved
        $comment->save();

        // Notify the post owner
        $postOwner = $comment->post->user; // Assuming $comment->post gives the post instance
        $postOwner->notify(new CommentPostedNotification($comment));
    }

}
