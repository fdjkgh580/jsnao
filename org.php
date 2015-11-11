<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<pre>
相必大家都知道 stdClass 类,
这这可看成是PHP5的一个基类, 提供了类似于数组的调用方法
可以通过显式的方法将一个数组转换成stdClass,然后通过用对像的方式访问
[php] 
$a = new stdClass();
$a->b = 1;
echp $a->b; // output:1
// arr->obj
$arr = array('a','b');
$obj = (object)$arr;
[/php]

为什么不用数组呢? 对于PHP来说用数组不是更方便吗?
1. 我喜欢用对像的调用方式,写起来方便,顺畅
2. 数组是COPY值,对像是能过引用的
3. 可以实现一些特殊的功能,(全局静态变量,这个以后再说)

但是对于多维数组呢? 我们不能就这样的转换,
下面这个类.将会实现这样的方法,
至于可以用在什么地方.大家可以发挥
[php] 
     $data = array('a1'=>array('b1'=>'b1value','b2'=>'b2value','b3'=>'b3value'));
     $data = new map($data);
     // OBJ 取值
     echo $data->a1->b1;   // output: b1value
     // OBJ 赋值
     $data->a1->b2 = 'newb2value';
     echo '<br>'.$data->a1->b2;   //output: newb2value
     // ARRAY 取值
     echo '<br>'.$data['a1']['b3']; //output: b3value
   // FOREACH 循环
     // output: b1=>b1value  b2=>newb2value  b3=>b3value
     foreach($data->a1 as $key=>$val){
      echo '<br>'.$key.'=>'.$val;
     }
[/php]

class map
[php] 
class map extends ArrayObject{

    // 获取 arrayobject 因子
    public function __construct(array $array = array()){
        foreach ($array as &$value){
            is_array($value) && $value = new self($value);
        }
        parent::__construct($array);
    }

    // 取值
    public function __get($index){
        return $this->offsetGet($index);
    }

    // 赋值
    public function __set($index, $value){
     is_array($value) && $value = new self($value);
        $this->offsetSet($index, $value);
    }

    // 是否存在
    public function __isset($index){
        return $this->offsetExists($index);
    }

    // 删除
    public function __unset($index){
        $this->offsetUnset($index);
    }

    // 转换为数组类型
    public function toArray(){
        $array = $this->getArrayCopy();
        foreach ($array as &$value){
            ($value instanceof self) && $value = $value->toArray();
        }
        return $array;
    }
  
    // 打印成字符
    public function __toString(){
        return var_export($this->toArray(), true);
    }
    
    // 根据索引赋值
    public function put($index,$value){
     is_array($value) && $value = new self($value);
        $this->offsetSet($index, $value);
    }
    
    // 根据索引取值
    public function get($index){
     return $this->offsetGet($index);
    }

}
[/php]
<pre>
</body>
</html>