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
        if(!session('user')){
            session('back_url','home/order/index');
            $this->redirect('home/index/loginview');
        }
        $ids=request()->param('id');
        //查询地址信息
        $user_id=session('user.id');
        $address=\app\home\model\Address::where(['user_id'=>$user_id])->select();
        //查询购物车选中得商品
        $bygoods=\app\home\model\Cart::alias('t1')
            ->field('t1.*,t2.goods_name,t2.goods_price,t2.goods_logo')
            ->join('goods t2','t1.goods_id=t2.id','left')
            ->where('t1.id','in',$ids)
            ->select();
        return view('index',[
            'address'=>$address,
            'bygoods'=>$bygoods,
            'ids'=>$ids,
        ]);
    }

    /**
     * 提交订单
     *
     * @return \think\Response
     */
    public function commit_order()
    {
        //接收数据
        $data=request()->param();
        $ids=$data['ids'];
        $address_id=$data['address_id'];
        //查询地址数据
        $address=\app\home\model\Address::where(['id'=>$address_id])->find();
        //查询商品相关信息
        $bygoods=\app\home\model\Cart::alias('t1')
            ->field('t1.*,t2.goods_name,t2.goods_price,t2.goods_logo')
            ->join('goods t2','t1.goods_id=t2.id','left')
            ->where('t1.id','in',$ids)
            ->select();
        //生成订单数据
        //生成订单号
        $order_sn=time();
        //用户id
        $user_id=session('user.id');
        //收货人姓名
        $consignee_name=$address['consignee'];
        //收货人电话
        $consignee_phone=$address['phone'];
        //收货人地址
        $consignee_address=$address['address'];
        //快递方式
        $shipping_type="yunda";
        $pay_status=0;
        $pay_type="alipay";
        $num=0;
        $order_amount=0;
        foreach($bygoods as $v){
            $order_amount=$v['number']*$v['goods_price']+$order_amount;

        }
        $order=[
            'order_sn'=>$order_sn,
            'user_id'=>$user_id,
            'consignee_name'=>$consignee_name,
            'consignee_phone'=>$consignee_phone,
            'consignee_address'=>$consignee_address,
            'shipping_type'=>$shipping_type,
            'pay_status'=>$pay_status,
            'pay_type'=>$pay_type,
            'order_amount'=>$order_amount,
        ];
        //添加订单信息
        $res=\app\home\model\Order::create($order,true);
        foreach($bygoods as $v){
            $order_id=$res->id;
            $goods_order=[
                'order_id'=>$order_id,
                'goods_id'=>$v['goods_id'],
                'goods_name'=>$v['goods_name'],
                'goods_price'=>$v['goods_price'],
                'goods_logo'=>$v['goods_logo'],
                'number'=>$v['number'],
                'goods_attr_ids'=>$v['goods_attr_ids']
            ];
            //添加订单商品数据
            $result=\app\home\model\Order_goods::create($goods_order,true);
        }
    }


}
