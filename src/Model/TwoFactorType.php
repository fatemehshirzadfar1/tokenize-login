<?php

namespace TwoFactorAuth\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class TwoFactorType extends Model
{
    use Notifiable , HasApiTokens;

    const off   = 0;
    const sms   = 1;
    const email = 2;
}




