<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>微警务后台管理系统</title>
    <link rel="stylesheet" href="/huzheng/Public/admincss/pintuer.css">
    <link rel="stylesheet" href="/huzheng/Public/admincss/admin.css">
    <script src="/huzheng/Public/adminjs/jquery.js"></script>
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
    <div class="logo margin-big-left fadein-top">
        <h1>
            <img src="/huzheng/Public/adminimg/logo.png" height="50" alt="" />
        </h1>
    </div>
    <div class="head-l">
        <a href="<?php echo U('admin/main/index');?>" class="button button-little bg-green">
            <span class="icon-home"></span> 后台首页</a>
        &nbsp;&nbsp;
        <a href="<?php echo U('admin/main/ziliaoxiugai');?>" target="right" class="button button-little bg-blue">
            <span class="icon-wrench"></span> 用户信息</a>
        &nbsp;&nbsp;
        <a href="<?php echo U('admin/login/loginout');?>" class="button button-little bg-red" >
            <span class="icon-power-off"></span> 退出登录</a>
    </div>
</div>
<div class="leftnav">
    <div class="leftnav-title">
        <strong>
            <span class="icon-list"></span>菜单列表
        </strong>
    </div>
    <?php if(is_array($left)): foreach($left as $k=>$v): ?><h2><span class="<?php echo ($v["tubiao"]); ?>"></span><?php echo ($v["biaoti"]); ?></h2>
    <ul>
        <?php if(is_array($left1[$v['id']])): foreach($left1[$v['id']] as $key=>$vv): ?><li><a href="<?php echo ($vv["url"]); ?>" target="right"><span class="icon-caret-right"></span><?php echo ($vv["biaoti"]); ?></a></li><?php endforeach; endif; ?>
    </ul><?php endforeach; endif; ?>
</div>
<script type="text/javascript">
    $(function(){
        $(".leftnav h2").click(function(){
            $(this).next().slideToggle(200);
            $(this).toggleClass("on");
        })
        $(".leftnav ul li a").click(function(){
            $("#a_leader_txt").text($(this).text());
            $(".leftnav ul li a").removeClass("on");
            $(this).addClass("on");
        })
    });
</script>
<ul class="bread">
    <li><a href="<?php echo U('admin/main/tongji');?>" target="right" class="icon-home"> 首页</a></li>
    <li><a href="##" id="a_leader_txt">网站信息</a></li>
</ul>
<div class="admin">
    <iframe scrolling="auto" rameborder="0" src="<?php echo U('admin/main/tongji');?>" name="right" width="100%" height="100%"></iframe>
</div>
<div style="text-align:center;">
    <p>Copyright &copy; 2017.Company name All rights reserved.<a target="_blank">盐城市公安微警务</a></p>
</div>
</body>
</html>