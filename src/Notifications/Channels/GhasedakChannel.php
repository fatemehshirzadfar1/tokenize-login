<?php

namespace KitchenAuth\Notifications\Channels;

use Illuminate\Notifications\Notification;

use Ghasedak\Exceptions\ApiException;
use Ghasedak\Exceptions\HttpException;

class GhasedakChannel {


    public function send($notifiable , Notification $notification){

        if(! method_exists($notification , 'toGhasedak')) {
            throw new \Exception('toGhasedakSms not found');
        }

        $data = $notification->toGhasedak($notifiable);
        $message = $data['text'];
        $receptor = $data['number'];
        $apiKey = config('services.ghasedak.key');

        try
        {
            $lineNumber = "10008566";
            $api = new \Ghasedak\GhasedakApi($apiKey);
            $api->SendSimple($receptor,$message,$lineNumber);
        }
        catch(ApiException $e){
            report($e);
            return false;
        }
        catch(HttpException $e){
            report($e);
            return false;
        }
    }
}