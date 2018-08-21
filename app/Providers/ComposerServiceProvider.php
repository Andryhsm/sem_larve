<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;
use Cart;
use App\Category;
use App\Models\WishList;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    { 
        $yes_no_local = "oui";
        View::share('layout','admin.layout.master');
        View::share('local_dev',$yes_no_local);
        View::composer('*', function ($view) {
            $view->with('user', auth()->guard('admin')->user())
				->with('is_user_login',Auth::check());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
