<?php /*a:1:{s:90:"F:\ruanjian\wampServer\wamp64\www\rent.niuguagua.com\application\admin\view\apply\lst.html";i:1579436130;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>租赁申请管理</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">租赁申请管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div style="padding-bottom: 10px;">
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加用户</button>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-inline">
                        <input style="width: auto;" type="text" id="house_name" name="house_name"  placeholder="请输入楼宇名称" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline " style="width: 90px">
                        <button class="layui-btn layuiadmin-btn-useradmin"  data-type="reload">
                            <i class="layui-icon" style="font-size: 20px; "></i> 搜索
                        </button>
                    </div>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="seeAccount">租赁申请详情</a>
                    {{# if(d.status == 1){ }}
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">禁用</a>
                    {{# }else if(d.status == -1){ }}
                    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="fix">解封</a>
                    {{# } }}
                    <!--<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>-->
                    <!--<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">编辑</a>-->
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
            url: "<?php echo url('admin/apply/lst'); ?>", //数据接口
            title: '租赁申请表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {field: 'id', title: 'ID', sort: true, fixed: 'left',width:150},
                {field: 'house_name', title: '楼宇名称', sort: true,width:250},
                {field: 'username', title: '创建人', sort: true,width:150},
                {field: 'contract_type', title: '合同类型', sort: true, width:150},
                {field: 'process_type', title: '所属流程', sort: true, width:150},
                {field: 'is_soft_first', title: '是否需要安全办审核', sort: true, width:100},
                {field: 'is_public_rental', title: '是否公开招租', sort: true, width:100},
                {field: 'status', title: '状态', sort: true},
                {field: 'created_at', title: '创建时间', sort: true},
                {fixed: 'right', width: 165, align: 'center', toolbar: '#barDemo',title:"操作", width:200}
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
                var house_name=$('#house_name').val();
                var index = layer.msg('查询中，请稍候...',{icon: 16,time:false,shade:0});

                setTimeout(function(){
                    table.reload('list', { //表格的id
                        page: {
                            curr: 1 //重新从第 1 页开始
                        },
                        where: {
                            house_name:$.trim(house_name),
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
                parent.layui.index.openTabsPage('/Apply/userAccount?id=' + data.id,'租赁申请详情');
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