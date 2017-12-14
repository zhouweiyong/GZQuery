<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;

class IndexController extends BaseController
{
    public function index()
    {
        $email = Session::get("userName");
        $realName = Session::get("realName");
        $list = Db::name("gz_data")->where("col0", $email)->select();
        $this->assign("realName", $realName);
        $this->assign("userName", $email);
        $this->assign("list", $list);
        return $this->fetch("index");
    }

    public function detail()
    {
        $userName = input("get.userName");
        $gtime = input("get.gtime");
        $num = Db::name("gz_num")->where("gtime", $gtime)->value("num");
        $header = Db::name("gz_header")->where("gtime", $gtime)->find();
        $detail = Db::name("gz_data")->where("col0", $userName)->where("gtime", $gtime)->find();
        $this->assign("gtime", $gtime);
        $this->assign("num", $num);
        $this->assign("header", $header);
        $this->assign("data", $detail);

        return $this->fetch();
    }
}
