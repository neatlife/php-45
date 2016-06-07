<?php

$array = array(
    'url' => 'http://www.baidu.com',
    'message' => '用户名或密码错误.',
    'waitSecond' => 3,
);

echo $url . '<br />';
echo $message . '<br />';
echo $waitSecond . '<br />';

extract($array);


echo $url . '<br />';
echo $message . '<br />';
echo $waitSecond . '<br />';
