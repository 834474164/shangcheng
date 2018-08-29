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
        $data_cart=\app\home\model\Cart::show_cart();
        //查询商品属性表
        $data_attr=\app\admin\model\Goods_attr::select();
        return view('cart/index',[
            'data_cart'=>$data_cart,
            'data_attr'=>$data_attr,
        ]);
    }
}
