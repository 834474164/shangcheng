<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\www\shangcheng\public/../application/admin\view\goods\update.html";i:1533465947;s:52:"D:\www\shangcheng\application\admin\view\layout.html";i:1532697794;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo config('admin_css'); ?>main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo config('admin_css'); ?>bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo config('admin_css'); ?>bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo config('admin_js'); ?>jquery-1.8.1.min.js"></script>
    <script src="<?php echo config('admin_js'); ?>bootstrap.min.js"></script>
</head>
<body>
<!-- 上 -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <ul class="nav pull-right">
                <li id="fat-menu" class="dropdown">
                    <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user icon-white"></i> admin
                        <i class="icon-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="javascript:void(0);">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="<?php echo url('admin/login/logout'); ?>">安全退出</a></li>
                    </ul>
                </li>
            </ul>
            <a class="brand" href="index.html"><span class="first">后台管理系统</span></a>
            <ul class="nav">
                <li class="active"><a href="javascript:void(0);">首页</a></li>
                <li><a href="javascript:void(0);">系统管理</a></li>
                <li><a href="javascript:void(0);">权限管理</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 左 -->
<div class="sidebar-nav">
    <?php foreach($top_nav as $k=>$top): ?>
        <a href="#error-menu<?php echo $k; ?>" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i><?php echo $top['auth_name']; ?></a>
        <ul id="error-menu<?php echo $k; ?>" class="nav nav-list collapse">
                    <?php foreach($second_nav as $second): if(($top['id'] == $second['pid'])): ?><li><a href="<?php echo url($second['auth_c'].'/'.$second['auth_a']); ?>"><?php echo $second['auth_name']; ?></a></li><?php endif; endforeach; ?>
        </ul>
    <?php endforeach; ?>
</div>


<script>
    $(function(){
        //一级分类菜单绑定change事件
        $('#category_one').change(function(){
            var id_cate_one=$('#category_one').val();
            $.ajax({
                'url':"<?php echo url('category/select_two'); ?>",
                'datatype':'json',
                'type':'post',
                'data':'id='+id_cate_one,
                'success':function(res){
                    $('#category_two').html('<option value="">请选择二级分类</option>');
                    var str='<option value="">请选择二级分类</option>';
                    $.each(res.category_two,function(i,j){
                        str+="<option value=\""+j['id']+"\">"+j['cate_name']+"</option>";
                    });
                    $('#category_two').html(str);
                }
            });
        });


        //二级分类绑定change事件
        $('#category_two').change(function(){
            var id_cate_two=$('#category_two').val();
            $.ajax({
                'url':"<?php echo url('category/select_three'); ?>",
                'datatype':'json',
                'type':'post',
                'data':'id='+id_cate_two,
                'success':function(res){
                    $('#category_three').html('<option value="">请选择三级分类</option>');
                    var str='<option value="">请选择三级分类</option>';
                    $.each(res.category_three,function(i,j){
                        str+="<option value=\""+j['id']+"\">"+j['cate_name']+"</option>";
                    });
                    $('#category_three').html(str);
                }
            });
        });


        //显示当前商品的属性
        var type_id=$('#type_name').val();
        var goods_id=$('#goodsId').val();
        var data={'type_id':type_id,'goods_id':goods_id};
        $.ajax({
            'url':"<?php echo url('attribute/select_attribute_edit'); ?>",
            'data':data,
            'datatype':'json',
            'type':'post',
            'success':function(res){

                if(res.msg=='success'){

                    var str='';
                    $.each(res.data,function(i,v){

                        if(v['attr_input_type']==0){
                            str+="<label>"+v['attr_name']+"</label>";
                            str+="<input type=\"text\" name=\"attr_values["+v['id']+"][]\" placeholder=\""+v['attr_values']+"\" class=\"input-xlarge\" value='"+res.attr_str[v['id']]+"'><br/>";

                        }else if(v['attr_input_type']==1){
                            str+="<label>"+v['attr_name']+"</label>";
                            str+='<select name="attr_values['+v['id']+'][]">';
                            var attrs=v['attr_values'].split(',');
                            $.each(attrs,function(a,b){
                                if(b==res.attr_str[v['id']]){
                                    str+="<option selected='selected' value='"+b+"'>"+b+"</option>";
                                }else{
                                    str+="<option value='"+b+"'>"+b+"</option>";
                                }

                            });
                            str+='</select><br/>';
                        }else if(v['attr_input_type']==2){
                            var attra=v['attr_values'].split(',');
                            str+="<label>"+v['attr_name']+"</label>";
                            $.each(attra,function(c,d){
                                console.log(res.attr_str[v['id']]);
                                if(!($.inArray(d,res.attr_str[v['id']])===false)){
                                    str+="<input checked='checked' type='checkbox' name='attr_values["+v['id']+"][]' value='"+d+"'/>"+d;
                                }else{
                                    str+="<input type='checkbox' name='attr_values["+v['id']+"][]' value='"+d+"'/>"+d;
                                }

                            });
                            str+="<br/>";

                        }

                    });

                    $('#box').html(str);
                }
            }

        });
        //商品类型绑定change事件
        $('#type_name').change(function(){

            var type_id=$(this).val();
            var data={'type_id':type_id};
            $.ajax({
                'url':"<?php echo url('attribute/select_attribute'); ?>",
                'data':data,
                'datatype':'json',
                'type':'post',
                'success':function(res){

                    if(res.msg=='success'){

                        var str='';
                        $.each(res.data,function(i,v){

                            if(v['attr_input_type']==0){
                                str+="<label>"+v['attr_name']+"</label>";
                                str+="<input type=\"text\" name=\"attr_values["+v['id']+"][]\" placeholder=\""+v['attr_values']+"\" class=\"input-xlarge\"><br/>";

                            }else if(v['attr_input_type']==1){
                                str+="<label>"+v['attr_name']+"</label>";
                                str+='<select name="attr_values['+v['id']+'][]">';
                                var attrs=v['attr_values'].split(',');
                                $.each(attrs,function(a,b){
                                    str+="<option value='"+b+"'>"+b+"</option>"
                                });
                                str+='</select><br/>';
                            }else if(v['attr_input_type']==2){
                                var attra=v['attr_values'].split(',');
                                str+="<label>"+v['attr_name']+"</label>";
                                $.each(attra,function(c,d){
                                    str+="<input type='checkbox' name='attr_values["+v['id']+"][]' value='"+d+"'/>"+d+"";
                                });
                                str+="<br/>";

                            }

                        });

                        $('#box').html(str);
                    }
                }

            });


        });

        //给加号绑定点击事件
        $('.add').click(function(){
            var add_div="<div>[<a href=\"javascript:void(0);\" class=\"sub\">-</a>]商品图片：<input type=\"file\" name=\"goods_pics[]\" value=\"\" class=\"input-xlarge\"></div>";
            $(this).parent().after(add_div);
        });
        //给减号绑定点击事件
        $('.sub').live('click',function(){
            $(this).parent().remove();
        });

        //删除相册
        //给删除按钮绑定点击事件
        $('.picsdelete').click(function(){
            //拿到相册id
            var id=$(this).closest('div').attr('picsid');
            var data='id='+id;
            var _this=this;
            //发送ajax请求
            $.ajax({
                'url':"<?php echo url('admin/goodspics/delete'); ?>",
                'data':data,
                'datatype':'json',
                'type':'post',
                'success':function(res){
                    if(res.msg=='success'){
                        $(_this).closest('div').remove();
                    }
                }
            });

           });





    });
</script>
    <!-- 右 -->
    <div class="content">
        <div class="header">
            <h1 class="page-title">商品编辑</h1>
        </div>
        
        <!-- edit form -->
        <form action="<?php echo url('edit'); ?>" method="post" id="tab" enctype="multipart/form-data">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="#basic" data-toggle="tab">基本信息</a></li>
              <li role="presentation"><a href="#desc" data-toggle="tab">商品描述</a></li>
              <li role="presentation"><a href="#attr" data-toggle="tab">商品属性</a></li>
              <li role="presentation"><a href="#pics" data-toggle="tab">商品相册</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="basic">
                    <div class="well">
                        <label>商品名称：</label>
                        <input type="text" name="goods_name" value="<?php echo $goods['goods_name']; ?>" class="input-xlarge">
                        <label>商品价格：</label>
                        <input type="text" name="goods_price" value="<?php echo $goods['goods_price']; ?>" class="input-xlarge">
                        <label>商品数量：</label>
                        <input type="text" name="goods_number" value="<?php echo $goods['goods_number']; ?>" class="input-xlarge">
                        <label>商品logo：</label>
                        <img src="<?php echo $goods['goods_logo']; ?>" alt="商品图片">
                        <input type="file" name="goods_logo" value="" class="input-xlarge">
                        <label>商品分类：</label>
                        <select name="" class="input-xlarge" id="category_one">
                            <option value="">请选择一级分类</option>
                            <?php foreach($cate_one as $v): ?>
                            <option value="<?php echo $v['id']; ?>" <?php if(($v['id'] == $cate_one_id)): ?>selected="selected"<?php endif; ?>><?php echo $v['cate_name']; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <select name="" class="input-xlarge" id="category_two">
                            <option value="">请选择二级分类</option>
                            <?php foreach($cate_two as $v): ?>
                            <option value="<?php echo $v['id']; ?>" <?php if(($v['id'] == $cate_two_id)): ?>selected="selected"<?php endif; ?>><?php echo $v['cate_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="cate_id" class="input-xlarge" id="category_three">
                            <option value="">请选择三级分类</option>
                            <?php foreach($cate_three as $v): ?>
                            <option value="<?php echo $v['id']; ?>"<?php if(($v['id'] == $cate_three_id)): ?>selected="selected"<?php endif; ?>><?php echo $v['cate_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!--加入富文本编辑器插件-->
                <script src="/plugins/ueditor/ueditor.config.js"></script>
                <script src="/plugins/ueditor/ueditor.all.min.js"></script>
                <script src="/plugins/ueditor/lang/zh-cn/zh-cn.js"></script>
                <div class="tab-pane fade in" id="desc">
                    <div class="well">
                        <label>商品简介：</label>
                        <textarea id="ueditor" style="width:500px;" value="Smith" name="goods_introduce" rows="3" class="input-xlarge"><?php echo $goods['goods_introduce']; ?></textarea>
                    </div>
                </div>
                <div class="tab-pane fade in" id="attr">
                    <div class="well">
                        <input type="hidden" name="goods_id" value="<?php echo $goods['id']; ?>" id="goodsId">
                        <label>商品类型：</label>
                        <select name="type_id" class="input-xlarge" id="type_name">
                            <?php foreach($type as $v): ?>

                            <option value="<?php echo $v['id']; ?>" <?php if(($v['id'] == $type_id)): ?>selected="selected"<?php endif; ?>><?php echo $v['type_name']; ?></option>

                            <?php endforeach; ?>
                        </select>
                        <div id="box">
                    <!--属性显示-->
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade in" id="pics">
                    <!--插入商品相册图片-->
                    <?php foreach($picsdata as $v): ?>
                    <div picsid="<?php echo $v['id']; ?>">
                        <img src="<?php echo $v['pics_sma']; ?>">
                        <a class="picsdelete" src="javascript:;">删除</a>
                    </div>
                    <?php endforeach; ?>
                    <div class="well">
                            <div>[<a href="javascript:void(0);" class="add">+</a>]商品图片：<input type="file" name="goods_pics[]" value="" class="input-xlarge"></div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">保存</button>
            </div>
        </form>

    <script type="text/javascript">
        $(function(){
            $('.add').click(function(){
                var add_div = '<div>[<a href="javascript:void(0);" class="sub">-</a>]商品图片：<input type="file" name="goods_pics[]" value="" class="input-xlarge"></div>';
                $(this).parent().after(add_div);
            });
            $('.sub').live('click',function(){
                $(this).parent().remove();
            });


            UE.getEditor('ueditor');

        });
    </script>



<!-- footer -->
<footer>
    <hr>
    <p>© 2017 <a href="javascript:void(0);" target="_blank">ADMIN</a></p>
</footer>
</div>
</body>
</html>