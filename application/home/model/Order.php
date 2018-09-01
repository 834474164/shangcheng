<?php

namespace app\home\model;

use think\Model;

class Order extends Model
{
    public function getPayStatusAttr($index)
    {
        $data=['0'=>'未付款','1'=>"已付款"];
        return $data[$index];
    }
    public function getPayTypeAttr($index)
    {
        $data=['alipay'=>'支付宝'];
        return $data[$index];
    }
    public function getShippingTypeAttr($index)
    {
        $data=['yunda'=>'韵达快递'];
        return $data[$index];
    }
}
