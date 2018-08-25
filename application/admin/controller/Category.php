<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
class Category extends Base
{
    //查询一级分类的二级分类
    public function select_two()
    {
        //接收id值
        $id=request()->param('id');
        //查询当前分类数据
        $cate=\app\admin\model\Category::where('id',$id)->find();
        //查询这个一级分类的二级分类
        $category_two=\app\admin\model\Category::where('pid',$cate['id'])->select();
        $res=[
            'category_two'=>$category_two,
        ];
        return json($res);
    }

    //查询二级分类的三级分类
    public function select_three()
    {
        //接收id值
        $id=request()->param('id');
        //查询当前分类数据
        $cate=\app\admin\model\Category::where('id',$id)->find();
        //查询这个一级分类的二级分类
        $category_three=\app\admin\model\Category::where('pid',$cate['id'])->select();
//        dump($id);die;
        $res=[
            'category_three'=>$category_three,
        ];
        return json($res);
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
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
