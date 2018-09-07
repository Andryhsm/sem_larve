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
