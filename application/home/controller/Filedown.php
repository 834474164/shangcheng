<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use \app\home\controller\Base;
class Filedown extends Base
{
    /**
     * 下载文件方法
     *
     * @return \think\Response
     */
    public function download()
    {
        $file_name="test.txt";      //下载文件名
        $file_dir=ROOT_PATH.'public'.DS.'upfiles'.DS;     //下载文件存放目录
//        echo $file_dir.$file_name;
        $file1=fopen($file_dir.$file_name,'r');
        //输入文件标签
        Header('Content-type:application/octet-stream');
        Header("Accept-Ranges:bytes");
        Header("Accept-Length:".filesize($file_dir.$file_name));
        Header("Content-Disposition:attachment;filename=".$file_name);  //下载的文件的新文件名
        ob_clean();
        flush();
        echo  fread($file1,filesize($file_dir.$file_name));  //确定并读取下载的文件
        fclose($file1);
        exit();
    }

    /**
     * 下载测试
     *
     * @return \think\Response
     */
    public function index()
    {
        $this->download();
    }


    /**
     * 测试页面
     *
     * @return \think\Response
     */
    public function test()
    {
        return view();
    }


}
