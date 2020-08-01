<?php /*a:1:{s:80:"/www/wwwroot/rent.niuguagua.com/application/admin/view/user/register_config.html";i:1578233548;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>系统配置</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-header">系统配置</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="" lay-filter="component-form-group">
                <div class="layui-form-item">
                    <label class="layui-form-label">系统logo</label>
                    <div class="layui-input-block">
                        <div class="layui-upload">
                            <button type="button" class="layui-btn" id="uploadcover">上传图片</button>
                            <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                                预览图：
                                <div class="layui-upload-list" id="demo1">
                                    <?php if(isset($config['system_logo']) && $config['system_logo'] != ''): ?>
                                    <img class="layui-upload-img" src="<?php echo htmlentities($config['system_logo']); ?>">
                                    <?php endif; ?>
                                </div>
                            </blockquote>
                            <input type="hidden" name="system_logo" id="more" value="<?php echo htmlentities($config['system_logo']); ?>" />
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-col-xs4">
                        <label class="layui-form-label">Twitter</label>
                        <div class="layui-input-block">
                            <input class="layui-input" type="text" name="twitter" <?php if(isset($config['twitter'])): ?> value="<?php echo htmlentities($config['twitter']); ?>" <?php endif; ?>>
                        </div>
                        <div class="layui-form-mid layui-word-aux"></div>
                    </div>
                    <div class="layui-col-xs4">
                        <label class="layui-form-label">Facebook</label>
                        <div class="layui-input-block">
                            <input class="layui-input" type="text" name="facebook" <?php if(isset($config['facebook'])): ?> value="<?php echo htmlentities($config['facebook']); ?>" <?php endif; ?>>
                        </div>
                        <div class="layui-form-mid layui-word-aux"></div>
                    </div>
                    <div class="layui-col-xs4">
                        <label class="layui-form-label">Google</label>
                        <div class="layui-input-block">
                            <input class="layui-input" type="text" name="google" <?php if(isset($config['google'])): ?> value="<?php echo htmlentities($config['google']); ?>" <?php endif; ?>>
                        </div>
                        <div class="layui-form-mid layui-word-aux"></div>
                    </div>
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
    }).use(['index', 'form', 'laydate','upload'], function(){
        var $ = layui.$
            ,admin = layui.admin
            ,upload = layui.upload
            ,element = layui.element
            ,layer = layui.layer
            ,form = layui.form;

            //普通图片上传
            var imgurl=[];
            var uploadInst = upload.render({
                elem: '#uploadcover'
                ,url: '<?php echo url("news/uploadImg"); ?>'
                ,multiple: true
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#demo1').empty();
                        $('#demo1').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
                    });
                }
                ,done: function(res){
                    //上传完毕
                    if(res.code ==0){
                        imgurl.push(res.url);
                        var jsonStr1 = JSON.stringify(imgurl);
                        $('#more').val(jsonStr1)
                        return layer.msg('上传成功');
                    }else{
                        return layer.msg('上传失败');
                    }

                }
            });

            form.render(null, 'component-form-group');

            /* 监听提交 */
            form.on('submit(component-form-demo)', function(data){
                var register_type = [];
                $("input[name='register_type']:checked").each(function () {
                    register_type.push(this.value);
                });
                var reg_switch = [];
                $("input[name='reg_switch']:checked").each(function () {
                    reg_switch.push(this.value);
                });
                data.field.reg_switch = reg_switch;
                data.field.register_type = register_type;
                $.post("<?php echo url('admin/user/registerConfig'); ?>", {data: data.field}, function (res) {
                    layer.msg(res.msg);
                    setTimeout(function(){ window.location.reload();},2000);
                }, 'json');
                return false;
            });
    });
</script>
</body>
</html>
