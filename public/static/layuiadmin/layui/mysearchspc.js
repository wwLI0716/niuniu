$.extend({
    myMethod: function(id, tagData, name, communityId,allTagData) {
        var html = '<div class="layui-form-item">';
        html += '<label class="layui-form-label">已选择:</label>';
        html += '<div class="AD">';
        html += '</div>';
        html += '</div>';
        html += '<div class="layui-form-item">';
        html += '<label class="layui-form-label">选择民警</label>';
        html += '<div class="layui-input-inline fileId layui-form-select layui-form-selected">';
        html += '<input type="text" class="layui-input" placeholder="输入或选择民警" autocomplete="off">';
        html += '<dl style="display: none;"></dl>';
        html += '</div>';
        html += '</div>';
        $(id).append(html);
        $(".AD").parent().hide();
        if (allTagData.length > 0) //初始加载原有标签
        {
            for (var i = 0; i < allTagData.length; i++) {
                $(".AD").append('<a href="javascript:;" class="label"><span lay-value="64">' + allTagData[i].name + '</span><input type="hidden" name="' + allTagData[i].name + '" id="' + allTagData[i].id + '" value="' + allTagData[i].id + '"/><i class="layui-icon close">x</i></a>')
            }
            $(".AD").parent().show();
        }
        $(".fileId").on("click", "dl dd", function() {
            var id = $(this).attr("value");
            var that = $(this);
            $codeStatus = 1;
            $('.AD input').each(function(){
                if($(this).val() == id)
                {
                    layer.msg('该民警已添加,请勿重复添加');
                    $codeStatus = 0;
                    return;
                }
            });
            if (id != undefined && $codeStatus == 1) {
                $.post("", {
                    'id': communityId,
                    'policeid': id,
                    'type': 1
                },
                function(result) { //发送请求
                    layer.msg(result.msg);
                    if (result.code == -1) {
                        return false;
                    }
                    $(".AD").append('<a href="javascript:;" class="label"><span lay-value="64">' + that.html() + '</span><input type="hidden" name="' + name + '" id="' + that.html() + '" value="' + id + '"/><i class="layui-icon close">x</i></a>')
                    $(".AD").parent().show();
                    for (var i = 0; i < tagData.length; i++) {
                        if (tagData[i].id == id) {
                            tagData.splice(i, 1);
                        }
                    }
                });
            }
            $(".fileId dl").hide();
            $(".fileId input").val("");
        });
        function AD(name, id) {
            this.name = name;
            this.id = id;
        }
        $(".AD").on("click", ".close", function() {
            $(this).parent().remove();
            var th = $(this);
            var id = $(th).parent().children("input").val();
            $.post("", {
                'id': communityId,
                'policeid': id,
                'type': 2,
            },
            function(result) { //发送请求
                layer.msg(result.msg);
                if (result.code == -1) {
                    return false;
                }
                var id = $(th).parent().children("input").val();
                var text = $(th).parent().children("input").attr("id");
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
                        $(".fileId dl").append('<dd value="' + tagData[i].id + '">' + tagData[i].name + '</dd>')
                    }
                }
                if (temp == 0) {
                    $(".fileId dl").append('<dd>暂无数据</dd>')
                }
            }
        });
        $(document).click(function() {
            $(".fileId dl").hide();
            $(".fileId input").val("");
        });
        $(".fileId input").click(function(event) {
            $(".fileId dl dd").remove();
            if (tagData.length == 0) {
                $(this).val("暂无数据")
            } else {
                $(".fileId dl").show()
            }
            for (var i = 0; i < tagData.length; i++) {
                $(".fileId dl").append('<dd value="' + tagData[i].id + '">' + tagData[i].name + '</dd>')
            }
            event.stopPropagation();
        });
    }
});