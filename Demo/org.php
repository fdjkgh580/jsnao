<?php
require_once __DIR__ . '/../jsnao.php';

// 購物車
$cart = [
    '001' => [
        'name' => 'apple',
    ],
];

$cart = new Jsnao($cart);

// 取值
$cart->offsetGet('001')->name; //output: apple

// 賦值
$cart->offsetSet('002', ['name' => 'banana']);

// 修改
$cart->offsetGet('001')->offsetSet('name', 'cherry');

// 刪除
$cart->offsetSet('003', ['name' => 'bag']);
$cart->offsetUnset('003');

echo $cart;
