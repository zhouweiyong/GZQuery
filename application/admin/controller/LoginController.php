<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/8
 * Time: 16:04
 */

namespace app\admin\controller;


use app\admin\model\Admin;
use think\Controller;
use think\Session;

class LoginController extends Controller
{
    function login()
    {
        $tip = input("param.tip");
        if (isset($tip) && !empty($tip)) {
            $this->assign("tip", $tip);
        }
//        dump(Session::get("admin"));
        return $this->fetch();
    }

    function doLogin()
    {
        $adminName = input("post.name");
        $pwd = input("post.password");
        $admin = Admin::get(["admin_name" => $adminName]);
        if (isset($admin) && $admin->admin_pwd == $pwd) {
            Session::set("admin", $adminName);
            $this->redirect("Index/index");
        } else {
            $this->redirect("Login/login", ["tip" => urlencode("用户名或者密码错误！")]);
        }

    }


    function logout()
    {
        Session::delete("admin");
        $this->redirect("Index/index");
    }
}