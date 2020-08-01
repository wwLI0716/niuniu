<?php /*a:1:{s:74:"/www/wwwroot/rent.niuguagua.com/application/admin/view/system/setting.html";i:1578234269;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>系统基本配置</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <style>
        .layui-form-label {
            width: 130px;
        }
        .layui-input, .layui-textarea {
            width: auto;
        }
    </style>
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-header">系统基本配置</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="" lay-filter="component-form-group">
                <div class="layui-col-xs4">
                    <label class="layui-form-label">消息接收手机号</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="number" name="get_notice_mobile" <?php if(isset($config['get_notice_mobile'])): ?> value="<?php echo htmlentities($config['get_notice_mobile']); ?>" <?php endif; ?>>
                    </div>
                    <div class="layui-form-mid layui-word-aux"></div>
                </div>
                <div class="layui-form-item layui-layout-admin">
                    <div class="layui-input-block">
                        <div class="layui-footer" style="left: 0;">
                            <button class="layui-btn" lay-submit="" lay-filter="component-form-demo">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form', 'laydate'], function(){
        var $ = layui.$
            ,admin = layui.admin
            ,element = layui.element
            ,layer = layui.layer
            ,form = layui.form;

        form.render(null, 'component-form-group');

        /* 监听提交 */
        form.on('submit(component-form-demo)', function(data){
            data.field.withdraw_time = '';
            //设置多选内容
            $('input:checkbox[name="withdraw_time"]:checked').each(function(){
                data.field.withdraw_time += $(this).val()+",";
            });
            $.post("<?php echo url('admin/system/setting'); ?>", {data: data.field}, function (res) {
                layer.msg(res.msg);
            }, 'json');
            return false;
        });
    });
</script>
</body>
</html>
