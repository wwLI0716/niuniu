<?php /*a:1:{s:77:"/www/wwwroot/rent.niuguagua.com/application/admin/view/user/user_account.html";i:1578233780;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户银行帐户</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <style>
        .layui-form-label {
            width: 150px;
        }
        .layui-form-item .layui-input-inline {
            width: 400px;
        }
        .layui-spec {
            margin-top: 50px;
            padding: 100px 0;
            text-align: center;
        }
        .showClass {
            width: 70%;
        }
    </style>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-card">
        <?php if(isset($userLst['username'])): ?>
        <div class="layui-card-header">用户: <?php echo htmlentities($userLst['username']); ?> /用户银行帐户</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="" method="post" lay-filter="admin-form">
                <div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-md6">
                            <label class="layui-form-label">开户行</label>
                            <div class="layui-input-inline">
                                <input type="text" value="<?php echo htmlentities($userLst['bankname']); ?>" lay-verify="required" autocomplete="off" class="layui-input" readonly />
                            </div>
                        </div>
                        <div class="layui-col-md6">
                            <label class="layui-form-label">开户支行</label>
                            <div class="layui-input-inline">
                                <input type="text" value="<?php echo htmlentities($userLst['bank_prov']); ?>" lay-verify="required" autocomplete="off" class="layui-input" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-md6">
                            <label class="layui-form-label">开户人</label>
                            <div class="layui-input-inline">
                                <input type="text" value="<?php echo htmlentities($userLst['bank_person']); ?>" lay-verify="required" autocomplete="off" class="layui-input" readonly />
                            </div>
                        </div>
                        <div class="layui-col-md6">
                            <label class="layui-form-label">用户卡号</label>
                            <div class="layui-input-inline">
                                <input type="text" value="<?php echo htmlentities($userLst['bank_card']); ?>" lay-verify="required" autocomplete="off" class="layui-input" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-md6">
                            <label class="layui-form-label">银行卡正面照片</label>
                            <div class="layui-input-inline">
                                <img class="showClass" src="<?php echo htmlentities($userLst['bank_img']); ?>" />
                            </div>
                        </div>
                </div>
            </form>
        </div>
        <?php else: ?>
        <div class="layui-spec">
            该用户暂未绑定银行帐户信息！
        </div>
        <?php endif; ?>
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script src="/static/layuiadmin/layui/jquery-1.10.2.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
    }).use(['index', 'form'],function() {
        var $ = layui.jquery,
            form = layui.form;
    });
</script>
</body>
</html>