<?
/*
 * 取材自網友 http://bbs.phpchina.com/thread-123682-1-1.html 
 */
include_once 'jsnao_inputype.php';

class Jsnao extends ArrayObject
{
    protected $version = "1.1.3";

    /**
     * 獲取 ArrayObject 因子
     * @param mix $mix  可輸入的型態或資料格式 string | integer | array | object | json | NULL 
     */
    public function __construct($mix = null)
    {
        $array = Jsnao_inputype::filter($mix);
        foreach ($array as &$value)
        {
            is_array($value) && $value = new self($value);
        }
        parent::__construct($array);
    }

    public function version ()
    {
        return $this->version;
    }
    
    // 取值
    public function __get($index)
    {
        return $this->get($index);
    }

    // 賦值
    public function __set($index, $value)
    {
        $this->put($index, $value);
    }

    // 是否存在
    public function __isset($index)
    {
        return $this->offsetExists($index);
    }

    // 刪除
    public function __unset($index)
    {
        $this->offsetUnset($index);
    }

    // 轉換為陣列類型
    public function toArray()
    {
        $array = $this->getArrayCopy();
        foreach ($array as &$value)
        {
            ($value instanceof self) && $value = $value->toArray();
        }
        return $array;
    }
  
    // 輸出成字串
    public function __toString()
    {
        return var_export($this->toArray(), true);
    }

    // 輸出到 JavaScript console.log，回傳 $this 可供串接
    public function log($title = NULL)
    {
        $string = $this->__toString();
        if ($title !== NULL)
        {
            $this->console_log("'§ -------- {$title} -------- §'", false);
        }
        $this->console_log($string, true);
        if ($title !== NULL)
        {
            $this->console_log("'                              '", false);
        }
        return $this;
    }

    private function console_log($string, $isencode = false)
    {
        if ($isencode == true)
        {
            $string = json_encode($this->toArray());
        }
        echo "<script>console.log({$string})</script>";
    }
    
    // 根據索引賦值
    public function put($index, $value)
    {
        is_array($value) && $value = new self($value);
        return $this->offsetSet($index, $value);
    }
    
    // 根據索引取值
    public function get($index)
    {
        return $this->offsetGet($index);
    }
}


?>