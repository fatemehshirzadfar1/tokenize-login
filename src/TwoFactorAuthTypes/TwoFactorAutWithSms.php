<?php

namespace TwoFactorAuth\TwoFactorAuthTypes;

use Illuminate\Support\Facades\Notification;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Notifications\TwoFactorAutWithSmsNotification;
use TwoFactorAuth\Responses\ResponderFacade;

class TwoFactorAutWithSms{
    
    public function __construct($user)
    {
        $token = TokenGeneratorFacade::generateToken();
        TokenStoreFacade::saveToken($token, $user->id);

        Notification::sendNow($user, 
        new TwoFactorAutWithSmsNotification($token, $user->phone_number));   

        ResponderFacade::twoFactorAutTokenSentWithSms()->throwResponse();
    }
}