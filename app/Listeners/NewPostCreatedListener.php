<?php

namespace App\Listeners;

use App\Events\PostWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPostCreatedListener
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
    public function handle(PostWasCreatedEvent $event): void
    {
        //
        dd('DDDDDDD', $event);
    }
}
