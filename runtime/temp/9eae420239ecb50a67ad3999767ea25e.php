<?php /*a:4:{s:108:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\examine\show_release_demand.html";i:1595854068;s:93:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\shead.html";i:1595813888;s:92:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\left.html";i:1594024606;s:94:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\bottom.html";i:1588746419;}*/ ?>
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
               <!--<li class="dropdown user user-menu spec-menu" style="position: relative">
                    <a href="" class="dropdown-toggle getA">
                        <span class="bigger"><</span>&nbsp;<span class="pageName"></span>
                    </a>
                </li>-->
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
                        <a class="specialA" href="javascript:void(0);" data-href="<?php echo url('/index/Examine/showReleaseDemand'); ?>?status=2" data-parameter="">已审核</a>
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
                        <a class="specialA" href="javascript:void(0);" data-href="<?php echo url('Bid/bidList'); ?>" data-parameter="">招标标书</a>
                    </li>
                    <li>
                        <a class="specialA" href="javascript:void(0);" data-href="<?php echo url('His/hisList'); ?>" data-parameter="">合同备案</a>
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
    .content-header>.breadcrumb {
        position: unset;
    }
    .webticker-4 {
        padding: 1.25rem 0;
    }
    .webticker-3 {
        height: 27px;
        overflow: hidden;
        position: relative;
        padding: 0 1.25rem;
    }
    #webticker-2 {
        list-style:none;
        padding-left: 0;
    }
    #webticker-2 li {
        width: 100%;
        word-break: break-all;
        word-wrap: break-word;
        white-space: normal;
        color: #6c757d;
    }
    .show-auto {
        width: 32%;
        margin-right: 0;
    }
    .dollar-value,.show-auto .media i {
        display: block;
        width: 100%;
    }
    .show-auto .media i {
        font-size: 30px;
    }
    .show-auto .media,.dollar-value {
        text-align: center;
    }
    .show-auto .box-body {
        padding-left: .7rem;
        padding-right: .7rem;
    }
    .page-dashboard .dollar-value {
        font-size: 1rem;
    }
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
    .doing {
        padding-left: .5rem;
    }
    .show-status {
        padding: 0.1rem .5rem;
        line-height: normal;
    }
    .btn-primary {
        background-color: #3c7fff;
        padding: 0.1rem 1rem;
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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header show-content-title">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="sendA" href="javascript:history.back(-1)">
                    < &nbsp;
                </a>
            </li>
            <li class="breadcrumb-item active sendContent">
                <?php if($status == 0): ?>
                待审核
                <?php elseif($status == 1): ?>
                审核中
                <?php elseif($status == 2): ?>
                已审核
                <?php else: ?>
                待复核
                <?php endif; ?>
            </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- RENOVATION -->
        <div class="row row_message">
            <div class="col-lg-12 col-md-12 margin-top-20">
                <table style="width: 100%;background-color: #fff;line-height: 50px;text-align: center;">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>名称</th>
                        <th>房产权证号</th>
                        <th>租赁面积</th>
                        <th>提交时间</th>
                        <th>审核状态</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($demondInfos) || $demondInfos instanceof \think\Collection || $demondInfos instanceof \think\Paginator): $i = 0; $__LIST__ = $demondInfos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo htmlentities($vo['apple_id']); ?></td>
                        <td><?php echo htmlentities($vo['house_name']); ?></td>
                        <td><?php echo htmlentities($vo['house_card_number']); ?></td>
                        <td><?php echo htmlentities($vo['lease_area_now']); ?></td>
                        <td><?php echo date('Y-m-d H:i:s',$vo['updated_at']); ?></td>
                        <td><span class="doing"><?php if($vo['apple_status'] == 0): ?><button type="button" class="btn btn-info show-status">待审核</button><?php elseif($vo['apple_status'] == 1): ?><button type="button" class="btn btn-warning show-status">审核中</button><?php elseif($vo['apple_status'] == 2): ?><button type="button" class="btn btn-success show-status">审核通过</button><?php else: ?><button type="button" class="btn btn-danger show-status">审核驳回</button><?php endif; ?></span></td>
                        <td>
                            <button style="line-height: 30px;" type="button" class="btn btn-primary"><a style="color: #fff;" href="/Examine/seeDemand?demandId=<?php echo htmlentities($vo['apple_id']); ?>">查看</a></button>
                            <?php if($roleId == 8): ?>
                            <button style="line-height: 30px;" type="button" class="btn btn-primary">
<!--                                常规流程 不需要安全办审核-->
                                <?php if($vo['apple_process_type'] == 0 And $vo['apple_is_soft_first'] == 0): ?>
                                <a style="color: #fff;" onclick="doCommonPrint(<?php echo htmlentities($vo['apple_id']); ?>)">打印</a>
                                <?php else: ?>
<!--                                简易流程 -->
                                <a style="color: #fff;" onclick="doPrint(<?php echo htmlentities($vo['apple_id']); ?>)">打印</a>
                                <?php endif; ?>
                            </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page">
            <?php echo $page; ?>
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
            <i class="iconfont icon_iconfont-fengxiangqudao-duanxin-"></i><br /><a href="/Bid/bidList"  data-url="Bid">招标</a>
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

<script>
    function doCommonPrint(id) {
        let demandInfo;
        let examineInfo;
        $.ajax({
            type: "POST",
            url: "/Examine/getDemandDetail",
            data: {"id": id},
            timeout:60000,    //超时时间
            dataType:'json',
            success: function(data){
                data = data.data
                demandInfo = data.demandInfo;
                examineInfo = data.examineInfo;
                bdhtml="<body>\n" +
                    "<!--startprint-->\n" +
                    "<table border='1' cellpadding='0' cellspacing='0'>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='center' style='font-size: 25px;'><b>虹桥镇集体经济组织楼宇经营管理审核表</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='center' style='height: 30px;font-size: 20px' ><b>一、租赁基本信息</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>出租单位名称</td>\n" +
                    "\t\t<td colspan='2' style='width: 25%'>&nbsp;</td>\n" +
                    "\t\t<td>出租楼宇名称</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.house_name+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>出租地址</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.house_address+"</td>\n" +
                    "\t\t<td>出租面积</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_area+"</td>\n" +
                    "\t</tr>\n" +
                    "\t\t<td>原承租企业</td>\n" +
                    "\t\t<td colspan='2' style='width: 25%'>"+demandInfo.original_tenant+"</td>\n" +
                    "\t\t<td>原合同租赁起止日</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_start+"至"+demandInfo.lease_end+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>终止原因</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.end_reason+"</td>\n" +
                    "\t\t<td>合同终止日</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_end_day+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>现意向承租企业</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_unit+"</td>\n" +
                    "\t\t<td>承租后经营业态</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.purpose+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>租赁面积</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_area_now+"平方</td>\n" +
                    "\t\t<td>租赁单价</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_price+"元</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>租赁年限</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_year+"</td>\n" +
                    "\t\t<td>租赁起止日期</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_start_now+"至"+demandInfo.lease_end_now+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>免租期</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.rent_free_period+"</td>\n" +
                    "\t\t<td>租金起算日</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.rent_start_day+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' height='80px'>特殊情况说明："+demandInfo.explain+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' style='height: 30px;font-size: 20px' align='center'  ><b>二、审核意见</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr style='font-weight: bold'>\n" +
                    "\t\t<td colspan='3'>镇安全办审核意见</td>\n" +
                    "\t\t<td>通过</td>\n" +
                    "\t\t<td>拒绝</td>\n" +
                    "\t\t<td>原因:"+examineInfo.security_do_examine_reason+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >镇经管办审核意见</td>\n" +
                    "\t\t<td>通过</td>\n" +
                    "\t\t<td>拒绝</td>\n" +
                    "\t\t<td>原因:"+examineInfo.jing_before_examine_reason+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >经发办审核意见</td>\n" +
                    "\t\t<td>通过</td>\n" +
                    "\t\t<td>拒绝</td>\n" +
                    "\t\t<td>原因:"+examineInfo.jing_examine_reason+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >农经站审核意见</td>\n" +
                    "\t\t<td>通过</td>\n" +
                    "\t\t<td>拒绝</td>\n" +
                    "\t\t<td>原因:"+examineInfo.farmer_examine_reason+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >审计办 审核意见</td>\n" +
                    "\t\t<td>通过</td>\n" +
                    "\t\t<td>拒绝</td>\n" +
                    "\t\t<td>原因:"+examineInfo.audit_examine_reason+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >财政所审核意见</td>\n" +
                    "\t\t<td>通过</td>\n" +
                    "\t\t<td>拒绝</td>\n" +
                    "\t\t<td>原因:"+examineInfo.finance_examine_reason+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >镇资产公司办审核意见</td>\n" +
                    "\t\t<td>通过</td>\n" +
                    "\t\t<td>拒绝</td>\n" +
                    "\t\t<td>原因:"+examineInfo.assets_examine_reason+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >镇领导办审核意见</td>\n" +
                    "\t\t<td>通过</td>\n" +
                    "\t\t<td>拒绝</td>\n" +
                    "\t\t<td>原因:"+examineInfo.town_examine_reason+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</td>\n" +
                    "\t</tr>\n" +
                    "</table>\n" +
                    "\n" +
                    "<br>\n" +
                    "<!--endprint-->\n" +
                    "</body>";
                sprnstr="<!--startprint-->"; //开始打印标识字符串有17个字符
                eprnstr="<!--endprint-->"; //结束打印标识字符串
                prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17); //从开始打印标识之后的内容
                prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr)); //截取开始标识和结束标识之间的内容
                window.document.body.innerHTML=prnhtml; //把需要打印的指定内容赋给body.innerHTML
                window.print(); //调用浏览器的打印功能打印指定区域
                window.document.body.innerHTML=bdhtml; // 最后还原页面
            },
            error:function(xhr,textStatus){console.log(data)
                layer.msg('Page refresh', {time: 2000});
//              layer.closeAll('loading');
                location.reload();
            },
        });

    }
    function doPrint(id) {
        let demandInfo;
        let examineInfo;
        let examineResult = "";
        $.ajax({
            type: "POST",
            url: "/Examine/getDemandDetail",
            data: {"id": id},
            timeout:60000,    //超时时间
            dataType:'json',
            success: function(data){
                data = data.data;
                demandInfo = data.demandInfo;
                examineInfo = data.examineInfo;
                console.log(examineInfo);
                if (examineInfo.jing_before_examine_reason !== "") {
                    examineResult += "镇经管办预审审核反馈:" + examineInfo.jing_before_examine_reason + "<br>";
                }
                if (examineInfo.finance_examine_reason !== "") {
                    examineResult += "财政所审核反馈:" + examineInfo.finance_examine_reason + "<br>";
                }
                if (examineInfo.jing_examine_reason !== "") {
                    examineResult += "镇经发办审核反馈:" + examineInfo.jing_examine_reason + "<br>";
                }
                if (examineInfo.farmer_examine_reason !== "") {
                    examineResult += "农经站审核反馈:" + examineInfo.farmer_examine_reason + "<br>";
                }
                if (examineInfo.audit_examine_reason !== "") {
                    examineResult += "审计办审核反馈:" + examineInfo.audit_examine_reason + "<br>";
                }
                if (examineInfo.security_examine_reason !== "") {
                    examineResult += "安全办前置审核反馈:" + examineInfo.security_examine_reason + "<br>";
                }
                if (examineInfo.security_do_examine_reason !== "") {
                    examineResult += "安全办审核反馈:" + examineInfo.security_do_examine_reason + "<br>";
                }
                if (examineInfo.management_examine_reason !== "") {
                    examineResult += "经管办审核反馈:" + examineInfo.management_examine_reason + "<br>";
                }
                if (examineInfo.town_examine_reason !== "") {
                    examineResult += "镇领导审核反馈:" + examineInfo.town_examine_reason + "<br>";
                }
                bdhtml="<body>\n" +
                    "<!--startprint-->\n" +
                    "<table border='1' cellpadding='0' cellspacing='0'>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='center' style='font-size: 25px;'><b>楼宇租赁项目审核意见表</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='center' style='height: 30px;font-size: 20px' ><b>一、租赁基本信息</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>出租单位名称</td>\n" +
                    "\t\t<td colspan='2' style='width: 25%'>&nbsp;</td>\n" +
                    "\t\t<td>出租楼宇名称</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.house_name+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>出租地址</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.house_address+"</td>\n" +
                    "\t\t<td>出租面积</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_area+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>租赁单价</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_price+"元</td>\n" +
                    "\t\t<td>竞拍底价</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_price+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>租赁年限</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_year+"</td>\n" +
                    "\t\t<td>租赁起止日期</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.lease_start+"至"+demandInfo.lease_end+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>免租期</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.rent_free_period+"</td>\n" +
                    "\t\t<td>租金起算日</td>\n" +
                    "\t\t<td colspan='2' align='center'>"+demandInfo.rent_start_day+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' height='80px'>特殊情况说明："+demandInfo.explain+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' style='height: 30px;font-size: 20px' align='center'  ><b>二、审核意见</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr style='font-weight: bold'>\n" +
                    "\t\t<td colspan='3'>镇经管办审核意见</td>\n" +
                    "\t\t<td>是</td>\n" +
                    "\t\t<td>否</td>\n" +
                    "\t\t<td>否定原因</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >1、是否符合审核范围</td>\n" +
                    "\t\t<td>√</td>\n" +
                    "\t\t<td></td>\n" +
                    "\t\t<td></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >2、意向承租方资格是否符合规定</td>\n" +
                    "\t\t<td>√</td>\n" +
                    "\t\t<td></td>\n" +
                    "\t\t<td></td>\n" +
                    "\t</tr>\n" +
                    "\t\t<td colspan='3' >3、租金价格是否符合规定</td>\n" +
                    "\t\t<td>√</td>\n" +
                    "\t\t<td></td>\n" +
                    "\t\t<td></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >4、租赁业态是否符合规定</td>\n" +
                    "\t\t<td>√</td>\n" +
                    "\t\t<td></td>\n" +
                    "\t\t<td></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='3' >5、证明材料是否齐全</td>\n" +
                    "\t\t<td>√</td>\n" +
                    "\t\t<td></td>\n" +
                    "\t\t<td></td>\n" +
                    "\t</tr>\n" +
                    "\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='center' style='height: 30px;font-size: 20px'><b>三、审核结果</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' height='80px' align='center' >"+examineResult+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='right'>" +
                    "<p>签字盖章&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='/wap//images/zhang.png' style='width: 200px;margin:1px'></p>" +
                    "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日&nbsp;&nbsp;&nbsp;&nbsp;</p>" +
                    "\t\t</td>\n" +
                    "\t</tr>\n" +
                    "</table>\n" +
                    "\n" +
                    "\t<p>备注：</p>\n" +
                    "\t<p>1、镇经管办应在7个工作日之内将审核意见反馈给相关公司，并将该审核意见报农经站和分管领导。</p>\n" +
                    "\t<p>2、通过项目审核的公司应根据闵虹委办〔2016〕1号文件要求，及时召开“三重一大”对项目进行集体讨论、民主决策。<br>其中涉及公开招租的，应按公开招租流程进行操作。</p>\n" +
                    "<br>\n" +
                    "<!--endprint-->\n" +
                    "</body>";
                sprnstr="<!--startprint-->"; //开始打印标识字符串有17个字符
                eprnstr="<!--endprint-->"; //结束打印标识字符串
                prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17); //从开始打印标识之后的内容
                prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr)); //截取开始标识和结束标识之间的内容
                window.document.body.innerHTML=prnhtml; //把需要打印的指定内容赋给body.innerHTML
                setTimeout(function(){
                    window.print(); //调用浏览器的打印功能打印指定区域
                },200);
                window.document.body.innerHTML=bdhtml; // 最后还原页面

            },
            error:function(xhr,textStatus){console.log(data)
                layer.msg('Page refresh', {time: 2000});
//              layer.closeAll('loading');
                location.reload();
            },
        });
    }
</script>
<!--   Core JS Files   -->
<script src="/wap//js/layer.js" type="text/javascript"></script>
<script src="/wap//js/common1.js" type="text/javascript"></script>
<script src="/wap//js/bootstrap.min.14d449eb8876.js" type="text/javascript"></script>

<!-- webticker -->
<script src="/wap//js/jquery.webticker.min.f78e1731f573.js"></script>
<!-- Crypto_Admin App -->
<script src="/wap//js/template.eca497836b5a.js"></script>
<!-- 滾動樣式 -->
<script src="/wap//js/dashboard.89aa0af61d92.js"></script>
<!-- Chart -->
<script src="/wap//js/chart.min.c508c360e58f.js"></script>
<script src="/wap//js/chartjs-int.b4511dbd6cc9.js"></script>
<script src="/wap//js/chartjs-int.b4511dbd6cc99.js"></script>
<!-- easypiechart -->
<script src="/wap//js/jquery.easypiechart.0f1bfd4eb4e7.js"></script>
<!-- chart-widgets -->
<script src="/wap//js/chart-widgets.0569c48737c0.js"></script>
<script src="/wap//js/moment-with-locales.min.a79a8710a351.js"></script>
<script src="/wap//js/moment-timezone-with-data.min.a3f47b485883.js"></script>
<script src="/wap//js/jquery.loading.f548d3016cfe.js"></script>

<script>
    $(function () {

        $('.getA').attr('href',$('.sendA').attr("href"));
        $('.pageName').html($(".sendContent").html());

        $('.logout').click(function(){
            //询问框
            layer.open({
                content: '<?php echo lang("logout_tip"); ?>'
                ,btn: ['<?php echo lang("yes"); ?>', '<?php echo lang("no"); ?>']
                ,skin: 'loginout'
                ,yes: function(index){
                    window.location.href = "<?php echo url('index/Login/logout'); ?>";
                }
            });
        });
    });
</script>

</body>

</html>