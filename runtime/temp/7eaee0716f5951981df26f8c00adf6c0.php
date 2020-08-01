<?php /*a:4:{s:89:"/www/wwwroot/rent.niuguagua.com/application/index/view/examine/release_mobile_demand.html";i:1585707253;s:72:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/shead.html";i:1585686728;s:71:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/left.html";i:1579008137;s:73:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/bottom.html";i:1579008099;}*/ ?>
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
<link rel="stylesheet" href="/wap//css/flatpickr.min.css">
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
    .specSearch {
        border: 0 !important;
        background-color: #eee !important;
        color: #555 !important;
    }
    .show-module {
        display: inline-block;
        padding: 0;
        text-align: center;
        font-size: 1rem;
    }
    .show-module-sign {
        color: #3c7fff;
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
            <li class="breadcrumb-item active sendContent">提交申请</li>
        </ol>
    </section>
    <section class="content-header header-top">
        <div class="col-12">
            <div class="box box-solid bg-black">
                <div class="box-body box-body-spec">
                    <div class="row">
                        <div class="col-12 show-module-all">
                            <div class="col-4 show-module show-module-sign">楼宇基本信息</div>
                            <div class="col-3 show-module">原租赁信息</div>
                            <div class="col-3 show-module">拟租赁信息</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-header content-bottom">
        <div class="col-12">
            <div class="box box-solid bg-black">
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="demandInfo" name="demandInfo" action="<?php echo url('getreleaseDemand'); ?>" enctype="multipart/form-data" method="post">
                                <input type="hidden" id="id" name="id" value="<?php echo htmlentities($demondInfo['id']); ?>">
                                <input type="hidden" id="apple_id" name="apple_id" value="<?php echo htmlentities($demondInfo['apple_id']); ?>">
                                <div>
                                    <div class="show-module-content">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">楼宇名称</label>
                                            <div class="col-sm-10 input-group">
                                                <input type="text" name="house_name" class="form-control" placeholder="请输入楼宇名称" value="<?php echo htmlentities($demondInfo['house_name']); ?>" required />
                                                <?php if(!isset($demondInfo)): ?><span class="input-group-addon specSearch">搜索</span><?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">楼宇地址</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="house_address" class="form-control" placeholder="请输入楼宇地址" value="<?php echo htmlentities($demondInfo['house_address']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地上层数/层</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="house_up_height" class="form-control" placeholder="请输入地上层数" value="<?php echo htmlentities($demondInfo['house_up_height']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地下层数/层</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="house_down_height" class="form-control" placeholder="请输入地下层数" value="<?php echo htmlentities($demondInfo['house_down_height']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地上面积</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="house_up_area" class="form-control" placeholder="请输入地上面积" value="<?php echo htmlentities($demondInfo['house_up_area']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地下面积</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="house_down_area" class="form-control" placeholder="请输入地下面积" value="<?php echo htmlentities($demondInfo['house_down_area']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">投资方式</label>
                                            <div class="col-sm-10">
                                                <!--<input type="text" name="investment_mode" class="form-control" placeholder="请输入投资方式" value="<?php echo htmlentities($demondInfo['investment_mode']); ?>" required />-->
                                                <select name="investment_mode" class="form-control investment_mode">
                                                    <?php if(is_array($investment_mode) || $investment_mode instanceof \think\Collection || $investment_mode instanceof \think\Paginator): $i = 0; $__LIST__ = $investment_mode;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo htmlentities($vo); ?>" <?php if($demondInfo['investment_mode'] == $vo): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">投资比例%</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="investment_rate" class="form-control" placeholder="请输入投资比例" value="<?php echo htmlentities($demondInfo['investment_rate']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">投资总额/万</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="investment_total" class="form-control" placeholder="请输入投资总额/万" value="<?php echo htmlentities($demondInfo['investment_total']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">楼宇性质</label>
                                            <div class="col-sm-10">
                                                <!--<input type="text" name="house_nature" class="form-control" placeholder="请输入楼宇性质" value="<?php echo htmlentities($demondInfo['house_nature']); ?>" required />-->
                                                <select name="house_nature" class="form-control house_nature">
                                                    <?php if(is_array($nature_of_building) || $nature_of_building instanceof \think\Collection || $nature_of_building instanceof \think\Paginator): $i = 0; $__LIST__ = $nature_of_building;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo htmlentities($vo); ?>" <?php if($demondInfo['house_nature'] == $vo): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="build_at">开工时间</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="build_at" name="build_at" class="form-control datepicker build_at" placeholder="请输入开工时间" value="<?php echo htmlentities($demondInfo['build_at']); ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">竣工时间</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="finished_at" name="finished_at" class="form-control datepicker finished_at" placeholder="请输入竣工时间" value="<?php echo htmlentities($demondInfo['finished_at']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">房产权证号</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="house_card_number" class="form-control" placeholder="请输入房产权证号" value="<?php echo htmlentities($demondInfo['house_card_number']); ?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="show-module-content" style="display: none;">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">原租赁方</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="original_tenant" class="form-control" placeholder="请输入原租赁方" value="<?php echo htmlentities($demondInfo['original_tenant']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁开始时间</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="lease_start" name="lease_start" class="form-control datepicker lease_start" placeholder="请输入租赁开始时间" value="<?php echo htmlentities($demondInfo['lease_start']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁结束时间</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="lease_end" name="lease_end" class="form-control datepicker lease_end" placeholder="请输入租赁结束时间" value="<?php echo htmlentities($demondInfo['lease_end']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁位置</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="lease_position" class="form-control" placeholder="请输入租赁位置" value="<?php echo htmlentities($demondInfo['lease_position']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地上位置/层</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="up_position" class="form-control" placeholder="请输入地上位置" value="<?php echo htmlentities($demondInfo['up_position']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地下位置/层</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="down_position" class="form-control" placeholder="请输入地下位置" value="<?php echo htmlentities($demondInfo['down_position']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁面积</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_area" class="form-control" placeholder="请输入租赁面积" value="<?php echo htmlentities($demondInfo['lease_area']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地上面积</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_up_area" class="form-control" placeholder="请输入租赁地上面积" value="<?php echo htmlentities($demondInfo['lease_up_area']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地下面积</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_down_area" class="form-control" placeholder="请输入租赁地下面积" value="<?php echo htmlentities($demondInfo['lease_down_area']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">合同终止原因</label>
                                            <div class="col-sm-10">
                                                <!--<input type="text" name="end_reason" class="form-control" placeholder="请输入合同终止原因" value="<?php echo htmlentities($demondInfo['end_reason']); ?>" required />-->
                                                <select name="end_reason" class="form-control end_reason">
                                                    <?php if(is_array($reasons_for_termination) || $reasons_for_termination instanceof \think\Collection || $reasons_for_termination instanceof \think\Paginator): $i = 0; $__LIST__ = $reasons_for_termination;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo htmlentities($vo); ?>" <?php if($demondInfo['end_reason'] == $vo): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">合同终止日</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="lease_end_day" name="lease_end_day" class="form-control datepicker lease_end_day" placeholder="请输入合同终止日" value="<?php echo htmlentities($demondInfo['lease_end_day']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁单价/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_price" class="form-control" placeholder="请输入租赁单价/元" value="<?php echo htmlentities($demondInfo['lease_price']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">物业管理费/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_manager_price" class="form-control" placeholder="请输入物业管理费/元" value="<?php echo htmlentities($demondInfo['lease_manager_price']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">递增方式</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="incremental_way" class="form-control" placeholder="请输入递增方式" value="<?php echo htmlentities($demondInfo['incremental_way']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">退租违约金/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="falsify" class="form-control" placeholder="请输入退租违约金/元" value="<?php echo htmlentities($demondInfo['falsify']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">房屋保证金/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="house_deposit" class="form-control" placeholder="请输入房屋保证金/元" value="<?php echo htmlentities($demondInfo['house_deposit']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">风险保证金/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="risk_deposit" class="form-control" placeholder="请输入风险保证金/元" value="<?php echo htmlentities($demondInfo['risk_deposit']); ?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="show-module-content" style="display: none;">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">合同类型</label>
                                            <div class="col-sm-10">
                                                <!--<input type="text" name="contract_mode" class="form-control" placeholder="请输入合同类型" value="<?php echo htmlentities($demondInfo['contract_mode']); ?>" required />-->
                                                <select name="contract_mode" class="form-control contract_mode">
                                                    <?php if(is_array($type_of_contract) || $type_of_contract instanceof \think\Collection || $type_of_contract instanceof \think\Paginator): $i = 0; $__LIST__ = $type_of_contract;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo htmlentities($vo); ?>" <?php if($demondInfo['contract_mode'] == $vo): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁方式</label>
                                            <div class="col-sm-10">
                                                <!--<input type="text" name="lease_mode" class="form-control" placeholder="请输入租赁方式" value="<?php echo htmlentities($demondInfo['lease_mode']); ?>" required />-->
                                                <select name="lease_mode" class="form-control lease_mode">
                                                    <?php if(is_array($leasing_mode) || $leasing_mode instanceof \think\Collection || $leasing_mode instanceof \think\Paginator): $i = 0; $__LIST__ = $leasing_mode;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo htmlentities($vo); ?>" <?php if($demondInfo['lease_mode'] == $vo): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁位置</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="lease_position_now" class="form-control" placeholder="请输入租赁位置" value="<?php echo htmlentities($demondInfo['lease_position_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地上位置</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="up_position_now" class="form-control" placeholder="请输入地上位置" value="<?php echo htmlentities($demondInfo['up_position_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地下位置</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="down_position_now" class="form-control" placeholder="请输入地下位置" value="<?php echo htmlentities($demondInfo['down_position_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁面积</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_area_now" class="form-control" placeholder="请输入租赁面积" value="<?php echo htmlentities($demondInfo['lease_area_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地上面积</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_up_area_now" class="form-control" placeholder="请输入地上面积" value="<?php echo htmlentities($demondInfo['lease_up_area_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">地下面积</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_down_area_now" class="form-control" placeholder="请输入地下面积" value="<?php echo htmlentities($demondInfo['lease_down_area_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁年限/年</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_year" class="form-control" placeholder="请输入租赁年限/年" value="<?php echo htmlentities($demondInfo['lease_year']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁开始时间</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="lease_start_now" name="lease_start_now" class="form-control datepicker lease_start_now" placeholder="请输入租赁开始时间" value="<?php echo htmlentities($demondInfo['lease_start_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁结束时间</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="lease_end_now" name="lease_end_now" class="form-control datepicker lease_end_now" placeholder="请输入租赁结束时间" value="<?php echo htmlentities($demondInfo['lease_end_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">免租期/天</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="rent_free_period" class="form-control" placeholder="请输入免租期/天" value="<?php echo htmlentities($demondInfo['rent_free_period']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租金起算日</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="rent_start_day" name="rent_start_day" class="form-control datepicker rent_start_day" placeholder="请输入租金起算日" value="<?php echo htmlentities($demondInfo['rent_start_day']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁单价/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_price_now" class="form-control" placeholder="请输入租赁单价/元" value="<?php echo htmlentities($demondInfo['lease_price_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">物业管理费/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lease_manager_price_now" class="form-control" placeholder="请输入物业管理费/元" value="<?php echo htmlentities($demondInfo['lease_manager_price_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">递增方式</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="incremental_way_now" class="form-control" placeholder="请输入递增方式" value="<?php echo htmlentities($demondInfo['incremental_way_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">退租违约金/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="falsify_now" class="form-control" placeholder="请输入退租违约金/元" value="<?php echo htmlentities($demondInfo['falsify_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">房屋保证金/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="house_deposit_now" class="form-control" placeholder="请输入房屋保证金/元" value="<?php echo htmlentities($demondInfo['house_deposit_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">风险保证金/元</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="risk_deposit_now" class="form-control" placeholder="请输入风险保证金/元" value="<?php echo htmlentities($demondInfo['risk_deposit_now']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">意向承租企业名称</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="lease_unit" class="form-control" placeholder="请输入意向承租企业名称" value="<?php echo htmlentities($demondInfo['lease_unit']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">企业性质</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="lease_unit_nature" class="form-control" placeholder="请输入企业性质" value="<?php echo htmlentities($demondInfo['lease_unit_nature']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">注册资金/万</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="register_capital" class="form-control" placeholder="请输入注册资金/万" value="<?php echo htmlentities($demondInfo['register_capital']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">经营范围</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="business_scope" class="form-control" placeholder="请输入经营范围" value="<?php echo htmlentities($demondInfo['business_scope']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">商务税务落地</label>
                                            <div class="col-sm-10">
                                                <!--<input type="text" name="tax_landing" class="form-control" placeholder="请输入商务税务落地" value="<?php echo htmlentities($demondInfo['tax_landing']); ?>" required />-->
                                                <select name="tax_landing" class="form-control tax_landing">
                                                    <?php if(is_array($tax_landing) || $tax_landing instanceof \think\Collection || $tax_landing instanceof \think\Paginator): $i = 0; $__LIST__ = $tax_landing;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo htmlentities($vo); ?>" <?php if($demondInfo['tax_landing'] == $vo): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">承租后实际用途</label>
                                            <div class="col-sm-10">
                                                <!--<input type="text" name="purpose" class="form-control" placeholder="请输入承租后实际用途" value="<?php echo htmlentities($demondInfo['purpose']); ?>" required />-->
                                                <select name="purpose" class="form-control purpose">
                                                    <?php if(is_array($actual_use_after_lease) || $actual_use_after_lease instanceof \think\Collection || $actual_use_after_lease instanceof \think\Paginator): $i = 0; $__LIST__ = $actual_use_after_lease;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo htmlentities($vo); ?>" <?php if($demondInfo['purpose'] == $vo): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">实际经营状态</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="management_state" class="form-control" placeholder="请输入实际经营状态" value="<?php echo htmlentities($demondInfo['management_state']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">上年度税收</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="last_tax" class="form-control" placeholder="请输入上年度税收" value="<?php echo htmlentities($demondInfo['last_tax']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">承诺实际税收/万</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="real_tax" class="form-control" placeholder="请输入承诺实际税收/万" value="<?php echo htmlentities($demondInfo['real_tax']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <textarea class="form-control" name="explain" id="explain" rows="5"><?php if(isset($demondInfo['explain']) && $demondInfo['explain'] != ''): ?><?php echo htmlentities($demondInfo['explain']); else: ?>特殊情况说明<?php endif; ?></textarea>
                                        </div>
                                        <div class="form-group row">
                                            <input type="hidden" id="annex_address" name="annex_address" placeholder="请上传附件" value="<?php echo htmlentities($demondInfo['annex_address']); ?>" />
                                            <label class="col-sm-2 col-form-label showNowAnnex"><?php if($demondInfo['annex_address'] == ''): ?>上传附件<?php else: ?><a class="nowAnnex" href="<?php echo htmlentities($demondInfo['annex_address']); ?>" download="<?php echo htmlentities($demondInfo['annex_address']); ?>">当前附件</a><?php endif; ?></label>
                                            <div class="col-sm-10">
                                                <input type="file" id="annex_address_show" name="annex_address_show" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!--<label class="col-sm-2 col-form-label"></label>-->
                                    <div class="col-sm-12">
                                        <input class="btn btn-primary btn-lg btn-block submit" type="submit" value="提交" readonly />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
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
<script src="/wap//js/2a559aaccaa34fb78270f9dc5f3dcac1.js"></script>
<script src="/wap//js/layer.js" type="text/javascript"></script>
<script src="/wap//js/common1.js" type="text/javascript"></script>
<script src="/wap//js/bootstrap.min.14d449eb8876.js" type="text/javascript"></script>
<script src="/wap//js/template.eca497836b5a.js"></script>
<script src="/wap//js/jquery.form.js"></script>
<script>
    $(function () {
        $('.getA').attr('href',$('.sendA').attr("href"));
        $('.pageName').html($(".sendContent").html());

        flatpickr(".datepicker", {
            onReady: function (dateObj, dateStr, instance) {
                var $cal = $(instance.calendarContainer);
                if ($cal.find('.flatpickr-clear').length < 1) {
                    $cal.append('<div class="flatpickr-clear">Clear</div>');
                    $cal.find('.flatpickr-clear').on('click', function () {
                        instance.clear();
                        instance.close();
                    });
                }
            }
        });

        $('.show-module').click(function(){
            $(this).siblings().removeClass("show-module-sign");
            $(this).addClass("show-module-sign");
            var sinId = $(this).index();
            $('.show-module-content').eq(sinId).css("display","block");
            $('.show-module-content').eq(sinId).siblings().css("display","none");
        });

        //文件上传
        $("#annex_address_show").change(function(){
            var formdata=new FormData();
            formdata.append("annex_address",$("#annex_address_show")[0].files[0]);
            $.ajax({
                url:"<?php echo url('Examine/updateFile'); ?>",
                type:"post",
                data:formdata,
                processData: false ,    // 不处理数据
                contentType: false,    // 不设置内容类型
                success:function(res){
                var res = JSON.parse(res);
                layer.msg(res.info);
                if(res.code == 100)
                {
                    $("#annex_address").val(res.data.address);
                    $(".showNowAnnex").html("<a href='"+ res.data.address +"' download='"+ res.data.address +"'>当前附件</a>");
                }
            }
        })
        });

        //当表单提交时，调用所有的校验方法
        $("#demandInfo").submit(function(){
            var forthat = $(this);
            //询问框
            layer.open({
                content: '确认提交吗？'
                ,btn: ['是', '否']
                ,skin: 'loginout'
                ,yes: function(index){
                    var status = 1;
                    //验证
                    $('input').each(function () {
                        var that = $(this);
                        if($(this).attr('name') != 'annex_address' && $(this).attr('name') != 'id' && $(this).attr('name') != 'apple_id' && $(this).attr('name') != undefined && $(this).attr('name') != '' && $(this).attr('name') != 'annex_address_show')
                        {
                            if($(this).val() == '')
                            {
                                layer.msg(that.attr('placeholder'), {time: 2000});
                                status = 0;
                                return false;
                            }
                        }
                    });

                    if(status == 0)
                    {
                        return false;
                    }
                    layer.open({
                        type: 3,
                        skin: 'loading_style'
                    });
                    //1.发送数据到服务器
                    $.post(
                        "<?php echo url('Examine/getreleaseDemand'); ?>",
                        forthat.serialize(),
                        function(res){
                        var res = JSON.parse(res);
                        layer.closeAll();
                        layer.msg(res.info, {time: 2000}, function () {
                            if(res.code == 100)
                            {
                                setTimeout(function(){ window.history.go(-1);},2000);
                            }
                        })
                    });
                    //2.不让页面跳转
                    return false;
                    //如果这个方法没有返回值，或者返回为true，则表单提交，如果返回为false，则表单不提交
                }
                ,no: function (index) {
                    return false;
                }
            });

            return false;
        });

        $(".specSearch").click(function(){
            var searchContent = $("input[name='house_name']").val();
            if(searchContent == "")
            {
                layer.msg("请填写搜索的内容!");
                return false;
            }
            //1.发送数据到服务器
            $.post("<?php echo url('Examine/searchNeed'); ?>",{"search_content": searchContent},function(res){
                var res = JSON.parse(res);
                layer.msg(res.info);
                if(res.code == 100)
                {
                    var nowContent = res.data;
                    for(var p in nowContent){
                        if($("."+ p).length > 0)
                        {
                            $("input[name='"+ p +"']").val(nowContent[p]);
                            $("." + p + " option").each(function(){
                                if($(this).val() == nowContent[p])
                                {
                                    $(this).attr("selected",true);
                                }
                            });
                        } else {
                            $("input[name='"+ p +"']").val(nowContent[p]);
                        }
                    }
                }
            });

        });

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