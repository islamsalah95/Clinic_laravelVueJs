<?php

namespace App\Providers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;  
    public $patient_id;  

   public function __construct($data,$patient_id)
   {
       $this->data=$data;
       $this->patient_id=$patient_id;

   }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'data' => $this->data
           
    //     ]);
    // }

    public function broadcastOn()
    {
        return new PrivateChannel('private-channel.'.$this->patient_id);
    }
}
