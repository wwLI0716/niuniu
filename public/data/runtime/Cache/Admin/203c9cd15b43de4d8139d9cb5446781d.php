<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>管理平台</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/huzheng/Public/admincss/bootstrap.min.css" />
    <link rel="stylesheet" href="/huzheng/Public/admincss/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/huzheng/Public/admincss/unicorn.main.css" />
    <link rel="stylesheet" href="/huzheng/Public/admincss/unicorn.grey.css" class="skin-color" />
    <link rel="stylesheet" href="/huzheng/Public/admincss/myCss.css" />
    <link rel="stylesheet" href="/huzheng/Public/admincss/font-awesome.min.css" />
    <link rel="stylesheet" href="/huzheng/Public/admincss/index.css" />
    <link rel="stylesheet" href="/huzheng/Public/admincss/page.css"/>
    <script type="text/javascript" src="/huzheng/Public/adminjs/jquery.js"></script>
    <script type="text/javascript" src="/huzheng/Public/laydate/laydate.js"></script>
    <script type="text/javascript" src="/huzheng/Public/layer/layer.js"></script>
    <script charset="utf-8" src="/huzheng/Public/editor/kindeditor.js"></script>
    <script charset="utf-8" src="/huzheng/Public/editor/lang/zh_CN.js"></script>
    <script>
        KindEditor.options.filterMode = false;
        KindEditor.ready(function(K) {
            window.editor = K.create('#neirong');
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
        var isIE = /msie/i.test(navigator.userAgent) && !window.opera;
        function preImg(sourceId, targetId, target) {
            var fileSize = 0;
            if (isIE && !target.files) {
                var filePath = target.value;
                var fileSystem = new ActiveXObject("Scripting.FileSystemObject");
                var file = fileSystem.GetFile (filePath);
                fileSize = file.Size;
            } else {
                fileSize = target.files[0].size;
            }
            var size = fileSize / 1024;
            if(size>5120){
                alert("附件不能大于5M");
                var fileup = target;
                fileup.outerHTML = fileup.outerHTML;
                var imgPre = document.getElementById(targetId);
                imgPre.src = "";
                return false;
            }else{
                var file = target.value;
                var strTemp = file.split(".");
                var strCheck = strTemp[strTemp.length-1];
                if(strCheck.toUpperCase()=='JPG' || strCheck.toUpperCase()=='GIF' || strCheck.toUpperCase()=='PNG')
                {
                    var url = getFileUrl(sourceId);
                    var imgPre = document.getElementById(targetId);
                    imgPre.src = url;
                }else
                {
                    alert('上传文件类型不对！');
                    var fileup = target;
                    fileup.outerHTML = fileup.outerHTML;
                    var imgPre = document.getElementById(targetId);
                    imgPre.src = "";
                    return false;
                }
            }
        }

    </script>
</head>
<body style="overflow-x:hidden;">
<div id="content">
    <div class="container-fluid">
    </div>
    <div class="content-footer">
        <p>Copyright &copy; 2017.Company name All rights reserved.<a target="_blank">盐城市公安微警务</a></p>
    </div>
</div>
</body>
<script type="text/javascript">
    //日期范围限制
    var start = {
        elem: '#start',
        format: 'YYYY-MM-DD',
        min: '2000-01-01', //设定最小日期为当前日期
        max: '2099-12-31', //最大日期
        istime: true,
        istoday: false,
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };

    var end = {
        elem: '#end',
        format: 'YYYY-MM-DD',
        min: laydate.now(),
        max: '2099-12-31',
        istime: true,
        istoday: false,
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };

    laydate(start);
    laydate(end);
</script>
</html>