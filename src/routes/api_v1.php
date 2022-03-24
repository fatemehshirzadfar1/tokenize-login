<?php

use Illuminate\Support\Facades\Route;


 $namespace = 'TwoFactorAuth\\';


Route::post('/two-factor-auth-token', $namespace.'TwoFactorAuthController@sendTwoFacorAutToken')->name('two_factor_auth_token');

