<?
/*
 *
 * 取材自網友 http://bbs.phpchina.com/thread-123682-1-1.html 
 * 原文參考org.php
 * version 1.1
 */
class Jsnao extends ArrayObject
{

    // 獲取 ArrayObject 因子
    /**
     * aaaa
     * @param mix $mix array | json | string
     */
    public function __construct($mix = null)
    {
        $array = self::typefilter($mix);
        foreach ($array as &$value)
        {
            is_array($value) && $value = new self($value);
        }
        parent::__construct($array);
    }

    // 型別過濾
    public function typefilter($mix)
    {
        $type = gettype($mix);
        if ($type == "string")
        {
            $array = json_decode($mix, true);
            if ($array == false) 
            {
                $array = array('data' => $mix);
            }
        }
        elseif ($type == "array")
        {
            $array = $mix;
        }
        elseif ($type == "object")
        {
            $array = json_decode(json_encode($mix), true);
        }
        else 
        {
            $array = $mix;
        }
        return $array;
    }

    // 取值
    public function __get($index)
    {
        return $this->offsetGet($index);
    }

    // 賦值
    public function __set($index, $value)
    {
        is_array($value) && $value = new self($value);
        $this->offsetSet($index, $value);
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
    
    // 根據索引賦值
    public function put($index,$value)
    {
        is_array($value) && $value = new self($value);
        $this->offsetSet($index, $value);
    }
    
    // 根據索引取值
    public function get($index)
    {
        return $this->offsetGet($index);
    }
}


?>