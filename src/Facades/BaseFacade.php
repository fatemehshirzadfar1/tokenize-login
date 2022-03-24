<?php

namespace TwoFactorAuth\Facades;

use Illuminate\Support\Facades\Facade;

abstract class BaseFacade extends Facade{

    public static function getFacadeAccessor(){
        return static::key;
    }

    static function shouldProxyTo($class)
    {
        app()->singleton(self::getFacadeAccessor(), $class);
    }

}