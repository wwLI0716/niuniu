<?php /*a:1:{s:74:"/www/wwwroot/rent.niuguagua.com/application/admin/view/user/user_list.html";i:1578278417;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户管理</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">用户管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div style="padding-bottom: 10px;">
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加用户</button>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-inline">
                        <input style="width: auto;" type="text" id="username" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline " style="width: 90px">
                        <button class="layui-btn layuiadmin-btn-useradmin"  data-type="reload">
                            <i class="layui-icon" style="font-size: 20px; "></i> 搜索
                        </button>
                    </div>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="seeAccount">银行帐户</a>
                    {{# if(d.status == 1){ }}
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">禁用</a>
                    {{# }else if(d.status == -1){ }}
                    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="fix">解封</a>
                    {{# } }}
                    <!--<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>-->
                    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">编辑</a>
                </script>
            </div>

            <div class="layui-tab-item">
                <table id="data-list" lay-filter="list"></table>
            </div>
        </div>
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.use(['table', 'jquery'], function () {
        var table = layui.table,
            $ = layui.$;
        table.render({
            elem: '#list',
            url: "<?php echo url('admin/user/userList'); ?>", //数据接口
            title: '用户表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {field: 'id', title: 'ID', sort: true, fixed: 'left',width:100},
                {field: 'username', title: '用户名', sort: true,width:150},
                {field: 'moble', title: '手机号', sort: true, width:150},
                {field: 'email', title: '邮箱', sort: true, width:200},
                {field: 'statusText', title: '用户状态', sort: true, width:100},
                {field: 'is_real_text', title: '实名状态', sort: true, width:100},
                {field: 'role_name', title: '用户角色', sort: true},
                {field: 'addtime', title: '注册时间', sort: true},
                {fixed: 'right', width: 165, align: 'center', toolbar: '#barDemo',title:"操作", width:250}
            ]],
        });

        //事件
        var active = {
            add: function () {
                layer.open({
                    type: 2
                    , title: "添加用户"
                    , content: "<?php echo url('admin/user/userEditForm'); ?>"
                    , area: ['500px', '500px']
                    , maxmin: true
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            if(!data.field.email.match(/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/))
                            {
                                layer.msg("邮箱错误，请重新输入");
                                return false;
                            }
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('admin/user/userEditForm'); ?>", {data: data.field}, function (res) {
                                if (res.code === 1) {
                                    table.reload('list');   //数据刷新
                                    layer.close(index);     //关闭弹层
                                    layer.msg(res.msg);
                                } else {
                                    layer.msg(res.msg);
                                }
                            });
                        });
                        submit.trigger('click');
                    }
                });
            },
            reload: function () {
                var username=$('#username').val();
                var index = layer.msg('查询中，请稍候...',{icon: 16,time:false,shade:0});

                setTimeout(function(){
                    table.reload('list', { //表格的id
                        page: {
                            curr: 1 //重新从第 1 页开始
                        },
                        where: {
                            username:$.trim(username),
                        }
                    });
                    layer.close(index);
                },800);
                table.render();
            }
        };
        $('.layuiadmin-btn-useradmin').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

        //监听行工具事件
        table.on('tool(list)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;
            if (layEvent === 'del') {
                layer.confirm('禁用此用户吗？', function (index) {
                    $.post('<?php echo url("/user/delUser"); ?>', {id: [data.id]}, function (res) {
                        if (res.code === 1) {
                            layer.close(index);
                            table.reload('list');
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    });
                });
            }else if (layEvent === 'fix') {
                layer.confirm('解封此用户吗？', function (index) {
                    $.post('<?php echo url("/user/fixedUser"); ?>', {id: [data.id]}, function (res) {
                        if (res.code === 1) {
                            layer.close(index);
                            table.reload('list');
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    });
                });
            } else if (layEvent === 'useLst') {
                parent.layui.index.openTabsPage('/user/userForm?id=' + data.id,'用户资产');
            } else if (layEvent === 'seeAddress') {
                parent.layui.index.openTabsPage('/user/userAddress?id=' + data.id,'用户地址');
            } else if (layEvent === 'seeAccount') {
                parent.layui.index.openTabsPage('/user/userAccount?id=' + data.id,'银行帐户');
            }else if(layEvent === 'fix'){
                layer.confirm('真的需要修复吗？', function (index) {
                    $.post('<?php echo url("/user/fixedUser"); ?>', {id:data.id}, function (res) {
                        if (res.code === 1) {
                            obj.del();
                            layer.close(index);
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    });
                });
            } else if (layEvent === 'edit') {
                layer.open({
                    type: 2
                    , title: '编辑用户角色'
                    , content: "<?php echo url('admin/user/userEditForm'); ?>?id=" + data.id
                    , maxmin: true
                    , area: ['600px', '500px']
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            if(!data.field.email.match(/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/))
                            {
                                layer.msg("邮箱错误，请重新输入");
                                return false;
                            }
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('admin/user/userEditForm'); ?>", {data: data.field}, function (res) {
                                if (res.code === 1) {
                                    table.reload('list');   //数据刷新
                                    layer.close(index);     //关闭弹层
                                    layer.msg(res.msg);
                                } else {
                                    layer.msg(res.msg);
                                }
                            });
                        });
                        submit.trigger('click');
                    }
                });
            }
        });
    });
</script>
</body>
</html>