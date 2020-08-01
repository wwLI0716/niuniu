<?php /*a:1:{s:76:"/www/wwwroot/rent.niuguagua.com/application/admin/view/admin/admin_list.html";i:1578232893;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员管理</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
    <style>
        .layui-form-item .layui-input-inline {
            width: auto;
        }
        .layui-form-item .layui-input-inline select {
            border-color: #e6e6e6;
            border-radius: 2px;
            color: #666;
        }
    </style>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">管理员管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div style="padding-bottom: 10px;">
                    <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>
                    <a class="layui-btn layuiadmin-btn-useradmin" lay-event="del">刪除</a>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-inline">
                        <input style="width: auto;" type="text" id="nickname" name="nickname"  placeholder="请输入用户昵称" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline">
                        <input style="width: auto;" type="text" id="mobile" name="mobile"  placeholder="请输入手机号码" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline">
                        <select name="group_id" id="group_id" style="height:38px" lay-filter="area">
                            <option value="" selected>请选择管理分组</option>
                            <?php if(is_array($adminAuthGroupList) || $adminAuthGroupList instanceof \think\Collection || $adminAuthGroupList instanceof \think\Paginator): $i = 0; $__LIST__ = $adminAuthGroupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title_show']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                     <div class="layui-input-inline " style="width: 130px">
                        <select name="status" lay-verify="" id="status" style="height:38px">
                            <option value="" selected>请选择状态</option>
                            <option value="0">禁用</option>
                            <option value="1" >启用</option>
                        </select>
                     </div>
                    <div class="layui-input-inline " style="width: 90px">
                        <button class="layui-btn layuiadmin-btn-useradmin"  data-type="reload">
                            <i class="layui-icon" style="font-size: 20px; "></i> 搜索
                        </button>
                    </div>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                    {{# if(d.id > 1){ }}
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">刪除</a>
                    {{# } }}
                </script>
            </div>
        </div>
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.use(['table', 'jquery'], function () {
        var table = layui.table,
            $ = layui.$;

        $('#area_id').change(function(data){
            var areaId = $(this).val();
            $.post("<?php echo url('admin/Community/getInstitution'); ?>", {areaId: areaId}, function (res) {
                $('.institution_id').empty();
                if(res.length > 0)
                {
                    var html = '';
                    for(var a=0;a<res.length;a++)
                    {
                        html += '<option value="'+res[a]["id"]+'" >'+ res[a]["name"] +'</option>';
                    }
                    $('.institution_id').append(html);
                }
            });
        });

        table.render({
            elem: '#list',
            url: "<?php echo url('admin/adminList'); ?>", //数据接口
            title: '管理员表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left', width:100},
                {field: 'group_name', title: '权限组', sort: true, width:120},
                {field: 'username', title: '编号', sort: true, width:120},
                {field: 'nickname', title: '昵称', sort: true, width:100},
                {field: 'mobile', title: '手机号', sort: true,width:130},
                {field: 'status', title: '状态', sort: true, width:100},
                {field: 'last_login_time', title: '上次登陆时间', sort: true, width:180},
                {field: 'last_login_ip', title: '上次登陆IP', sort: true, width:180},
                {field: 'update_time', title: '更新时间', sort: true, width:180},
                {fixed: 'right', width: 165, align: 'center', toolbar: '#barDemo',title:'操作'}
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
                    $.post("<?php echo url('delAdmin'); ?>", {id: ids}, function (res) {
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
                    , title: "添加管理员"
                    , content: "<?php echo url('adminForm'); ?>"
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
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('adminForm'); ?>", {
                                id: field.id,
                                username: field.username,
                                nickname: field.nickname,
                                password: field.password,
                                avatar: field.avatar,
                                email: field.email,
                                mobile: field.mobile,
                                group_id: field.group_id,
                                status: field.status,
                                area_id: field.area_id,
                                institution_id: field.institution_id
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
            },
            reload: function () {
                var nickname=$('#nickname').val();
                var mobile=$('#mobile').val();
                var group_id=$('#group_id').val();
                var area_id=$('#area_id').val();
                var institution_id=$('#institution_id').val();
                var status=$('#status').val();
                    var index = layer.msg('查询中，请稍候...',{icon: 16,time:false,shade:0});

                    setTimeout(function(){
                        table.reload('list', { //表格的id
                            page: {
                                curr: 1 //重新从第 1 页开始
                            },
                            where: {
                                nickname:$.trim(nickname),
                                mobile:$.trim(mobile),
                                group_id : $.trim(group_id),
                                area_id:$.trim(area_id),
                                institution_id:$.trim(institution_id),
                                status:$.trim(status)
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
                layer.confirm('真的删除行么', function (index) {
                    $.post('<?php echo url("admin/delAdmin"); ?>', {id: [data.id]}, function (res) {
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
                    , title: '编辑管理员'
                    , content: "<?php echo url('adminForm'); ?>?aid=" + data.id
                    , maxmin: true
                    , area: ['600px', '500px']
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的 字段
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('adminForm'); ?>", {
                                id: field.id,
                                username: field.username,
                                nickname: field.nickname,
                                password: field.password,
                                avatar: field.avatar,
                                email: field.email,
                                mobile: field.mobile,
                                group_id: field.group_id,
                                status: field.status,
                                area_id: field.area_id,
                                institution_id: field.institution_id
                            }, function (res) {
                                if (res.code === 1) {
                                    layer.close(index);
                                    table.reload('list');
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