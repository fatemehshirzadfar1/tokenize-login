<?php
namespace TwoFactorAuth\Responses;

use Illuminate\Support\Facades\Facade;

class ResponderFacade extends Facade 
{

     public static function getFacadeAccessor() : string 
        {
            $client = request('client');

            return [
                'react' => \TwoFactorAuth\Responses\ReactResponses\ReactResponses::class,
            ][$client] ?? \TwoFactorAuth\Responses\ReactResponses\ReactResponses::class;

        }
}