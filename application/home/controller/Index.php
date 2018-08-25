<?php
namespace app\home\controller;
use \app\home\controller\Base;
class Index extends Base
{
    public function index()
    {
       return view();
    }

    //前台登陆
    public function loginview()
    {
        $this->view->engine->layout(false);
        return view();
    }

    //前台登陆验证
    public function login()
    {
        $data=request()->param();
//        dump($data);
        $username=$data['username'];
        $password=$data['password'];
        $password=encrypt_password($password);
        $where=['username'=>$username,'password'=>$password];
        $res=\app\home\model\User::where($where)->find();
        if($res){
            session('user',$username);
            $this->assign('user',$username);
            $this->fetch("admin/index/index");
            $this->redirect('home/index/index');
        }else{
            $this->error('网络错误','home/index/loginview');
        }
    }


}
