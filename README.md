# jsnao
easy use ArrayObject! 可以輕易地將陣列，改用物件呼叫。

<pre>
<?
include_once("jsnao.php");

$data = array
(
    'item_1' => array
    (
        'a' => 'value_a',
        'b' => 'value_b',
    ),
    'item_2' => array 
    (
        'red',
        'sec' => 'green'
    )
);

$data = new Jsnao($data);

// OBJ 取值
echo $data->item_1->a;   // output: value_a

// 鍵為數字時，須改用陣列方式取值
echo "<br>" . $data->item_2[0]; //output: red

// OBJ 賦值
$data->item_1->c = 'value_c';

echo '<br>'.$data->item_1->c;   //output: value_c

// ARRAY 取值
echo '<br>'.$data['item_1']['b']; //output: value_b

// FOREACH item_1
foreach($data->item_1 as $key => $val)
{
    echo "<br> {$key} => {$val} ";
}

?>
</pre>