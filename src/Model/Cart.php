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


    //购物车项的属性
    protected $itemAttributes = array(['cart_id', 'good_id', 'count', 'price', 'color', 'size', 'total_price']);


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
     * @param $cart_id
     * @return mixed
     */
    public function getAllItems($cart_id)
    {
        $items = CartItem::where('cart_id', $cart_id)->get();

        return $items;
    }


    /**
     * 计算购物车内商品的数量
     * @param $cart_id
     * @return int
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
     * @param $cart_id
     * @return int
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
     * 更新商品的数目
     * @param $itemId
     * @param $qty
     * @return mixed
     */
    public function updateQty($itemId, $qty)
    {
        if($qty < 0)
        {
            return $this->removeItem($itemId);
        }

        return $this->updateItem($itemId, ['count' => $qty]);

    }


    public function removeItem($itemId)
    {
        $item = CartItem::findOrFail($itemId);

        $item->delete();
    }

    /**
     * 更新一件商品的属性
     * @param $itemId
     * @param $attributes
     */
    public function updateItem($itemId, $attributes)
    {
        $item = CartItem::findOrFail($itemId);


        foreach($attributes as $key => $value)
        {
            if(array_key_exists($key, $this->itemAttributes))
            {
                $item->$key = $value;
            }

        }

        if( ! is_null(array_keys($attributes, ['count', 'price'])))
        {
            $item->total_price = $item->count * $item->price;
        }

        $item->save();

        return $item;
    }

    /**
     *  清空购物车
     * @param $cart_id
     * @return mixed
     */
    public function removeAllItem($cart_id)
    {
        $cart = Cart::findOrFail($cart_id);

        $items = $this->getAllItems($cart_id);

        foreach($items as $item)
        {
            $item->delete();
        }

        $cart->total_value = 0;
        $cart->total_number = 0;

        $cart->save();

        return $cart;
    }

    /**
     * 增加购物车商品
     * @param $attributes
     * @return CartItem
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