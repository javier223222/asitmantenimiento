<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EstatusEvento implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $status;
     public $foliid;
     public $urlimg;
    public function __construct($status,$foliid,$urlimg)
    {
        $this->status = $status;
        $this->foliid = $foliid;
        $this->urlimg = $urlimg;

    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */


    public function broadcastOn()
  {
      $cha= 'status'.$this->foliid;
      return [$cha];
  }

  public function broadcastAs()
  {
      return 'changestatus';
  }
}
