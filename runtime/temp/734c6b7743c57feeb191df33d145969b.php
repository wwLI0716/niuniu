<?php /*a:1:{s:73:"/www/wwwroot/rent.niuguagua.com/application/admin/view/index/console.html";i:1578270867;}*/ ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>控制台</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
</head>
<body>
<div class="layui-fluid">
  <div class="layui-row layui-col-space15">
    <div class="layui-card">
      <div class="layui-card-header">余额统计</div>
      <div class="layui-card-body">
        <div class="layui-carousel layadmin-carousel layadmin-backlog">
          <div carousel-item>
            <ul class="layui-row layui-col-space10">
              <li class="layui-col-xs6">
                <a href="javascript:;" class="layadmin-backlog-body">
                  <h3>平台总用户</h3>
                  <p><cite><?php echo htmlentities($allUsers); ?></cite></p>
                </a>
              </li>
              <li class="layui-col-xs6">
                <a href="javascript:;" class="layadmin-backlog-body">
                  <h3>留言数量统计</h3>
                  <p><cite><?php echo htmlentities($messages); ?></cite></p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/static/layuiadmin/layui/layui.js?t=1"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'console']);
</script>
</body>
</html>