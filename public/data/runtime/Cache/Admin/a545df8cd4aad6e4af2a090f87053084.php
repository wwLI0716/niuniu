<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>政务咨询分类</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/Public/css/unicorn.main.css" />
    <link rel="stylesheet" href="/Public/css/unicorn.grey.css" class="skin-color" />
    <link rel="stylesheet" href="/Public/css/myCss.css" />
    <link rel="stylesheet" href="/Public/css/page.css"/>
    <script type="text/javascript" src="/Public/indexjs/jquery.js"></script>
    <script src="/Public/layer/layer.js" type="text/javascript"></script>
    <script charset="utf-8" src="/Public/editor/kindeditor.js"></script>
    <script charset="utf-8" src="/Public/editor/lang/zh_CN.js"></script>
    <script type="text/javascript">
        /**
         * 从 file 域获取 本地图片 url
         */
        function getFileUrl(sourceId) {
            var url;
            if (navigator.userAgent.indexOf("MSIE")>=1) { // IE
                url = document.getElementById(sourceId).value;
            } else if(navigator.userAgent.indexOf("Firefox")>0) { // Firefox
                url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
            } else if(navigator.userAgent.indexOf("Chrome")>0) { // Chrome
                url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
            }
            return url;
        }

        /**
         * 将本地图片 显示到浏览器上
         */
        function preImg(sourceId, targetId) {
            var url = getFileUrl(sourceId);
            var imgPre = document.getElementById(targetId);
            imgPre.src = url;
        }
    </script>
</head>
<div id="content">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12 center" style="text-align: center;">
                <!--待办清单表格开始-->
                <div class="widget-box">
                    <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                        <h5>分类管理</h5>
                          <div class="buttons">
                            <a href="<?php echo U('admin/contact/cate_add');?>" class="btn btn-mini font-size12" title="新增分类">
                                <i class="icon-plus"></i>
                                新增分类</a>
                        </div>
                    </div>
    
                    <table width="95%" class="table table-bordered table-striped table-hover table-condensed">
                        <thead>
                        <tr>
                            <th width="10%">编号</th>
                            <th width="10%">分类名称</th>
                            <th width="10%">排序</th>
                            <th width="20%">更新时间</th>
                            <th width="10%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                                <td style="text-align:center;vertical-align:middle;"><?php echo ($v["id"]); ?></td>
                                <td style="text-align:center;vertical-align:middle;"><?php echo ($v["name"]); ?></td>
                                <td style="text-align:center;vertical-align:middle;"><?php echo ($v["sort"]); ?></td>
                                <td style="text-align:center;vertical-align:middle;"><?php echo date('Y-m-d H:i:s',$v['time']); ?></td>
                                <td style="text-align:center;vertical-align:middle;">
                                    <div style="width:210px;padding-top:5px;text-align:center;margin-left:auto;margin-right:auto;">
                                        <a class="button-b" href="<?php echo U('admin/contact/cate',array('id'=>$v['id']),'html');?>">编辑</a>
                                        <a class="button-red" href="<?php echo U('admin/contact/cate_delete',array('id'=>$v['id']),'html');?>">删除</a>
                                    </div>
                                </td>
                            </tr><?php endforeach; endif; ?>
                        <tr>
                            <td colspan="5" style="text-align:right;vertical-align:middle;height:50px;"><div class="sabrosus"><?php echo ($page); ?></div></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="content-footer">
        
    </div>
</div>
<script type="text/javascript">
    function tupianyulan(img){
        layer.open({
            type: 1,
            title: "图片",
            area: ['500px'],
            skin: 'layui-layer-rim', //加上边框
            closeBtn: 0, //不显示关闭按钮
            shadeClose: true, //开启遮罩关闭
            content: "<div style='text-align:center;'><img src='"+img+"' style='max-width:500px;max-height:500px;'/></div></div>"
        });
    }
    function out(){

    }
</script>