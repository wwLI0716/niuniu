<?php /*a:2:{s:77:"/www/wwwroot/rent.niuguagua.com/application/index/view/login/first_login.html";i:1578304991;s:73:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/header.html";i:1564665268;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>ANTTRADE</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="/wap//css/bootstrap.d59729439a20.css">
    <link rel="stylesheet" href="/wap//css/master_style.45157f3d858b.css">
    <link rel="stylesheet" href="/wap//css/layer.css">
    <link rel="stylesheet" href="/wap//css/general.06bf784cb4f7.css">
    <script src="/wap//js/jquery.min.473957cfb255.js" type="text/javascript"></script>
    <script src="/wap//js/common.js" type="text/javascript"></script>
    <script src="/wap//js/layer.js" type="text/javascript"></script>
</head>
<body class="hold-transition login-page">
<link rel="stylesheet" type="text/css" href="/web/font/iconfont.css">
<style>
#slide_box {
    width: 100%;
    height: 42px;
    text-align: center;
    line-height: 42px;
    font-size: 14px;
    color: #717171;
    background-color: #e8e8e8;
    border: none;
    margin-bottom: 20px;
}

#slide_xbox {
    width: 50px;
    height: 42px;
    text-align: center;
    line-height: 42px;
    font-size: 16px;
    color: #fff;
    position: absolute;
    background: #1E9FFF;
}

#btn {
    cursor: pointer;
    width: 50px;
    height: 42px;
    background-color: #fff;
    float: right;
    -webkit-box-shadow: 0px 0px 15px 0px #ddd;
    -moz-box-shadow: 0px 0px 15px 0px #ddd;
    box-shadow: 0px 0px 15px 0px #ddd;
    color: #8a8c97;

}

#btn > .iconfont {
    font-size: 20px;
}
#slide_box{
    position: relative;
}
.sendCode {
    width: auto;
    padding: 0.3rem 1rem;
    position: relative;
    top: -1px;
    max-width: 30%;
}
#code {
    max-width: 65%;
}
#code, .sendCode {
    display: inline-block;
}
</style>
<div class="login-box">
    <div class="register-logo">
        <img src="/wap//picture/logo.png" class="img-responsive" alt="">
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">已绑定手机号<br /><span id="mobleNb"><?php echo htmlentities($checkUserMoble); ?></span></p>
        <form id="id-form-login" method="post" class="form-element form-register">
            <input type="hidden" name="__token__" value="<?php echo htmlentities(app('request')->token()); ?>" />
            <div class="form-group">
                <label style="display: block;" class="control-label" for="code">验证码</label>
                <input type="text" name="auth-username" value="" autofocus maxlength="254" class="form-control" id="code" placeholder="请输入验证码" required />
                <input class="btn btn-block btn-primary btn-lg sendCode" value="发送" readonly="">
            </div>
            <div class="form-group">
                <label class="control-label" for="id_password">新密码</label>
                <input type="password" name="auth-password" value="" class="form-control" placeholder="请输入新密码" title="" required id="id_password" />
            </div>
            <div class="form-group">
                <label class="control-label" for="id_repeat_password">确认新密码</label>
                <input type="password" name="auth-password" value="" class="form-control" placeholder="请确认新密码" title="" required id="id_repeat_password" />
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <input class="btn btn-info btn-register btn-block margin-top-10 login" data-send-href="<?php echo url('firstLoginSubmit'); ?>" value="确认" readonly />
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
function countdown(s, sendObj,content) {
    s--;
    if (s == 0) {
        sendObj.attr('value',content);
    } else {
        sendObj.attr('value',s + 's');
        setTimeout(function() {
            countdown(s, sendObj,content)
        }, 1000)
    }
}
var locked = false;
window.onload = function () {
    slide();
    /*$("*").keydown(function (e) {
        e = window.event || e || e.which;
        if (e.keyCode == 123) {
            e.keyCode = 0;
            return false;
        }
    });*/
    $(document).bind("contextmenu",function(e){
        return false;
    });
}
window.onresize = function () {
    if(locked==true){
        var boxWidth = $('#slide_box').width();
        $('#slide_xbox').width(boxWidth);
    }else{
        slide();
    }
}
</script>
<script>
$(function(){
    var sendStatus = 0;
    $("body").on("click", ".sendCode", function () {
        if(sendStatus == 1)
        {
            layer.msg("<?php echo lang('do_click_again'); ?>",{time: 2000})
            return false;
        }
        let that = $(this);
        if(that.val() != '<?php echo lang("send"); ?>')
        {
            return false;
        }
        let token = $("input[ name='__token__']").val();
        if(token == '')
        {
            // layer.open({
            //     content: "<?php echo lang('complete_the_parameters'); ?>"
            //     ,skin: 'msg'
            //     ,time: 2 //2秒后自动关闭
            // });
            layer.msg("<?php echo lang('complete_the_parameters'); ?>",{time: 2000})

            return false;
        }
        let lang = 'zh-ch';
        var senData = {
            token : token,
            status : 1,
            lang : lang,
            moble : $('#mobleNb').html()
        };
        sendStatus = 1;
        $.post("<?php echo url('Login/sendUserCode'); ?>",senData,
            function(res){
                var res = JSON.parse(res);
                // layer.open({
                //     content: res.info
                //     ,skin: 'msg'
                //     ,type:1
                //     ,time: 2 //2秒后自动关闭
                // });
                layer.msg(res.info,{time: 2000},function(){
                    countdown(60, that,that.val());
                    sendStatus = 0;
                })
            });
    });

    $('.login').click(function(){
        let token = $("input[ name='__token__']").val();
        let code = $("#code").val();
        let password = $("#id_password").val();
        let repeatPassword = $("#id_repeat_password").val();
        if(token == '' || code == '' || password == '' || repeatPassword == '')
        {
            layer.msg("<?php echo lang('complete_the_parameters'); ?>", {time: 2000});
            return false;
        }
        if(password != repeatPassword)
        {
            layer.msg("两次输入的密码不一致!", {time: 2000});
            return false;
        }
        let lang = 'zh-ch';
        if(getCookie('language'))
        {
            lang = getCookie('language');
        }
        var senData = {
            token : token,
            code : code,
            password : password,
            repeatPassword : repeatPassword,
            lang : lang,
        };
        layer.open({
            type: 3,
            skin: 'loading_style'
        })
        $.post($(this).attr('data-send-href'),senData,
            function(res){
                var res = JSON.parse(res);
                setTimeout(function(){
                    layer.closeAll();
                    layer.msg(res.info, {time: 2000})
                    if(res.code == 200)
                    {
                        return;
                    }else if(res.code == 600) {
                        setTimeout(function(){ window.location.href="<?php echo url('Login/login'); ?>";},2000);
                    } else {
                        setTimeout(function(){ window.location.href="<?php echo url('Index/index'); ?>";},2000);
                    }
                },500);
            });
    });
})
</script>
</body>
</html>