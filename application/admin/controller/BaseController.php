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
        $admin = Session::get("admin");
        if (!isset($admin)) {
            $this->redirect("Login/login");
        } else {
            $this->project["admin"] = $admin;
        }

    }

}