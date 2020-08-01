$(function () {
    //$('#side-menu').metisMenu();

	$(window).bind("load resize", function () {
		topOffset = 50;
		width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
		if (width < 768)
		{
			$('div.navbar-collapse').addClass('collapse')
			topOffset = 100; // 2-row-menu
		}
		else
		{
			$('div.navbar-collapse').removeClass('collapse')
		}

		height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
		height = height - topOffset;
		if (height < 1) height = 1;
		if (height > topOffset)
		{
			$("#page-wrapper").css("min-height", (height) + "px");
		}
	});
    
    $(".idaterangepicker").each(function(){
        var start_name=$(this).attr('data-start');
        var stop_name=$(this).attr('data-stop');
        var start_val= $('input[name=' + start_name + ']').val();
        if(start_val.length==0)
            start_val= moment().startOf('day');
        var stop_val= $('input[name=' + stop_name + ']').val();
        if(stop_val.length==0)
            stop_val= moment().endOf('day');
        $(this).daterangepicker({
            startDate: start_val, endDate: stop_val, format: 'YYYY-MM-DD', ranges: {
                '今日': [moment().startOf('day'), moment()],
                '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
                '最近7日': [moment().subtract('days', 6).startOf('day'), moment()],
                '最近30日': [moment().subtract('days', 29).startOf('day'), moment()],
                '这个月': [moment().startOf('month'), moment().endOf('month')],
                '上个月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale : {
                applyLabel : '确定',
                cancelLabel : '取消',
                fromLabel : '起始时间',
                toLabel : '结束时间',
                customRangeLabel : '自定义',
                daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
                monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月',
                    '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                firstDay : 1
            }
        }, function (start, end, label) {
            $(":hidden[name=" + start_name + "]").val(start.format("YYYY-MM-DD"));
            $(":hidden[name=" + stop_name + "]").val(end.format("YYYY-MM-DD"));
        })
    });
    
    $(".idatepicker").each(function(){
        var value_name=$(this).attr("value_name");
        $(this).daterangepicker({
            format: 'YYYY-MM-DD', singleDatePicker: true, showDropdowns: true
        }, function (start, end, label) {
            $(":hidden[name=" + value_name + "]").val(start.format("YYYY-MM-DD"));
        })
    });

    var locale = {
        "format": 'YYYY-MM-DD',
        "separator": " -222 ",
        "applyLabel": "确定",
        "cancelLabel": "取消",
        "fromLabel": "起始时间",
        "toLabel": "结束时间'",
        "customRangeLabel": "自定义",
        "weekLabel": "W",
        "daysOfWeek": ["日", "一", "二", "三", "四", "五", "六"],
        "monthNames": ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
        "firstDay": 1
    };
    $(".idatetimerangepicker").each(function(){
        var start_name = $(this).attr('data-start');
        var stop_name = $(this).attr('data-stop');
        var start_val = $('input[name=' + start_name + ']').val();
        if (start_val.length == 0)
            start_val = moment().startOf('day');
        var stop_val = $('input[name=' + stop_name + ']').val();
        if (stop_val.length == 0)
            stop_val = moment().endOf('day');
        $(this).daterangepicker({
            startDate: start_val, endDate: stop_val, format: 'YYYY-MM-DD HH:mm:ss', ranges: {
                '今日': [moment().startOf('day'), moment()],
                '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
                '最近7日': [moment().subtract('days', 6).startOf('day'), moment()],
                '最近30日': [moment().subtract('days', 29).startOf('day'), moment()],
                '这个月': [moment().startOf('month'), moment().endOf('month')],
                '上个月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },locale : locale,timePicker: true, timePickerSeconds: true, timePicker12Hour: false, timePickerIncrement:10
        }, function (start, end, label) {
            $(":hidden[name=" + start_name + "]").val(start.format("YYYY-MM-DD HH:mm:ss"));
            $(":hidden[name=" + stop_name + "]").val(end.format("YYYY-MM-DD HH:mm:ss"));
        })
    });
    $(".idatetimepicker").each(function(){
        var value_name = $(this).attr("value_name");
        $(this).daterangepicker({
            format: 'YYYY-MM-DD HH:mm:ss',singleDatePicker: true,locale:locale, showDropdowns: true, timePicker:true, timePickerSeconds:true, timePicker12Hour:false, timePickerIncrement:10
        }, function (start, end, label) {
            $(":hidden[name=" + value_name + "]").val(start.format("YYYY-MM-DD HH:mm:ss"));
        })
    });
    $(".idatetimepicker_post").each(function(){
        var value_name = $(this).attr("data-name");
        $(this).daterangepicker({
            format: 'YYYY-MM-DD HH:mm:ss',singleDatePicker: true, showDropdowns: true, timePicker:true, timePickerSeconds:true, timePicker12Hour:false, timePickerIncrement:10
        }, function (start, end, label) {
            $("#" + value_name + "").attr('value',start.format("YYYY-MM-DD HH:mm:ss"));
        })
    });

    var acting=false;
    $("a.action_act").on('click',function(){
        var _this = $(this);
        if(!acting && confirm("确认"+_this.text()+"?"))
        {
            var method=_this.attr("data-method");
            var data= $.parseJSON(_this.attr("data-data"));
            var url= _this.attr("href");
            var callback= _this.attr("data-callback");
            if(method && url){
                acting=true;
                $.ajax({
                    url:url,
                    dataType:"json",
                    type:method,
                    data:data,
                    success:function(data){
                        if(callback.length>0)
                        {
                            eval(callback+"(_this, data)");
                        }
                    },
                    error:function(data){
                        alert(data.responseText);
                    },
                    complete:function(){
                        acting=false;
                    }
                })
            }
        }
        return false;
    });
    
    var deleting = false;
    $("a.action_delete").on('click', function () {
        if (!deleting && confirm("确定删除?"))
        {
            var id = $(this).attr("data-id");
            var action = $(this).attr("data-action");
            var url = $(this).attr("href");
            var target = $(this).attr("data-target");
            if (url && id && action && target)
            {
                deleting = true;
                $.ajax({
                    url: url, dataType: "json", method: "post", data: {
                        action: action, id: id
                    }, success: function (data) {
                        if (data.status == 1)
                            $("#" + target).remove();
                        else
                            alert(data.msg);
                    }, error: function (data) {
                        alert(data.responseText);
                    }, complete: function () {
                        deleting = false;
                    }
                })
            }
        }

        return false;
    });

    var enableing = false;
    $("a.action_enable").on('click', function () {
        if (!enableing && confirm("确定启用?"))
        {
            var id = $(this).attr('data-id');
            var action = $(this).attr('data-action');
            var url = $(this).attr('href');
            var target = $(this).attr('data-target');
            if (url && id && action && target)
            {
                $enableing = true;
                $.ajax({
                    url: url, dataType: "json", method: "post", data: {
                        action: action, id: id
                    }, success: function (data) {
                        if (data.status == 1)
                        {
                            $("#" + target).find(".action_enable").hide();
                            $("#" + target).find(".action_disable").show();
                        }
                        else
                            alert(data.msg);
                    }, error: function (data) {
                        alert(data.responseText);
                    }, complete: function () {
                        enableing = false;
                    }
                });
            }
        }

        return false;
    });

    var disabling = false;
    $("a.action_disable").on('click', function () {
        if (!disabling && confirm("确定禁用?"))
        {
            var id = $(this).attr('data-id');
            var action = $(this).attr('data-action');
            var url = $(this).attr('href');
            var target = $(this).attr('data-target');
            if (url && id && action && target)
            {
                disabling = true;
                $.ajax({
                    url: url, dataType: "json", method: "post", data: {
                        action: action, id: id
                    }, success: function (data) {
                        if (data.status == 1)
                        {
                            $("#" + target).find(".action_disable").hide();
                            $("#" + target).find(".action_enable").show();
                        }
                        else
                            alert(data.msg);
                    }, error: function (data) {
                        alert(data.responseText);
                    }, complete: function () {
                        disabling = false;
                    }
                });
            }
        }

        return false;
    });

});
