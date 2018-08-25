<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
//密码加密
if(!function_exists('encrypt_password')){
    function encrypt_password($password){
//        加盐方式
        $str='kdjfk!lkdjfk';
        $newpassword=md5(md5($password).$str);
        return $newpassword;
    }
}


//递归方法实现无限极分类
if(!function_exists('get_tree')){
    function get_tree($list,$pid=0,$level=0){
        static $tree =array();
        foreach($list as $row){
            if($row['pid']==$pid){
                $row['level']=$level;
                $tree[]=$row;
                get_tree($list,$row['id'],$level+1);
            }
        }
        return $tree;
    }
}

//使用递归方法实现无限极分类树
if(!function_exists('get_cate_tree')){
    function get_cate_tree($list){
        $temp=[];
        foreach($list as $v){
            $temp[$v['id']]=$v;
        }
        foreach($temp as $k=>$v){
            $temp[$v['pid']]['son'][$v['id']]=&$temp[$v['id']];
        }
        return isset($temp[0]['son'])?$temp[0]['son']:[];
    }
}


//封装curl库发送请求
if(!function_exists('curl_request')){
    function curl_request($url,$post=false,$params=[],$https=false){
        //初始化请求会话
        $ch=curl_init($url);
        //设置一些选项
        if($post){
            //设置请求方式,请求参数
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
        }
        if($https){
            //禁止curl从服务器验证本地证书
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        }
        //发送请求
        //设置让curl_exec直接返回接口的结果数据
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $res=curl_exec($ch);
        //关闭请求会话
        curl_close($ch);
        return $res;
    }
}


if(!function_exists('sendmail')){
    //使用phpmailer发送邮件
    function sendmail($email,$subject,$body)
    {
        $mail=new \PHPMailer\PHPMailer\PHPMailer();//传参数true,表示使用异常处理机制
        $mail->SMTPDebug=2;//调试信息
        $mail->isSMTP();//设置使用SMTP协议
        $mail->Host=config('email.host');
        $mail->SMTPAuth=true;
        $mail->Username=config('email.username');
        $mail->Password=config('email.password');
        $mail->SMTPSecure='tls';
        $mail->Port=25;
        $mail->CharSet='UTF-8';
        $mail->setFrom(config('email.username'));
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject=$subject;
        $mail->Body=$body;
        if(!$mail->send()){
            //发送失败
        return $mail->ErrorInfo;
    }
        return true;


    }
}