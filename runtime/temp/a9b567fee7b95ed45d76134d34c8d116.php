<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"D:\www\shangcheng\public/../application/admin\view\auth\list.html";i:1532951402;s:52:"D:\www\shangcheng\application\admin\view\layout.html";i:1532697794;}*/ ?>
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
            <h1 class="page-title">权限列表</h1>
        </div>

        <div class="well">
            <a class="btn btn-primary" href="<?php echo url('save'); ?>">新增</a>
            <!-- table -->
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th>编号</th>
                        <th>权限名称</th>
                        <th>上级id</th>
                        <th>控制器</th>
                        <th>方法</th>
                        <th>是否菜单项</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($authdata as $k=>$v): ?>
                    <tr class="success">
                        <td><?php echo $k+1; ?></td>

                        <td><?php echo str_repeat('&emsp;',$v['level']*2); ?><?php echo $v['auth_name']; ?></td>
                        <td><?php echo $v['pid']; ?></td>
                        <td><?php echo $v['auth_c']; ?></td>
                        <td><?php echo $v['auth_a']; ?></td>
                        <td><?php echo $v['is_nav']; ?></td>
                        <td>
                            <a href="<?php echo url('edit',['id'=>$v['id']]); ?>"> 编辑 </a>
                            <a href="javascript:void(0);" onclick="if(confirm('确认删除？')) location.href='<?php echo url('auth/delete',['id'=>$v['id']]); ?>'"> 删除 </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>



<!-- footer -->
<footer>
    <hr>
    <p>© 2017 <a href="javascript:void(0);" target="_blank">ADMIN</a></p>
</footer>
</div>
</body>
</html>