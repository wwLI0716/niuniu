<?php /*a:1:{s:80:"/www/wwwroot/rent.niuguagua.com/application/admin/view/activity/advert_list.html";i:1579418213;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>留言管理</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
    <style>
        .laytable-cell-1-cover{
            height:100%;
            max-width: 100%;
        }
        .laytable-cell{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">留言管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div style="padding-bottom: 10px;">
                    <!--<button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>-->
                    <a class="layui-btn layuiadmin-btn-useradmin" data-type="del">刪除</a>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-inline">
                        <input style="width: auto;" type="text" id="title" name="title"  placeholder="请输入留言标题" autocomplete="off" class="layui-input">
                    </div>
                   <div class="layui-input-inline">
                        <input name="start_time"  id="datestart" lay-verify="date" placeholder="开始时间"
                       autocomplete="off"
                       class="layui-input" type="text">
                    </div>
                    <div class="layui-input-inline">
                        <input name="end_time" id="dateend" lay-verify="date" placeholder="结束时间"
                       autocomplete="off"
                       class="layui-input" type="text">
                    </div>
                     <!--<div class="layui-input-inline " style="width: 130px">
                        <select name="status" lay-verify="" id="status" style="height:38px">
                            <option value="" selected>请选择状态</option>
                            <option value="0">未回复</option>
                            <option value="1" >已回复</option>
                        </select>
                     </div>-->
                    <div class="layui-input-inline " style="width: 90px">
                        <button class="layui-btn layuiadmin-btn-useradmin"  data-type="reload">
                            <i class="layui-icon" style="font-size: 20px; "></i> 搜索
                        </button>
                    </div>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <!--{{# if(d.status == 0){ }}
                    <a class="layui-btn layui-btn-xs" lay-event="edit">回复</a>
                    {{# } }}-->
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">刪除</a>
                    {{# if(d.status == 1){ }}
                    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                    {{# } }}
                </script>
            </div>
        </div>
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.use(['table', 'jquery','laydate'], function () {
        var table = layui.table,
            $ = layui.$;
        var laydate = layui.laydate;

        laydate.render({
            elem: '#datestart'
            ,done: function(value, date, endDate){
            $('#datestart').val(value);
          }
        });
        laydate.render({
            elem: '#dateend'
            ,done: function(value, date, endDate){
            $('#dateend').val(value);
            }
        });
        table.render({
            elem: '#list',
            url: "<?php echo url('/activity/advert'); ?>", //数据接口
            title: '留言表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'username', title: '留言用户'},
                {field: 'description', title: '留言内容'},
                /*{field: 'reply', title: '回复内容'},*/
                {field: 'created_at', title: '留言时间', sort: true},
                /*{field: 'statusText', title: '回复状态', sort: true},*/
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
                    $.post("<?php echo url('/activity/delAdvert'); ?>", {id: ids}, function (res) {
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
                parent.layui.index.openTabsPage('activity/advertForm','留言添加');
                
            },
            reload: function () {
                var title=$('#title').val();
                var datestart=$('#datestart').val();
                var dateend=$('#dateend').val();
                var status=$('#status').val();
                    var index = layer.msg('查询中，请稍候...',{icon: 16,time:false,shade:0});

                    setTimeout(function(){
                        table.reload('list', { //表格的id
                            page: {
                                curr: 1 //重新从第 1 页开始
                            },
                            where: {
                                title:$.trim(title),
                                datestart:$.trim(datestart),
                                dateend:$.trim(dateend),
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
                    $.post('<?php echo url("/activity/delActivity"); ?>', {id: [data.id]}, function (res) {
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
                parent.layui.index.openTabsPage('/activity/advertForm?aid=' + data.id,'留言修改');
                
            }
        });
    });
</script>
</body>
</html>