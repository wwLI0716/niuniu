var Thread = {};
/*********回复***************/
var client_comment_user = function( pid, iconurl, username, content){

    var contentArr = eval(content);
    var commentArr =  new Array();

    //alert( pid );

    var content = "";
    for(var i=0; i < contentArr.length; i++ ){
        commentArr[i] = new Array();
        //防止注入
        commentArr[i]['content'] = contentArr[i].inputContent.replace(/(script)|(iframe)/ig, '');
        content_tmp = commentArr[i]['content'];

        commentArr[i]['imgpath'] = contentArr[i].imagePath;
        if( commentArr[i]['imgpath'].length > 0 )
        {
            var imgStr = "";
            for( var j=0; j < commentArr[i]['imgpath'].length; j++ )
            {
                content_tmp += "<div><img data-flag='1' style=\"display: block;\" src=\"" + qiniu_url + commentArr[i]['imgpath'][j]["url"] + "\" /></div>";
            }
        }

        content = content + content_tmp;
    }
    // content = content + "<div style='height: 10px;'></div>";
    var contents = "";



    if(pid != 0){
        for(var i=0; i<myArray.length;i++){
            if(myArray[i].pid == pid){
                if(myArray[i].floor != ''){
                    myArray[i].floor = "第"+ myArray[i].floor + "楼";
                }
                contents = '<li class="clearfix point5a"><a href="javascript:void(0)" class="discuss_head view_author"><img' +
                    ' src="' + iconurl + '"></a><div class="infor_header"><div class="clearfix"><a' +
                    ' href="javascript:void(0);" class="view_author fl">' + username + '</a><a class="new_add fl' +
                    ' clearfix">';

                contents += '</a></div><p class="discuss_reply">引用' + myArray[i].floor + '' + myArray[i].author + '于' + myArray[i].postdate + '发表的&nbsp;&nbsp;:' + myArray[i].content + '</p><div' +
                    ' class="reply_content"><div class="content_main contents">' + content + '</div></div><div' +
                    ' class="discuss_floor"><span class="dinline">刚刚回复</span></div></div></li>';
                break;
            }
        }
    }else{
        contents = '<li class="clearfix point5a"><a href="javascript:void(0)" class="discuss_head view_author"><img src="' + iconurl + '"></a><div class="infor_header"><div class="clearfix"><a href="javascript:void(0);" class="view_author fl">' + username + '</a><a class="new_add fl clearfix">';
        contents += '</a></div><div class="reply_content"><div class="content_main contents">' + content + '</div></div><div' +
            ' class="discuss_floor"><span class="dinline">刚刚回复</span></div></div></li>';
    }
    if($(".qsf").length > 0) {
        $(".qsf").remove();
    }
    $(".content_discuss_all ul").append(contents);
    var height = $(".content_discuss_all li .reply_content").last().offset().top - document.documentElement.clientHeight + 100 ;
    $(window).scrollTop(height);
};

$(document).on("click", ".qsf", function(){
    LCH5.jumpForumComment();
});

/*****客户端自带的点赞按钮*********/
var  client_ping_thread = function (uid, username, iconurl) {
    if( $(".likeContainer").size() == 0 ) {
        var html = "<div class=\"likeContainer\">";
        html += "<div class=\"sq_box show6\">";
        html += "<a class=\"clickTimes\"><i class=\"zan-icon-wai\"><i class=\"zan-icon h_like\"></i></i><span>1&nbsp;</span></a>";
        html += "<a class=\"ping_user\" data-id=\""+uid+"\">"+username+"</a>";
        html += "</div></div>";
        $(".discuss_article").prepend( html );
        var themeSkin = $(".likeContainer .zan-icon").css("background-color");
        if(themeSkin != themeConf) {
            $(".likeContainer .zan-icon").css("background-color", themeConf);
        }
    } else {
        var num = parseInt( $(".likeContainer .clickTimes span:nth-child(2)").html() );
        $ (".likeContainer .clickTimes span:nth-child(2)").html( ++num );
        var doc = $(".likeContainer .ping_user").first();
        var like = $(".likeContainer .clickTimes .d_like").first();

        if( like ){
            $(".likeContainer .clickTimes .zan-icon").addClass('h_like').removeClass('d_like');
        }

        if( doc ) {
            $("<a class=\"ping_user\" data-id=\""+uid+"\">"+username+"</a> · ").insertBefore(doc);
        } else {
            $("<a class=\"ping_user\" data-id=\""+uid+"\">"+username+"</a>").insertAfter( $ (".likeContainer .clickTimes") );
        }
    }
    isping = 1;
};

/*********************客户端获取全局参数********************/
var tell_client_params = function(){
    if( deviceType == "2" ) {
        LCH5.client_get_params4Android( fid, tid, touid, threadTitle, isping, isfavor, sharelink, shareimg, sharecontent,
            replies );
        LCH5.client_get_totalpage( parseInt( totalpages ),parseInt( pingnum ) );
    }

    LCH5.client_get_params( fid, tid, touid, threadTitle, isping, isfavor, sharelink, shareimg, sharecontent,
        replies, totalpages );

    LCH5.client_enable_loadmore();
}


/****数据不断刷新***************ok********/
var dropload = null;
var dropload_me = null;
var client_get_datas = function(statusfunc){
    if( hasmore ) {
        page++;
        $.ajax({
            type: 'POST',
            url: host + '/wap/portal/getMore',
            data: {
                'page' : page,
                'tid' : tid,
                'isSeeMaster' : isSeeMaster,
                'replyOrder' : replyOrder,
                'supportOrder' : supportOrder,
                'isAdmin' : parseInt( isAdmin ),
                'login_token' : login_token,
                'device' : device,
                'user_id' : user_id,
                'screen_width' : screenwidth,
                'oldornew' : 1
            },
            success: function( data ){
                //判断是否刷新页面
                if( data == ""){
                    page--;
                    hasmore = 0;
                }else{
                    //alert(page);
                    //LCH5.updatePage( page );//传递给客户端page
                }
                if( hasmore ){
                    $(".content_discuss ul.reply_container").append( data );
                    if( dropload ) {
                    }
                }else{
                    if( dropload ){
                        dropload.noData();
                        dropload.resetload();
                    }
                }
                if(typeof(statusfunc) == "function"){
                    statusfunc(hasmore);//通知客户端状态
                }
                if(dropload){
                    dropload.resetload();
                }

                //重新调用点击事件
                click_reply_content();
            },
            error: function( xhr, type, error) {
                if(dropload){
                    dropload.resetload();
                }
            }
        });
    } else {
        if( dropload ){
            dropload.resetload();
        }

        if(typeof statusfunc == "function" ) {
            statusfunc(hasmore);
        }
    }
}

var client_view_reply = function(){
    window.location.href = "#threadreply";
}
/******引用回复与举报********/

$('.lazy_auto,.lazy').lazyload({
    "placeholder_real_img" : "",
    "placeholder_data_img" : "",
    "load" : function(e){
        $(e).css({
            "background-color" : "#FFFFFF",
            "background-image" : "none"
        });
    }
});

counter = 0;
var lazy_offset = 0;
//$(document).on("touchmove", function(e){
//    e.stopPropagation();
//    var img_doc = $("img.lazy").eq(lazy_offset)
//    if( img_doc.offset().top - $(window).scrollTop() <= 20 ) {
//        lazy_offset++;
//        counter++;
//    }
//});

/******图片加载错误***/


/****给客户端提供公共参数*******/

/****关注当前用户**********ok***/
$(".gz").bind('click',function(){
    if(author == '匿名') {
        return false;
    }
    uid = touid;
    username = author;
    if( isfollow == 1){
        LCH5.jumpTalk(uid,username,avatar);
        return 0;
    }
    LCH5.client_follow_user( isfollow, function(){
        //未关注
        if( isfollow == 0){
            $('.gz').removeClass('author_see');
            $('.gz').addClass('author_see_no');
            $('.gz').html("聊天");
            isfollow = 1;
            return 0;
        }
    })
});

$("EMBED").each(function(){
    var self = this;
    $(this).replaceWith( '<span>当前版本不支持该视频格式播放</span>' );
});

// 查看之前楼层
$(document).on("click", ".seelastpage" , function(){
    if( pagebefore <= 1 ){
        $("#listJumpContainer").remove();
        return false;
    }
    pagebefore--;

    $.ajax({
        type: 'POST',
        url: host + '/wap/portal/getMore',
        data: {
            'page' : pagebefore,
            'tid' : tid,
            'isSeeMaster' : isSeeMaster,
            'replyOrder' : replyOrder,
            'supportOrder' : supportOrder,
            'login_token' : login_token,
            'device' : device,
            'user_id' : user_id,
            'screen_width' : screenwidth
        },
        beforeSend: function(){
            var load_html = '<div class="detail-loading"><i></i><span>加载中...</span></div>';
            $("#threadreply").prepend( load_html );
        },
        success: function( data ){
            if(data){
                //更新script变量
                $(".script_var div").remove();
                $(".script_var").prepend( "<div><script type=\"text/javascript\">var isSeeMaster = \""+isSeeMaster+"\"; var replyOrder = \""+replyOrder+"\"; var supportOrder = \""+supportOrder+"\"; var page = \""+page+"\"; var hasmore = 1;</script></div>" );

                //更新页数
                LCH5.updatePage( pagebefore );


                $(".content_discuss_all ul").prepend( data );
                if( pagebefore <= 1 ){
                    $("#listJumpContainer").remove();
                }

                //重新调用点击事件
                click_reply_content();
            }
        },
        complete: function(){
            $('.detail-loading').remove();
        },
        error: function( xhr, type, error) {
        }
    })
});

// 是否是跳页
if( page > 1 ){
    window.location.href = "#threadreply";
}

/*点击和长安事件*/
function replyfunction(e){

    $(".content_discuss li").find(".discuss_zan").removeClass("con");
    $(".content_discuss li").siblings().find(".discuss_zan").removeClass("con");

    var state= $(".content_discuss li.on").length;
    if( state ){
        $(".content_discuss li.on").removeClass("on");
        $(".doperate").hide();
    }else{
        $(this).parents(".content_discuss li").find(".doperate").css("display","");
        $(this).parents(".content_discuss li").find(".doperate").show();

        $(this).parents(".content_discuss li").addClass("on");
        /*点赞手的差别*/

        $(this).parents(".content_discuss li").find(".discuss_zan").addClass("con");


        var iw = 750;
        var w = window.innerWidth;
        if(w>750){
            w = 750;
        }
        var irate= 625/(iw/w)*0.2;
        e = e || window.event;
        //var xx=e.pageX || e.clientX + document.body.scroolLeft;
        var yy=e.pageY || e.clientY + document.body.scrollTop ;
        var label_top=$(this).parents(".content_discuss li").offset().top;
        //var label_top=$(this).offset().top;
        var new_top=yy-label_top-(1+0.22)*irate;


        $(this).parents(".content_discuss li").find(".doperate").css("top",new_top);
        //console.log(irate+","+yy+","+""+label_top+","+new_top);

        return false;
    }

}



$(document).ready(function(){

    /*分享*/
    $(".qfshare").click(function(){
        var platform = $(this).attr('plat-form');
        LCH5.openShare(parseInt(platform));
        $(this).parent().removeClass("touch-link");

    });

    $(".news-imgslists li").live('click',function(){
        $(this).addClass("con");
    });

    /*点击文字出现操作框*/
    click_reply_content();

    $(document).click(function () {
        $(".doperate").hide();
        $(".content_discuss li").siblings().removeClass("on");

        /*点赞手的差别*/
        $(".content_discuss li").siblings().find(".discuss_zan").removeClass("con");
    });


    // 查看全部
    $(document).on("click", ".seeall", function(){
        /*param int 是否刷新cookie 0不刷新 1刷新*/
        LCH5.refresh( 1 );
    });

    FastClick.attach(document.body);
    $(document).on('click',function(){
        if($('.discuss_pop').hasClass('test')){
            $('.discuss_pop').removeClass('test');
            $('.discuss_pop').animate({width:''},200,'ease-out');
        }
    })

    $(document).on("click",".icon-jts",function(){
        if($(".sq_box").hasClass("show6")){
            $(".sq_box").removeClass("show6");
            $(this).animate({"transform":"rotate(180deg)","-webkit-transform":"rotate(180deg)"},300);
        }else{
            $(".sq_box").addClass("show6");
            $(this).animate({"transform":"rotate(360deg)","-webkit-transform":"rotate(360deg)"},300);
        }
    });

    //举报
    $('.doperate_icons .doperate_popl').live('click',function(){
        pid = $(this).attr('data-pid');
        r_authorid = $(this).attr('data-authorid');
        LCH5.client_report_userping( pid , r_authorid );
    });

    //复制
    $(".doperate_icons .doperate_copy").live('click',function(){
        var content = $(this).parents("li").find(".content_main").clone().text();
        LCH5.contentCopy( content );
    });

    //管理评论
    $('.doperate_icons .doperate_admin').live('click',function(){
        pid = $(this).attr('data-pid');
        uid = $(this).attr('data-authorid');
        url= host + '/v2_2/admin/thread-reply?pid='+pid+'&tid='+tid;
        LCH5.openUrl( url );
    });

    /*详情页的点赞*/
    $('.discuss_zan , .doperate_zan').live('click',function(){
        var _this = $(this);
        var zan_num= parseInt( $(this).closest('.infor_header').find('.discuss_zan .zan-num').html() )? $(this).closest('.infor_header').find('.discuss_zan .zan-num').html() : 0;
        var pid=$(this).attr("data-pid");
        var touid=$(this).attr("data-authorid");
        var comment = $(this).parents("li").find(".content_main").clone().text();

        if(_this.closest('.infor_header').find('.discuss_zan .icon-zan').hasClass("on"))
        {
            return ;
        }else{
            $.ajax({
                type: 'POST',
                url: host + '/v2_2/wap/ping-comment',
                dataType: "json",
                data: {
                    'uid' : current_user_id,
                    'pid' : pid,
                    'tid' : tid,
                    'touid' : touid,
                    'title' : threadTitle,
                    'comment': comment,
                    'page' : page
                },
                beforeSend:function ( data ) {
                    /*预先改变样式*/
                    if(current_user_id){
                        _this.closest('.infor_header').find('.discuss_zan .icon-zan').addClass("on");
                        _this.closest('.infor_header').find('.doperate_zan').addClass("on");
                        _this.closest('.infor_header').find('.discuss_zan .zan-num').addClass("on");
                        _this.closest('.infor_header').find('.discuss_zan .icon-zan').addClass("icon-click-on");//点赞效果样式
                        _this.closest('.infor_header').find('.discuss_zan .icon-zan').css("background-color",theme_skin);//修改其主题色的问题
                        _this.closest('.infor_header').find('.discuss_zan .zan-num').html(parseInt(zan_num)+1);
                    }
                },
                success: function( data ){
                    if(data.code == 200){

                        // LCH5.toast(1,data.text,1);
                    }else if(data.code == 400){
                        LCH5.jumpLogin(function(state,data){
                        });
                    }else{

                        LCH5.toast(2,data.text,2);
                    }
                }
            });
        }
    });

    //引用回复
    $('.discuss_handle .discuss_lun,.doperate_icons .doperate_popr').die().live('click',function(event){
        arr = new Object();
        arr.pid = String($(this).attr('data-pid'));
        arr.author = $(this).attr('data-author');
        arr.floor = $(this).attr('data-floor');
        arr.postdate = $(this).attr('data-postdate');
        tmpdoc = $(this).parents("li").find(".content_main").clone();
        tmpdoc.find(".has_shang").remove()
        arr.content = tmpdoc.text();
        //arr.content = $(this).attr('data-content');
        myArray[i] = arr;
        tmpdoc.remove();
        pid = arr.pid;
        r_authorid = $(this).attr('data-authorid');
        r_author = arr.author;

        r_replyname = '回复'+ $(this).attr('data-replyname');
        i++;

        LCH5.client_comment_user( pid, r_authorid, r_author, r_replyname , function( pid, iconurl, username, content){

            client_comment_user( pid, iconurl, username, content);

        });//触发客户端引用回复的方法

        $('.discuss_pop').removeClass('test');
        $('.discuss_pop').animate({width:''},200,'ease-out');
        event.stopPropagation();
    });

    $('.discuss_point .p_img').live('click',function(event){
        if($(this).parent().find(".discuss_pop").hasClass('test')){
            $('.discuss_pop').removeClass('test');
            $(this).parent().find('.discuss_pop').animate({width:'0'},200,'ease-out');
        }
        else
        {
            $('.discuss_pop').animate({width:'0'},200,'ease-out');
            $('.discuss_pop').removeClass('test');
            $(this).parent().find(".discuss_pop").animate({width:'3.2rem'},200,'ease-out');
            $(this).parent().find('.discuss_pop').addClass('test');
        }
        event.stopPropagation();
    });

    /********点赞当前帖子******ok*****/
    $(document).on('click','.zan',function(){
        if( isping == 1){
            return 0;
        }
        LCH5.client_ping_thread(function( uid, username, iconurl ){
            client_ping_thread( uid, username, iconurl );
        });
    })



    //点击点赞图标跳转
    $(document).on('click','.ping_user',function(){
        var self = this;
        LCH5.jumpUser( parseInt( $(self).attr("data-id") ) );
    })

    //点击用户，跳转用户个人中心
    $(document).on("click", ".view_author", function(){
        var self = this;
        LCH5.jumpUser( parseInt( $(self).attr("data-uid") ) );
    });


    //打开板块
    $(document).on("click", ".view_forum", function(){
        var self = this;
        LCH5.jumpThreadList( parseInt($(self).attr("data-fid")) );

    });

    //进入帖子详情页
    $(document).on('click','.seemore',function(){
        LCH5.jumpThread(tid);
    });

    //跳转电梯贴详情
    $(document).on("click", ".view_thread_by_reply", function(){
        var self = this;
        LCH5.jumpThreadTargetReply( parseInt( $(self).attr("data-tid") ) , parseInt( $(self).attr("data-pid") ));
        event.stopPropagation();
    });


    //内容的图片点击事件
    // $(document).on("click", ".content_article img", function(){
    //     if($(this).attr("width")<200 && $(this).attr("height")<150){
    //         return 0;
    //     }
    //     var imgsrc = $(this).attr("naturl");
    //     var contenter = $(this).parents(".content_article");
    //     var images = $(contenter).find("img");
    //     var offset = 0;
    //     var flag = 0;
    //     var imagesrcs = [];
    //     if( images.length ) {
    //         $.each(images, function(index){
    //             var self = this;
    //             if( $(self).attr("naturl") ){
    //                 if($(this).attr("width")<200 && $(this).attr("height")<150){
    //                     flag++;
    //                     return true;
    //                 }
    //                 if( $(this).attr("naturl") == imgsrc ){
    //                     offset = index1 -flag;
    //                 }
    //                 imagesrcs.push( $(self).attr("naturl") );
    //             }
    //             else
    //             {
    //                 flag++;
    //             }
    //         });
    //     }
    //     if( imagesrcs.length > 0 ) {
    //         LCH5.viewImages( offset, imagesrcs );
    //     }
    //     return false;
    // });

    $(".content_article img").each(function(index, element) {
        $(this).click(function(){
            if($(this).attr("width")<200 && $(this).attr("height")<150){
                return 0;

            }
            var imgsrc = $(this).attr("naturl");
            var contenter = $(this).parents(".content_article");
            var images = $(contenter).find("img");
            var offset = 0;
            var flag = 0;
            var imagesrcs = [];
            if( images.length ) {
                $.each(images, function(index1){
                    var self = this;
                    if( $(self).attr("naturl") ){
                        if($(this).attr("width")<200 && $(this).attr("height")<150){
                            flag++;
                            return true;
                        }
                        if( $(this).attr("naturl") == imgsrc ){
                            offset = index -flag;
                        }
                        imagesrcs.push( $(self).attr("naturl") );
                    }
                    else
                    {
                        flag++;
                    }
                });
            }
            if( imagesrcs.length > 0 ) {
                LCH5.viewImages( offset, imagesrcs );
            }
            return false;
        });
    });

    // 客户端上拉加载
    //threshold 这么判断是防止跳页预加载了
    var qsf = $(".qsf").length;
    var threshold =  document.body.clientWidth;

    if( (qsf == 0))
    {
        var dropload_box = $('.box_discuss').dropload({
            // distance : 80,
            scrollArea : window,
            threshold : threshold,
            loadDownFn : function(me){
                dropload = me;
                client_get_datas(null);
            }
        });
    }

    //如果是显示某一个回复,则第一步先隐藏加载更多的
    if( viewpid ){
        $(".dropload-down").addClass("hide");
        dropload_box.lock();
    }


    /*展示评论的顺序**/
    var num=0;
    $(".discuss-state a").click(function(){
        //判断是否是楼主
        if($(this).hasClass("discuss_poster"))
        {
            if($(this).hasClass("on"))
            {
                $(this).attr("data-sort","0");
                $(this).removeClass("on");
            }
            else
            {
                $(this).attr("data-sort","1");
                $(this).addClass("on");
            }
        }
        else
        {
            $(this).addClass("on").siblings().removeClass("on");
            $(this).siblings().attr("data-sort","2");

            if($(this).find(".posit").length>0)
            {
                //为正序时，点击之后，还是正序，变高亮
                if(num==1)
                {
                    $(this).attr("data-sort","0");
                    $(this).find("span").html("正序");
                    $(this).find(".posit").removeClass("con");
                    num=2;
                }
                else
                {
                    //判断正序倒序
                    if($(this).find(".posit").hasClass("con"))
                    {
                        $(this).attr("data-sort","0");
                        $(this).find("span").html("正序");
                        $(this).find(".posit").removeClass("con");
                    }
                    else
                    {
                        $(this).attr("data-sort","1");
                        $(this).find("span").html("倒序");
                        $(this).find(".posit").addClass("con");

                    }
                }
            }
            else
            {
                //点击最赞之后，变成正序
                $(".discuss_sort a").find(".posit").parents("a").attr("data-sort","0");
                $(".discuss_sort a").find(".posit").parent().find("span").html("正序");
                $(".discuss_sort a").find(".posit").removeClass("con");
                $(this).attr("data-sort","1");
                num=1;
            }
        }

        var isSeeMaster  = $(this).closest('.discuss-state').find('.isSeeMaster').attr("data-sort");
        var supportOrder = $(this).closest('.discuss-state').find('.supportOrder').attr("data-sort");
        var replyOrder   = $(this).closest('.discuss-state').find('.replyOrder').attr("data-sort");
        /**
         * 给客户端传状态
         * @param int isSeeMaster  是否只看楼主（0否,1是）
         * @param int supportOrder 最赞（2关闭 0ASC  1DESC )
         * @param int replyOrder   回复的排序（ 0ASC  1 DESC )
         *
         * 备注:如果supportOrder的值为1或者为0的时候 , 按照supportOrder排序,此时replyOrder默认为0
         *     如果supportOrder的值为2的时候, 按照replyOrder排序
         */
        LCH5.changeReadStatus(parseInt(isSeeMaster),parseInt(supportOrder),parseInt(replyOrder));

        $.ajax({
            type: 'POST',
            url: host + '/wap/portal/getMore',
            data: {
                'tid' : tid,
                'isSeeMaster' : isSeeMaster,
                'replyOrder' : replyOrder,
                'supportOrder' : supportOrder,
                'isAdmin' : parseInt( isAdmin ),
                'login_token' : login_token,
                'device' : device,
                'user_id' : user_id,
                'screen_width' : screenwidth
            },
            beforeSend: function(){
                $(".detail-page").remove();//把查看全部等去除掉
                $(".seemore").remove(); //查看某个评论的时候去除掉

                var load_html = '<div class="detail-loading"><i></i><span>加载中...</span></div>';
                $("#threadreply").prepend( load_html );

                setTimeout("$('.detail-loading').remove();",3000);//防止进程终止,然后在那一直转
            },
            success: function( data ){
                //更新script变量
                $(".script_var div").remove();
                $(".dropload-down").removeClass("hide"); //开启
                $(".script_var").prepend( "<div><script type=\"text/javascript\">var isSeeMaster = \""+isSeeMaster+"\"; var replyOrder = \""+replyOrder+"\"; var supportOrder = \""+supportOrder+"\"; var page = 1; var hasmore = 1;</script></div>" );

                $(".content_discuss_all ul li,.content_discuss_all ul p").remove();


                //去掉loading图标
                $('.detail-loading').remove();

                if(data){
                    $(".content_discuss_all ul").prepend( data );
                    LCH5.updatePage( 1 );  //客户端重新传值

                    dropload_box.unlock();
                    dropload_box.noData(false);
                    dropload_box.resetload();

                }else{
                    $(".dropload-down").addClass("hide");
                    var html = '<p class="qsf"></p>';
                    $(".content_discuss_all ul").prepend( html );
                }
                //重新调用点击事件
                click_reply_content();

            },
            complete: function(){
                //$('.detail-loading').remove();
            },
            error: function( xhr, type, error) {
            }
        })

    });

    //改变点赞按钮颜色
    //var themeSkin = $(".likeContainer .zan-icon").css("background-color");
    //if(themeSkin != themeConf) {
    //    $(".likeContainer .zan-icon").css("background-color", themeConf);
    //}

    //if( typeof QFH5ready=="function" ){
    //    QFH5ready();
    //}
});



function click_reply_content(){
    /*********懒加载********/
    $('.icon_lazy').lazyload({
        "placeholder_real_img" : ""+host+"/public/static/wap/portal/images/icon_default.png",
        "placeholder_data_img" : ""+host+"/public/static/wap/portal/images/icon_default.png",
        "load" : function(e){
            $(e).css({
                "background-color" : "#FFFFFF",
                "background-image" : "none"
            });
        }
    });


    $('.reply_content').off('click');
    $('.reply_content img').off('click');

    $(".reply_content a").click(function( event ){
        event.stopPropagation();
    });

    //点击评论文字部分
    $(".reply_content").bind("click",replyfunction);
    $(".reply_content").on('touchstart', function(e){
        time = setTimeout(function(){
            e.stopPropagation();
            $(".reply_content").unbind("click",replyfunction);
        }, 500);//这里设置长按响应时间
    });

    $(".reply_content").on('touchend', function(e){
        e.stopPropagation();
        $(".reply_content").unbind("click",replyfunction);
        $(".reply_content").bind("click",replyfunction);
        clearTimeout(time);
    });


    //点击评论图片
    $(".reply_content img").on('click',function( event ){
        if(($(this).attr("width")<200 && $(this).attr("height")<150) || $(this).attr("data-flag")){
            return 0;
        }
        var imgsrc = $(this).attr("naturl");
        var contenter = $(this).parents(".reply_content");
        var images = $(contenter).find("img");
        var offset = 0;
        var flag = 0;
        var imagesrcs = [];
        if( images.length ) {
            $.each(images, function(index){
                var self = this;
                if(($(this).attr("width")<200 && $(this).attr("height")<150) || $(this).attr("data-flag")){
                    flag++;
                    return true;
                }
                if( $(this).attr("naturl") == imgsrc ){
                    offset = index - flag;
                }
                imagesrcs.push( $(self).attr("naturl") );
            });
        }
        LCH5.viewImages( offset, imagesrcs );
        event.stopPropagation();
        return false;
    });


    //打开外链
    $(".view_newweb").off('click');
    $(".view_newweb").on("click", function(){
        var self = this;
        //LCH5.outOpen( $(self).attr("data-url") );
        LCH5.openUrl( $(self).attr("data-url") );
        event.stopPropagation();
    });
    //跳转帖子详情
    $(".view_thread").off('click');
    $(".view_thread").on("click", function(){
        $(this).addClass("con");
        var self = this;
        LCH5.jumpThread( parseInt( $(self).attr("data-tid") ) );
        event.stopPropagation();
    });
}


/*跳转广告*/
$(".jump_type .imgslist-left").click(function(){
    var totype = $(this).attr('data-totype');
    var url = $(this).attr('data-url');
    var toid = $(this).attr('data-toid');
    var name = $(this).attr('data-name');
    var id = $(this).attr('data-id');

    //更新点击量
    $.ajax({
        type: 'POST',
        url: host + '/v1_5/log/advert-from-thread',
        dataType: "json",
        data: {
            'id' : id,
            'action' : 2
        }
    });


    /*
     * type 1帖子  2话题 3外链（内部浏览器）4版块 5本地圈详情   6外链（外部浏览器） 8商城首页 9金币中心 10视频 17交友推荐页 18交友邂逅页
     * */
    switch(totype)
    {
        case '1':
            LCH5.jumpThread(parseInt(toid));
            break;
        case '2':
            LCH5.jumpSideList(parseInt(toid),name);
            break;
        case '3':
            QFWap.openUrl(url);
            break;
        case '4':
            LCH5.jumpThreadList(parseInt(toid));
            break;
        case '5':
            LCH5.jumpSide(parseInt(toid));
            break;
        case '6':
            LCH5.outOpen(url);
            break;
        case '8':
            LCH5.jumpNewWebview(url);
            break;
        case '9':
            LCH5.jumpNewWebview(url);
            break;
        case '10':
            LCH5.jumpNewWebview(url);
            break;
        case '17':
            LCH5.jumpFriendContainer( parseInt(totype) );
            break;
        case '18':
            LCH5.jumpFriendContainer( parseInt(totype) );
            break;

    }
});

//把:hover和鼠标事件干掉.防止误触发带来的rendering
if(device == '2'){
    var timer,timeout = 500;
    $(document).scroll(function(){
        if(!timer){
            $('.discuss_article').addClass('pointer-none');
        }else{
            clearTimeout(timer);
            timer=null;
        }
        timer=setTimeout(function(){
            $('.discuss_article').removeClass('pointer-none');
            // next();
            timer=null;
        }, timeout);
    });
}else{
    var interval = null;// 定时器
    var topValue = 0;

    $("body").on('touchmove', function(e){
        if(interval == null) {
            interval = setInterval("lisccen_scroll()", 50);
            $('.discuss_article').addClass('pointer-none');
        }
    });

    function lisccen_scroll() {
        if(document.body.scrollTop == topValue) {
            clearInterval(interval);
            interval = null;
            setTimeout(function(){
                $('.discuss_article').removeClass('pointer-none');
            }, 500);

        } else {
            topValue = document.body.scrollTop ;
        }
    }
}

/*重新给media加上宽高*/
$('.qf_media iframe').each(function () {
    var $this = $(this);
    var w = parseInt($this.parent('.qf_media').width());
    var h = w / 1.33;//设置宽高比例为1.33
    $this.css({'width':w,'height':h});
});