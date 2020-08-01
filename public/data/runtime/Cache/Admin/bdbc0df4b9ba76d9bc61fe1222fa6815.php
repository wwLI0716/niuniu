<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>海报管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/Public/css/unicorn.main.css" />
    <link rel="stylesheet" href="/Public/css/unicorn.grey.css" class="skin-color" />
    <link rel="stylesheet" href="/Public/css/myCss.css" />
    <link rel="stylesheet" href="/Public/css/page.css"/>
    <script src="/Public/js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="/Public/layer/layer.js"type="text/javascript"></script>
    <script type="text/javascript" src="/Public/indexjs/jquery.js"></script>
    <script charset="utf-8" src="/Public/editor/kindeditor.js"></script>
    <script charset="utf-8" src="/Public/editor/lang/zh_CN.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css"/>

   
     <script>
        KindEditor.options.filterMode = true;
        KindEditor.ready(function(K) {
            window.editor = K.create('#neirong',{
                autoHeightMode : true,
                afterCreate : function() {
                    this.loadPlugin('autoheight');
                }
            });
        });
    </script>
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
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-user"></i>
                                </span>
                        <h5>新增分类</h5>
                        <div class="buttons">
                            <a href="<?php echo U('admin/contact/cate');?>" class="btn btn-mini font-size12" title="返回">
                                返回分类管理
                            </a>
                        </div>
                    </div>
                    <form action="#" class="form-horizontal" />
                    <div class="widget-content nopadding">
                        <div class="control-group" style="border-bottom:0px;">
                            <label class="control-label">分类名称：</label>
                            <div class="controls">
                                <input type="text" name="name" id="name" value="" style="width:350px;"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">排序</label>
                            <div class="controls">
                                <input type="text" name="sort" id="sort"   value="" placeholder="">
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="button" class="btn btn-primary btn-small offset3" value="新增" id="add_cate">
                            <input type="reset" class="btn btn-small" value="重置" style="margin-left:20px;">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!--待办清单表格结束-->
        </div>
    </div>
    <div class="content-footer">
        
    </div>
</div>
<script type="text/javascript">
        $(document).ready(function(){
                $('#add_cate').click(function(){
                    $('#form').submit(function(){
                        return false;
                        }
                    );
                    var name=$('#name').val();
                    var sort=$('#sort').val();

                    $.post(
                        "<?php echo U('admin/contact/cate_add_post');?>",
                        {name:name,sort:sort},
                        function(data){
                            console.log(data)
                            if(data.status==1001){
                                layer.alert("提交成功")
                                
                            }


                        }
                    )
                })
        });
</script>