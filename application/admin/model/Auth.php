<?php

namespace app\admin\model;

use think\Model;

class Auth extends Model
{
    //    设置软删除
    use \traits\model\SoftDelete;
    protected $deleteTime='delete_time';

//    获取器,转化is_nav字段内容
     public function getIsNavAttr($value)
     {
         $data=[0=>'否',1=>'是'];
         return $data[$value];
     }
}
