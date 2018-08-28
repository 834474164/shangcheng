<?php

namespace app\home\model;

use think\Model;

class Cart extends Model
{
    //定义静态方法,添加商品到购物车
    public static function to_cart($data)
    {
        if(session('user')){
            //用户已登陆
            $data['user_id']=session('user.id');
            $where=['goods_id'=>$data['goods_id'],'goods_attr_ids'=>$data['goods_attr_ids'],'user_id'=>$data['user_id']];
            $result=\app\home\model\Cart::where($where)->find();
            if($result){
                //如果商品已经在购物车了,
                $where=['id'=>$result['id'],'number'=>($result['number']+$data['number'])];
                \app\home\model\Cart::update($where);
                return;
            }
            \app\home\model\Cart::create($data,true);
        }else{
            //用户未登陆
            $goods_id=$data['goods_id'];
            $goods_attr_ids=$data['goods_attr_ids'];
            $number=$data['number'];
//            dump(unserialize(cookie('cart')));die;
            if(isset(unserialize(cookie('cart'))[$goods_id."-".$goods_attr_ids])){
                $arr_cart=unserialize(cookie('cart'));
                $arr_cart[$goods_id."-".$goods_attr_ids]+=$number;
                cookie("cart",serialize($arr_cart));
                return;
            }
            $arr_cart[$goods_id."-".$goods_attr_ids]=$number;
            cookie('cart',serialize($arr_cart));
        }
    }

    //迁移购物车数据到数据库
    public static function to_mysql()
    {
        //获取cookie中的购物车数据
        $cart_arr=unserialize(cookie('cart'));
        if(cookie('cart')==null){
            return;
        }
        foreach($cart_arr as $k=>$v){
            $user_id=session('user.id');
            $number=$v;
            $arr=explode('-',$k);
            $goods_id=$arr[0];
            $goods_attr_ids=$arr[1];

            $where=['goods_id'=>$goods_id,'goods_attr_ids'=>$goods_attr_ids,'user_id'=>$user_id];
            $result=\app\home\model\Cart::where($where)->find();
            if($result){
                //如果商品已经在购物车了,
                $where=['id'=>$result['id'],'number'=>(intval($result['number'])+intval($number))];
                \app\home\model\Cart::update($where);

            }else{
                //如果购物车中部存在该商品
                $data=['user_id'=>$user_id,'number'=>$number,'goods_attr_ids'=>$goods_attr_ids,'goods_id'=>$goods_id];
                \app\home\model\Cart::create($data,true);
            }


        }
        cookie('cart',null);
    }
}
