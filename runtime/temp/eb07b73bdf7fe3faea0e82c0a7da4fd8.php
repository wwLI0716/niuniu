<?php /*a:4:{s:98:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\bid\show_bid_list.html";i:1589177322;s:92:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\head.html";i:1586950449;s:92:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\left.html";i:1587133078;s:94:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\bottom.html";i:1588746419;}*/ ?>
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
    @media print {
        body{
            -webkit-print-color-adjust:exact;
            -moz-print-color-adjust:exact;
            -ms-print-color-adjust:exact;
            print-color-adjust:exact;
        }
    }
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
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
<!--            <div class="col-lg-2 col-md-2 col-sm-2 show-auto margin-top-20">-->
<!--                <div class="box pull-up">-->
<!--                    <select class="form-control investment_mode" name="status">-->
<!--                        <option value="">请选择审核状态</option>-->
<!--                        <option value="0" <?php if($status != '' && $status == 0): ?>selected="selected"<?php endif; ?>>待审核</option>-->
<!--                        <option value="1" <?php if($status == 1): ?>selected="selected"<?php endif; ?>>审核中</option>-->
<!--                        <option value="2" <?php if($status == 2): ?>selected="selected"<?php endif; ?>>审核通过</option>-->
<!--                        <option value="3" <?php if($status == 3): ?>selected="selected"<?php endif; ?>>待复核</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-2 col-md-2 col-sm-2 show-auto margin-top-20">-->
<!--                <div class="box pull-up">-->
<!--                    <select class="form-control investment_mode" name="countryid">-->
<!--                        <option value="">请选择村企业</option>-->
<!--                        <option value="11">111</option>-->

<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-1 col-md-1 col-sm-1 show-auto margin-top-20">-->
<!--                <div class="box pull-up">-->
<!--                    <input class="btn btn-info btn-lg btn-block submit" type="submit" value="搜索" readonly="">-->
<!--                </div>-->
<!--            </div>-->
            <div class="col-lg-1 col-md-4 col-sm-8 show-auto margin-top-20">
                <div class="box pull-up">
                    <?php if($role == 0): ?>
                    <a href="/Bid/saveView" style="padding-left: 0;padding-right: 0;" class="btn btn-info btn-lg btn-block submit">+ 创建发布</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- RENOVATION -->
        <div class="row row_message">
            <div class="col-lg-12 col-md-12 margin-top-20">
                <table style="width: 100%;background-color: #fff;line-height: 50px;text-align: center;">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>出租方名称</th>
                        <th>出租地址</th>
                        <th>出租面积</th>
                        <th>提交时间</th>
                        <th>审核状态</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($demondInfos) || $demondInfos instanceof \think\Collection || $demondInfos instanceof \think\Paginator): $i = 0; $__LIST__ = $demondInfos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo htmlentities($vo['id']); ?></td>
                        <td><?php echo htmlentities($vo['rent_name']); ?></td>
                        <td><?php echo htmlentities($vo['rent_address']); ?></td>
                        <td><?php echo htmlentities($vo['rent_area']); ?></td>
                        <td><?php echo htmlentities($vo['created_at']); ?></td>
                        <td><span class="doing"><?php if($vo['status'] == 0): ?><button type="button" class="btn btn-info show-status">待审核</button><?php elseif($vo['status'] == 1): ?><button type="button" class="btn btn-warning show-status">审核中</button><?php elseif($vo['status'] == 2): ?><button type="button" class="btn btn-success show-status">审核通过</button><?php else: ?><button type="button" class="btn btn-danger show-status">审核驳回</button><?php endif; ?></span></td>
                        <td>
                            <button style="line-height: 30px;" type="button" class="btn btn-primary"><a style="color: #fff;" href="/Bid/viewBid?bidId=<?php echo htmlentities($vo['id']); ?>">查看</a></button>
                            <?php if($vo['status'] == 2 && $vo['examine_type'] != 2 && $vo['creator_id'] == $userId): ?>
                            <button style="line-height: 30px;" type="button" class="btn btn-primary"><a style="color: #fff;" href="/Bid/viewBid?bidId=<?php echo htmlentities($vo['id']); ?>">上传附件</a></button>
                            <?php endif; ?>
                          <button style="line-height: 30px;" type="button" class="btn btn-primary"><a style="color: #fff;" onclick="doPrint(<?php echo htmlentities($vo['id']); ?>)">打印</a></button>
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
<script src="http://p8sv0x8g6.bkt.clouddn.com/jquery-2.1.1.min.js"></script>
<script>
	function doPrint(id) {
		$.ajax({
			type: "POST",
			url: "/Bid/getAjaxBidDetail",
			data: {"id": id},
			timeout:60000,    //超时时间
			dataType:'json',
			success: function(data){
                data = data.data;
                bidInfo = data.bidInfo;
                bdhtml="<body>\n" +
                    "<!--startprint-->\n" +
                    "<table border='1' cellpadding='0' cellspacing='0'>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='center' style='font-size: 25px;'><b>虹桥镇集体经济组织楼宇公开招租审核表</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='center' style='height: 30px;font-size: 20px' ><b>一、租赁基本信息</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>出租单位名称</td>\n" +
                    "\t\t<td colspan='2' style='width: 25%'>&nbsp;"+bidInfo.rent_name+"</td>\n" +
                    "\t\t<td>出租楼宇名称</td>\n" +
                    "\t\t<td colspan='2'>"+bidInfo.rent_house+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>出租地址</td>\n" +
                    "\t\t<td colspan='2'>"+bidInfo.rent_address+"</td>\n" +
                    "\t\t<td>出租面积</td>\n" +
                    "\t\t<td colspan='2'>"+bidInfo.rent_area+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>租赁单价</td>\n" +
                    "\t\t<td colspan='2'>"+bidInfo.bid_increase+"</td>\n" +
                    "\t\t<td>竞拍底价</td>\n" +
                    "\t\t<td colspan='2'>"+bidInfo.bid_low_price+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>租赁年限</td>\n" +
                    "\t\t<td colspan='2'>"+bidInfo.lease_period+"</td>\n" +
                    "\t\t<td>租赁起止日期</td>\n" +
                    "\t\t<td colspan='2'>"+bidInfo.lease_time+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td>免租期</td>\n" +
                    "\t\t<td colspan='2'>"+bidInfo.rent_free_period+"</td>\n" +
                    "\t\t<td>租金起算日</td>\n" +
                    "\t\t<td colspan='2'>"+bidInfo.lease_calculat_stime+"</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='5' style='height: 40px;font-size: 20px' align='center'  ><b>二、审核内容</b></td>\n" +
                    "\t\t<td>同意</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='5' >1、楼宇租赁合同审核情况</td>\n" +
                    "\t\t<td>√</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='5' >2、出租单位“三重一大”事项决策情况</td>\n" +
                    "\t\t<td>√</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='5' >3、出租单位（村级公司）监事会意见</td>\n" +
                    "\t\t<td>√</td>\n" +
                    "\t</tr>\n" +
                    "\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='5' style='' >楼宇经营管理服务办公室（镇经管办）审核意见</td>\n" +
                    "\t\t<td></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='4'></td>\n" +
                    "\t\t<td>签字：</td>\n" +
                    "\t\t<td></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='4'></td>\n" +
                    "\t\t<td>部门盖章：</td>\n" +
                    "\t\t<td><img src='/wap//images/zhang.png' style='width: 200px;margin:1px'></td>\n" +
                    "\t</tr>\n" +
                    "\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='5'></td>\n" +
                    "\t\t<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    日</td>\n" +
                    "\t</tr>\n" +
                    "\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' align='center' style='height: 30px;font-size: 20px'><b>三、附公开招租资料</b></td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' >1、出租楼宇房地产权证复印件</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' >2、出租单位公开招租标书（纸质、电子版）</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' >3、出租单位公开招租预审文件（纸质、电子版）</td>\n" +
                    "\t</tr>\n" +
                    "\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' >备注：</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' >1、本公开招租审核表必须经镇经管办常务副主任审核同意并签字盖章后有效。</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' >2、镇经管办提交该表时必须附上述招租资料。</td>\n" +
                    "\t</tr>\n" +
                    "\t<tr>\n" +
                    "\t\t<td colspan='6' >3、镇农经站在收到该表及所附资料后，在闵行区国有集体资产交易信息平台上对该租赁项目按公开招租流程进行招租。</td>\n" +
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
                setTimeout(function(){
                    window.print(); //调用浏览器的打印功能打印指定区域
                },200);
                window.document.body.innerHTML=bdhtml; // 最后还原页面
			},
			error:function(xhr,textStatus){
				layer.msg('Page refresh', {time: 2000});
//              layer.closeAll('loading');
				location.reload();
			},
		});
	}
</script>
<script>

    $(function () {

        $(".submit").click(function(){
            window.location.href = "/index?status=" + $("select[name='status']").val() + "&countryid=" + $("select[name='countryid']").val() + "&type=" + $("select[name='type']").val() + "&name=" + $("input[name='name']").val() + "&person=" + $("input[name='person']").val();
        });

        var num=$("#webticker-2").find("li").length;
        if (num>1) {
            setInterval(function(){
                $('#webticker-2').animate({
                    marginTop:"-26px"
                },500,function(){
                    $(this).css({marginTop : "0"}).find("li:first").appendTo(this);
                });
            }, 3000);
        }

        'use strict';
        $('.easypie').easyPieChart({
            easing: 'easeOutBounce',
            onStep: function (from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });
        var chart = window.chart = $('.easypie').data('easyPieChart');
        $('.js_update').on('click', function () {
            chart.update(Math.random() * 200 - 100);
        });

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