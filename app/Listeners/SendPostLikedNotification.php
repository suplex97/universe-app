<?php

namespace App\Listeners;

use App\Events\PostLiked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PostLikedNotification;

class SendPostLikedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostLiked $event)
    {
        // Send notification to the post owner
        \Log::info('Handling PostLiked event for post ID: ' . $event->post->id);
        if ($event->post->user_id != $event->user->id) {
            $event->post->user->notify(new PostLikedNotification($event->user));
        }
    }
}
