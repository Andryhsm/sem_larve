<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use App\Models\AdwordsApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        ini_set('memory_limit','1024M'); //set the limit of memory
        ini_set('max_execution_time', 180);

        Validator::extend(
          'recaptcha',
          'App\\Validators\\Recaptcha@validate'
        );

        $auth_adword = AdwordsApi::where('is_default', 1)->first();
         config(['adwords-targeting-idea-service.developer_token' => $auth_adword->adwords_developper_token]);
         config(['adwords-targeting-idea-service.client_id' => $auth_adword->adwords_client_id]);
         config(['adwords-targeting-idea-service.client_secret' => $auth_adword->adwords_client_secret]);
         config(['adwords-targeting-idea-service.client_refresh_token' => $auth_adword->adwords_client_refresh_token]);
         config(['adwords-targeting-idea-service.client_customer_id' => $auth_adword->adwords_client_customer_id]);
         config(['adwords-targeting-idea-service.user_agent' => $auth_adword->adwords_user_agent]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
