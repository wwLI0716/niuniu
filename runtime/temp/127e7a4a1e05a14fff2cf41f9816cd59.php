<?php /*a:4:{s:88:"/www/wwwroot/rent.niuguagua.com/application/index/view/news/lst_jing_before_examine.html";i:1579330771;s:72:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/shead.html";i:1584715989;s:71:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/left.html";i:1579008137;s:73:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/bottom.html";i:1579008099;}*/ ?>
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
<link rel="stylesheet" href="/wap//css/layer.css">
<link rel="stylesheet" href="/wap//css/website.9576659c0ec6.css ">
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
                    <a href="" class="dropdown-toggle getA">
                        <span class="bigger"><</span>&nbsp;<span class="pageName"></span>
                    </a>
                </li>
                <li class="dropdown user user-menu" style="position: relative">
                    <a href="<?php echo url('news/lst'); ?>" class="dropdown-toggle">
                        <i class="iconfont icon_iconfont-yijianfankui-" style="margin-right: 0;"></i>
                        <span class="showLogoTip">消息通知</span>
                    </a>
                    <?php if($noticeStatus == 1): ?>
                    <div class="red_icon"></div>
                    <?php endif; ?>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconfont icon_iconfont-xiugainicheng-" style="margin-right: 0;"></i>
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
<style>
    .box {
        box-shadow: none;
    }

    .card-container h2 {
        margin-top: 40px;
    }

    .card-body {
        border: 1px solid #f6f6f6;
        box-shadow: 0px 0px 5px 0px rgba(142, 139, 133, 0.32);
        box-sizing: border-box;
        color: #666;
    }
    ul,li{
        list-style: none;
    }
    .news{
        padding: 0;
        margin-bottom: 0;
    }
    .news li{
        line-height: 40px;
        border-bottom: 1px solid #eaeaea;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        font-size: 14px;
    }
    .news li:last-child{
        border-bottom: 0;
    }
    .page-dashboard .content .container-fluid{
        padding: 20px 10px;
    }
    .showTime {
        flex: 1;
        text-align: right;
        color: #ccc;
    }
    .news li span:last-child{
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .page {
        margin-top: 15px;
        width: 100%;
        word-wrap: break-word;
        word-break: break-all;
        margin-bottom: 10rem;
    }
    .page .pagination {
        width: 100%;
        word-wrap: break-word;
        word-break: break-all;
        display: block;
    }
    .page .pagination li {
        display: inline-block;
        margin-top: .3rem;
    }
    .pagination li span {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        display: inline-block;
        min-width: 25px;
        padding: .4em 1em;
        text-decoration: none;
        cursor: pointer;
        color: #adadad;
        border: 1px solid transparent;
        border-radius: 2px;
        margin-left: 5px;
        margin-right: 5px;
        background-color: #ddd;
    }
    @media (max-width: 767px) {
        .txtinfo {
            width: 112px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .newscontent > div.layui-layer-content > p:nth-child(1) {
            font-size: 16px;
            line-height: 2;
        }
        .newscontent > div.layui-layer-content > p:nth-child(2) {
            font-size: 14px;
            color: #646464;
        }
        .newscontent > div.layui-layer-btn > a {
            color: #fff;
        }
        .newscontent {
            width: 100%!important;
            left: 0!important;
        }
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header show-content-title">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="sendA" href="<?php echo url('User/personInfo'); ?>">
                    < &nbsp;
                </a>
            </li>
            <li class="breadcrumb-item active sendContent">通知</li>
        </ol>
    </section>
    <div class="content-header header-top margin-top-20">
        <div class="container-fluid">
            <ul class="news">
                <?php if(count($notices) != 0): if(is_array($notices) || $notices instanceof \think\Collection || $notices instanceof \think\Paginator): $i = 0; $__LIST__ = $notices;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <span class="iconfont icon_iconfont-xinxituisong-"></span>
                    <span><a href="/Examine/seeDemand?demandId=<?php echo htmlentities($vo['apple_id']); ?>"><?php if(isset($vo['username'])): ?><?php echo htmlentities($vo['username']); ?>提交的<?php endif; ?><?php echo htmlentities($vo['description']); ?></a></span>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; else: ?>
                <li>
                    <span><?php echo lang('has_no_notice'); ?></span>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="page">
        <?php echo $page; ?>
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

    $('.getA').attr('href',$('.sendA').attr("href"));
    $('.pageName').html($(".sendContent").html());

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
    })
</script>
</body>

</html>