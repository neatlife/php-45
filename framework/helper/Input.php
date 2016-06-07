<?php

class Input
{
    public static function recursiveAddslashes($array) {
        foreach($array as $index => $value) {
            if (is_string($value)) {
                $array[$index] = addslashes($value);
            } else if (is_array($value)) {
                $array[$index] = recursiveAddslashes($value);
            } else {// 其它类型的数据原样返回

            }
        }
        return $array;
    }
}