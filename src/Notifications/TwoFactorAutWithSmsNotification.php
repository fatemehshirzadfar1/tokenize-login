<?php

namespace TwoFactorAuth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use KitchenAuth\Notifications\Channels\GhasedakChannel;

class TwoFactorAutWithSmsNotification extends Notification
{
    use Queueable;


    private $token;
    private $phoneNumber;
    
    public function __construct($token , $phoneNumber)
    {
        $this->token = $token;
        $this->phoneNumber = $phoneNumber;
    }

    
    public function via($notifiable)
    {
        return [GhasedakChannel::class];
    }

 
    public function toGhasedak($notifiable)
    {
        return [
            'text' => "کد احراز هویت دو مرحله‌ ای شما : {$this->token} \nسلف غذای دانشگاه مهاجر",
            'number' => $this->phoneNumber
        ];
    }
}
