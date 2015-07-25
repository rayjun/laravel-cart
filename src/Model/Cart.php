<?php
namespace Rayjun\LaravelCart\Model;

/**
 * Created by PhpStorm.
 * User: ray
 * Date: 15/7/24
 * Time: 上午10:23
 */

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $table = 'carts';


    /**
     * 创建或者查找一个购物车
     */
    public function cart($user_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();

        if(!$cart)
        {
            return null;
        }
        else
        {
            return $cart;
        }
    }

    /**
     * 将商品添加到购物车当中
     */
    public function add($cart_id, $good_id, $count, $price, $color, $size)
    {

        $total_price = $count * $price;

        $attributes = compact('cart_id', 'good_id', 'count', 'price', 'color', 'size', 'total_price');

        $item = $this->addItem($attributes);

        return $item;

    }


    /**
     * 获取购物车中的所有商品
     */
    public function getAllItems($cart_id)
    {
        $items = CartItem::where('cart_id', $cart_id)->get();

        return $items;
    }


    /**
     * 计算购物车内商品的数量
     */
    public function count($cart_id)
    {
        $count = 0;
        $items = $this->getAllItems($cart_id);

        if(!$items)
        {
            return $count;
        }

        foreach($items as $item)
        {
            $count += $item->count;
        }

        return $count;
    }

    /**
     * 计算购物车的总价格
     */
    public function totalPrice($cart_id)
    {
        $total_price = 0;
        $items =  $this->getAllItems($cart_id);


        if(!$items)
        {
            return $total_price;
        }

        foreach($items as $item)
        {
            $total_price += $item->total_price;
        }

        return $total_price;
    }

    /**
     * 增加购物车商品
     */
    protected function addItem($attributes)
    {
        $cartItem = new CartItem();

        $cartItem->cart_id = $attributes['cart_id'];
        $cartItem->good_id = $attributes['good_id'];
        $cartItem->count = $attributes['count'];
        $cartItem->price = $attributes['price'];
        $cartItem->color = $attributes['color'];
        $cartItem->size = $attributes['size'];
        $cartItem->total_price = $attributes['total_price'];

        $cartItem->save();

        return $cartItem;
    }



}