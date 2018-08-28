<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
class Manager extends Base
{
    /**
     * 管理员列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询用户数据
        $list=\app\admin\model\Manager::select();
        return view('manager/index',['list'=>$list]);
    }

    /**
     * 管理员添加页面
     *
     * @return \think\Response
     */
    public function addview()
    {
        //查取角色数据
        $role=\app\admin\model\Role::select();
        return view('addview',['role'=>$role]);
    }

    /**
     * 管理员添加
     *
     * @return \think\Response
     */
    public function add()
    {
        $data=request()->param();
        $data['password']=encrypt_password($data['password']);
        $result=\app\admin\model\Manager::create($data,true);
        if($result){
            $this->redirect("admin/manager/index");
        }else{
            $error("网络错误","admin/manager/addview");
        }
    }

    /**
     * 管理员添加
     *
     * @return \think\Response
     */
    public function delete()
    {
        $id=request()->param('id');
//        dump($id);die;
        $result=\app\admin\model\Manager::where('id',$id)->delete();
        if($result){
            return json(['code'=>10000]);
        }

    }
}
