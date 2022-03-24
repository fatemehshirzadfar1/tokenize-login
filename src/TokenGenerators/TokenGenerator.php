<?php

namespace TwoFactorAuth\TokenGenerators;

use KitchenAuth\Model\User;
use KitchenAuth\Responses\ResponderFacade;

class TokenGenerator {

    public function generateToken()
    {
        return random_int(100000, 1000000 - 1);
    }
}