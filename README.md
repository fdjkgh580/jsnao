# jsnao

簡易的讓你的物件、陣列，能同時使用物件、陣列、ArrayObject的寫法呼叫。


2015/11/11 改寫了兩年前的一支主力程式 Jsnao。主要是繼承 php 內部的 ArrayObject 。改寫了功能，可以輸入 string、json、stdClass、Array 的格式或形態，然後自動轉換為 ArrayObject 原生格式。透過 Jsnao 的操作，無論新增、修改、刪除，都可以依照不同場合需求，同時被 Object、Array、ArrayObject 三種呼叫方式混合呼叫使用。

## 輸入範例
### Array
````php
$mix = array('my'=>"Jsnao");
$result = new Jsnao($mix);
$result->my; // 輸出: Jsnao
````
### JSON
````php
$mix = '{"my":"Jsnao"}';
$result = new Jsnao($mix);
$result->my; // 輸出: Jsnao
````
### String
````php
$mix = 'Hello World';
$result = new Jsnao($mix);
$result->data; // 輸出: Hello World
````
### stdClass
````php
$mix = new stdClass;
$mix->my = "Jsnao";
$result = new Jsnao($mix);
$result['my']; // 輸出: Jsnao
````


## 一般用法
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

## 陣列用法
````php
<?
include_once("../jsnao.php");

// 購物車
$cart = array
(
    '001'   =>  array
    (
        'name'  =>  'apple',
    )
);

$cart = new Jsnao($cart);

// 取值
$cart['001']['name']; // output: apple

// 賦值
$cart['002']['name'] = "banana"; 

// 修改
$cart['001']['name'] = "cherry"; 

// 刪除
$cart['003']['name'] = "bag";
unset($cart['003']);

echo $cart;
````

## 繼承 ArrayObject 原生用法
````php
<?
include_once("../jsnao.php");

// 購物車
$cart = array
(
    '001'   =>  array
    (
        'name'  =>  'apple',
    )
);

$cart = new Jsnao($cart);


// 取值
$cart->offsetGet('001')->name; //output: apple

// 賦值
$cart->offsetSet('002', array('name' => 'banana')); //output: apple

// 修改
$cart->offsetGet('001')->offsetSet('name', 'cherry');

// 刪除
$cart->offsetSet('003', array('name' => 'bag')); 
$cart->offsetUnset('003'); 

echo $cart;
````
