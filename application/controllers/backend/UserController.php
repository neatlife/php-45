<?php

class UserController extends Controller
{
    public function loginAction()
    {
        $this->loadHelper('Input');
        $_POST = Input::recursiveAddslashes($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_SESSION['captchaCode'] != strtolower($_POST['captcha'])) {
                return $this->redirect('index.php?controller=backend/user&action=login', '验证码错误.', 3, 2);
            }

            $user = array();
            $user['username'] = $_POST['username'];
            $user['password'] = $_POST['password'];

            // 过滤和验证
            if (!$user['username'] || !$user['password']) {
                return $this->redirect('index.php?controller=backend/user&action=login', '用户名或密码不能为空.', 3, 2);
            }
            $user['password'] = $user['password'];

            // 通过数据库验证用户名和密码是否匹配
            $userModel = new UserModel('user');
            $where = "username='{$user['username']}' AND password='{$user['password']}'";
            if ($userModel->total($where)) {
                $_SESSION['user'] = $user;
                return $this->redirect('index.php?controller=backend/index&action=index', '登录成功.', 3, 2);
            } else {
                return $this->redirect('index.php?controller=backend/user&action=login', '用户名或密码错误.', 3, 2);
            }
        } else {
            return $this->render('backend/user/login');
        }
    }

    public function logoutAction()
    {
        // Todo: 销毁登录session, 返回登陆页面
        unset($_SESSION['user']);
        session_destroy();

        return $this->redirect('index.php?controller=backend/user&action=login', '退出成功.', 3, 2);
    }

    public function captchaAction()
    {
        // Todo: 输出一个验证码图片, 将验证码里的字符串保存session
        $this->loadLibrary('Captcha');
        $captcha = new Captcha();
        $captcha->generateCode();
        $_SESSION['captchaCode'] = $captcha->getCode();
    }
}














