<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"D:\www\shangcheng\public/../application/admin\view\goods\index.html";i:1533469661;s:52:"D:\www\shangcheng\application\admin\view\layout.html";i:1532697794;}*/ ?>
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


<!--分页按钮样式-->
<style type="text/css">
    .pagination li{list-style:none;float:left;margin-left:10px;
        padding:0 10px;
        background-color:#5a98de;
        border:1px solid #ccc;
        height:26px;
        line-height:26px;
        cursor:pointer;color:#fff;
    }
    .pagination li a{color:white;padding: 0;line-height: inherit;border: none;}
    .pagination li a:hover{background-color: #5a98de;}
    .pagination li.active{background-color:white;color:gray;}
    .pagination li.disabled{background-color:white;color:gray;}
</style>
<script>
$(function(){
    $('.Goods_delete').click(function(){
        var id=$(this).closest('tr').attr('goods_id');
        alert(id);
        var _this=this;
        id='id='+id;

        $.ajax({
            'url':"<?php echo url('admin/goods/goods_delete'); ?>",
            'datatype':'json',
            'type':'post',
            'data':id,
            'success':function(res){
                if(res.msg=='success'){
                    $(_this).closest('tr').remove();
                }else{
                    alert('网络繁忙');
                }
            }
        });
    });
});


</script>
    <!-- 右 -->
    <div class="content">
        <div class="header">
            <h1 class="page-title">商品列表</h1>
        </div>

        <div class="well">
            <!-- search button -->
            <form action="" method="get" class="form-search">
                <div class="row-fluid" style="text-align: left;">
                    <div class="pull-left span4 unstyled">
                        <p> 商品名称：<input class="input-medium" name="" type="text"></p>
                    </div>
                </div>
                <button type="submit" class="btn">查找</button>
                <a class="btn btn-primary" href="<?php echo url('create'); ?>">新增</a>
            </form>
        </div>
        <div class="well">
            <!-- table -->
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th>编号</th>
                        <th>商品名称</th>
                        <th>商品价格</th>
                        <th>商品数量</th>
                        <th>商品logo</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($goodsdata as $k=>$v): ?>
                    <tr goods_id="<?php echo $v['id']; ?>" class="success">
                        <td><?php echo $k+1; ?></td>
                        <td><a href="javascript:void(0);"><?php echo $v['goods_name']; ?></a></td>
                        <td><?php echo $v['goods_price']; ?></td>
                        <td><?php echo $v['goods_number']; ?></td>
                        <td><img src="<?php echo $v['goods_logo']; ?>"></td>
                        <td><?php echo $v['create_time']; ?></td>
                        <td>
                            <a href="<?php echo url('update',['id'=>$v['id']]); ?>"> 编辑 </a>
                            <a href="javascript:void(0);" class="Goods_delete"> 删除 </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <!-- pagination -->
            <div class="pagination">
                <ul>
                    <?php echo $goodsdata->render(); ?>
                </ul>
            </div>
        </div>
        



<!-- footer -->
<footer>
    <hr>
    <p>© 2017 <a href="javascript:void(0);" target="_blank">ADMIN</a></p>
</footer>
</div>
</body>
</html>