<?php

namespace app\admin\controller;

use think\Controller;

class IndexController extends BaseController
{
    public function index()
    {
        return $this->fetch();
    }


}
