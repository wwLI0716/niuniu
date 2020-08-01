<?php /*a:2:{s:80:"/www/wwwroot/rent.niuguagua.com/application/index/view/login/forgetloginpwd.html";i:1578270762;s:73:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/header.html";i:1564665268;}*/ ?>
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
<div class="login-box">
    <div class="register-logo">
        <img src="/wap//picture/logo.png" class="img-responsive" alt="">
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><?php echo lang('forget_pw'); ?></p>
        <form id="id-form-login" method="post" class="form-element form-register">
            <input type="hidden" name="__token__" value="<?php echo htmlentities(app('request')->token()); ?>" />
            <div class="form-group">
                <label class="control-label" for="id_auth-username"><?php echo lang('username'); ?></label>
                <input type="text" name="auth-username" autofocus maxlength="254" class="form-control" placeholder="<?php echo lang('username'); ?>" title="" required id="id_auth-username" />
            </div>
            <div class="form-group">
                <label class="control-label" for="id_auth-password"><?php echo lang('email'); ?></label>
                <input type="email" name="auth-email" class="form-control" placeholder="<?php echo lang('email'); ?>" title="" required id="id_auth-password" />
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <input class="btn btn-info btn-register btn-block margin-top-10 login" readonly value="<?php echo lang('find_pw'); ?>" data-send-href="<?php echo url('findSubmit'); ?>" />
                </div>
            </div>
        </form>
        <div class=" row margin-top-20 text-center">
            <p class="col-6" style="text-align: left;"><a class="link-login" data-href="<?php echo url('login'); ?>" data-parameter=""><?php echo lang('login'); ?></a></p>
        </div>
    </div>
</div>
<style>
.loading_style{
    color: #fff;
}
</style>
<script>

    if(getCookie('language') && getCookie('language') != '')
    {
        var language = getCookie('language');
    } else {
        var language = 'zh-tw';
    }
    $('.checkLanguage option').each(function(){
        if($(this).val() == language)
        {
            $(this).attr("selected",true);
        }
    });

    $('.login').click(function(){
        let token = $("input[ name='__token__']").val();
        let name = $("input[ name='auth-username']").val();
        let email = $("input[ name='auth-email']").val();
        if(token == '' || name == '' || email == '')
        {
            // layer.open({
            //     content: "<?php echo lang('complete_the_parameters'); ?>"
            //     ,skin: 'msg'
            //     ,time: 2 //2秒后自动关闭
            // });
            layer.msg("<?php echo lang('complete_the_parameters'); ?>",{time:2000})
            return false;
        }
        if(!email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/))
        {
            // layer.open({
            //     content: "<?php echo lang('please_fill_in_the_correct_email_address'); ?>"
            //     ,skin: 'msg'
            //     ,time: 2 //2秒后自动关闭
            // });
            layer.msg("<?php echo lang('please_fill_in_the_correct_email_address'); ?>",{time:2000})

            return false;
        }
        let lang = 'zh-tw';
        if(getCookie('language'))
        {
            lang = getCookie('language');
        }
        var senData = {
            token : token,
            name : name,
            email : email,
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
                    layer.msg(res.info, {time: 2000}, function () {
                        if(res.code == 200)
                        {
                            window.location.reload();
                        } else {
                            window.location.href="<?php echo url('Login/login'); ?>";
                        }
                    })
                    // layer.open({
                    //     content: res.info
                    //     ,skin: 'msg'
                    //     ,time: 2 //2秒后自动关闭
                    // });
                    // if(res.code == 200)
                    // {
                    //     setTimeout(function(){ window.location.reload();},2000);
                    // } else {
                    //     setTimeout(function(){ window.location.href="<?php echo url('Login/login'); ?>";},2000);
                    // }
                },500);
            });
    });
</script>
</body>
</html>