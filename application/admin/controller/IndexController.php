<?php
namespace app\admin\controller;

use app\index\controller\BaseController;
use think\Controller;

class IndexController extends BaseController
{
    public function index(){
        return $this->fetch();
    }

}
