<?php
/**
 * Arr.php
 * @author liuchg
 */

namespace app\algo\arr;


class Arr
{
    // 数据
    public $data;

    // 长度
    public $length;

    // 容量
    public $capacity;

    /**
     * Arr constructor.
     * @param $capacity
     */
    public function __construct($capacity)
    {
        $capacity = intval($capacity);
        if ($capacity<0) {
            return null;
        }
        $this->data = [];
        $this->length = 0;
        $this->capacity = $capacity;
    }

    /**
     * 在索引index位置插入值value，返回错误码，0为插入成功
     * @param $index
     * @param $data
     * @return int
     */
    public function insert($index, $data) {
        $index = intval($index);
        $value = intval($data);

        if ($index<0 ) {
            return 1;
        }
        if ($this->checkIfFull() || $this->checkOutCap($index)) {
            return 2;
        }
        // 索引位置未设置值填充null
        if ($index > $this->length-1) {
            for ($i=0; $i<=$index; $i++) {
                if (!isset($this->data[$i])) {
                    $this->data[$i] = null;
                }
            }
        } else {
            for ($i=$this->length-1; $i>=$index && $i>=0; $i--) {
                $d = isset($this->data[$i])?$this->data[$i]:false;
                $this->data[$i+1] = $d;
            }
        }

        $this->data[$index] = $value;


        $this->length = count($this->data);

        return 0;
    }
    public function checkOutCap($index) {
        if ($index>=$this->capacity) {
            return true;
        }

        return false;
    }
    /**
     * 删除索引上的值并返回
     * @param $index
     * @return array
     */
    public function delete($index) {
        $value = 0;
        $index = intval($index);
        if ($index<0) {
            $code = 1;
            return [$code, $value];
        }

        if ($this->checkOutRange($index)) {
            $code = 2;
            return [$code, $value];
        }
        $value = $this->data[$index];
        for ($i=$index; $i<=$this->length-1; $i++) {
            $num = $this->data[$i+1]??null;
            $this->data[$i] = $num;
        }
        unset($this->data[$i-1]);
        $this->length--;

        return [0, $value];
    }

    /**
     *  查找索引index的值
     * @param $index
     * @return array
     */
    public function find($index) {
        $index = intval($index);
        $value = 0;
        if ($index<0) {
            $code = 1;
            return [$code, $value];
        }
        if ($this->checkOutRange($index)) {
            $code = 2;
            return [$code, $value];
        }
        return [$index, $this->data[$index]];
    }

    /**
     * 打印
     */
    public function printData() {
        $format = '';
        for ($i=0; $i<$this->length-1; $i++) {
            $format .= '|'.$this->data[$i];
        }
        print($format.'\n');
    }
    /**
     * 数值是否满
     * @return bool
     */
    public function checkIfFull() {
        if ($this->length == $this->capacity) {
            return true;
        }
        return false;
    }

    /**
     * 检查索引是否超出数值范围
     * @param $index
     * @return bool
     */
    private function checkOutRange($index) {
        if ($index >= $this->length) {
            return true;
        }
        return false;
    }
}
