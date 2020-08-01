<?php /*a:1:{s:87:"/www/wwwroot/rent.niuguagua.com/application/admin/view/admin/admin_auth_group_list.html";i:1578232960;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员权限分组</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">管理员权限分组</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div style="padding-bottom: 10px;">
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="del">刪除</button>
                </div>
                <div class="layui-form" id="treeTable-list">
                    <table id="treeTable" class="layui-table" lay-skin="line" lay-filter="treeTable"></table>
                </div>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                    {{# if(d.id > 1 ){ }}
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">刪除</a>
                    {{# } }}
                </script>
            </div>
        </div>
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    var editObj=null,ptable=null,treetable=null,tableId='treeTable',layer=null;
    layui.config({base: '/static/layuiadmin/'})
        .extend({treetable:'treetable-lay/treetable'})
        .use(['table', 'jquery', 'treetable'], function () {
            var table = layui.table,
                $ = layui.$;
                treetable = layui.treetable;
            var renderTable = function (href){
                layer.load(2);
                treetable.render({
                    treeColIndex: 2,
                    treeSpid: "0",
                    treeIdName: 'id',
                    treePidName: 'pid',
                    elem: '#' + tableId,
                    url: href,
                    page: false,
                    cols: [[
                        {type: 'checkbox', fixed: 'left'},
                        {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                        {field: 'title', title: '分组名称', sort: true, width:180},
                        {field: 'module', title: '所属模块', sort: true},
                        // {field: 'type', title: '类型', sort: true},
                        {field: 'description', title: '描述信息', sort: true, width:200},
                        {field: 'status', title: '状态', sort: true},
                        {field: 'end_time', title: '有效期', sort: true},
                        {field: 'create_time', title: '创建时间', sort: true},
                        {field: 'update_time', title: '更新时间', sort: true},
                        {fixed: 'right', width: 165, align: 'center', toolbar: '#barDemo',title:"操作"}
                    ]],
                    done: function (res, curr, count) {
                        layer.closeAll('loading');
                        if (curr === 1) {
                            $("[data-index='0']").find('a[lay-event="del"]').css('display', 'none');
                        }
                    }
                });
        }
        renderTable("<?php echo url('admin/adminAuthGroupList'); ?>");

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
                    $.post("<?php echo url('delAdminAuthGroup'); ?>", {id: ids}, function (res) {
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
                    , title: "添加权限分组"
                    , content: "<?php echo url('adminAuthGroupForm'); ?>"
                    , area: ['700px', '600px']
                    , maxmin: true
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            var checked = getCookie('admin_auth_checked');
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('adminAuthGroupForm'); ?>", {
                                id: field.id,
                                title: field.title,
                                module: field.module,
                                pid: field.pid,
                                // type: field.type,
                                description: field.description,
                                end_time: field.end_time,
                                rules: checked,
                                status: field.status
                            }, function (res) {
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
        };
        $('.layuiadmin-btn-useradmin').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

        //监听行工具事件
        table.on('tool(treeTable)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;
            if (layEvent === 'del') {
                layer.confirm('真的删除行么', function (index) {
                    $.post('<?php echo url("admin/delAdminAuthGroup"); ?>', {id: [data.id]}, function (res) {
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
                    , title: '编辑权限组'
                    , content: "<?php echo url('adminAuthGroupForm'); ?>?id=" + data.id
                    , maxmin: true
                    , area: ['700px', '600px']
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            var checked = getCookie('admin_auth_checked');
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('adminAuthGroupForm'); ?>", {
                                id: field.id,
                                title: field.title,
                                module: field.module,
                                pid: field.pid,
                                // type: field.type,
                                description: field.description,
                                end_time: field.end_time,
                                rules: checked,
                                status: field.status
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