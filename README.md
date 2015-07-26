# laravel-cart
laravel 框架购物车组件

# 安装
可以直接在命令行安装：

    composer require "rayjun/laravel-cart:1.0.*"

或者可以在你项目的 `composer.json` 

    "require": {
         "rayjun/laravel-cart": "1.0.*"
    }

然后执行：

    composer update
    
在完成上面的步骤之后，可以在 `config/app.php` 的 `providers` 数组中增加以下的代码:

    'Rayjun\LaravelCart\LaravelCartServiceProvider'
    
然后增加下面一行到 `aliases`:

    'Cart'   => 'Rayjun\LaravelCart\Facades\Cart',
  
# 使用

## 获取一个购物车

    Cart Cart::cart(int $user_id);

## 增加商品进购物车

    CartItem Cart::add(int $cart_id, int $good_id, int $count, float $price, string color, string size);
    
## 更新一件商品的属性

    CartItem Cart::updateItem(int $item_id, array $attributes);
    CartItem Cart::updateQty(int $item_id, int $qty);
    
## 获取购物车中所有的商品信息

    Collection Cart::getAllItems(int $cart_id);
    
## 获取一个特定的商品项

    CartItem Cart::getItem(int $item_id);
    
## 删除一个特定的商品项

    boolean Cart::removeItem(int $item_id);
    
## 清空购物车

    boolean Cart::removeAllItem(int $cart_id);
   
## 购物车总价

    float Cart::totalPrice(int $cart_id);
    
## 购物车总商品数

    int Cart::count(int $cart_id);
    

