<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/8
 * Time: 13:37
 */

namespace app\admin\controller;


use think\Controller;
use think\Session;

class BaseController extends Controller
{
    protected $project;

    protected function _initialize()
    {
        $userName = Session::get("admin");
        dump($userName);
        if (!isset($userName)) {
            $this->redirect("Login/login");
        } else {
            $this->project["userName"] = $userName;
        }

    }

}