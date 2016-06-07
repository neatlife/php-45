<?php

class IndexController extends BackendController
{
    public function indexAction()
    {
        return $this->render('backend/index/index');
    }

    public function topAction()
    {
        return $this->render('backend/index/top');
    }

    public function menuAction()
    {
        return $this->render('backend/index/menu');
    }

    public function mainAction()
    {
        return $this->render('backend/index/main');
    }

    public function dragAction()
    {
        return $this->render('backend/index/drag');
    }
}

