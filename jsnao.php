<?php
declare(strict_types=1);

/**
 * 取材自網友 http://bbs.phpchina.com/thread-123682-1-1.html
 */
require_once __DIR__ . '/jsnao_inputype.php';

class Jsnao extends ArrayObject
{
    protected string $version = '1.1.4';

    /**
     * 獲取 ArrayObject 因子
     * @param mixed $mix  可輸入的型態或資料格式 string | integer | array | object | json | NULL
     */
    public function __construct(mixed $mix = null)
    {
        $array = Jsnao_inputype::filter($mix);
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = new self($value);
            }
        }
        parent::__construct($array);
    }

    public function version(): string
    {
        return $this->version;
    }

    // 取值
    public function __get(string $index): mixed
    {
        return $this->get($index);
    }

    // 賦值
    public function __set(string $index, mixed $value): void
    {
        $this->put($index, $value);
    }

    // 是否存在
    public function __isset(string $index): bool
    {
        return $this->offsetExists($index);
    }

    // 刪除
    public function __unset(string $index): void
    {
        $this->offsetUnset($index);
    }

    // 轉換為陣列類型
    public function toArray(): array
    {
        $array = $this->getArrayCopy();
        foreach ($array as &$value) {
            if ($value instanceof self) {
                $value = $value->toArray();
            }
        }
        return $array;
    }

    // 輸出成字串
    public function __toString(): string
    {
        return var_export($this->toArray(), true);
    }

    // 輸出到 JavaScript console.log，回傳 $this 可供串接
    public function log(?string $title = null): self
    {
        if ($title !== null) {
            $this->consoleLog("'§ -------- {$title} -------- §'", false);
        }
        $this->consoleLog('', true);
        if ($title !== null) {
            $this->consoleLog("'                              '", false);
        }
        return $this;
    }

    private function consoleLog(string $string, bool $encode = false): void
    {
        if ($encode) {
            $string = json_encode($this->toArray(), JSON_THROW_ON_ERROR);
        }
        echo "<script>console.log({$string})</script>";
    }

    // 根據索引賦值
    public function put(mixed $index, mixed $value): void
    {
        if (is_array($value)) {
            $value = new self($value);
        }
        $this->offsetSet($index, $value);
    }

    // 根據索引取值
    public function get(mixed $index): mixed
    {
        return $this->offsetGet($index);
    }
}

