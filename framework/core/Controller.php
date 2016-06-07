<?php

class Controller
{
    /**
     * 1. 跳转，每个控制器都可能使用这个功能
     * @param $url 跳转的url
     * @param string $message 跳转时显示的提示信息, 如果type==1忽略该参数
     * @param int $waitSecond 跳转时等待的时间, 如果type==1忽略该参数
     * @param int $type 跳转的类型 1: 使用http头信息跳转, 2: 使用html的refresh标签跳转
     */
    protected function redirect($url, $message = '', $waitSecond = 3, $type = 1)
    {
        if ($type == 1) {
            header('location: ' . $url);
        } else if ($type == 2) {
            return $this->render('message', array(
                'url' => $url,
                'message' => $message,
                'waitSecond' => $waitSecond,
            ));
        }
    }

    /**
     * 2. 加载视图，每个控制器都可能使用这个功能
     * @param $templateId 模板id 例如 backend/index, backend/create, backend/update....
     * @param $templateData 模板变量 array('productName' => '小米', 'productCategoryName' => '手机')
     */
    protected function render($templateId, $templateData = array())
    {
        extract($templateData);
        include VIEWS_PATH . '/' . $templateId . '.php';
    }

    /**
     * 3. 加载第三方代码
     *
     * @param $libraryId 第三方代码库id
     */
    protected function loadLibrary($libraryId)
    {
        include LIBRARY_PATH . '/' . $libraryId . '.php';
    }

    /**
     * 4. 加载助手类
     * @param $helperId 助手类id
     */
    protected function loadHelper($helperId)
    {
        include HELPER_PATH . '/' . $helperId . '.php';
    }
}