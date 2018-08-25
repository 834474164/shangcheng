<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;

class Role extends Base
{
    /**
     * 角色列表页面
     *
     * @return \think\Response
     */
    public function index()
    {
//        调用模型查询数据
        $roledata=\app\admin\model\Role::select();
        return view('index',['roledata'=>$roledata]);
    }

    /**
     * 角色添加
     *
     * @return \think\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //        获取表单数据
        $role_name=request()->param('role_name');
//        构造数据添加到数据库
        $role_name=['role_name'=>$role_name];
//        验证数据的可用性
//        定义验证规则
        $rules=[
            'role_name'=>'require|unique:role,role_name',
        ];
//        定义错误提示信息
        $msg=[
            'role_name.require'=>'角色名不能为空',
            'role_name.unique'=>'角色名不能重复',
        ];
        $validate=new \think\Validate($rules,$msg);//实例化验证器类
        if($validate->batch()->check($role_name)){//验证成功
            //        调用模型添加数据
            $result=\app\admin\model\Role::create($role_name);
            if($result){
                $this->success('添加成功','index');
            }
        }else{//验证失败
            $errormsg=$validate->getError();
            $errormsg=implode(",",$errormsg);
            $this->error($errormsg,'create');
        }

    }

    /**
     * 删除角色
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
//        接收数据
        $id=request()->param('data');
        $resutl=\app\admin\model\Role::destroy($id);
        
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


}
