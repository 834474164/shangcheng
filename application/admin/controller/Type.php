<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
class Type extends Base
{
    /**
     * 商品类型列表页
     *
     * @return \think\Response
     */
    public function index()
    {
        $typedata=\app\admin\model\Type::select();
        return view('index',['typedata'=>$typedata]);
    }

    /**
     * 商品类型添加
     *
     * @return \think\Response
     */
    public function createview()
    {
        return view();
    }

    /**
     * 商品类型添加
     *
     * @return \think\Response
     */
    public function create()
    {
        $type_name=request()->param('type_name');
        $result=\app\admin\model\Type::create(['type_name'=>$type_name]);
        if($result){
            $this->success('添加成功','index');
        }
    }


    /**
     * 商品类型删除
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        $id=request()->param('id');
        $result=\app\admin\model\Type::destroy($id);
        if($result){
            $res=json(['code'=>10000,'msg'=>'success']);
            return $res;
        }

    }
    /**
     * 商品类型修改
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function editview(Request $request)
    {
        $id=request()->param('id');
        $type_name=\app\admin\model\Type::find($id);
        return view('editview',['type_name'=>$type_name]);
    }

    /**
     * 商品类型修改
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function edit(Request $request)
    {
        $type_name=request()->param('type_name');
        $id=request()->param('id');
        $type_name=['id'=>$id,'type_name'=>$type_name];
        $result=\app\admin\model\Type::update($type_name);
        if($result){
            $this->success('修改成功','index');
        }
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
