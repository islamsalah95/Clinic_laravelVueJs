<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class PatientNotification extends Notification implements ShouldBroadcast
{
    use Queueable;
     public $data;  
     public $patient_id;  

    public function __construct($data,$patient_id)
    {
        $this->data=$data;
        $this->patient_id=$patient_id;

    }


    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'data' => $this->data
            
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => $this->data
           
        ]);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('private-channel.'.$this->patient_id);
    }
}
