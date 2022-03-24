<?php

namespace TwoFactorAuth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use TwoFactorAuth\Facades\ApiTokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Facades\TwoFactorFacade;
use TwoFactorAuth\TokenGenerators\TokenGenerator;


class TwoFactorAuthServiceProvider extends ServiceProvider{

    public function register()
    {

        $this->mergeConfigFrom(
            __DIR__.'/config/two_factor_auth_config.php','two_factor_auth_config');


        TokenGeneratorFacade::shouldProxyTo(TokenGenerator::class);
        TwoFactorFacade::shouldProxyTo(TwoFactorAuthController::class);
        TokenStoreFacade::shouldProxyTo(TokenStore::class);
        ApiTokenGeneratorFacade::shouldProxyTo(ApiTokenGenerator::class);
    }

    public function boot()
    {
        $this->mapRoutes();
    }


    public function mapRoutes(){

        Route::group([
            'middleware' => ['api'],
            'prefix'     => 'api/v1',
        ], function ($router) {
            require base_path('two_factor_auth/routes/api_v1.php');
        });
    }
}