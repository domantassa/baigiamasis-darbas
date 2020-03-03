<?php

namespace App\Listeners;

use App\Events\FileCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationInTab
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FileCreatedEvent  $event
     * @return void
     */
    public function handle(FileCreatedEvent $event)
    {
        //
    }
}
