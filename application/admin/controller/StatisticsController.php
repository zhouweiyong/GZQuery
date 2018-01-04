<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/1/4
 * Time: 10:37
 */

namespace app\admin\controller;


use think\Db;

class StatisticsController extends BaseController
{

    public function logoNum()
    {
        $list = Db::name("gz_lnum")->order("lastTime", "desc")->select();
        if ($list != null) {
            $this->assign("list", $list);
        } else {
            return "还未有用户登录系统";
        }

        return $this->fetch();
    }
}