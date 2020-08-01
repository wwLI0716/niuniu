$.extend({
    myMethod: function(id, tagData, name, communityId) {
        var html = '<div class="layui-form-item">';
        html += '<label class="layui-form-label">已有标签:</label>';
        html += '<div class="AD">';
        html += '</div>';
        html += '</div>';
        html += '<div class="layui-form-item">';
        html += '<label class="layui-form-label">特征码</label>';
        html += '<div class="layui-input-inline fileId layui-form-select layui-form-selected" style="width: 300px;">';
        html += '<input type="text" style="width: 70%;display: inline-block;margin-right: 3%;padding-right: 0;" class="layui-input content" placeholder="请输入特征码,多个逗号相隔" autocomplete="off">';
        html += '<a href="#" class="layui-btn layuiadmin-btn-useradmin add" style="width: 25%;display: inline-block;margin-top: -3px;">添加</a>';
        html += '</div>';
        html += '</div>';
        $(id).append(html);
        if (tagData.length > 0) //初始加载原有标签
        {
            for (var i = 0; i < tagData.length; i++) {
                $(".AD").append('<a href="javascript:;" class="label"><span class="everyCode">' + tagData[i].name + '</span><input type="hidden" name="' + tagData[i].name + '" id="' + tagData[i].name + '" value="' + tagData[i].name + '"/><i class="layui-icon close">x</i></a>');
                $(".AD").parent().show();
            }
        } else {
            $(".AD").append('<a href="javascript:;" class="label"><span class="everyCode">社区</span><input type="hidden" name="社区" id="社区" value="社区"/><i class="layui-icon close">x</i></a>');
            $(".AD").parent().show();
        }
        $('.add').on('click', function() {
            //验证提交数据
            if ($(".content").val() == '') {
                layer.msg('请输入特征码!');
                return false;
            }
            //重复验证
            $codeStatus = 1;
            $allContent = $(".content").val().split(',');
            $('.everyCode').each(function() {
                var that = $(this);
                for (var i = 0; i < $allContent.length; i++) {
                    if (that.html() == $allContent[i]) {
                        $codeStatus = 0;
                        layer.msg(that.html() + '特征码已存在!');
                        return false;
                    }
                }
            });
            if ($codeStatus == 1) {
                $.post("", {
                    'id': communityId,
                    'codes': $(".content").val(),
                    'type': 1
                },
                function(result) { //发送请求
                    layer.msg(result.msg);
                    if (result.code == -1) {
                        $codeStatus = 0;
                        return false;
                    }
                    if ($codeStatus == 1) {
                        for (var i = 0; i < $allContent.length; i++) {
                            if ($allContent[i] != '') {
                                $(".AD").append('<a href="javascript:;" class="label"><span class="everyCode">' + $allContent[i] + '</span><input type="hidden" name="' + $allContent[i] + '" id="' + $allContent[i] + '" value="' + $allContent[i] + '"/><i class="layui-icon close">x</i></a>');
                                $(".AD").parent().show();
                            }
                        }
                    }
                });
            }
        });
        function AD(name, id) {
            this.name = name;
            this.id = id;
        }
        $(".AD").on("click", ".close", function() { //删除标签
            var th = $(this);
            var text = $(th).parent().children("input").attr("id");
            if (text == '社区') {
                layer.msg('默认特征码无须删除!');
                return false;
            }
            $.post("", {
                'id': communityId,
                'codes': text,
                'type': 2
            },
            function(result) { //发送请求
                layer.msg(result.msg);
                if (result.code == -1) {
                    return false;
                }
                $(th).parent().remove();
                var id = $(th).parent().children("input").val();
                tagData.push(new AD(text, id));
            });
        });
        $(".fileId input").on("input propertychange", function() {
            $(".fileId dl dd").remove();
            $(".fileId dl").hide();
            if (tagData.length > 0) {
                $(".fileId dl").show();
                var sear = new RegExp($(this).val());
                var temp = 0;
                for (var i = 0; i < tagData.length; i++) {
                    if (sear.test(tagData[i].name)) {
                        temp++;
                        $(".fileId dl").append('<dd value="' + tagData[i].id + '">' + tagData[i].name + '</dd>');
                    }
                }
            }
        });
        $(document).click(function() {
            $(".fileId dl").hide();
            $(".fileId input").val("");
        });
        $(".fileId input").click(function(event) {
            $(".fileId dl dd").remove();
            /*if(tagData.length==0){$(this).val("暂无数据")}else{$(".fileId dl").show()}*/
            for (var i = 0; i < tagData.length; i++) {
                $(".fileId dl").append('<dd value="' + tagData[i].id + '">' + tagData[i].name + '</dd>');
            }
            event.stopPropagation();
        });
    }
});