<?php

namespace TwoFactorAuth\TwoFactorAuthTypes;

use Illuminate\Support\Facades\Notification;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Notifications\TwoFactorAutWithEmailNotification;
use TwoFactorAuth\Responses\ResponderFacade;

class TwoFactorAutWithEmail  {

    public function __construct($user)
    {
        $token = TokenGeneratorFacade::generateToken();
        TokenStoreFacade::saveToken($token, $user->id);

        Notification::sendNow($user, new TwoFactorAutWithEmailNotification($token));

        ResponderFacade::twoFactorAutTokenSentWithEmail()->throwResponse();
        
    }
    
}