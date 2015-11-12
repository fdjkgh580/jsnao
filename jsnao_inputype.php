<?
/**
 * 輸入的格式過濾，最後都會回傳陣列
 */
class Jsnao_inputype
{
    //唯一對外的呼叫方法。依照輸入的型態對應適合的方法
    static public function filter($mix)
    {
        $method = "is_" . gettype($mix);
        return self::$method($mix);
    }
    static private function is_string($mix)
    {
        $decode = json_decode($mix, true);
        if (gettype($decode) == "array") return $decode;
        return self::wrap_element($mix);
    }
    static private function wrap_element($mix)
    {
        return array('data' => $mix);
    }
    static private function is_array($mix)
    {
        return $array = $mix;
    }
    static private function is_object($mix)
    {
        return json_decode(json_encode($mix), true);
    }
    static private function is_NULL($mix)
    {
        return array();
    }
    static public function __callStatic($name, $arguments)
    {
        return self::wrap_element($arguments[0]);
    }
}