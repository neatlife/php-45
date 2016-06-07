<?php

class BackendController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']) {
            $this->redirect('index.php?controller=backend/user&action=login', '禁止访问.', 3, 2);
            exit(0);
        }
    }
}