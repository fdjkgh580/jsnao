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
$cart['001']['name']; // output: apple

// 賦值
$cart['002']['name'] = 'banana';

// 修改
$cart['001']['name'] = 'cherry';

// 刪除
$cart['003']['name'] = 'bag';
unset($cart['003']);

echo $cart;
