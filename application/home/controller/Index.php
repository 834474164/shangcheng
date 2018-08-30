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
            session('user',$res);
            \app\home\model\Cart::to_mysql();
            if(session('back_url')){
                $this->redirect(session('back_url'));
                return;
            }
            $this->redirect('home/index/index');
        }else{
            $this->error('网络错误','home/index/loginview');
        }
    }

    //前台用户登出
    public function logout()
    {
        session('user',null);
        $this->redirect('home/index/index');
    }

}
