<?php

namespace app\admin\model;

use think\Model;

class Role extends Model
{
    //    设置软删除
    use \traits\model\SoftDelete;
    protected $deleteTime='delete_time';
}
