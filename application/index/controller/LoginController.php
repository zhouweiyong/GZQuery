<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/8
 * Time: 13:41
 */

namespace app\index\controller;


use app\index\model\User;
use think\Controller;
use think\Db;
use think\Session;

class LoginController extends Controller
{
    //wenbing.wei@vstecs.com    oYov4Gk5
    function login()
    {
        $tip = input("param.tip");
        if (isset($tip) && !empty($tip)) {
            $this->assign("tip", $tip);
        }
        return $this->fetch();
    }

    function doLogin()
    {
        $userName = input("post.name");
        $pwd = input("post.password");
        $user = User::get(["userName" => $userName]);
        if (isset($user) && $user["passWord"] == $pwd) {
            Session::set("userName", $user["userName"]);
            Session::set("realName", $user["realName"]);

            Db::name("gz_time")->insert(array("userName" => $userName, "realName" => $user["realName"], "loginTime" => time()), true);

            $now = date("Ym");
            $d = Db::name("gz_lnum")->where("gtime", $now)->find();
            if ($d != null) {
                Db::name("gz_lnum")->where("gtime", $now)->update(["lnum" => $d["lnum"] + 1,"lastTime"=>time()]);
            } else {
                Db::name("gz_lnum")->insert(["gtime" => $now, "lnum" => 1,"lastTime"=>time()]);
            }

            $this->redirect("Index/index");
        } else {
            $this->redirect("Login/login", ["tip" => urlencode("用户名或者密码错误！")]);
        }
    }


    function logout()
    {
        Session::delete("userName");
        Session::delete("realName");
        $this->redirect("Index/index");
    }
}