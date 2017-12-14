<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/11
 * Time: 11:15
 */

namespace app\admin\controller;


use PHPExcel;
use PHPExcel_IOFactory;
use think\Db;
use think\Request;

class SalaryController extends BaseController
{

    //导入工资
    public function import()
    {
        return $this->fetch();
    }

    public function doImport()
    {
        $gz = request()->file("gz");
        $gtime = input("post.gtime");
        $info = $gz->getInfo();
        $pe = new PHPExcel();
        $reader = PHPExcel_IOFactory::createReader('Excel2007');
        $excel = $reader->load($info["tmp_name"]);
        $sheet = $excel->getSheet(0);
        $arr = $sheet->toArray();

        //判断是否添加过该月工资数据
        $numDb = Db::table("gz_num")->where("gtime", $gtime)->find();
        if ($numDb != null) {
            return $this->error("已经添加过该月工资数据，不能多次添加");
        }

        //把表头添加到数据库
        //列数
        $colLen = sizeof($arr[0]);
        $header = array();
        $header["gtime"] = $gtime;
        for ($i = 0; $i < $colLen; $i++) {
            $header["col" . $i] = $arr[0][$i];
        }
        $insert = Db::name("gz_header")->insert($header, true);

        $data = array();
        //行数，包含空行，需要过滤
        $row = sizeof($arr);
        for ($i = 1; $i < $row; $i++) {
            //过滤空行
            if ($arr[$i][0] != null && !empty($arr[$i][0])) {
                $tmp = array();
                $tmp["gtime"] = $gtime;
                for ($j = 0; $j < $colLen; $j++) {
                    $tmp["col" . $j] = $arr[$i][$j];
                }
                array_push($data, $tmp);
            } else {
                continue;
            }
        }
        Db::name("gz_data")->insertAll($data, true);


        Db::name("gz_num")->insert(array("gtime" => $gtime, "num" => $colLen));

        $this->success("该月工资数据添加成功");
    }

//所有工资列表
    public function gzlist()
    {
        $list = Db::table("gz_num")->select();
        $this->assign("list", $list);
        return $this->fetch();
    }

    //每月工资列表
    public function detail()
    {
        $gtime = input("get.gtime");

        $numDb = Db::name("gz_num")->where("gtime", $gtime)->find();
        $num = $numDb["num"];
        $header = Db::name("gz_header")->where("gtime", $gtime)->find();
        $data = Db::name("gz_data")->where("gtime", $gtime)->select();
        $this->assign("num", $num);
        $this->assign("header", $header);
        $this->assign("data", $data);
        $this->assign("gtime", $gtime);
        return $this->fetch();
    }

    public function del()
    {
        $gtime = input("get.gtime");
        $isOk = Db::table("gz_num")->where("gtime", $gtime)->delete();
        Db::table("gz_header")->where("gtime", $gtime)->delete();
        Db::table("gz_data")->where("gtime", $gtime)->delete();
        if ($isOk) {
            $this->success("删除成功");
        } else {
            $this->error("删除失败，请重操作");
        }


    }
}