<?php

namespace Rayjun\LaravelCart;

use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: ray
 * Date: 15/7/25
 * Time: 上午10:45
 */

class LaravelCartServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAssets();
    }


    public function registerAssets()
    {
        $this->publishes([
            __DIR__.'/../migrations/' => database_path('/migrations')
        ], 'migrations');
    }

}