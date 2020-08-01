<?php /*a:1:{s:79:"/www/wwwroot/rent.niuguagua.com/application/admin/view/user/user_role_form.html";i:1578277158;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户角色编辑</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>
<form class="layui-form" action="" method="post" lay-filter="admin-form">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id" value="<?php echo htmlentities($role['id']); ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角色名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" value="<?php echo htmlentities($role['name']); ?>" lay-verify="required" placeholder="请输入角色名"
                   autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">建议統一中/英文，要求唯一。</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角色描述</label>
        <div class="layui-input-inline">
            <input type="text" name="description" value="<?php echo htmlentities($role['description']); ?>" lay-verify=""
                   placeholder="请输入角色描述"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">所属基本角色</label>
            <div class="layui-input-block">
                <select name="role_id" lay-filter="role_id">
                    <?php if(is_array($roles) || $roles instanceof \think\Collection || $roles instanceof \think\Paginator): $i = 0; $__LIST__ = $roles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($key); ?>" <?php if($role['role_id'] == $key): ?>selected<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="text" name="sort" value="<?php echo htmlentities((isset($role['sort']) && ($role['sort'] !== '')?$role['sort']:0)); ?>" lay-verify="required" placeholder="请输入排序"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <input <?php if(isset($role['status']) && $role['status']== 1): ?>checked<?php elseif(!isset($role['status'])): ?>checked<?php else: endif; ?> name="status" lay-skin="switch" lay-filter="switchTest"
            lay-text="启用|禁用" type="checkbox">
        </div>
    </div>

    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-user-front-submit" id="LAY-user-front-submit" value="确认">
    </div>
</form>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
        authtree: 'lib/extend/authtree'
    }).use(['jquery', 'authtree', 'form', 'layer', 'laydate'], function () {
        var $ = layui.jquery;
        var authtree = layui.authtree;
        var form = layui.form;
        var layer = layui.layer;
        var laydate = layui.laydate;

        laydate.render({
            elem: '#date'
        });
        // 监听自定义lay-filter选中状态，PS:layui现在不支持多次监听，所以扩展里边只能改变触发逻辑，然后引起了事件冒泡延迟的BUG，要是谁有好的建议可以反馈我
        form.on('checkbox(lay-check-auth)', function (data) {
            // 注意这里：需要等待事件冒泡完成，不然获取叶子节点不准确。
            setTimeout(function () {
                // 获取所有已选中节点
                var checked = authtree.getChecked('#LAY-auth-tree-index');
                document.cookie = "user_rule_checked=" + checked;
            }, 100);
        });

        // 监听自定义lay-filter选中状态，PS:layui现在不支持多次监听，所以扩展里边只能改变触发逻辑，然后引起了事件冒泡延迟的BUG，要是谁有好的建议可以反馈我
        form.on('checkbox(lay-check-require)', function (data) {
            // 注意这里：需要等待事件冒泡完成，不然获取叶子节点不准确。
            setTimeout(function () {
                // 获取所有已选中节点
                var requireChecked = authtree.getChecked('#LAY-auth-tree-indexx');
                document.cookie = "user_require_checked=" + requireChecked;
            }, 100);
        });
    });
</script>
</body>
</html>