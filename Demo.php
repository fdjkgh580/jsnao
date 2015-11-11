<?
include_once("jsnao.php");

$data = array(
			'a1'=>array(
					'b1'=>'b1value',
					'b2'=>'b2value',
					'b3'=>'b3value'
					)
			);

$data = new Jsnao($data);

// OBJ 取值
echo $data->a1->b1;   // output: b1value

// OBJ 賦值
$data->a1->b2 = 'newb2value';
echo '<br>'.$data->a1->b2;   //output: newb2value

// ARRAY 取值
echo '<br>'.$data['a1']['b3']; //output: b3value

// FOREACH 循環
// output: b1=>b1value  b2=>newb2value  b3=>b3value
foreach($data->a1 as $key=>$val){
	echo '<br>'.$key.'=>'.$val;
	}

?>