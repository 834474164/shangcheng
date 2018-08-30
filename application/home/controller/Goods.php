<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use \app\home\controller\Base;
use think\Cache;
//use think\cache\driver\Redis;
class Goods extends Base
{
    /**
     * 商品列表展示
     *
     * @return \think\Response
     */
    public function list()
    {
        $cate_id=request()->param('cate_id');
        //查询商品信息
        $goods_data=\app\admin\model\Goods::where('cate_id',$cate_id)->paginate(8);
        return view('list',['goods_data'=>$goods_data]);
    }


    public function detail()
    {
        //接收goods_id
        $goods_id=request()->param('goods_id');
        //查询商品相册信息
        $pics=\app\admin\model\Goodspics::where('goods_id',$goods_id)->select();
        //查询商品基本信息
        $goods_info=\app\admin\model\Goods::where('id',$goods_id)->find();
        $type_id=$goods_info->type_id;
//        $type_id=$goods_info["type_id"];
        //查询属性表
        $attribute=\app\admin\model\Attribute::where('type_id',$type_id)->select();
        //查询商品属性表
        $goods_attr=\app\admin\model\Goods_attr::where('goods_id',$goods_id)->select();
        return view('goods/detail',[
            'pics'=>$pics,
            'goods_info'=>$goods_info,
            'attribute'=>$attribute,
            'goods_attr'=>$goods_attr,
        ]);
    }

    //模拟接口,提供一个接口
    public function testapi()
    {
        $data=request()->param();
        return json(['code'=>10000,'msg'=>'success']);

    }

    public function testrequest()
    {
        $url='http://local.shangcheng.com/home/goods/testapi';
        $post=ture;
        $params=['page'=>10,'id'=>100];
        $res=curl_request($url,$post,$params);
        dump($res);die;
    }

    public function fayoujian()
    {
        $email='745108931@qq.com';
        $subject='测试PHPMailer';
        $body='PHPMailer真好用';
        $res=sendmail($email,$subject,$body);
        var_dump($res);die;
    }

    //使用ob缓存静态化页面
    public function useob()
    {
        if(file_exists("./static.html")){
            header("location:http://local.shangcheng.com/static.html");
        }else{
            ob_start();
            phpinfo();
            $str=ob_get_contents();
            $dir="./static.html";
            file_put_contents($dir,$str);
            header('location:http://local.shangcheng.com/static.html');
        }


    }







}
