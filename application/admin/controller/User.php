<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
class User extends Base
{
    /**
     * 会员列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询会员数据
        $list=\app\admin\model\User::select();
        return view('user/index',['list'=>$list]);
    }

}
