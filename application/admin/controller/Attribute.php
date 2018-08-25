<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
class Attribute extends Base
{
    /**
     * 属性列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $attribute = \app\admin\model\Attribute::alias('t1')
            ->field('t1.*,t2.type_name')
            ->join('tpshop_type t2', 't1.type_id=t2.id', 'left')
            ->select();
//        dump($attribute);die;
        return view('index', ['attribute' => $attribute]);
    }

    /**
     * 属性添加view
     *
     * @return \think\Response
     */
    public function createview()
    {
        //查询所有分类
        $typedata = \app\admin\model\Type::select();

        return view('createview', ['typedata' => $typedata]);
    }

    /**
     * 添加属性数据
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function create(Request $request)
    {
        //接收表单传递的数据
        $attrdata = request()->param();
        //添加数据到数据表
        $result = \app\admin\model\Attribute::create($attrdata, true);
        //判断并返回
        if ($result) {
            $this->success('添加成功', 'index');
        }
    }

    /**
     * 删除属性
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete()
    {
        //接收id
        $id = request()->param("attr_id");

        //删除对应的属性
        $result = \app\admin\model\Attribute::destroy($id);
        if($result){
            $res = [
                'code' => 10000,
                'msg' => 'success'
            ];
            return json($res);
        }
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function editview()
    {
        $id=request()->param('id');
        //查询全部商品类型
        $typedata=\app\admin\model\Type::select();
        //查询当前属性数据
        $attribute=\app\admin\model\Attribute::where('id',$id)->find();
        return view('editview',[
            'typedata'=>$typedata,
            'attribute'=>$attribute,
        ]);
    }

    /**
     * 修改属性
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function edit()
    {
        //获取表单提交的数据
        $data=request()->param();
        $data=[
            'id'=>$data['id'],
            'attr_name'=>$data['attr_name'],
            'type_id'=>$data['type_id'],
            'attr_type'=>$data['attr_type'],
            'attr_input_type'=>$data['attr_input_type'],
            'attr_values'=>$data['attr_values'],
        ];
       //修改数据到数据库
        $result=\app\admin\model\Attribute::update($data);
        if($result){
            $this->success('修改成功','index');
        }

    }


    //添加商品-查询对应类型的属性
    public function select_attribute()
    {
        //接收数据
        $type_id=request()->param('type_id');
        $goods_id=request()->param('goods_id');
//        dump($type_id);die;
        //查询属性
        $attributes=\app\admin\model\Attribute::where('type_id',$type_id)->select();
//        //查询当前商品的属性值
//        $goods_attrs=\app\admin\model\Goods_attr::where('goods_id',$goods_id)->select();
//        $attr_value=[];
//        foreach($goods_attrs as $k=>$v){
//            $attr_str[$v['attr_id']][]=$v['attr_value'];
//        }
//        foreach($attr_value as $a=>$b){
//            $attr_str[$a][]=implode(',',$b);
//        }
//        dump($attr_str);die;
        $res=json([
            'data'=>$attributes,

            'msg'=>'success',
        ]);
        return $res;
    }


    public function select_attribute_edit()
    {
        //接收数据
        $type_id=request()->param('type_id');
        $goods_id=request()->param('goods_id');
//        dump($type_id);die;
        //查询属性
        $attributes=\app\admin\model\Attribute::where('type_id',$type_id)->select();
        //查询当前商品的属性值
        $goods_attrs=\app\admin\model\Goods_attr::where('goods_id',$goods_id)->select();
        $attr_value=[];
        foreach($goods_attrs as $k=>$v){
            $attr_str[$v['attr_id']][]=$v['attr_value'];
        }
//        foreach($attr_value as $a=>$b){
//            $attr_str[$a][]=implode(',',$b);
//        }
//        dump($attr_str);die;
        $res=json([
            'data'=>$attributes,
            'attr_str'=>$attr_str,
            'msg'=>'success',
        ]);
        return $res;
    }




}
