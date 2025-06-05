<?php
declare(strict_types=1);

/**
 * 輸入的格式過濾，最後都會回傳陣列
 */
class Jsnao_inputype
{
    //唯一對外的呼叫方法。依照輸入的型態對應適合的方法
    public static function filter(mixed $mix): array
    {
        $method = 'is_' . gettype($mix);

        if (self::is_method($method)) {
            return self::$method($mix);
        }
        return self::is_string($mix);
    }

    //是否存在這個方法？
    private static function is_method(string $method): bool
    {
        return method_exists(__CLASS__, $method);
    }

    private static function is_boolean($mix): array
    {
        return [];
    }

    private static function is_string(string $mix): array
    {
        $decode = json_decode($mix, true);
        if (is_array($decode)) {
            return $decode;
        }
        return self::wrap_element($mix);
    }

    private static function is_array(array $mix): array
    {
        return $mix;
    }

    private static function is_object(object $mix): array
    {
        return json_decode(json_encode($mix, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
    }

    private static function is_NULL($mix): array
    {
        return [];
    }

    private static function wrap_element(mixed $mix): array
    {
        return ['data' => $mix];
    }

    public static function __callStatic(string $name, array $arguments): array
    {
        return self::wrap_element($arguments[0] ?? null);
    }
}

