<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use \app\home\controller\Base;
class Order extends Base
{
    /**
     * 订单结算
     *
     * @return \think\Response
     */
    public function index()
    {
        $id=request()->param('id');
        return view();
    }


}
