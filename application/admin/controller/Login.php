<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Login extends Controller
{
    /**
     * 登陆页面
     *
     * @return \think\Response
     */
    public function index()
    {
        $this->view->engine->layout(false);
        return view();
    }

    /**
     * 登陆验证数据
     *
     * @return \think\Response
     */
    public function login()
    {
//        接收登陆页面提交的数据
        $logininfo=request()->param();
        //用户名
        $username=$logininfo['username'];
        $password=$logininfo['password'];
        $password=encrypt_password($password);
        $where=['username'=>$username,'password'=>$password];
        $result=\app\admin\model\Manager::where($where)->find();
//        判断是否登陆成功
        if($result){//登陆成功
//            验证码验证
//接收用户输入的验证码
            $captcha=request()->param('captcha');
            if(!captcha_check($captcha)){
                $this->error('验证码输入不正确','index');
            }
//            设置登陆标识
            session('manager_info',$result);
            $this->success('登陆成功','index/index');
        }else{//登陆失败
            $this->error('用户名或者密码错误','login/index');
        }
    }

    /**
     * 后台登出
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function logout(Request $request)
    {
        session(null);
        return $this->redirect('admin/login/index');
    }


    /**
     *
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
