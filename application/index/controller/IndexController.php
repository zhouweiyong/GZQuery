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
        //限制只能看最近6个月的工资信息，按时间降序排
        $list = Db::name("gz_data")->where("col0", $email)->order("gtime", "desc")->limit(6)->select();
        $this->assign("realName", $realName);
        $this->assign("userName", $email);
        $this->assign("list", $list);
        return $this->fetch("index");
    }

    //显示全部
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

    //显示有数据的部分
    public function detail2()
    {
        $userName = input("get.userName");
        $gtime = input("get.gtime");
        $num = Db::name("gz_num")->where("gtime", $gtime)->value("num");
        $header = Db::name("gz_header")->where("gtime", $gtime)->find();
        $detail = Db::name("gz_data")->where("col0", $userName)->where("gtime", $gtime)->find();

        //查找空数据的项
        $epty = array();
        while (list($key, $val) = each($detail)) {
            if ($val == null || empty($val)) {
                array_push($epty, $key);
            }
        }

        //删除空数据项
        $len = sizeof($epty);
        for ($i = 0; $i < $len; $i++) {
            $key = array_pop($epty);
            unset($header[$key]);
            unset($detail[$key]);
        }


        $this->assign("gtime", $gtime);
        $this->assign("num", $num);
        $this->assign("header", $header);
        $this->assign("data", $detail);
        return $this->fetch("detail");
    }

    public function show()
    {
        $arr = array();
        array_push($arr, "hell");
        array_push($arr, "hell2");
        $len = sizeof($arr);
        for ($i = 0; $i < $len; $i++) {
            dump($arr[$i]);
        }
        dump($arr);
        return "IIIIIIIIII";
    }
}
