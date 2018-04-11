<?php

namespace laraveldes3;

use Illuminate\Support\ServiceProvider;

class Des3Provider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 在容器中注册
        $this->app->singleton('des3', function (){
            $key = env('DES3_KEY', null);
            $iv = env('DES3_IV', null);
            return new Des3($key, $iv);
        });
    }
}
