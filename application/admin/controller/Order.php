<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
class Order extends Base
{
    /**
     * 后台订单列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询订单信息
        $order=\app\home\model\Order::alias('t1')
            ->field('t1.*,t2.username')
            ->join('user t2','t1.user_id=t2.id','left')
            ->select();
        return view('index',['order'=>$order]);
    }

    /**
     * 订单修改
     *
     * @return \think\Response
     */
    public function editview()
    {
        $id=request()->param('id');
        //查询当前的订单信息
        $order=\app\home\model\Order::alias('t1')
            ->field('t1.*,t2.username')
            ->join('user t2','t1.user_id=t2.id','left')
            ->where(['t1.id'=>$id])
            ->find();
        return view('editview',['order'=>$order]);
    }

    /**
     * 订单修改
     *
     * @return \think\Response
     */
    public function edit()
    {
        $data=request()->param();
        $id=$data['id'];
        $order_amount=$data['order_amount'];
        $consignee_address=$data['consignee_address'];
        $where=['id'=>$id,'order_amount'=>$order_amount,'consignee_address'=>$consignee_address];
        //修改订单数据
        $res=\app\home\model\Order::update($where);
        if($res){
            $this->success('修改订单成功','admin/order/index');
        }else{
            $this->error('网络错误,请稍后再试','admin/order/index');
        }

    }




}
