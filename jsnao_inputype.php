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
        $decode      = json_decode($mix, true);

        if (gettype($decode) == "integer" or $decode == false)
        {
            return self::is_integer($mix);
        }

        return $decode;
    }
    static private function is_integer($mix)
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
    static private function is_default($mix)
    {
        return $mix;
    }
}