<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 15/7/25
 * Time: 下午2:43
 */

namespace Rayjun\LaravelCart\Facades;


use Illuminate\Support\Facades\Facade;

class CartItem extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'cartItem';
    }
}