<?php /*a:1:{s:78:"/www/wwwroot/rent.niuguagua.com/application/admin/view/apply/user_account.html";i:1579437070;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>租赁申请详情</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <style>
        .table {
            width: 100%;
        }
        .orderable {
            width: 30%;
            font-size: 18px;
            padding: 15px 0 0 20px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form" action="" method="post" lay-filter="admin-form">
                <div class="layui-form-item">
                    <div class="table-container table-responsive show-module-content">
                        <table class="table">
                            <tr>
                                <th class="orderable">楼宇名称: <?php echo htmlentities($demondInfo['house_name']); ?></th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    楼宇地址: <?php echo htmlentities($demondInfo['house_address']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地上层数: <?php echo htmlentities($demondInfo['house_up_height']); ?>/层
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地下层数: <?php echo htmlentities($demondInfo['house_down_height']); ?>/层
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地上面积: <?php echo htmlentities($demondInfo['house_up_area']); ?>/平方
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地下面积: <?php echo htmlentities($demondInfo['house_down_area']); ?>/平方
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    投资方式: <?php echo htmlentities($demondInfo['investment_mode']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    投资比例%: <?php echo htmlentities($demondInfo['investment_rate']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    投资总额: <?php echo htmlentities($demondInfo['investment_total']); ?>/万
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    楼宇性质: <?php echo htmlentities($demondInfo['house_nature']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    开工时间: <?php echo htmlentities($demondInfo['build_at']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    竣工时间: <?php echo htmlentities($demondInfo['finished_at']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    房产权证号: <?php echo htmlentities($demondInfo['house_card_number']); ?>
                                </th>
                            </tr>
                        </table>
                    </div>
                    <div class="table-container table-responsive show-module-content">
                        <table class="table">
                            <tr>
                                <th class="orderable">原租赁方: <?php echo htmlentities($demondInfo['original_tenant']); ?></th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁开始时间: <?php echo htmlentities($demondInfo['lease_start']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁结束时间: <?php echo htmlentities($demondInfo['lease_end']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁位置: <?php echo htmlentities($demondInfo['lease_position']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地上位置: <?php echo htmlentities($demondInfo['up_position']); ?>/层
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地下位置: <?php echo htmlentities($demondInfo['down_position']); ?>/层
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁面积: <?php echo htmlentities($demondInfo['lease_area']); ?>/平方
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地上面积: <?php echo htmlentities($demondInfo['lease_up_area']); ?>/平方
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地下面积: <?php echo htmlentities($demondInfo['lease_down_area']); ?>/平方
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    合同终止原因: <?php echo htmlentities($demondInfo['end_reason']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    合同终止日: <?php echo htmlentities($demondInfo['lease_end_day']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁单价: <?php echo htmlentities($demondInfo['lease_price']); ?>/元
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    物业管理费: <?php echo htmlentities($demondInfo['lease_manager_price']); ?>/元
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    递增方式: <?php echo htmlentities($demondInfo['incremental_way']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    退租违约金: <?php echo htmlentities($demondInfo['falsify']); ?>/元
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    房屋保证金: <?php echo htmlentities($demondInfo['house_deposit']); ?>/元
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    风险保证金: <?php echo htmlentities($demondInfo['risk_deposit']); ?>/元
                                </th>
                            </tr>
                        </table>
                    </div>
                    <div class="table-container table-responsive show-module-content">
                        <table class="table">
                            <tr>
                                <th class="orderable">合同类型: <?php echo htmlentities($demondInfo['contract_mode']); ?></th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁方式: <?php echo htmlentities($demondInfo['lease_mode']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁位置: <?php echo htmlentities($demondInfo['lease_position_now']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地上位置: <?php echo htmlentities($demondInfo['up_position_now']); ?>/层
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地下位置: <?php echo htmlentities($demondInfo['down_position_now']); ?>/层
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁面积: <?php echo htmlentities($demondInfo['lease_area_now']); ?>/平方
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地上面积: <?php echo htmlentities($demondInfo['lease_up_area_now']); ?>/平方
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    地下面积: <?php echo htmlentities($demondInfo['lease_down_area_now']); ?>/平方
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁年限: <?php echo htmlentities($demondInfo['lease_year']); ?>/年
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁开始时间: <?php echo htmlentities($demondInfo['lease_start_now']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁结束时间: <?php echo htmlentities($demondInfo['lease_end_now']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    免租期: <?php echo htmlentities($demondInfo['rent_free_period']); ?>/天
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租金起算日: <?php echo htmlentities($demondInfo['rent_start_day']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    租赁单价: <?php echo htmlentities($demondInfo['lease_price_now']); ?>/元
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    物业管理费: <?php echo htmlentities($demondInfo['lease_manager_price_now']); ?>/元
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    递增方式: <?php echo htmlentities($demondInfo['incremental_way_now']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    退租违约金: <?php echo htmlentities($demondInfo['falsify_now']); ?>/元
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    房屋保证金: <?php echo htmlentities($demondInfo['house_deposit_now']); ?>/元
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    风险保证金: <?php echo htmlentities($demondInfo['risk_deposit_now']); ?>/元
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    意向承租企业名称: <?php echo htmlentities($demondInfo['lease_unit']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    企业性质: <?php echo htmlentities($demondInfo['lease_unit_nature']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    注册资金: <?php echo htmlentities($demondInfo['register_capital']); ?>/万
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    经营范围: <?php echo htmlentities($demondInfo['business_scope']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    商务税务落地: <?php echo htmlentities($demondInfo['tax_landing']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    承租后实际用途: <?php echo htmlentities($demondInfo['purpose']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    实际经营状态: <?php echo htmlentities($demondInfo['management_state']); ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    上半年税收: <?php echo htmlentities($demondInfo['last_tax']); ?>/万
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    承诺实际税收:<?php echo htmlentities($demondInfo['real_tax']); ?>/万
                                </th>
                            </tr>
                            <tr>
                                <th class="orderable">
                                    特殊情况说明: <?php echo htmlentities($demondInfo['explain']); ?>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
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