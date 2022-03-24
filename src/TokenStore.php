<?php

namespace TwoFactorAuth;


class TokenStore {

    public function saveToken($token , $userId)
    {
         $ttl = config('two_factor_auth_config.token_ttl');
         cache()->set($token.'_two_factor_auth',$userId, now()->addSeconds($ttl));
    }


    function getUidByToken($token)
    {
        $userId = cache()->pull($token.'_two_factor_auth');
        return nullable($userId);
    }
}