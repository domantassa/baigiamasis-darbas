<?php

namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\FileNotification;
class EndPool implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $pool;
    
    public function __construct(FileNotification $pool)
    {
        
          $this->pool = $pool;
          
          
     }
    public function broadcastOn()
    {
          return new PrivateChannel('pool.'.$this->pool->user_id);
    }
}