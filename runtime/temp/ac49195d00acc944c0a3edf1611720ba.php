<?php /*a:1:{s:72:"/www/wwwroot/rent.niuguagua.com/application/admin/view/access/index.html";i:1578233464;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>管理员权限</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
    <style>
        #edt-search {
            width: 120px;
            display: inline-block;
            position: relative;
            top: 2px;
        }
    </style>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">管理员权限</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-form-item">
                <div class="layui-inline tool-btn">
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="sort">排序</button>
                    <button class="layui-btn" id="btn-expand">全部展开</button>
                    <button class="layui-btn" id="btn-fold">全部摺疊</button>
                    <input class="layui-input" id="edt-search" type="text" placeholder="输入关键字" />
                    <button class="layui-btn" id="btn-search">搜索</button>
                </div>
            </div>
            <div class="layui-form" id="table-list">
                <table id="treeTable" class="layui-table" lay-skin="line" lay-filter="treeTable"></table>
            </div>
        </div>

        <!-- 操作列 -->
        <script type="text/html" id="access-state">
            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">刪除</a>
        </script>

    </div>
</div>
<script src="/static/layuiadmin/layui/layui.all.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var treetable=null,tableId='treeTable',layer=null;

    layui.config({base: '/static/layuiadmin/'})
        .extend({treetable:'treetable-lay/treetable'})
        .use(['table','jquery','treetable','layer'], function() {

            var $ = layui.jquery,
                table = layui.table,
                treetable = layui.treetable,
                layer = layui.layer;//很重要

            treetable.render({
                treeColIndex: 2,
                treeSpid: "0",
                treeIdName: 'id',
                treePidName: 'pid',
                elem: '#'+tableId,
                url: "<?php echo url('ajaxList'); ?>",
                page: false,
                cols: [[
                    {field: 'id', minWidth: 200, title: 'ID'},
                    {field: 'sort', width: 80, align: 'center', title: '排序'},
                    {field: 'title', minWidth: 200, title: '名称'},
                    {field: 'module', title: '模块'},
                    {field: 'name', minWidth: 200, title: 'URL'},
                    {
                        field: 'icon', width: 80, align: 'center', templet: function (d) {
                            if (d.icon != '' ) {
                                return '<i class="layui-icon '+d.icon+'"></i>';
                            } else {
                                return '';
                            }
                        }, title: '图标'
                    },
                    {
                        field: 'is_show', width: 120, align: 'center', templet: function (d) {
                            if (d.is_show == 0) {
                                return '<span class="layui-badge layui-bg-gray">关闭</span>';
                            } else {
                                return '<span class="layui-badge-rim layui-bg-blue">显示</span>';
                            }
                        }, title: '是否显示'
                    },
                    {
                        field: 'is_menu', width: 120, align: 'center', templet: function (d) {
                            if (d.is_menu == 0) {
                                return '<span class="layui-badge layui-bg-gray">菜单×</span>';
                            } else {
                                return '<span class="layui-badge-rim layui-bg-blue">菜单√</span>';
                            }
                        }, title: '是否菜单'
                    },
                    {templet: '#access-state', width: 180, align: 'center', title: '操作'}
                ]],
                done: function () {
                    layer.closeAll('loading');
                }
            });

            $('#btn-expand').click(function () {
                treetable.expandAll('#treeTable');
            });

            $('#btn-fold').click(function () {
                treetable.foldAll('#treeTable');
            });

            $('#btn-search').click(function () {
                var keyword = $('#edt-search').val();
                var searchCount = 0;
                $('#treeTable').next('.treeTable').find('.layui-table-body tbody tr td').each(function () {
                    $(this).css('background-color', 'transparent');
                    var text = $(this).text();
                    if (keyword != '' && text.indexOf(keyword) >= 0) {
                        $(this).css('background-color', 'rgba(250,230,160,0.5)');
                        if (searchCount == 0) {
                            treetable.expandAll('#treeTable');
                            $('html,body').stop(true);
                            $('html,body').animate({scrollTop: $(this).offset().top - 150}, 500);
                        }
                        searchCount++;
                    }
                });
                if (keyword == '') {
                    layer.msg("请输入搜索內容", {icon: 5});
                } else if (searchCount == 0) {
                    layer.msg("沒有匹配結果", {icon: 5});
                }
            });

            //事件
            var active = {
                del: function () {
                    var checkStatus = table.checkStatus('treeTable')
                        , checkData = checkStatus.data; //得到选中的数据
                    if (checkData.length === 0) {
                        return layer.msg('请选择数据');
                    }
                    var ids = [];
                    for (var v in checkData) {
                        ids.push(checkData[v].id);
                    }
                    layer.confirm('确定删除吗？', function (index) {
                        $.post("<?php echo url('admin/delAdminAuth'); ?>", {id: ids}, function (res) {
                            if (res.code === 1) {
                                layer.close(index);
                                table.reload('list');
                                layer.msg(res.msg);
                            } else {
                                layer.msg(res.msg);
                            }
                        }, 'json')
                    });
                }
                , add: function () {
                    layer.open({
                        type: 2,
                        title: "添加管理员权限",
                        content: "<?php echo url('admin/adminAuthForm'); ?>",
                        maxmin: true,
                        area: ['600px', '600px'],
                        btn: ['确定', '取消'],
                        yes: function (index, layero) {
                            var iframeWindow = window['layui-layer-iframe' + index]
                                , submitID = 'LAY-user-front-submit'
                                , submit = layero.find('iframe').contents().find('#' + submitID);

                            //监听提交
                            iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                                var field = data.field; //获取提交的字段
                                //提交 Ajax 成功后，静态更新表格中的数据
                                $.post("<?php echo url('admin/adminAuthForm'); ?>", {
                                    id: field.id,
                                    is_menu: field.is_menu,
                                    is_show: field.is_show,
                                    module: field.module,
                                    name: field.name,
                                    pid: field.pid,
                                    remark: field.remark,
                                    status: field.status,
                                    title: field.title,
                                    icon: field.icon,
                                    sort: field.sort
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
                        $.post('<?php echo url("admin/delAdminAuth"); ?>', {id: data.id}, function (res) {
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
                        , title: '编辑管理员权限'
                        , content: "<?php echo url('admin/adminAuthForm'); ?>?id=" + data.id
                        , maxmin: true
                        , area: ['600px', '600px']
                        , btn: ['确定', '取消']
                        , yes: function (index, layero) {
                            var iframeWindow = window['layui-layer-iframe' + index]
                                , submitID = 'LAY-user-front-submit'
                                , submit = layero.find('iframe').contents().find('#' + submitID);

                            //监听提交
                            iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                                var field = data.field; //获取提交的字段
                                //提交 Ajax 成功后，静态更新表格中的数据
                                $.post("<?php echo url('admin/adminAuthForm'); ?>", {
                                    id: field.id,
                                    is_menu: field.is_menu,
                                    is_show: field.is_show,
                                    module: field.module,
                                    name: field.name,
                                    pid: field.pid,
                                    remark: field.remark,
                                    status: field.status,
                                    title: field.title,
                                    icon: field.icon,
                                    sort: field.sort
                                }, function (res) {
                                    if (res.code === 1) {
                                        table.reload('list');   //数据刷新
                                        layer.close(index);     //关闭弹层
                                        layer.msg(res.msg);
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
</script>
</body>
</html>