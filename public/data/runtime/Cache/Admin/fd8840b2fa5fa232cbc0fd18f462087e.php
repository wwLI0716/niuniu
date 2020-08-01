<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>微警务后台登录系统</title>
    <link href="/huzheng/Public/admincss/login.css" rel="stylesheet" rev="stylesheet" type="text/css" media="all" />
    <link href="/huzheng/Public/admincss/demo.css" rel="stylesheet" rev="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="/huzheng/Public/adminjs/jquery1.42.min.js"></script>
    <script type="text/javascript" src="/huzheng/Public/adminjs/jquery.SuperSlide.js"></script>
    <script type="text/javascript" src="/huzheng/Public/adminjs/Validform_v5.3.2_min.js"></script>

    <script>
        $(function(){
            $(".registerform").Validform({
                tiptype:function(msg,o,cssctl){
                    var objtip=$(".error-box");
                    cssctl(objtip,o.type);
                    objtip.text(msg);
                },
            });
        });
    </script>
</head>

<body>

<div class="header">
    <h1 class="headerLogo"><img alt="logo" src="/huzheng/Public/adminimg/logo.gif"></h1>
    <div class="headerNav">
        一指风行 平安相随
    </div>
</div>

<div class="banner">

    <div class="login-aside">
        <div id="o-box-up"></div>
        <div id="o-box-down"  style="table-layout:fixed;">
            <div class="error-box"></div>

            <form class="registerform" action="<?php echo U('admin/login/index',array('bianji'=>'denglu'),'html');?>" name="from" method="post" enctype="multipart/form-data">
                <div class="fm-item">
                    <label for="logonId" class="form-label">帐号：</label>
                    <input type="text" placeholder="输入帐号" maxlength="100" name="username" id="username" class="i-text"  datatype="s5-18" nullmsg="请设置帐号！" errormsg="帐号至少5个字符,最多18个字符！"  >
                    <div class="ui-form-explain"></div>
                </div>

                <div class="fm-item">
                    <label for="logonId" class="form-label">密　码：</label>
                    <input type="password"　placeholder="输入密码"  maxlength="100" name="password" id="password" class="i-text" datatype="*1-16" nullmsg="请设置密码！" errormsg="密码范围在1~16位之间！">
                    <div class="ui-form-explain"></div>
                </div>

                <div class="fm-item pos-r">
                    <label for="logonId" class="form-label">验证码</label>
                    <input type="text" placeholder="输入验证码" maxlength="100" name="yzm" id="yzm" class="i-text yzm" datatype="s4-4"  nullmsg="请输入验证码！" errormsg="请输入4位验证码！">
                    <div class="ui-form-explain">
                        <script language="javascript">
                            function changeImg(){
                                var vcode=$("#yanzheng");
                                vcode.attr("src","<?php echo U('admin/login/yanzhengma');?>?temp=Math.random()");
                            }
                        </script>
                        <a href="javascript:changeImg();" title="点击刷新验证码">
                            <img src="<?php echo U('admin/login/yanzhengma');?>" id="yanzheng" class="yzm-img" />
                        </a>
                    </div>
                </div>

                <div class="fm-item">
                    <label for="logonId" class="form-label"></label>
                    <input type="submit" value="" tabindex="4" id="send-btn" class="btn-login">
                    <div class="ui-form-explain"></div>
                </div>

            </form>

        </div>

    </div>

    <div class="bd">
        <ul>
            <li style="background:url(/huzheng/Public/adminimg/theme-pic1.jpg) #CCE1F3 center 0 no-repeat;"><a></a></li>
            </li>
        </ul>
    </div>

    <div class="hd"><ul></ul></div>
</div>
<div class="banner-shadow"></div>

<div class="footer">
    <p>Copyright &copy; 2017.Company name All rights reserved.<a target="_blank">盐城市公安微警务</a></p>
</div>
</body>
</html>