<?php

namespace TwoFactorAuth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use KitchenAuth\Notifications\Channels\GhasedakChannel;

class TwoFactorAutWithEmailNotification extends Notification
{
    use Queueable;


    private $token;
    
    
    public function __construct($token)
    {
        $this->token = $token;
    }

    
    public function via($notifiable)
    {
        return ['mail'];
    }

 
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your Two Factor Auth Token is : '.$this->token)
                    ->line('Your token will be expired in 2 minutes!');
    }
}
