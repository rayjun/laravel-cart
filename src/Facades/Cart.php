<?php

namespace Rayjun\LaravelCart\Facades;
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 15/7/25
 * Time: 下午2:35
 */

use Illuminate\Support\Facades\Facade;

class Cart extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}