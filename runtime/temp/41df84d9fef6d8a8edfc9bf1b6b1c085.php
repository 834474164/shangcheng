<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"D:\www\shangcheng\public/../application/admin\view\auth\save.html";i:1532064587;s:52:"D:\www\shangcheng\application\admin\view\layout.html";i:1532697794;}*/ ?>
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



    <!-- 右 -->
    <div class="content">
        <div class="header">
            <h1 class="page-title">权限新增</h1>
        </div>

        <div class="well">
            <!-- add form -->
            <form id="tab" action="<?php echo url('add'); ?>" method="post">
                <label>权限名称：</label>
                <input type="text" name="auth_name" value="" class="input-xlarge">
                <label>上级权限</label>
                <select name="pid" class="input-xlarge">
                    <option value="0">作为顶级权限</option>
                    <?php foreach($topauth  as $v): ?>
                    <option value="<?php echo $v['id']; ?>"><?php echo $v['auth_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div>
                    <label>控制器：</label>
                    <input type="text" name="auth_c" value="" class="input-xlarge">
                </div>
                <div>
                    <label>方法：</label>
                    <input type="text" name="auth_a" value="" class="input-xlarge">
                </div>
                <label>是否菜单项</label>
                <select name="is_nav" class="input-xlarge">
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>

                <label></label>
                <button class="btn btn-primary" type="submit">保存</button>
            </form>
        </div>

    <script>
        $(function(){
            $("input[name=auth_c]").parent().hide();
            $("input[name=auth_a]").parent().hide();
            $("select[name=pid]").on('change', function(){
                if($(this).val() != 0){
                    $("input[name=auth_c]").parent().show();
                    $("input[name=auth_a]").parent().show();
                }else{
                    $("input[name=auth_c]").parent().hide();
                    $("input[name=auth_a]").parent().hide();
                }
            });
        })
    </script>



<!-- footer -->
<footer>
    <hr>
    <p>© 2017 <a href="javascript:void(0);" target="_blank">ADMIN</a></p>
</footer>
</div>
</body>
</html>