<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/11
 * Time: 11:21
 */

namespace app\admin\controller;

use extra\UserUtils;
use PHPExcel;
use PHPExcel_IOFactory;
use think\Db;

class UserController extends BaseController
{
    //添加用户
    public function add()
    {


        return $this->fetch();
    }

    //导入用户
    public function daAddAll()
    {
        $file = request()->file("user");
        $info = $file->getInfo();
        $pe = new PHPExcel();
        $reader = PHPExcel_IOFactory::createReader("Excel2007");
        $excel = $reader->load($info["tmp_name"]);
        $sheet = $excel->getSheet(0);
        $arr = $sheet->toArray();

        $len = sizeof($arr);
        $user = array();
        for ($i = 0; $i < $len; $i++) {
            if ($arr[$i][0] != null && !empty($arr[$i][0])) {
                $tmp = array();
                $tmp["userName"] = trim($arr[$i][0]);
                $tmp["realName"] = $arr[$i][1];
                $tmp["passWord"] = UserUtils::createPassword(8);
                array_push($user, $tmp);
            }
        }
        $insertAll = Db::name("gz_user")->insertAll($user, true);
        if ($insertAll) {
            $this->success("员工信息导入成功");
        } else {
            $this->error("员工信息导入失败");
        }
    }

//单个添加
    public function doAdd()
    {
        $realName = input("post.realName");
        $email = input("post.email");


        $user = Db::name("gz_user")->where("userName", $email)->find();
        if ($user != null) {
            return $this->error("该员工已经存在，不能多次注册");
        }

        $pwd = UserUtils::createPassword(8);
        $insert = Db::name("gz_user")->insert(array("userName" => $email, "realName" => $realName, "passWord" => $pwd), true);
        if ($insert) {
            $this->success("员工信息注册成功");
        } else {
            $this->error("员工信息注册失败");
        }
    }


//查看用户
    public
    function show()
    {
        $realName = input("post.realName");

        if ($realName == "" && $realName == null) {
            $list = Db::table("gz_user")->order("userName", "asc")->select();
        } else {
            $list = Db::table("gz_user")->whereLike("realName", "%".$realName."%")->select();
        }

        $this->assign("list", $list);
        return $this->fetch();
    }

//查看用户登录时间
    public
    function showTime()
    {
        $userName = input("get.userName");
        $realName = input("get.realName");

        $list = Db::name("gz_time")->where("userName", $userName)->order("loginTime", "desc")->select();
        $this->assign("realName", $realName);
        $this->assign("list", $list);
        return $this->fetch("time");
    }

    public function del()
    {
        $userName = input("get.userName");
        $delete = Db::name("gz_user")->where("userName", $userName)->delete();
        if ($delete) {
            $this->success("删除" . $userName . "成功");
        } else {
            $this->error("删除失败");
        }

    }


    public function history(){
        $list = Db::name("gz_time")->order("loginTime", "desc")->select();
        $this->assign("list", $list);
        return $this->fetch("history");
    }

}