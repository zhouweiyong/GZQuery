<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/8
 * Time: 16:04
 */

namespace app\admin\controller;


use think\Controller;

class LoginController extends Controller
{
    function login()
    {
        return $this->fetch();
    }

    function doLogin()
    {
        $userName = input("post.name");
        $pwd = input("post.password");
        return $userName;
    }


    function logout()
    {

    }
}