<?php


/*


$array = array(
    array(
        'id' => '1',
        'name' => '北京',
        'parent_id' => 0,
    ),
    array(
        'id' => '2',
        'name' => '海淀区',
        'parent_id' => 1,
    ),
    array(
        'id' => '3',
        'name' => '东城区',
        'parent_id' => 1,
    ),
    array(
        'id' => '4',
        'name' => '西城区',
        'parent_id' => 1,
    ),



    array(
        'id' => '5',
        'name' => '上海',
        'parent_id' => 0,
    ),
    array(
        'id' => '7',
        'name' => '长宁区',
        'parent_id' => 5,
    ),
    array(
        'id' => '6',
        'name' => '徐汇区',
        'parent_id' => 5,
    ),
);

 */

$array = array(
    array(
        'id' => '7',
        'name' => '长宁区',
        'parent_id' => 5,
    ),
    array(
        'id' => '5',
        'name' => '上海',
        'parent_id' => 0,
    ),
    array(
        'id' => '2',
        'name' => '海淀区',
        'parent_id' => 1,
    ),
    array(
        'id' => '3',
        'name' => '东城区',
        'parent_id' => 1,
    ),
    array(
        'id' => '1',
        'name' => '北京',
        'parent_id' => 0,
    ),
    array(
        'id' => '6',
        'name' => '徐汇区',
        'parent_id' => 5,
    ),
    array(
        'id' => '4',
        'name' => '西城区',
        'parent_id' => 1,
    ),
);

function tree($citys, $parentId = 0) {
    static $cityTrees = array();
    foreach($citys as $city) {
        if ($city['parent_id'] == $parentId) {
            $cityTrees[] = $city;
            tree($citys, $city['id']);
        }
    }
    return $cityTrees;
}

print_r(tree($array, 0));







