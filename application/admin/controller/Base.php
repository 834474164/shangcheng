<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
        public function __construct(Request $request)
        {
            parent::__construct($request);//调用父类的构造函数
            if(!session('manager_info')){
                $this->redirect('admin/login/index');
            }
            //调用getauth方法,查询菜单权限
            $this->getauth();
            //控制页面权限
            $this->checkauth();
        }

        //展示左侧菜单栏数据展示
        public function getauth()
        {
            //从session获取当前用户的角色id
            $role_id=session('manager_info.role_id');
//            dump($role_id);die;
            //超级管理员直接查询所有的权限
            if(1==$role_id){
                //查询顶级权限
                $top_nav=\app\admin\model\Auth::where([
                    'pid'=>0,
                    'is_nav'=>1,
                ])->select();
                //查询二级权限
                $second_nav=\app\admin\model\Auth::where([
                    'pid'=>['gt',0],
                    'is_nav'=>1,
                ])->select();
            }else{
                //不是超级管理员
                //查询角色表,取到拥有的顶级菜单权限,拥有的二级菜单权限的权限ids
                //查询当前角色所拥有的权限数据
                $auth=\app\admin\model\Role::where('id',$role_id)->find();
                //得到所有权限id
                $role_auth_ids=$auth['role_auth_ids'];
                //查询当前用户的顶级权限
                $top_nav=\app\admin\model\Auth::where([
                    'pid'=>0,
                    'is_nav'=>1,
                    'id'=>['in',$role_auth_ids]
                ])->select();

                //查询当前用户的二级权限
                $second_nav=\app\admin\model\Auth::where([
                    'pid'=>['gt',0],
                    'is_nav'=>1,
                    'id'=>['in',$role_auth_ids]
                ])->select();
//                dump($top_nav);die;
            }
            //变量赋值
            $this->assign('top_nav',$top_nav);
            $this->assign('second_nav',$second_nav);
        }


        //页面权限控制
        public function checkauth()
        {
            //获取角色id
            $role_id=session('manager_info.role_id');

            if($role_id==1){
                //超级管理员不限制访问
                return;
            }
            //查询角色数据
            $roleinfo=\app\admin\model\Role::where('id',$role_id)->find();
            //获取角色id
            $role_auth_ids=$roleinfo['role_auth_ids'];
            //转化为数组
            $role_auth_ids=explode(',',$role_auth_ids);

            //获取当前页面的控制器方法
            $controller=request()->controller();//获取当前访问页面的控制器
            $action=request()->action();//获取当前访问的页面的方法
//            dump($controller);die;
            if(strtolower($controller)=='index'&&strtolower($action=='index')){
                //首页不限制访问
                return;
            }

            $where=[
                'auth_c'=>$controller,
                'auth_a'=>$action,
            ];

            //获取当前控制器的权限id
            $authinfo=\app\admin\model\Auth::where($where)->find();
            $auth_id=$authinfo['id'];
            //判断用户是否有当前页面的访问的权限
            $result=in_array($auth_id,$role_auth_ids);
            //判断完跳转
            if(!$result){
                $this->error('没有权限','index/index');
            }
            return;
        }
}
