<?
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
//或
$cart->A002 = array();
$cart->A002->name = 'banana';
//或
$cart->put(2000, array('name' => 'lemon'));

// 修改
$cart->A001->name = 'cherry';

// 刪除
$cart->A003 = array('name' => 'bag');
unset($cart->A003);

echo $cart;