<?php /*a:1:{s:75:"/www/wwwroot/rent.niuguagua.com/application/admin/view/admin/admin_log.html";i:1578233042;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理日志</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">管理日志</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div style="padding-bottom: 10px;">
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="del">刪除</button>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">刪除</a>
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
            url: "<?php echo url('admin/adminLog'); ?>", //数据接口
            title: '管理日志表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'admin_id', title: '管理员ID', sort: true},
                {field: 'username', title: '用户名', sort: true},
                {field: 'module', title: '模块名', sort: true},
                {field: 'action', title: 'URL', sort: true},
                {field: 'param', title: '参数', sort: true},
                {field: 'title', title: '标题', sort: true},
                {field: 'content', title: '内容', sort: true},
                {field: 'ip', title: 'IP地址', sort: true},
                {field: 'user_agent', title: '客户端', sort: true},
                {field: 'create_time', title: '创建时间', sort: true},
                {fixed: 'right', width: 165, align: 'center', toolbar: '#barDemo'}
            ]],
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
                    $.post("<?php echo url('delAdminLog'); ?>", {id: ids}, function (res) {
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
                    $.post('<?php echo url("admin/delAdminLog"); ?>', {id: [data.id]}, function (res) {
                        if (res.code === 1) {
                            obj.del();
                            layer.close(index);
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    });
                });
            }
        });
    });
</script>
</body>
</html>