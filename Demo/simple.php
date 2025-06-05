<?php
require_once __DIR__ . '/../jsnao.php';

$cart = [
    'A001' => [
        'name' => 'apple',
    ],
    1000 => [
        'name' => 'water',
    ],
];
$cart = new Jsnao($cart);

// 取值
$cart->A001->name; //output: apple
// 或
$cart->get(1000)->name;

// 賦值
$cart->A002 = ['name' => 'banana'];
//或
$cart->A002 = [];
$cart->A002->name = 'banana';
//或
$cart->put(2000, ['name' => 'lemon']);

// 修改
$cart->A001->name = 'cherry';

// 刪除
$cart->A003 = ['name' => 'bag'];
unset($cart->A003);

echo $cart;
