<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
class Goods extends Base
{
    /**
     * 商品列表
     *
     * @return \think\Response
     */
    public function index()
    {
//        调用模型查询商品数据
        $goodsdata=\app\admin\model\Goods::paginate(10);
        return view('index',['goodsdata'=>$goodsdata]);
    }

    /**
     * 新增商品
     *
     * @return \think\Response
     */
    public function create()
    {
        //查询一级分类
        $category_one=\app\admin\model\Category::where('pid',0)->select();
        //查询类型
        $typedata=\app\admin\model\Type::select();


        return view('create',[
            'category_one'=>$category_one,
            'typedata'=>$typedata,
        ]);
    }

    /**
     * 商品添加保存
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //接收数据
        $data=request()->param();
//        dump($data);die;
        //收集并保存商品基本数据数据
        //收集goods表数据
        $goods_logo=$this->upload_pics();
        $goods=[
            'goods_name'=>$data['goods_name'],
            'goods_price'=>$data['goods_price'],
            'goods_number'=>$data['goods_number'],
            'type_id'=>$data['type_id'],
            'goods_logo'=>$goods_logo,
            'cate_id'=>$data['cate_id'],
            'goods_introduce'=>$data['goods_introduce'],
        ];
        $result=\app\admin\model\Goods::create($goods);
        //提取商品
        $goods_id=$result->id;

        //添加并保存属性数据
//        dump($data['attr_values']);die;

        foreach($data['attr_values'] as $k=>$v){
            foreach($v as $a=>$b){
                //组装商品属性数据
                $goods_attr=[
                    'goods_id'=>$goods_id,
                    'attr_id'=>$k,
                    'attr_value'=>$b,
                ];
                //添加商品属性数据
                \app\admin\model\Goods_attr::create($goods_attr);
            }
        }

        //添加并保存相册数据
        $files=request()->file('goods_pics');
        foreach($files as $file){
            //将图片保存到服务器上的文件夹中保存
            $info=$file->validate(['size'=>5*1024*1024,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH.'public'.DS.'uploads');

            //判断,上传成功则进行处理
            if($info){
                //拼接图片路径
                $pics_path=DS.'uploads'.DS.$info->getSaveName();
//dump($pics_path);die;
                //拼接缩略图路径
                $savename=explode(DS,$info->getSaveName());

                //拼接缩略图路径
                $path_sma=DS.'uploads'.DS.$savename[0].'/thumb_400'.$savename[1];
                $path_big=DS.'uploads'.DS.$savename[0].'/thumb_800'.$savename[1];

                //生成缩略图
                $image=\think\Image::open('.'.$pics_path);//打开缩略图
//                dump($image);die;
                $image->thumb(800,800)->save('.'.$path_big);
                $image->thumb(400,400)->save('.'.$path_sma);

            \app\admin\model\Goodspics::create(['goods_id'=>$goods_id,'pics_big'=>$path_big,'pics_sma'=>$path_sma]);

            }


        }


        if($result){
            //添加成功判断跳转
            $this->success('添加成功','index');
            //收集goods_attr表数据
            //收集goods_pics表数据
        }

    }


    //封装上传图片方法
    /*
     * 接收提交过来的图片
     * 生成缩略图并保存到uploads目录
     * 返回此缩略图的路径地址
     */
    private function upload_pics()
    {
        //接收图片文件
        $file=request()->file('goods_logo');
        //判断是否有图片上传
        if(empty($file)){
            $this->error('请上传图片');
        }
        //将临时文件移动到上传文件目录中
        $info=$file->validate(['size'=>5*1024*1024,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH.'public'.DS.'uploads');
        if($info){
            //拼接图片的访问路径
            $goods_logo=DS.'uploads'.DS.$info->getSaveName();
            //生成缩略图
            //调用open方法打开原始图片
            $image=\think\Image::open('.'.$goods_logo);
            //生成缩略图并保存覆盖到原始目录中,路径不变
            $image->thumb(210,240)->save('.'.$goods_logo);
            return $goods_logo;
        }



    }


    //商品信息修改
    public function update()
    {
        //接收id值
        $id=request()->param('id');

        //查询商品信息
        $goods=\app\admin\model\Goods::find($id);
        //提取当前的cate_id
        $cate_id=$goods->cate_id;
        //查询当前的分类信息
        $cate_info=\app\admin\model\Category::where('id',$cate_id)->find();
        //提取当前的pid
        $pid_three=$cate_info['pid'];
        //查询所有三级分类
        $cate_three=\app\admin\model\Category::where('pid',$pid_three)->select();
        //查询当前的二级分类
        $cate_info_two=\app\admin\model\Category::where('id',$pid_three)->find();
        //提取二级分类pid
        $pid_two=$cate_info_two['pid'];
        //查询当前所有的二级分类
        $cate_two=\app\admin\model\Category::where('pid',$pid_two)->select();
        //查询所有一级分类数据
        $cate_one=\app\admin\model\Category::where('pid',0)->select();


        //查询商品属性
        //提取商品类型
        $type_id=$goods->type_id;
        //查询所有的类型
        $type=\app\admin\model\Type::select();
        //查询商品属性
//        $goods_attr=\app\admin\model\Attribute::where('type_id',$type_id)->select();
//        $goods_attr=\app\admin\model\Goods_attr::where('goods_id',$id)->select();
        //查询相册图片
        $goods_pics=\app\admin\model\Goodspics::where('goods_id',$id)->select();
//    dump($type);die;

        //查询商品相册图片
        $picsdata=\app\admin\model\Goodspics::where('goods_id',$id)->select();
//        dump($picsdata);die;

        return view('update',[
            'goods'=>$goods,
            'type'=>$type,
            'type_id'=>$type_id,
            'goods_pics'=>$goods_pics,
            'cate_one'=>$cate_one,
            'cate_two'=>$cate_two,
            'cate_three'=>$cate_three,
            'cate_three_id'=>$cate_id,
            'cate_two_id'=>$pid_three,
            'cate_one_id'=>$pid_two,
            'picsdata'=>$picsdata,
        ]);
    }

    //修改并更新数据库
    public function edit()
    {
        //接收数据
        $data=request()->param();
//        dump($data);die;
        //收集并保存商品基本数据数据
        //收集goods表数据
        $goods_logo=$this->upload_pics();
        $goods=[
            'id'=>$data['goods_id'],
            'goods_name'=>$data['goods_name'],
            'goods_price'=>$data['goods_price'],
            'goods_number'=>$data['goods_number'],
            'goods_logo'=>$goods_logo,
            'cate_id'=>$data['cate_id'],
            'goods_introduce'=>$data['goods_introduce'],
        ];
        $result=\app\admin\model\Goods::update($goods);
        //提取商品
        $goods_id=$data['goods_id'];

        //添加并保存属性数据
//        dump($data['attr_values']);die;
        $where=['goods_id'=>$goods_id,
        ];
        \app\admin\model\Goods_attr::destroy($where);
        foreach($data['attr_values'] as $k=>$v){

            foreach($v as $a=>$b){
                //组装商品属性数据

                $goods_attr=[
                    'goods_id'=>$goods_id,
                    'attr_id'=>$k,
                    'attr_value'=>$b,
                ];
                //添加商品属性数据
                \app\admin\model\Goods_attr::create($goods_attr);

            }
        }
        $this->redirect('admin/goods/index');
    }

    //ajax异步删除商品
    public function goods_delete()
    {
        $id=request()->param('id');
//        dump($id);die;
        //删除商品信息数据
        $where=['id',$id];
        $result1=\app\admin\model\Goods::destroy($where);
        //删除相册数据
        $where=['goods_id'=>$id];
        $result2=\app\admin\model\Goodspics::destroy($where);
        //删除商品属性数据
        $where=['goods_id'=>$id];
        $result3=\app\admin\model\Goods_attr::destroy($where);
        if($result3||$result1||$result2){
            $res=['msg'=>'success'];
            return json($res);
        }else{
            return false;
        }
    }

}
