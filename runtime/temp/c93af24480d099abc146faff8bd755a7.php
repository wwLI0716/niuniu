<?php /*a:2:{s:71:"/www/wwwroot/rent.niuguagua.com/application/index/view/login/login.html";i:1578288277;s:73:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/header.html";i:1564665268;}*/ ?>
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
</style>
<div class="login-box">
    <div class="register-logo">
        <img src="/wap//picture/logo.png" class="img-responsive" alt="">
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><?php echo lang('login'); ?></p>
        <form id="id-form-login" method="post" class="form-element form-register">
            <input type="hidden" name="__token__" value="<?php echo htmlentities(app('request')->token()); ?>" />
            <div class="form-group">
                <label class="control-label" for="id_auth-username"><?php echo lang('mobile'); ?></label>
                <input type="text" name="auth-username" value="" autofocus maxlength="254" class="form-control" placeholder="<?php echo lang('mobile'); ?>" title="" required id="id_auth-username" />
            </div>
            <div class="form-group">
                <label class="control-label" for="id_auth-password"><?php echo lang('password'); ?></label>
                <input type="password" name="auth-password" value="" class="form-control" placeholder="<?php echo lang('password'); ?>" title="" required id="id_auth-password" />
            </div>
            <div id="slide_box">
                <div id="slide_xbox">
                    <div id="btn">
                        <i class="iconfont icon-double-right"></i>
                        <img src="" alt="">
                    </div>
                </div>
                <?php echo lang('slide_validation'); ?>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <input class="btn btn-info btn-register btn-block margin-top-10 login" data-send-href="<?php echo url('loginSubmit'); ?>" value="<?php echo lang('login'); ?>" readonly />
                </div>
            </div>
        </form>
        <div class=" row margin-top-20 text-center">
            <p class="col-6" style="text-align: left;"><a class="link-login" data-href="<?php echo url('forgetloginpwd'); ?>" data-parameter=""><?php echo lang('forget_password'); ?></a></p>
        </div>
    </div>
</div>
<script type="text/javascript">
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
//滑动解锁移动
function slide() {
    var slideBox = $('#slide_box')[0];
    var slideXbox = $('#slide_xbox')[0];
    var btn = $('#btn')[0];
    var slideBoxWidth = slideBox.offsetWidth;
    var btnWidth = btn.offsetWidth;
    //pc端
    btn.ondragstart = function () {
        return false;
    };
    btn.onselectstart = function () {
        return false;
    };
    btn.onmousedown = function (e) {
        var disX = e.clientX - btn.offsetLeft;
        document.onmousemove = function (e) {
            var objX = e.clientX - disX + btnWidth;
            if (objX < btnWidth) {
                objX = btnWidth
            }
            if (objX > slideBoxWidth) {
                objX = slideBoxWidth
            }
            $('#slide_xbox').width(objX + 'px');
        };
        document.onmouseup = function (e) {
            var objX = e.clientX - disX + btnWidth;
            if (objX < slideBoxWidth) {
                objX = btnWidth;
            } else {
                objX = slideBoxWidth;
                locked = true;
                $('#slide_xbox').html('<?php echo lang("check_success"); ?><div id="btn"><i class="iconfont icon-xuanzhong" style="color: #35b34a;"></i></div>');
            }
            $('#slide_xbox').width(objX + 'px');
            document.onmousemove = null;
            document.onmouseup = null;
        };
    };
    //移动端
    var cont = $("#btn");
    var startX = 0, sX = 0, moveX = 0,leftX = 0;
    cont.on({
        touchstart: function (e) {
            startX = e.originalEvent.targetTouches[0].pageX;//获取点击点的X坐标
            sX = $(this).offset().left;//相对于当前窗口X轴的偏移量
            leftX = startX - sX;//鼠标所能移动的最左端是当前鼠标距div左边距的位置
        },
        touchmove: function (e) {
            e.preventDefault();
            moveX = e.originalEvent.targetTouches[0].pageX;//移动过程中X轴的坐标
            var objX = moveX - leftX + btnWidth;
            if (objX < btnWidth) {
                objX = btnWidth
            }
            if (objX > slideBoxWidth) {
                objX = slideBoxWidth
            }
            $('#slide_xbox').width(objX + 'px');
        },
        touchend: function (e) {
            var objX = moveX - leftX + btnWidth;
            if (objX < slideBoxWidth) {
                objX = btnWidth;
            } else {
                objX = slideBoxWidth;
                locked = true;
                $('#slide_xbox').html('<?php echo lang("check_success"); ?><div id="btn"><i class="iconfont icon-xuanzhong" style="color: #35b34a;"></i></div>');
            }
            $('#slide_xbox').width(objX + 'px');
        }
    });
}
</script>
<script>
$(function(){

    if(getCookie('language') && getCookie('language') != '')
    {
        var language = getCookie('language');
    } else {
        var language = 'zh-ch';
    }
    $('.checkLanguage option').each(function(){
       if($(this).val() == language)
       {
           $(this).attr("selected",true);
       }
    });

    $('.login').click(function(){
        if(locked == false)
        {
            // layer.open({
            //     content: "<?php echo lang('slide_validation'); ?>"
            //     ,skin: 'msg'
            //     ,time: 2 //2秒后自动关闭
            // });
            layer.msg("<?php echo lang('slide_validation'); ?>", {time: 2000})
            return false;
        }
        let token = $("input[ name='__token__']").val();
        let name = $("input[ name='auth-username']").val();
        let password = $("input[ name='auth-password']").val();
        if(token == '' || name == '' || password == '')
        {
            // layer.open({
            //     content: "<?php echo lang('complete_the_parameters'); ?>"
            //     ,skin: 'msg'
            //     ,time: 2 //2秒后自动关闭
            // });
            layer.msg("<?php echo lang('complete_the_parameters'); ?>", {time: 2000})

            return false;
        }
        let lang = 'zh-ch';
        if(getCookie('language'))
        {
            lang = getCookie('language');
        }
        var senData = {
            token : token,
            name : name,
            password : password,
            lang : lang,
        };
        // layer.open({
        //     type: 2
        //     ,content: '<?php echo lang("sending_data"); ?>'
        // });
        layer.open({
            type: 3,
            skin: 'loading_style'
            // content: '<?php echo lang("sending_data"); ?>'
        })
        $.post($(this).attr('data-send-href'),senData,
            function(res){
                var res = JSON.parse(res);
                setTimeout(function(){
                    layer.closeAll();
                    // layer.open({
                    //     content: res.info
                    //     ,skin: 'msg'
                    //     ,time: 2 //2秒后自动关闭
                    // });
                    layer.msg(res.info, {time: 2000})
                    if(res.code == 200)
                    {
                        setTimeout(function(){ window.location.reload();},2000);
                    }else if(res.code == 600) {
                        setTimeout(function(){ window.location.href="<?php echo url('login/firstLogin'); ?>";},2000);
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