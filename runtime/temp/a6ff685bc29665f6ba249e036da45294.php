<?php /*a:4:{s:83:"/www/wwwroot/rent.niuguagua.com/application/index/view/examine/management_more.html";i:1579317370;s:72:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/shead.html";i:1584715989;s:71:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/left.html";i:1579008137;s:73:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/bottom.html";i:1579008099;}*/ ?>
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
<link rel="stylesheet" href="/wap//nowiconfont/iconfont.css">
<link rel="stylesheet" href="/wap//css/dropify.min.cf55479bd0d3.css">
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
    .show-title {
        margin: 0 0 0px;
        font-size: 24px;
        color: #6c757d;
    }
    .content-bottom {
        margin-bottom: 10rem;
    }
    .show-module-all {
        padding: 0;
    }
    .box-body-spec {
        padding: 0;
    }
    .show-module {
        display: inline-block;
        padding: 0;
        text-align: center;
        font-size: 1rem;
    }
    .show-module:first-child {
        margin-left: .9rem;
    }
    .table th, .table td {
        border-bottom: 1px solid #dee2e6;
        border-top: 0;
        padding: .5rem 1rem;
    }
    .right-th {
        text-align: right;
    }
    .show-module-sign {
        color: #3c7fff;
    }
    .content-header-spec {
        margin-top: .7rem;
    }
    .show-title {
        margin: 0 0 0px;
        font-size: 15px;
        color: #6c757d;
    }
    .index_message .p1 {
        padding-bottom: 0;
    }
    .p1,.p2 {
        margin-bottom: 0;
    }
    .special-row {
        width: 100%;
        margin-right: 0;
        margin-left: 0;
    }
    .index_message {
        border-radius: 8px !important;;
    }
    .special-row-m {
        margin-top: 2rem;
    }
    .senData {
        width: 48%;
        display: block;
        margin: 0 1% 0 1%;
    }
    .seeLog {
        width: 48%;
        display: block;
        margin-left: 1%;
    }
    .show-title-special {
        margin-top: 1rem;
    }
    .show-p {
        position: relative;
    }
    .radio {
        line-height: 2rem;
    }
    [type=radio]:not(:checked),[type=radio]:checked {
        opacity: 1;
        position: static;
        margin: 0 .5rem;
    }
    .radio-text {
        position: relative;
        top: -2px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header show-content-title">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="sendA" href="javascript:history.back(-1)">
                    < &nbsp;
                </a>
            </li>
            <li class="breadcrumb-item active sendContent">经管办</li>
        </ol>
    </section>
    <section class="content-header content-bottom content-header-spec">
        <div class="col-12">
            <div class="box box-solid bg-black">
                <div class="box-body box-body-spec">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-container show-module-content">
                                <form id="examineInfo" name="examineInfo" action="<?php echo url('getreleaseExamine'); ?>" method="post">
                                    <input type="hidden" id="apple_id" name="apple_id" value="<?php echo htmlentities($demondInfo['apple_id']); ?>">
                                    <input type="hidden" id="id" name="id" value="<?php echo htmlentities($demondInfo['id']); ?>">
                                    <input type="hidden" id="house_name" name="house_name" value="<?php echo htmlentities($demondInfo['house_name']); ?>">
                                    <input type="hidden" id="examine_id" name="examine_id" value="<?php echo htmlentities($examineInfo['id']); ?>">
                                    <input type="hidden" id="management_examine_status" name="management_examine_status" value="0">
                                    <h1 class="show-title show-title-special">审核信息</h1>
                                    <div class="form-group">
                                        <label class="control-label">1、是否符合审核范围</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['management_1']): ?>checked<?php endif; ?> name="management_1" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['management_1']): ?>checked<?php endif; ?> name="management_1" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="management_reason_1" id="management_reason_1" rows="5"><?php if($examineInfo['management_reason_1'] == ''): ?>无<?php else: ?><?php echo htmlentities($examineInfo['management_reason_1']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">2、意向承租方资格是否符合规定</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['management_2']): ?>checked<?php endif; ?> name="management_2" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['management_2']): ?>checked<?php endif; ?> name="management_2" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="management_reason_2" id="management_reason_2" rows="5"><?php if($examineInfo['management_reason_2'] == ''): ?>无<?php else: ?><?php echo htmlentities($examineInfo['management_reason_2']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">3、租金价格是否符合规定</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['management_3']): ?>checked<?php endif; ?> name="management_3" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['management_3']): ?>checked<?php endif; ?> name="management_3" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="management_reason_3" id="management_reason_3" rows="5"><?php if($examineInfo['management_reason_3'] == ''): ?>无<?php else: ?><?php echo htmlentities($examineInfo['management_reason_3']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">4、租赁业态是否符合规定</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['management_4']): ?>checked<?php endif; ?> name="management_4" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['management_4']): ?>checked<?php endif; ?> name="management_4" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="management_reason_4" id="management_reason_4" rows="5"><?php if($examineInfo['management_reason_4'] == ''): ?>无<?php else: ?><?php echo htmlentities($examineInfo['management_reason_4']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">5、证明材料是否齐全</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['management_5']): ?>checked<?php endif; ?> name="management_5" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['management_5']): ?>checked<?php endif; ?> name="management_5" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="management_reason_5" id="management_reason_5" rows="5"><?php if($examineInfo['management_reason_5'] == ''): ?>无<?php else: ?><?php echo htmlentities($examineInfo['management_reason_5']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">6、是否提交镇领导审核</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['management_6']): ?>checked<?php endif; ?> name="management_6" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['management_6']): ?>checked<?php endif; ?> name="management_6" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="management_examine_reason" id="management_examine_reason" rows="5"><?php if($examineInfo['management_examine_reason'] == ''): ?>无<?php else: ?><?php echo htmlentities($examineInfo['management_examine_reason']); endif; ?></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
<script src="/wap//js/dropify.min.c33a6db4b019.js"></script>
<script>
$(function () {

    $('.getA').attr('href',$('.sendA').attr("href"));
    $('.pageName').html($(".sendContent").html());

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

});
</script>
</body>

</html>