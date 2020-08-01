<?php /*a:4:{s:97:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\user\person_info.html";i:1582013424;s:92:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\head.html";i:1585686692;s:92:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\left.html";i:1586613852;s:94:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\bottom.html";i:1579008100;}*/ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<title>ANTTRADE</title>
<link rel="stylesheet" href="/wap//iconfont/iconfont.css">
<link rel="stylesheet" href="/wap//css/bootstrap.d59729439a20.css">
<link rel="stylesheet" href="/wap//css/bootstrap-extend.0f113029eba9.css">
<link rel="stylesheet" href="/wap//css/master_style.45157f3d858b.css">
<link rel="stylesheet" href="/wap//css/general.06bf784cb4f7.css">
<link rel="stylesheet" href="/wap//css/_all-skins.663f7ae35658.css ">
<link rel="stylesheet" href="/wap//css/select2.min.4765adee4f66.css ">
<link rel="stylesheet" href="/wap//css/website.9576659c0ec6.css ">
<link rel="stylesheet" href="/wap//css/layer.css">
<link rel="stylesheet" href="/wap//css/cryptocoins.566b3ccd0c95.css">
<script src="/wap//js/jquery.min.473957cfb255.js" type="text/javascript"></script>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper page-dashboard">
<header class="main-header">
    <a href="/" class="logo">
        <span class="logo-lg">
            <img src="/wap//picture/logo.png" alt="logo" class="img-responsive light-logo"
                 style="max-width:140px;">
        </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <a href="#" class="iconfont icon_mulu" data-toggle="push-menu" role="button"></a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu spec-menu" style="position: relative">
                    <a href="javascript:void(0)" class="dropdown-toggle getA">
                    </a>
                </li>
                <li class="dropdown user user-menu" style="position: relative">
                    <a href="<?php echo url('news/lst'); ?>" class="dropdown-toggle">
                        <i class="iconfont icon_iconfont-yijianfankui-" style="margin-right: 0;font-size: 2.5rem;"></i>
                        <span class="showLogoTip">消息通知</span>
                    </a>
                    <?php if($noticeStatus == 1): ?>
                    <div class="red_icon"></div>
                    <?php endif; ?>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconfont icon_iconfont-xiugainicheng-" style="margin-right: 0;font-size: 2.5rem;"></i>
                        <span class="showLogoTip">个人中心</span>
                    </a>
                    <ul class="dropdown-menu scale-up">
                        <li class="user-body">
                            <div class="row no-gutters">
                                <div class="col-12 text-left col-12-spec">
                                    <a href="javascript:void(0)"><?php echo htmlentities($username); ?> / <?php echo htmlentities($userrole); ?></a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<style>
.red_icon {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: #ff0000;
    animation: opacityX 1s infinite;
}
.showLogoTip {
    font-size: .8rem;
}
@keyframes opacityX {
    0%{
        opacity: 100%;
    }
    50%{
        opacity: 0;
    }
    100%{
        opacity: 100%;
    }
}
</style>
<style>
    .layui-layer.layui-anim.layui-layer-dialog .layui-layer-content {
        color: #333;
    }
    .first_in_one a:not([href]):not([tabindex]).layui-layer-btn0,.first_in_two a:not([href]):not([tabindex]).layui-layer-btn0 {
        color: #fff;
    }
    .layui-layer.layui-anim.layui-layer-dialog .layui-layer-content{
        color: #333;
    }
    .layui-layer.layui-anim.layui-layer-dialog.layui-layer-msg .layui-layer-content{
        color: #fff;
    }
    .bottom-mulu {
        display: none;
    }
    .content-wrapper {
        margin-bottom: 5rem;
        padding-top: 0;
    }
    .content-header {
        margin-top: 2rem;
    }
    .page-dashboard {
        background-color: #f2f2f2 !important;
    }
    .breadcrumb {
        font-size: 1.5rem !important;
        padding-top: 0;
        padding-bottom: 0;
    }
    .spec-menu {
        display: none;
    }
    .bigger {
        font-weight: 900;
        font-size: 1.8rem;
    }
</style>
<link rel="stylesheet" href="/wap//css/adaption.css" media="screen and (max-width: 767px)">
<aside class="main-sidebar">
    <!-- sidebar -->
    <input type="hidden" name="__token__" value="<?php echo htmlentities(app('request')->token()); ?>" />
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="ulogo">
                <a href="/">
                    <!-- logo for regular state and mobile devices -->
                    <img src="/wap//picture/logo.png" class="img-responsive" alt="">
                </a>
            </div>
        </div>
        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="nav-devider"></li>
            <li>
                <a class="specialA" href="javascript:void(0);" data-href="<?php echo url('Index/index'); ?>" data-parameter="">
                    <i class="iconfont icon_iconfont-shouye"></i> <span><?php echo lang('home_page'); ?></span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="iconfont icon_iconfont-shezhitouxiang-"></i>
                    <span>审核</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="specialA" href="javascript:void(0);" data-href="<?php echo url('/Examine/showReleaseDemand'); ?>?status=2" data-parameter="">已审核</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="iconfont icon_iconfont-shangchuangtouxiang"></i>
                    <span>竞标</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="specialA" href="javascript:void(0);" data-href="<?php echo url('/Examine/showReleaseDemand'); ?>?status=2" data-parameter="">招标标书</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="iconfont icon_iconfont-shezhitouxiang-"></i>
                    <span>个人中心</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="specialA" href="javascript:void(0);" data-href="<?php echo url('User/personInfo'); ?>" data-parameter="">个人中心</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="iconfont icon_iconfont-baitang-"></i>
                    <span>反馈</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="specialA" href="javascript:void(0);" data-href="<?php echo url('Tools/membershipMessage'); ?>" data-parameter="">意见反馈</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="logout" href="javascript:void(0);">
                    <i class="iconfont icon_084tuichu"></i>
                    <span><?php echo lang('logout'); ?></span>
                </a>
            </li>
        </ul>
    </section>
</aside>
<script>
$(function(){
    var sendCheckForStatus = 0;
    if('<?php echo htmlentities($userStatus); ?>' == 0)
    {
        if('<?php echo htmlentities($checkText); ?>' == '')
        {
            let checkEmailTip = '<?php echo lang("check_email_true"); ?>';
            layer.open({
                content: checkEmailTip
                ,btn: '<?php echo lang("sure"); ?>',
                skin: 'first_in_one'
                ,yes: function(index){
                    if(sendCheckForStatus == 1)
                    {
                        layer.msg('<?php echo lang("do_click_again"); ?>');
                        return false;
                    }
                    let token = $("input[ name='__token__']").val();
                    let lang = 'zh-tw';
                    if(getCookie('language'))
                    {
                        lang = getCookie('language');
                    }
                    let senData = {
                        token : token,
                        lang : lang,
                    };
                    sendCheckForStatus = 1;
                    layer.open({
                        type: 3,
                        skin: 'loading_style'
                        // content: '<?php echo lang("sending_data"); ?>'
                    });
                    $.post("<?php echo url('/index/User/checkEmail'); ?>",senData,
                    function(res){
                        var res = JSON.parse(res);
                        setTimeout(function(){
                            layer.closeAll();
                            layer.open({
                                content: res.info
                                ,skin: 'msg'
                                ,time: 2 //2秒后自动关闭
                            });
                            sendCheckForStatus = 0;
                            setTimeout(function(){ window.location.reload();},2000);
                        },500);
                    });
                }
            });
        } else {
            let checkEmailTip = '<?php echo lang("check_email_true_already"); ?>';
            layer.open({
                skin: 'first_in_two',
                content: checkEmailTip
                ,btn: '<?php echo lang("sure"); ?>'
            });
        }
    }
});
</script>
<style xmlns="http://www.w3.org/1999/html">
    .index_message {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .index_message>div:first-child {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .index_message>div:first-child p {
        padding: 0;
        margin: 0;
    }

    .index_message p {
        padding: 0;
        margin: 0;
        line-height: 2rem;
    }

    .index_message p.p1 {
        font-weight: 700;
    }

    .index_message p.p3 {
        font-size: 18px;
        line-height: 32px;
        font-weight: 700;
        color: rgb(221, 127, 12);
    }

    .index_message p.p4 span:last-child {
        font-size: 16px;
        font-weight: 700;
        color: rgb(180, 132, 42);
    }
    .show-head {
        width: 3rem;
        margin-right: 1rem;
    }
    .table th, .table td {
        border-bottom: 1px solid #dee2e6;
        border-top: 0;
    }
    .logout-div {
        display: none;
    }
    .first-one {
        margin-top: 0;
    }
</style>
<div class="content-wrapper">
    <div class="content">
        <div class="row row_message">
            <div class="col-lg-12 col-md-12 margin-top-20 first-one">
                <a href="/">
                    <div class="index_message">
                        <div>
                            <img class="show-head" src="/images/logo-touming.png">
                            <div>
                                <p class="p1"><?php echo htmlentities($userrole); ?></p>
                                <p class="p2"><?php echo htmlentities($username); ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="box box-solid bg-black">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-container table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th class="orderable">
                                                <a href="/User/profile">
                                                    <i class="iconfont icon_iconfont-shezhitouxiang-"></i>密码修改
                                                </a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="orderable">
                                                <a href="/User/changeMoble">
                                                    <i class="iconfont icon_iconfont-shezhitouxiang-"></i>绑定手机
                                                </a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="orderable">
                                                <a href="/News/lst">
                                                    <i class="iconfont icon_iconfont-shezhitouxiang-"></i>消息通知
                                                </a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="orderable">
                                                <a href="/Tools/membershipMessage">
                                                    <i class="iconfont icon_iconfont-shezhitouxiang-"></i>意见反馈
                                                </a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="orderable">
                                                <a href="javascript:void(0)" class="showTips">
                                                    <i class="iconfont icon_iconfont-shezhitouxiang-"></i>版本更新
                                                </a>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row logout-div">
            <a class="logout" href="javascript:void(0);">退出登录</a>
        </div>
    </div>
</div>
</div>
<div class="bottom-mulu col-12">
    <ul class="bottom-mulu-ul col-12">
        <li>
            <i class="iconfont icon_iconfont-shouye"></i><br /><a href="/" data-url="Index">首页</a>
        </li>
        <li>
            <i class="iconfont icon_iconfont-xinxizhongxin-"></i><br /><a href="/Examine/showReleaseDemand?status=2"  data-url="Examine">已审核</a>
        </li>
        <li>
            <i class="iconfont icon_iconfont-xiugainicheng-"></i><br /><a href="/user/personInfo" data-url="User">我的</a>
        </li>
    </ul>
</div>
<script>
    $('.bottom-mulu-ul li').each(function () {
        if($(this).children('a').attr('data-url').toLowerCase() == '<?php echo htmlentities($pos); ?>'.toLowerCase())
        {
            $(this).addClass('on');
        }
    });
</script>
<!--   Core JS Files   -->
<script src="/wap//js/layer.js" type="text/javascript"></script>
<script src="/wap//js/common1.js" type="text/javascript"></script>
<script src="/wap//js/bootstrap.min.14d449eb8876.js" type="text/javascript"></script>
<script src="/wap//js/template.eca497836b5a.js"></script>
<script>
$(function () {
    $('.logout').click(function(){
        //询问框
        layer.open({
            content: '<?php echo lang("logout_tip"); ?>'
            ,skin: 'loginout'
            ,btn: ['<?php echo lang("yes"); ?>', '<?php echo lang("no"); ?>']
            ,yes: function(index){
                window.location.href = "<?php echo url('index/Login/logout'); ?>";
            }
        });
    });

    function checkpassword(v){
        var numasc = 0;
        var charasc = 0;
        var otherasc = 0;
        if(0==v.length){
            return "<?php echo lang('pw_not_null'); ?>";
        }else if(v.length<6||v.length>12){
            return "<?php echo lang('pw_length_tip'); ?>";
        }else{
            for (var i = 0; i < v.length; i++) {
                var asciiNumber = v.substr(i, 1).charCodeAt();
                if (asciiNumber >= 48 && asciiNumber <= 57) {
                    numasc += 1;
                }
                if ((asciiNumber >= 65 && asciiNumber <= 90)||(asciiNumber >= 97 && asciiNumber <= 122)) {
                    charasc += 1;
                }
                if ((asciiNumber >= 33 && asciiNumber <= 47)||(asciiNumber >= 58 && asciiNumber <= 64)||(asciiNumber >= 91 && asciiNumber <= 96)||(asciiNumber >= 123 && asciiNumber <= 126)) {
                    otherasc += 1;
                }
            }
            if(0==numasc) {
                return "<?php echo lang('pw_contain_nb'); ?>";
            }else if(0==charasc){
                return "<?php echo lang('pw_contain_char'); ?>";
            }else if(0==otherasc){
                return "<?php echo lang('pw_contain_spec'); ?>";
            }else{
                return 1000;
            }
        }
    };

    $("#id_password").on('focus',function(){
        let that = this;
        let str = `<p>1.<?php echo lang('pwd_check_msg1'); ?></p>
                    <p>2.<?php echo lang('pwd_check_msg2'); ?></p>
                    <p>3.<?php echo lang('pwd_check_msg3'); ?></p>`
        layer.tips(str, that, {tips: 3, skin: 'pwdmsg', time: 0})
    });

    $('.showTips').on("click", function () {
        layer.msg("暂无版本更新！",{time: 2000})
    });

    $("#id_password").on('blur',function(){
        layer.closeAll();
    });

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
        let lang = 'zh-tw';
        if(getCookie('language'))
        {
            lang = getCookie('language');
        }
        var senData = {
            token : token,
            status : 1,
            lang : lang,
        };
        sendStatus = 1;
        $.post("<?php echo url('/index/User/sendEmailCode'); ?>",senData,
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
                    $("input[ name='__token__']").attr('value',res.data.newtoken);
                    sendStatus = 0;
                })

            });
    });
$('.personInfo').click(function(){
    let token = $("input[ name='__token__']").val();
    var phone = $("input[ name='phone']").val();
    let email = $("input[ name='useremail']").val();
    let password = $("input[ name='password']").val();
    let country = $('#id_country  option:selected').val();
    let code = $("input[ name='code']").val();

    if(phone == undefined)
    {
        phone = '';
    }

    if(token == '' || country == '' || email == '' || code == '')
    {
        layer.msg("<?php echo lang('complete_the_parameters'); ?>", {time: 2000})
        return false;
    }
    if(!email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/))
    {
        layer.msg("<?php echo lang('please_fill_in_the_correct_email_address'); ?>",{time: 2000});
        return false;
    }
    if(password != '')
    {
        if(checkpassword(password) != 1000){
            layer.msg(checkpassword(password),{time: 2000});
            return false;
        }
    }

    let lang = 'zh-tw';
    if(getCookie('language'))
    {
        lang = getCookie('language');
    }
    var senData = {
        token : token,
        phone : phone,
        country : country,
        email : email,
        password : password,
        code : code,
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
                layer.msg(res.info, {time: 2000},function(){
                    window.location.reload();
                })
                // layer.open({
                //     content: res.info
                //     ,skin: 'msg'
                //     ,time: 2 //2秒后自动关闭
                // });
                // setTimeout(function(){ window.location.reload();},2000);
            },500);
        });
});
});
</script>
</body>

</html>