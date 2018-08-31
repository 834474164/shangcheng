<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use \app\home\controller\Base;
class Money extends Base
{
    /**
     * 同步跳转
     *
     * @return \think\Response
     */
    public function return()
    {
        //接收参数
        $data=request()->param();
        //验签
        require_once("./plugins/alipay/config.php");
        require_once("./plugins/alipay/pagepay/service/AlipayTradeService.php");
        $alipayService=new \AlipayTradeService($config);
        $result=$alipayService->check($data);
        if($result){
            //验证成功
            $order_sn=$data['out_trade_no'];
            $order=\app\home\model\Order::where(['order_sn'=>$order_sn])->find();
            if($order){
                //确认订单正确
                $order_amount=$order['order_amount'];
                return view('paysuccess',['total_amount'=>$order_amount,'order_id'=>$order_sn]);
            }else{
                //订单确认失败
                return view('payfail',['error'=>"支付失败,请稍后再试"]);
            }
        }else{
            //验证失败
            return view('payfail',['error'=>"支付失败,请稍后再试"]);
        }


    }

    /**
     * 异步跳转.
     *
     * @return \think\Response
     */
    public function notify()
    {
        //接收参数
        $data=request()->param();
        //验签
        require_once("./plugins/alipay/config.php");
        require_once("./plugins/alipay/pagepay/service/AlipayTradeService.php");
        $alipayService=new \AlipayTradeService($config);
        $result=$alipayService->check($data);
        if($result){
            //验证成功 修改订单状态
            if($data['trade_status']=='TRADE_FINISHED'){
                echo 'success';die;
            }elseif($data['trade_status']=='TRADE_SUCCESS'){
                $order_sn=$data['out_trade_no'];
                \app\home\model\Order::update(['pay_status'=>1],['order_sn'=>$order_sn]);
                echo 'success';die;
            }
        }

    }

}
