# jsnao
輕易地將陣列，改用物件呼叫。

````php
<?
include_once("../jsnao.php");

// 如果鍵不是以數字為開頭，就使用這種普通方法。
$cart = array
(
    'A001'   =>  array
    (
        'name'  =>  'apple',
    )
);
$cart = new jsnao($cart);

// 取值
$cart->A001->name; //output: apple

// 賦值
$cart->A002 = array('name' => 'banana');
//或
$cart->A002 = array();
$cart->A002->name = 'banana';

// 修改
$cart->A001->name = 'cherry';

// 刪除
$cart->A003 = array('name' => 'bag');
unset($cart->A003);

echo $cart;
?>
````

其他的用法可以參考：https://github.com/fdjkgh580/jsnao/tree/master/Demo
