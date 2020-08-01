<?php /*a:4:{s:98:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\his\view_his_save.html";i:1593683360;s:93:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\shead.html";i:1595813888;s:92:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\left.html";i:1594024606;s:94:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\index\view\public\bottom.html";i:1588746419;}*/ ?>
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
<link rel="stylesheet" href="/wap//css/flatpickr.min.css">
<link rel="stylesheet" href="/wap//layui/css/layui.css">
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

    .show-module {
        display: inline-block;
        padding: 0;
        text-align: center;
        font-size: 1rem;
    }

    .show-module-sign {
        color: #3c7fff;
    }
    .none {
        display: none;
    }
    .layui-upload-file{
        display: none;
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
<!--    <section class="content-header header-top">-->
<!--        <div class="col-12">-->
<!--            <div class="box box-solid bg-black">-->
<!--                <div class="box-body box-body-spec">-->
<!--                    <div class="row">-->
<!--                        <div class="col-12 show-module-all">-->
<!--                            <div class="col-4 show-module show-module-sign">招标基本信息</div>-->
<!--                            <div class="col-3 show-module">对竞投方资格要求</div>-->
<!--                            <div class="col-3 show-module">对承租方经营出租物要求</div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <section class="content-header content-bottom">
        <div class="col-12">
            <div class="box box-solid bg-black">
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="demandInfo" name="demandInfo" action="" enctype="multipart/form-data" method="post">
                                <input type="hidden" id="bid_id" name="bid_id" value="<?php echo htmlentities($demondInfo['id']); ?>">
                                <div>
                                    <div class="show-module-content">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">报名开始时间</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="enrol_start_time" name="enrol_start_time"
                                                       class="form-control datepicker enrol_start_time"
                                                       placeholder="请输入报名开始时间" value="<?php echo htmlentities($demondInfo['enrol_start_time']); ?>"/>

                                            </div>
                                            <label class="col-sm-2 col-form-label">报名结束时间</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="enrol_end_time" name="enrol_end_time"
                                                       class="form-control datepicker enrol_end_time"
                                                       placeholder="请输入报名结束时间"
                                                       value="<?php echo htmlentities($demondInfo['enrol_end_time']); ?>" required/>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">	租赁方</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="rent_name" class="form-control"
                                                       placeholder="" value="<?php echo htmlentities($demondInfo['rent_name']); ?>"
                                                       required/>
                                            </div>
                                            <label class="col-sm-2 col-form-label">楼宇名称</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="rent_house" class="form-control"
                                                       placeholder="" value="<?php echo htmlentities($demondInfo['rent_house']); ?>"
                                                       required/>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">租赁层数</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="rent_floor" class="form-control"
                                                       placeholder="" value="<?php echo htmlentities($demondInfo['rent_floor']); ?>"
                                                       required/>
                                            </div>
                                            <label class="col-sm-2 col-form-label">出租面积</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="rent_area" class="form-control"
                                                       placeholder="" value="<?php echo htmlentities($demondInfo['rent_area']); ?>"
                                                       required/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">	租赁价格</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="rent_price" class="form-control"
                                                       placeholder="" value="<?php echo htmlentities($demondInfo['rent_price']); ?>"
                                                       required/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">合同扫描件</label>
                                            <div class="col-sm-4">
                                                <button type="button" class="layui-btn" id="file-a1">上传</button>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="hidden" id="va_file-a1" name="pdf" class="input normal upload-path" />
                                               <p id="pdfview"></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label"></label>
                                    <div class="col-sm-2">
                                        <input class="btn btn-primary btn-lg btn-block submit" type="submit" value="提交"
                                               readonly/>
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
<script src="/wap//js/2a559aaccaa34fb78270f9dc5f3dcac1.js"></script>
<script src="/wap//js/layer.js" type="text/javascript"></script>
<script src="/wap//js/common1.js" type="text/javascript"></script>
<script src="/wap//js/bootstrap.min.14d449eb8876.js" type="text/javascript"></script>
<script src="/wap//js/template.eca497836b5a.js"></script>
<script src="/wap//js/jquery.form.js"></script>
<script src="/wap//layui/layui.js"></script>
<script>
    var  admin_uploadimg = "uploadimg";
    var imglist = [
        'file-a1'
    ];

    $.each(imglist,function (k,v) {
        layui.use(['form','layer','upload'], function(){
            var form = layui.form,
                layer = layui.layer;
            upload = layui.upload;
            var $ = layui.jquery;

            //拖拽上传
            upload.render({
                elem: '#'+v
                ,url: admin_uploadimg
                ,accept:"file"
                ,acceptMime:"application/pdf"
                ,before: function(obj){
                }
                ,done: function(res){
                    if(res.code==200){
                        $("#va_"+v).val(res.data.msg);
                        layer.msg('上传成功',{
                            icon: 1,
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        });
                         $('#pdfview').html(res.data.msg); //图片链接（base64）zs_file-a1
                    }else{
                        layer.msg('上传失败');
                    }
                    //上传成功
                }
                ,error: function(){
                    alert("上传失败，稍后重试");
                }
            });
        });

    })
</script>
<script>
  function upload_file(){
            console.log(222)
            $.ajax({
                url: "<?php echo url('Bid/uploadBidAttach'); ?>",
                type: "post",
                data: formdata,
                processData: false,    // 不处理数据
                contentType: false,    // 不设置内容类型
                success: function (res) {
                    var res = JSON.parse(res);
                    layer.msg(res.info);
                    if (res.code == 100) {
                        $("#annex_address").val(res.data.address);
                        $(".showNowAnnex").html("<a href='" + res.data.address + "' download='" + res.data.address + "'>当前附件</a>");
                    }
                }
            })
        }
    $(function () {
        function upload_file(){
            console.log(222)
            $.ajax({
                url: "<?php echo url('Bid/uploadBidAttach'); ?>",
                type: "post",
                data: formdata,
                processData: false,    // 不处理数据
                contentType: false,    // 不设置内容类型
                success: function (res) {
                    var res = JSON.parse(res);
                    layer.msg(res.info);
                    if (res.code == 100) {
                        $("#annex_address").val(res.data.address);
                        $(".showNowAnnex").html("<a href='" + res.data.address + "' download='" + res.data.address + "'>当前附件</a>");
                    }
                }
            })
        }
        $('.getA').attr('href', $('.sendA').attr("href"));
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



        $('.show-module').click(function () {
            $(this).siblings().removeClass("show-module-sign");
            $(this).addClass("show-module-sign");
            var sinId = $(this).index();
            $('.show-module-content').eq(sinId).css("display", "block");
            $('.show-module-content').eq(sinId).siblings().css("display", "none");
        });

        $("input[type=radio][name=bidder_type]").change(function () {
            if (this.value == "1") {
                $(".bid_files1").removeClass("none");
                !$(".bid_files1").hasClass("none") && $(".bid_files2").addClass("none");
            }
            if (this.value == "2") {
                $(".bid_files2").removeClass("none");
                !$(".bid_files2").hasClass("none") && $(".bid_files1").addClass("none");
            }
        });



        //当表单提交时，调用所有的校验方法
        $("#demandInfo").submit(function () {
            var forthat = $(this);
            //询问框
            layer.open({
                content: '确认提交吗？'
                , btn: ['是', '否']
                , skin: 'loginout'
                , yes: function (index) {
                    var status = 1;
                    //验证
                    $('input').each(function () {
                        var that = $(this);
                        if ($(this).attr('name') != 'bid_id' && $(this).attr('name') != undefined && $(this).attr('name') != '' && $(this).attr('name') != 'other_require'&& $(this).attr('name') != 'file' ) {
                            if ($(this).val() == '') {
                                alert($(this).attr('name'))
                                layer.msg(that.attr('placeholder'), {time: 2000});
                                status = 0;
                                return false;
                            }
                        }
                    });

                    if (status == 0) {
                        return false;
                    }
                    layer.open({
                        type: 3,
                        skin: 'loading_style'
                    });
                    //1.发送数据到服务器
                    $.post(
                        "<?php echo url('His/saveHis'); ?>",
                        forthat.serialize(),
                        function (res) {
                            var res = JSON.parse(res);
                            layer.closeAll();
                            layer.msg(res.info, {time: 2000}, function () {
                                if (res.code == 100) {
                                    setTimeout(function () {
                                        window.history.go(-1);
                                    }, 500);
                                }
                            })
                        });
                    //2.不让页面跳转
                    return false;
                    //如果这个方法没有返回值，或者返回为true，则表单提交，如果返回为false，则表单不提交
                }
                , no: function (index) {
                    return false;
                }
            });

            return false;
        });


        $('.logout').click(function () {
            //询问框
            layer.open({
                content: '<?php echo lang("logout_tip"); ?>'
                , skin: 'loginout'
                , btn: ['<?php echo lang("yes"); ?>', '<?php echo lang("no"); ?>']
                , yes: function (index) {
                    window.location.href = "<?php echo url('index/Login/logout'); ?>";
                }
            });
        });
    });
</script>
</body>

</html>