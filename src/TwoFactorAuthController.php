<?php

namespace TwoFactorAuth;

use Illuminate\Support\Carbon;
use KitchenAuth\Model\User;
use TwoFactorAuth\Facades\ApiTokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Model\TwoFactorType;
use TwoFactorAuth\Responses\ResponderFacade;
use TwoFactorAuth\TwoFactorAuthTypes\NoTwoFactorAut;
use TwoFactorAuth\TwoFactorAuthTypes\TwoFactorAutWithEmail;
use TwoFactorAuth\TwoFactorAuthTypes\TwoFactorAutWithSms;

class TwoFactorAuthController {

    public static $twoFactorTypeMap = 
    [
        TwoFactorType::off => NoTwoFactorAut::class,
        TwoFactorType::sms => TwoFactorAutWithSms::class,
        TwoFactorType::email => TwoFactorAutWithEmail::class,
    ];

    public static function autorize($twoFactorType , $user)
    {
      if(!array_key_exists($twoFactorType, self::$twoFactorTypeMap)) 
      {
        ResponderFacade::NoTwoFactorAuth()->throwResponse();
      }

      return resolve(self::$twoFactorTypeMap[$twoFactorType],['user' => $user]);

      
    }

    public function sendTwoFacorAutToken()
    {
          $token = request('token');
          $user = TokenStoreFacade::getUidByToken($token)
          ->getOrSend([ResponderFacade::class, 'tokenNotFound']
        );

         $apiToken = ApiTokenGeneratorFacade::generateToken($user); 
         $user = User::find($user);
         $user->last_login = Carbon::now()->toDateTimeString();
         $user->save();

         ResponderFacade::loggedIn($apiToken)->throwResponse();  
    }
}


