<?php
namespace app\index\model;

use think\Model;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/14
 * Time: 16:33
 */

class User extends Model
{
    protected $table = "gz_user";
    protected $pk = "id";
}