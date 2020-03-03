<?php

namespace App\Listeners;

use App\Events\FileCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\FileNotificationController;
use App\file;
use App\FileNotification;

class NotificationInPage
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
        
        $userId = $event->userId;
        $fileId = $event->fileId;
        $file = file::findOrFail($fileId);  
        
        if($userId != 1)
        {
            FileNotification::create([
            'user_id' => $userId,
            'message' => $file->name,
        ]);
    }
            
        
        
    }
}
