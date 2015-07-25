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
        $mFrom = __DIR__ . '/../migrations/';
        $mTo = $this->app['path.database'] . '/migrations/';

        $this->publishes([
            /*$mFrom . '2015_07_25_101858_create_carts_table.php' => $mTo . '2015_07_25_101858_create_carts_table.php',
            $mFrom . '2015_07_25_102038_create_cart_items_table.php' => $mTo . '2015_07_25_102038_create_cart_items_table.php',
            */
            __DIR__.'/../database/migrations/' => database_path('/migrations')
        ], 'migrations');
    }

}