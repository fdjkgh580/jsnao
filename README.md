# jsnao
簡易的讓陣列(或其他格式)，可以使用更好懂的物件風格來呼叫。例如
````php
$data = array('say' => 'hello');
````
我們可以直接這麼使用
````php
echo $data->say; // 輸出 hello
````

其他說明可以看：<a href="http://jsnwork.kiiuo.com/archives/137/php-jsnao-%E7%B9%BC%E6%89%BF-arrayobject-%E6%9B%B4%E6%96%B9%E4%BE%BF%E7%9A%84%E9%99%A3%E5%88%97%E8%BD%89%E7%89%A9%E4%BB%B6%E5%AF%AB%E6%B3%95" target="_blank">我的部落格</a>

## 支持多種格式輸入的範例
### 陣列 Array
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
### 物件 Object
````php
$mix = new stdClass;
$mix->my = "Jsnao";
$result = new Jsnao($mix);
$result['my']; // 輸出: Jsnao
````
### 字串 String
````php
$mix = 'Hello World';
$result = new Jsnao($mix);
$result->data; // 輸出: Hello World
````
### 整數或小數 Integer or Double
````php
$mix = 123456;
$result = new Jsnao($mix);
$result->data; // 輸出: 123456
````
### 空值 Null
````php
$mix = null;
$result = new Jsnao($mix);
````


## 一般用法
````php
include_once("../jsnao.php");

$cart = array
(
    'A001'   =>  array
    (
        'name'  =>  'apple',
    ),
    1000 => array
    (
        'name'  => 'water'
    )
);
$cart = new jsnao($cart);

// 取值
$cart->A001->name; //output: apple
// 或
$cart->get(1000)->name;

// 賦值
$cart->A002 = array('name' => 'banana');
// 或
$cart->A002 = array();
$cart->A002->name = 'banana';
// 或
$cart->put(2000, array('name' => 'lemon'));

// 修改
$cart->A001->name = 'cherry';
// 或
$cart->A001->put('name', 'cherry');

// 刪除
$cart->A003 = array('name' => 'bag');
unset($cart->A003);

echo $cart;
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

# 方法
## Jsnao::get($index)
### 取值
````php
$result = new jsnao($array);
$result->get(0);
// 或
$result[0];
````

## Jsnao::put($index, $value)
### 賦值
````php
$result = new jsnao($array);
$result->put(1, "banana");
// 或
$result->put[1] = "banana";
// 或
$result->first = "banana";
````

## Jsnao::toArray()
### 取得陣列型態
````php
$result = new jsnao($array);
$result->toArray();
````

## Jsnao::log($title = NULL)
### 透過到 JavaScript 輸出到 console.log()
````php
$result = new jsnao($array);
$result->log();
// 或
$result->log("自訂顯示名稱");
// 或
$data = $result->log();
````
也可以放在想要檢視的定位點，例如
````php
$data = array
(
    'profile' => array
    (
        'phone' => "0939-333-333",
        'tel' => "07-333-3333"
    ), 
);
$data = new jsnao($data);
echo $data->log()->profile->phone; 
// 輸出 0939-333-333
// console.log() 為 Object {profile: Object {phone: "0939-333-333", tel: "07-333-3333"}}

// 或是放在另外一個定位點

echo $data->profile->log()->phone; 
// 輸出 0939-333-333
// console.log() 為 Object {phone: "0939-333-333", tel: "07-333-3333"}
````

## var_export()
### 輸出檢視錯誤時使用
````php
$result = new jsnao($array);
echo $result;
````
