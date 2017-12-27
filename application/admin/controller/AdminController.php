<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/27
 * Time: 10:46
 */

namespace app\admin\controller;


use think\Db;

class AdminController extends BaseController
{
    public function modify()
    {
        return $this->fetch();
    }

    public function doModify()
    {
        $newpass = input("post.newpass");
        $update = Db::table("gz_admin")->where("admin_name", "admin")->setField("admin_pwd",$newpass);
        if ($update) {
            $this->success("管理员密码修改成功！");
        } else {
            $this->error("管理员密码修改失败！");
        }
    }

}