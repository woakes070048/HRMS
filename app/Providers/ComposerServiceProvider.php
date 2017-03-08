<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // View()->composer('*', function($view) {
            
        //     if(Auth::guard('hrms')->check()){
        //         $view->with('auth', Auth()->guard('hrms')->user());
        //     }

        //     if(Auth::guard('setup')->check()){
        //         $view->with('auth', Auth()->guard('setup')->user());
        //     }
        // });

        View()->composer('layouts.hrms_navbar',function($view){
            \Artisan::call("db:connect");
            $config = \DB::table('configs')->where('id',Session('config_id'))->first();
            $view->with('settings',$config);
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
