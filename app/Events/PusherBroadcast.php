<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $idchat;
    public $sender;
    public $time;

  public function __construct($message,$idchat,$sender,$time)
  {
      $this->message = $message;
      $this->idchat = $idchat;
        $this->sender = $sender;
        $this->time = $time;
  }

  public function broadcastOn()
  {
      $cha= 'my-chat'.$this->idchat;
      return [$cha];
  }

  public function broadcastAs()
  {
      return 'my-event';
  }

}
