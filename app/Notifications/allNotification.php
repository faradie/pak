<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class allNotification extends Notification
{
    use Queueable;

    private $post;

    public function __construct(array $post){
        $this->post = $post;
    }
    
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase(){
        return[
            'pj' =>$this->post['pj'],
            'notification_subject' =>   $this->post['notification_subject'],
            'notification_content'=>   $this->post['notification_content'],
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
