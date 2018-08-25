<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
class Auth extends Base
{
    /**
     * 分派权限
     *
     * @return \think\Response
     */
    public function index()
    {
//        调用模型查询数据
//        查询所有数据
        $authdata=\app\admin\model\Auth::select();
//        查询当前用户的权限id
        $role_id=request()->param('id');
//        查询当前用户的权限id
        $role_authinfo=\app\admin\model\Role::where('id',$role_id)->find();
        $role_auth_ids=$role_authinfo['role_auth_ids'];
//      dump($authdata);die;
        return view('index',[
            'authdata'=>$authdata,
            'role_auth_ids'=>$role_auth_ids,
            'id'=>$role_id,
        ]);
    }

    /**
     * 分配权限.
     *
     * @return \think\Response
     */
    public function create()
    {
        //获取角色id
        $auth_id=request()->param('role_id');
        //获取角色的权限ids
        $auth_array=request()->param('id/a');
        //数组转化成字符串
        $role_auth_ids=implode(',',$auth_array);
//        dump($auth_array);die;
//        组装数组
        $newauthids=['id'=>$auth_id,'role_auth_ids'=>$role_auth_ids];
//        将新的权限id更新到当前角色中
        $result=\app\admin\model\Role::update($newauthids);
        if($result){
            $this->success('分配成功','role/index');
        }else{
            $this->error('请求错误,请再试','index');
        }

    }

    /**
     * 权限列表
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function list(Request $request)
    {
//        查询权限数据
        $authdata=\app\admin\model\Auth::select();
        $authdata=get_tree($authdata);
//        dump($authdata);die;

       return view('list',[
           'authdata'=>$authdata,
       ]);
    }

    /**
     * 添加权限页面
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
//        查询当前所有顶级权限
        $topauth=\app\admin\model\Auth::where('pid','0')->select();

      return view('save',['topauth'=>$topauth]);
    }

    /**
     * 添加权限到数据库
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function add()
    {
//        接收表单数据
        $authdata=request()->param();
//        添加数据到数据库
        $result=\app\admin\model\Auth::create($authdata,true);
        if($result){
            $this->success('添加成功','list');
        }else{
            $this->error('添加失败,请在试','save');
        }

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
//       接收id值
        $id=request()->param('id');
        //查询当前编辑的数据
        $authdata=\app\admin\model\Auth::where('id',$id)->find();
        //查询所有顶级权限
        $topauth=\app\admin\model\Auth::where('pid',0)->select();
        return view('edit',[
            'authdata'=>$authdata,
            'topauth'=>$topauth,
        ]);

    }

    /**
     * 将权限修改到数据库
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function update()
    {
        $authdata=request()->param();
        $result=\app\admin\model\Auth::update($authdata,[],true);
        $this->redirect('auth/list');
//        $this->success('修改成功','auth/list');
    }


    /**
     * 删除权限
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        //接收传递过来的参数
        $id=request()->param('id');
        //查询当前的权限数据
        $authinfo=\app\admin\model\Auth::where('id',$id)->find();
        //判断,如果当前权限是顶级权限,那么就要判断顶级权限下面是否有二级权限
        if($authinfo['pid']==0){
            //若为顶级权限
            //判断顶级权限下面有没有二级权限
            $result=\app\admin\model\Auth::where('pid',$authinfo['pid'])->select();
            if($result){
                //若此顶级权限下面存在二级权限,那么不能直接删除
                $this->error('有次级权限存在,需要先处理改权限下的次级权限','list');
            }
        }
        \app\admin\model\Auth::destroy($id);
        $this->redirect('list');
    }
}
