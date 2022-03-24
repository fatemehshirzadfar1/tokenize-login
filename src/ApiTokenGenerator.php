<?php

namespace TwoFactorAuth;


use KitchenAuth\Model\User;

class ApiTokenGenerator {

    public function generateToken($userId)
    {
        $user = User::find($userId);
        return $user->createToken('kitchen_token')->accessToken;  
    }
}