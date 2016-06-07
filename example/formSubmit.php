<form action="formSubmit.php" method="post">
    <fieldset>
        <legend>1</legend>
        <div>
            <label>
                名称:
                <input type="text" name="name[][][][]">
            </label>
        </div>

        <div>
            <label>
                年龄:
                <input type="text" name="age[]">
            </label>
        </div>
    </fieldset>
    <fieldset>
        <legend>2</legend>
        <div>
            <label>
                名称:
                <input type="text" name="name[]">
            </label>
        </div>

        <div>
            <label>
                年龄:
                <input type="text" name="age[]">
            </label>
        </div>
    </fieldset>

    <div><input type="submit" value="提交"></div>
</form>

<?php
echo var_export($_POST);
/**
 * 对一个不确定维数的数组进行批量转义: addslashes('string')
 */

/**
 * 一维的数组转义
 */
/*foreach($array as $key => $value) {
    if (is_string($value)) {
        $array[$key] = addslashes($value);
    } else if (is_array($value)) {
        foreach($value as $index => $v) {
            $value[$index] = addslashes($v);
        }
    }
}*/

$array = array (
    'name' =>
        array (
            0 =>
                array (
                    0 =>
                        array (
                            0 =>
                                array (
                                    0 => "张三'",
                                ),
                        ),
                ),
            1 => "'李四",
        ),
    'age' =>
        array (
            0 => '20',
            1 => '21',
        ),
);


function recursiveAddslashes($array) {
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

print_r(recursiveAddslashes($array));



