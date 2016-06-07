<?php

class Application
{
    public static function run()
    {
        /**
         * 1. 加载配置, 定义路径常量.
         */
        self::init();

        /**
         * 2. 注册自动加载函数
         */
        self::registerAutoload();

        /**
         * 3. 进行路由分发,调取业务逻辑的处理代码,输出响应内容(字符串)
         */
        self::dispatch();
    }

    private static function init()
    {
        define('ROOT_PATH', dirname(dirname(__DIR__)));

        define('APP_PATH', ROOT_PATH . '/application');
        define('CONFIG_PATH', APP_PATH . '/config');
        define('CONTROLLERS_PATH', APP_PATH . '/controllers');
        define('MODELS_PATH', APP_PATH . '/models');
        define('VIEWS_PATH', APP_PATH . '/views');

        define('FRAMEWORK_PATH', ROOT_PATH . '/framework');
        define('CORE_PATH', FRAMEWORK_PATH . '/core');
        define('DB_PATH', FRAMEWORK_PATH . '/db');
        define('HELPER_PATH', FRAMEWORK_PATH . '/helper');
        define('LIBRARY_PATH', FRAMEWORK_PATH . '/library');

        define('UPLOAD_PATH', ROOT_PATH . '/public/upload/');

        $GLOBALS['database'] = require CONFIG_PATH . '/' . 'database.php';

        require CORE_PATH . '/Controller.php';
        require DB_PATH . '/Mysql.php';
        require CORE_PATH . '/Model.php';

        session_start();
    }

    private static function registerAutoload()
    {
        spl_autoload_register('self::autoload');
    }

    private static function autoload($className)
    {
        // 自动加载模型
        if (substr($className, -5) === "Model") {
            require MODELS_PATH . '/' . $className . '.php';
        } else if (substr($className, -10) === "Controller") { // 加载application/controllers/common目录中的控制器
            require CONTROLLERS_PATH . '/common/' . $className . '.php';
        }
    }

    private static function dispatch()
    {
        // $controllerClassName = ucfirst($_GET['controller']) . 'Controller';
        // index.php?controller=frontend/home&action=index
        // 策略:
        // 1. 将frontend/home按照/分开为数组: explode
        $controllerParts = explode('/', $_GET['controller']);
        // 2. 将最后一部分应用ucfirst函数
        $controllerParts[count($controllerParts) - 1] = ucfirst($controllerParts[count($controllerParts) - 1]) . 'Controller';
        // 3. 用/拼接数组: implode
        // echo implode('/', $controllerParts);die;
        $controllerFileName = CONTROLLERS_PATH . '/' . implode('/', $controllerParts) . '.php';// 控制器的绝对路径
        $controllerClassName = $controllerParts[count($controllerParts) - 1];// 控制器的类名, 获取数组的最后一个元素 end

        require $controllerFileName;
        $controllerInstance = new $controllerClassName();

        $methodName = lcfirst($_GET['action']) . 'Action';
        $controllerInstance->$methodName();
    }
}






