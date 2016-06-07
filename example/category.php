<?php

$array = array(
    array(
        'id' => 1,
        'name' => '男装',
        'subchildrens' => array(
            array(
                'id' => 2,
                'name' => '衬衫',
            ),
            array(
                'id' => 3,
                'name' => 'T恤',
            ),
            array(
                'id' => 4,
                'name' => '牛仔裤',
            ),
        ),
    ),
);

$productCategorys = array(
    array(
        'id' => 4,
        'name' => '小霸王',
        'parent_id' => 1,
    ),
    array(
        'id' => 1,
        'name' => '游戏机',
        'parent_id' => 0,
    ),
    array(
        'id' => 2,
        'name' => '掌机',
        'parent_id' => 1,
    ),
    array(
        'id' => 3,
        'name' => '家庭主机',
        'parent_id' => 1,
    ),
    array(
        'id' => 5,
        'name' => '家用电器',
        'parent_id' => 0,
    ),
    array(
        'id' => 6,
        'name' => '大家电',
        'parent_id' => 5,
    ),
    array(
        'id' => 7,
        'name' => '厨卫大电',
        'parent_id' => 5,
    ),
    array(
        'id' => 8,
        'name' => '厨卫小电',
        'parent_id' => 5,
    ),
);

$productCategoryTrees = array();
foreach($productCategorys as $productCategory) {
    if ($productCategory['parent_id'] == 0) {
        $productCategory['level'] = 1;
        $productCategoryTrees[] = $productCategory;
        foreach($productCategorys as $item) {
            if ($item['parent_id'] == $productCategory['id']) {
                $item['level'] = 2;
                $productCategoryTrees[] = $item;
            }
        }
    }
}
var_dump($productCategoryTrees);

/*

array (
    0 =>
        array (
            'id' => '1',
            'name' => '游戏机',
            'parent_id' => '0',
            'level' => 1,
        ),
    1 =>
        array (
            'id' => '2',
            'name' => '掌机',
            'parent_id' => '1',
            'level' => 2,
        ),
    2 =>
        array (
            'id' => '3',
            'name' => '家庭主机',
            'parent_id' => '1',
            'level' => 2,
        ),
    3 =>
        array (
            'id' => '4',
            'name' => '小霸王',
            'parent_id' => '1',
            'level' => 2,
        ),
    4 =>
        array (
            'id' => '5',
            'name' => '家用电器',
            'parent_id' => '0',
            'level' => 1,
        ),
    5 =>
        array (
            'id' => '6',
            'name' => '大家电',
            'parent_id' => '5',
            'level' => 2,
        ),
    6 =>
        array (
            'id' => '9',
            'name' => '家庭影院',
            'parent_id' => '6',
            'level' => 3,
        ),
    7 =>
        array (
            'id' => '7',
            'name' => '厨卫大电',
            'parent_id' => '5',
            'level' => 2,
        ),
    8 =>
        array (
            'id' => '8',
            'name' => '厨卫小电',
            'parent_id' => '5',
            'level' => 2,
        ),
);
*/


$array = array(
    array(
        'id' => 1,
        'name' => '男装',
        'subchildrens' => array(
            array(
                'id' => 2,
                'name' => '衬衫',
                'subchildrens' => array(
                    array(
                        'id' => 5,
                        'name' => 'A',
                    ),
                    array(
                        'id' => 6,
                        'name' => 'B',
                    ),
                ),
            ),
            array(
                'id' => 3,
                'name' => 'T恤',
                'subchildrens' => array(
                    array(
                        'id' => 5,
                        'name' => 'A',
                    ),
                    array(
                        'id' => 6,
                        'name' => 'B',
                    ),
                ),
            ),
            array(
                'id' => 4,
                'name' => '牛仔裤',
                'subchildrens' => array(
                    array(
                        'id' => 5,
                        'name' => 'A',
                    ),
                    array(
                        'id' => 6,
                        'name' => 'B',
                    ),
                ),
            ),
        ),
    ),
);


foreach($productCategorys as $productCategory) {
    echo $productCategory['name'];
    foreach($productCategory['subchildrens'] as $item) {
        echo $item['name'];
        foreach($item['subchildrens'] as $children) {
            echo $children['name'];
        }
    }
}