<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 15/7/25
 * Time: 下午2:07P
 */

use Illuminate\Database\Capsule\Manager as Capsule;

use Rayjun\LaravelCart\Facades\Cart as CartFacade;
use Rayjun\LaravelCart\Model\Cart;


class CartTest extends PHPUnit_Framework_TestCase{


    public $capsule;

    protected $cart;

    public function __construct()
    {
        $this->capsule = new Capsule();

        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host'      => 'localhost',
            'database'  => 'esyou',
            'username'  => 'homestead',
            'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();

        $this->cart = new Cart();
    }

    public function testCart()
    {
        $cart = $this->cart->cart(1);
        $this->assertTrue( $cart instanceof Cart);
    }

    public function testAdd()
    {
        $item = $this->cart->add(1, 1, 2, 34.9, '红色', '中号');

        $this->assertTrue($item instanceof \Rayjun\LaravelCart\Model\CartItem);
    }

    public function testUpdateQty()
    {
        $item = $this->cart->updateQty(2,3);

        $this->assertTrue($item->count == 3);
    }

    public function testUpdateItem()
    {
        $item = $this->cart->updateItem(2, ['color' => 'red', 'size' => '12']);

        $this->assertTrue($item->color == 'red');
    }


    public function testRemoveItem()
    {
        $result = $this->cart->removeItem(2);

        $this->assertTrue($result);
    }

    /*public function testRemoveAllItem()
    {
        $result = $this->cart->removeAllItem(1);

        $this->assertTrue($result instanceof Cart);
    }*/


}