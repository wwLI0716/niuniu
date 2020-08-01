<?php /*a:4:{s:93:"/www/wwwroot/rent.niuguagua.com/application/index/view/examine/see_common_examine_result.html";i:1585708476;s:72:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/shead.html";i:1585686728;s:71:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/left.html";i:1579008137;s:73:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/bottom.html";i:1579008099;}*/ ?>
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
<link rel="stylesheet" href="/wap//time/css/style.css">
<link rel="stylesheet" href="/wap//nowiconfont/iconfont.css">
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
    .show-examine-content {
        text-align: center;
        font-size: 1.5rem;
        font-weight: 900;
        margin: 2rem 0;
    }
    .timeline:before {
        width: 0;
    }
    .cd-horizontal-timeline .events-wrapper::before,.cd-horizontal-timeline .events-wrapper::after {
        width: 0;
    }
    .cd-horizontal-timeline .events-wrapper {
        margin: 0 !important;
    }
    .events ol li a {
        font-size: .8rem !important;
    }
    .cd-horizontal-timeline .timeline {
        padding: 0;
    }
    .special-row {
        width: 100%;
        margin-right: 0;
        margin-left: 0;
    }
    .index_message {
        border-radius: 8px !important;
        margin-bottom: 1rem;
        height: auto !important;
    }
    .index_message .p1 {
        margin-bottom: 0;
    }
    .index_message .p1,.index_message .p2 {
        padding-bottom: 0;
    }
    .specia-m {
        margin-bottom: 10px;
    }
    .examineStatus,.company {
        display: inline-block;
        width: 49%;
    }
    .company {
     text-align: left;
    }
    .examineStatus {
        text-align: right;
    }
    .p3,.p3 a {
        color: #333;
        text-align: right;
    }
    .edit {
        color: #fff !important;
    }
    .show-title-h {
        margin-top: .8rem;
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
            <li class="breadcrumb-item active sendContent">楼宇审核</li>
        </ol>
    </section>
    <section class="content-header header-top">
        <div class="col-12">
            <div class="box box-solid bg-black">
                <div class="box-body box-body-spec">
                    <div class="row">
                        <div class="col-12 show-module-all">
                            <div class="col-2 show-module show-module-sign">审核跟踪</div>
                            <div class="col-3 show-module">楼宇基本信息</div>
                            <div class="col-3 show-module">原租赁信息</div>
                            <div class="col-3 show-module">拟租赁信息</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-header content-bottom content-header-spec">
        <div class="col-12">
            <div class="box box-solid bg-black">
                <div class="box-body box-body-spec">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-container show-module-content">
                                <form id="examineInfo" name="examineInfo" method="post">
                                    <input type="hidden" id="apple_id" name="apple_id" value="<?php echo htmlentities($demondInfo['apple_id']); ?>">
                                    <input type="hidden" id="id" name="id" value="<?php echo htmlentities($demondInfo['id']); ?>">
                                    <input type="hidden" id="house_name" name="house_name" value="<?php echo htmlentities($demondInfo['house_name']); ?>">
                                    <input type="hidden" id="examine_id" name="examine_id" value="<?php echo htmlentities($examineInfo['id']); ?>">
                                    <input type="hidden" id="jing_before_examine_status" name="jing_before_examine_status" value="0">
                                    <h1 class="show-title">村企业提交信息</h1>
                                    <div class="row special-row">
                                        <?php if(is_array($demandDetailsInfos) || $demandDetailsInfos instanceof \think\Collection || $demandDetailsInfos instanceof \think\Paginator): $i = 0; $__LIST__ = $demandDetailsInfos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <div class="col-lg-6 col-md-12 margin-top-10">
                                            <div class="index_message">
                                                <p class="p1"><?php echo htmlentities($takeTimes[$key]); ?></p>
                                                <p class="p2"><span class="iconfont icon-shijian"></span>提交时间：<?php echo date('Y-m-d H:i:s',$vo['updated_at']); ?></p>
                                            </div>
                                        </div>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                    <h1 class="show-title show-title-h">审核信息</h1>
                                    <div class="row special-row">
                                        <?php if(is_array($examinesInfo) || $examinesInfo instanceof \think\Collection || $examinesInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $examinesInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo[$statusName] != 0): ?>
                                        <div class="col-lg-12 col-md-12 margin-top-10 margin-bottom-10 specia-m">
                                            <div class="index_message">
                                                <p class="p1">
                                                    <span class="company"><?php echo htmlentities($roleName); ?></span>
                                                    <?php if($vo[$statusName] == 0): ?>
                                                    <span class="examineStatus"><span class="iconfont icon-weishenhe"></span>未审核</span>
                                                    <?php elseif($vo[$statusName] == 1): ?>
                                                    <span class="examineStatus"><span class="iconfont icon-pass-2-copy"></span>审核通过</span>
                                                    <?php else: ?>
                                                    <span class="examineStatus"><span class="iconfont icon-shenhebohui"></span>审核驳回</span>
                                                    <?php endif; ?>
                                                </p>
                                                <p class="p2">审核意见：<?php if($vo[$reasonName] != ''): ?><?php echo htmlentities($vo[$reasonName]); else: ?>无<?php endif; ?></p>
                                                <p class="p2"><span class="iconfont icon-shijian"></span>提交时间：<?php if($vo[$timeName] != 0): ?><?php echo date('Y-m-d H:i:s',$vo[$timeName]); endif; ?></p>
                                            </div>
                                        </div>
                                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </form>
                            </div>
                            <div class="table-container table-responsive show-module-content" style="display: none;">
                                <table class="table">
                                    <tr>
                                        <th class="orderable">
                                            楼宇名称
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_name']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            楼宇地址
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_address']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地上层数
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_up_height']); ?>/层
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地下层数
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_down_height']); ?>/层
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地上面积
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_up_area']); ?>/平方
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地下面积
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_down_area']); ?>/平方
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            投资方式
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['investment_mode']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            投资比例%
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['investment_rate']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            投资总额
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['investment_total']); ?>/万
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            楼宇性质
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_nature']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            开工时间
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['build_at']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            竣工时间
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['finished_at']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            房产权证号
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_card_number']); ?>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-container table-responsive show-module-content" style="display: none;">
                                <table class="table">
                                    <tr>
                                        <th class="orderable">
                                            原租赁方
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['original_tenant']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁开始时间
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_start']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁结束时间
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_end']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁位置
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_position']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地上位置
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['up_position']); ?>/层
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地下位置
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['down_position']); ?>/层
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁面积
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_area']); ?>/平方
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地上面积
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_up_area']); ?>/平方
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地下面积
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_down_area']); ?>/平方
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            合同终止原因
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['end_reason']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            合同终止日
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_end_day']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁单价
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_price']); ?>/元
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            物业管理费
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_manager_price']); ?>/元
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            递增方式
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['incremental_way']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            退租违约金
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['falsify']); ?>/元
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            房屋保证金
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_deposit']); ?>/元
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            风险保证金
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['risk_deposit']); ?>/元
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-container table-responsive show-module-content" style="display: none;">
                                <table class="table">
                                    <tr>
                                        <th class="orderable">
                                            合同类型
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['contract_mode']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁方式
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_mode']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁位置
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_position_now']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地上位置
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['up_position_now']); ?>/层
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地下位置
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['down_position_now']); ?>/层
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁面积
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_area_now']); ?>/平方
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地上面积
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_up_area_now']); ?>/平方
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            地下面积
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_down_area_now']); ?>/平方
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁年限
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_year']); ?>/年
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁开始时间
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_start_now']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁结束时间
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_end_now']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            免租期
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['rent_free_period']); ?>/天
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租金起算日
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['rent_start_day']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            租赁单价
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_price_now']); ?>/元
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            物业管理费
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_manager_price_now']); ?>/元
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            递增方式
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['incremental_way_now']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            退租违约金
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['falsify_now']); ?>/元
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            房屋保证金
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['house_deposit_now']); ?>/元
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            风险保证金
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['risk_deposit_now']); ?>/元
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            意向承租企业名称
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_unit']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            企业性质
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['lease_unit_nature']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            注册资金
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['register_capital']); ?>/万
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            经营范围
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['business_scope']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            商务税务落地
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['tax_landing']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            承租后实际用途
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['purpose']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            实际经营状态
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['management_state']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            上半年税收
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['last_tax']); ?>/万
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            承诺实际税收
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['real_tax']); ?>/万
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            特殊情况说明
                                        </th>
                                        <th class="orderable right-th">
                                            <?php echo htmlentities($demondInfo['explain']); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="orderable">
                                            查看附件
                                        </th>
                                        <th class="orderable right-th">
                                            <?php if($demondInfo['annex_address'] != ''): ?>
                                            <a class="nowAnnex" href="<?php echo htmlentities($demondInfo['annex_address']); ?>" download="<?php echo htmlentities($demondInfo['annex_address']); ?>">点击下载</a>
                                            <?php else: ?>
                                            暂无
                                            <?php endif; ?>
                                        </th>
                                    </tr>
                                </table>
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
<script>
$(function () {

    $('.getA').attr('href',$('.sendA').attr("href"));
    $('.pageName').html($(".sendContent").html());

    $('.filling-line').css("transform",'scaleX('+$('.selected').length*0.17+')');

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

    $('.show-module').click(function(){
        $(this).siblings().removeClass("show-module-sign");
        $(this).addClass("show-module-sign");
        var sinId = $(this).index();
        $('.show-module-content').eq(sinId).css("display","block");
        $('.show-module-content').eq(sinId).siblings().css("display","none");
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

    $("#id_password").on('blur',function(){
        layer.closeAll();
    });

    var sendStatus = 0;
    $("body").on("click", ".sendCode", function () {
        if(sendStatus == 1)
        {
            // layer.open({
            //     content: "<?php echo lang('do_click_again'); ?>"
            //     ,skin: 'msg'
            //     ,time: 2 //2秒后自动关闭
            // });
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