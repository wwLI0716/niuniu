<?php /*a:4:{s:95:"/www/wwwroot/rent.niuguagua.com/application/index/view/examine/see_demand_security_examine.html";i:1585708514;s:72:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/shead.html";i:1585686728;s:71:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/left.html";i:1579008137;s:73:"/www/wwwroot/rent.niuguagua.com/application/index/view/public/bottom.html";i:1579008099;}*/ ?>
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
                                <form id="examineInfo" name="examineInfo" action="<?php echo url('getreleaseExamine'); ?>" method="post">
                                    <input type="hidden" id="apple_id" name="apple_id" value="<?php echo htmlentities($demondInfo['apple_id']); ?>">
                                    <input type="hidden" id="id" name="id" value="<?php echo htmlentities($demondInfo['id']); ?>">
                                    <input type="hidden" id="house_name" name="house_name" value="<?php echo htmlentities($demondInfo['house_name']); ?>">
                                    <input type="hidden" id="examine_id" name="examine_id" value="<?php echo htmlentities($examineInfo['id']); ?>">
                                    <?php if($demondInfo['apple_is_soft_first'] == 1): ?>
                                    <input type="hidden" id="safe_img" name="safe_img" placeholder="请上传附件" value="<?php echo htmlentities($examineInfo['safe_img']); ?>">
                                    <?php endif; ?>
                                    <input type="hidden" id="security_examine_status" name="security_examine_status" value="0">
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
                                    <?php if($demondInfo['apple_is_soft_first'] == 1): ?>
                                    <h1 class="show-title show-title-special">审核信息</h1>
                                    <div class="form-group">
                                        <label class="control-label">1、是否建立、健全本单位安全生产责任制</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['safe_1']): ?>checked<?php endif; ?> name="safe_1" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['safe_1']): ?>checked<?php endif; ?> name="safe_1" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="safe_reason_1" id="safe_reason_1" rows="5"><?php if($examineInfo['safe_reason_1'] == ''): ?>请输入审核意见<?php else: ?><?php echo htmlentities($examineInfo['safe_reason_1']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">2、是否组织制定本单位安全生产、消防安全规章制度和操作规程</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['safe_2']): ?>checked<?php endif; ?> name="safe_2" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['safe_2']): ?>checked<?php endif; ?> name="safe_2" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="safe_reason_2" id="safe_reason_2" rows="5"><?php if($examineInfo['safe_reason_2'] == ''): ?>请输入审核意见<?php else: ?><?php echo htmlentities($examineInfo['safe_reason_2']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">3、建筑物二次装修是否经消防验收合格（未经消防验收合格禁止投入使用）</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['safe_3']): ?>checked<?php endif; ?> name="safe_3" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['safe_3']): ?>checked<?php endif; ?> name="safe_3" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="safe_reason_3" id="safe_reason_3" rows="5"><?php if($examineInfo['safe_reason_3'] == ''): ?>请输入审核意见<?php else: ?><?php echo htmlentities($examineInfo['safe_reason_3']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">4、是否制定并实施安全生产教育和培训计划或消防演练</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['safe_4']): ?>checked<?php endif; ?> name="safe_4" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['safe_4']): ?>checked<?php endif; ?> name="safe_4" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="safe_reason_4" id="safe_reason_4" rows="5"><?php if($examineInfo['safe_reason_4'] == ''): ?>请输入审核意见<?php else: ?><?php echo htmlentities($examineInfo['safe_reason_4']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">5、是否落实安全资金投入，定期对消防设施或器材进行检查检测</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['safe_5']): ?>checked<?php endif; ?> name="safe_5" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['safe_5']): ?>checked<?php endif; ?> name="safe_5" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="safe_reason_5" id="safe_reason_5" rows="5"><?php if($examineInfo['safe_reason_5'] == ''): ?>请输入审核意见<?php else: ?><?php echo htmlentities($examineInfo['safe_reason_5']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">6、是否建立健全安全生产事故隐患排查治理制度，及时发现、消除事故隐患并如实记录</label>
                                        <div class="show-p radio">
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(1 == $examineInfo['safe_6']): ?>checked<?php endif; ?> name="safe_6" value="1"><span class="radio-text">是</span>
                                            </label>
                                            <label  class="radio-inline">
                                                <input type="radio" <?php if(0 == $examineInfo['safe_6']): ?>checked<?php endif; ?> name="safe_6" value="0"><span class="radio-text">否</span>
                                            </label>
                                        </div>
                                        <div class="row special-row">
                                            <textarea class="form-control" name="safe_reason_6" id="safe_reason_6" rows="5"><?php if($examineInfo['safe_reason_6'] == ''): ?>请输入审核意见<?php else: ?><?php echo htmlentities($examineInfo['safe_reason_6']); endif; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">上传文件</label>
                                        <div class="show-p radio">
                                            <input type="file" <?php if($examineInfo['safe_img'] != ''): ?> disabled data-default-file="<?php echo htmlentities($examineInfo['safe_img']); ?>"<?php endif; ?> data-max-file-size="200M" name="attachments" accept="image/*" class="safe_img" placeholder="请上传附件" title="" multiple="multiple" />
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <h1 class="show-title show-title-special">审核信息</h1>
                                    <div class="row special-row">
                                        <textarea class="form-control" name="security_examine_reason" id="security_examine_reason" rows="5"><?php if($examineInfo['security_examine_reason'] == ''): ?>请输入审核意见<?php else: ?><?php echo htmlentities($examineInfo['security_examine_reason']); endif; ?></textarea>
                                    </div>
                                    <?php if($examineInfo['security_examine_status'] == 0): ?>
                                    <div class="row special-row special-row-m">
                                        <input class="btn btn-primary btn-lg senData toUrl" type="submit" value="同意" readonly />
                                        <input class="btn btn-primary btn-lg seeLog toUrl" type="submit" value="不同意" readonly />
                                    </div>
                                    <?php endif; ?>
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
<script src="/wap//js/dropify.min.c33a6db4b019.js"></script>
<script>
$(function () {

    $('.getA').attr('href',$('.sendA').attr("href"));
    $('.pageName').html($(".sendContent").html());

    $('input[type="file"]').dropify({
        showRemove: false,
        messages: {
            'default': '<?php echo lang("img_tip"); ?>',
            'replace': '<?php echo lang("img_replace"); ?>',
            'remove': '<?php echo lang("remove"); ?>',
            'error': '<?php echo lang("something_woring"); ?>'
        },
        error: {
            'fileSize': 'The file size is too big ( max).',
            'minWidth': 'The image width is too small (}px min).',
            'maxWidth': 'The image width is too big (}px max).',
            'minHeight': 'The image height is too small (}px min).',
            'maxHeight': 'The image height is too big (px max).',
            'imageFormat': 'The image format is not allowed ( only).'
        }
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

    $('.show-module').click(function(){
        $(this).siblings().removeClass("show-module-sign");
        $(this).addClass("show-module-sign");
        var sinId = $(this).index();
        $('.show-module-content').eq(sinId).css("display","block");
        $('.show-module-content').eq(sinId).siblings().css("display","none");
    });

    //当表单提交时，调用所有的校验方法
    $('.toUrl').click(function(){
        if($(this).val() == "同意")
        {
            $("#security_examine_status").val(1);
        } else {
            $("#security_examine_status").val(0);
        }
        $("#safe_img").val($('.safe_img').next().find('img').attr('src'));
        $("#examineInfo").submit(function(){
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
                        if($(this).attr('name') != 'id' && $(this).attr('name') != 'apple_id' && $(this).attr('name') != undefined && $(this).attr('name') != '')
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

                    /*layer.open({
                        type: 3,
                        skin: 'loading_style'
                    });*/
                    //1.发送数据到服务器
                    $.post("<?php echo url('Examine/getsaftExamine'); ?>",forthat.serialize(),function(res){
                        var res = JSON.parse(res);
                        /*layer.closeAll();*/
                        layer.msg(res.info, {time: 2000}, function () {
                            if(res.code == 100)
                            {
                                setTimeout(function(){ window.location.reload();},2000);
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
    });

});
</script>
</body>

</html>