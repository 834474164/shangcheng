<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        //查询分类列表信息
        $cates=\app\admin\model\Category::select();
        $cates=(new\think\Collection($cates))->toArray();
        $cates=get_cate_tree($cates);
        $this->assign('cates',$cates);
    }

}
