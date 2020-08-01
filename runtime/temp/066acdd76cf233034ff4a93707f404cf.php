<?php /*a:1:{s:95:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\admin\view\user\user_role.html";i:1578277280;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户角色管理</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">用户角色管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div style="padding-bottom: 10px;">
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="del">刪除</button>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                        {{# if(d.id > 2){ }}
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">刪除</a>
                        {{# } }}
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
            url: "<?php echo url('admin/user/UserRole'); ?>", //数据接口
            title: '用户角色表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', fixed: 'left', sort: true},
                {field: 'name', title: '角色名', fixed: 'left', sort: true},
                {field: 'description', title: '描述', sort: true},
                {field: 'create_time', title: '创建时间', sort: true},
                {field: 'update_time', title: '更新时间', sort: true},
                {field: 'status', title: '状态', sort: true},
                {fixed: 'right', width: 165, align: 'center', toolbar: '#barDemo',title:"操作"}
            ]]
        });

        //事件
        var active = {
            del: function () {
                var checkStatus = table.checkStatus('list')
                    , checkData = checkStatus.data; //得到选中的数据
                if (checkData.length === 0) {
                    return layer.msg('请选择数据');
                }
                var ids = [];
                for (var v in checkData) {
                    ids.push(checkData[v].id);
                }
                layer.confirm('确定删除吗？', function (index) {
                    $.post("<?php echo url('admin/user/delUserRole'); ?>", {id: ids}, function (res) {
                        if (res.code === 1) {
                            layer.close(index);
                            table.reload('list');
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    }, 'json')
                })
            }
            , add: function () {
                layer.open({
                    type: 2
                    , title: "添加用户"
                    , content: "<?php echo url('admin/user/userRoleForm'); ?>"
                    , area: ['600px', '500px']
                    , maxmin: true
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            var checked = getCookie('user_rule_checked');
                            field.rules = checked;
                            var requireChecked = getCookie('user_require_checked');
                            field.requires = requireChecked;
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('admin/user/userRoleForm'); ?>", {
                                id: field.id,
                                name: field.name,
                                description: field.description,
                                pid: field.pid,
                                sort: field.sort,
                                status: field.status,
                                role_id: field.role_id,
                            }, function (res) {
                                if (res.code === 1) {
                                    layer.close(index);
                                    table.reload('list');
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
                layer.confirm('真的删除行么', function (index) {
                    $.post('<?php echo url("admin/user/delUserRole"); ?>', {id: [data.id]}, function (res) {
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
                    , content: "<?php echo url('admin/user/userRoleForm'); ?>?id=" + data.id
                    , maxmin: true
                    , area: ['600px', '500px']
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            var checked = getCookie('user_rule_checked');
                            field.rules = checked;
                            var requireChecked = getCookie('user_require_checked');
                            field.requires = requireChecked;
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('admin/user/userRoleForm'); ?>", {
                                id: field.id,
                                name: field.name,
                                description: field.description,
                                pid: field.pid,
                                sort: field.sort,
                                status: field.status,
                                role_id: field.role_id,
                            }, function (res) {
                                if (res.code === 1) {
                                    table.reload('list');   //数据刷新
                                    layer.close(index);     //关闭弹层
                                    layer.msg(res.msg);
                                    document.cookie = null;
                                } else {
                                    layer.msg(res.msg);
                                }
                            }, 'json');
                        });
                        submit.trigger('click');
                    }
                });
            }
        });
    });

    function getCookie(cname)
    {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++)
        {
            var c = ca[i].trim();
            if (c.indexOf(name)==0) return c.substring(name.length,c.length);
        }
        return "";
    }
</script>
</body>
</html>