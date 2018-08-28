<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use \app\home\controller\Base;
class Cart extends Base
{
    /**
     * 添加购物车成功
     *
     * @return \think\Response
     */
    public function add_success()
    {
        return view();
    }

    /**
     * 添加购物车成功
     *
     * @return \think\Response
     */
    public function add_cart()
    {
        //接收数据
        $data=request()->param();
        //添加数据到购物车
        \app\home\model\Cart::to_cart($data);
        $this->redirect('add_success');
    }

    /**
     * 添加购物车成功
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询购物车数据
        $data_cart=\app\home\model\Cart::alias('t1')
            ->field('t1.*,t2.*')
            ->join('goods t2','t1.goods_id = t2.id','left')
            ->select();
        //查询商品属性表
        $data_attr=\app\admin\model\Goods_attr::select();
        return view('index',[
            'data_cart'=>$data_cart,
            'data_attr'=>$data_attr,
        ]);
    }
}
