//页面js部分
$(function(){
	//轮播图宽度
	var w_width = $('body').width();
	var slider_height = w_width/(750/326);
	$('#slider').height(slider_height);
	var slider_height_02 = w_width/(710/215);
	$('#slider_02').height(slider_height_02);
	$("#to_dhmain").click(function(){
		$(".dh_main").show();
		$(".dh_main .dh_content").animate({bottom:'0'});
		totalprice();
		$(".page_goodsdetail").addClass("jz");

		return;
	});
	$(".dh_close,.keep").click(function(){
		//$(".dh_main").css("display","none");
		$(".dh_main .dh_content").animate({bottom:'-600px'},800);
		//$(".dh_main").delay(500).fadeOut();
		$(".dh_main").hide(500);
		$(".page_goodsdetail").removeClass("jz");
	});
	//修改地址
	$(".xiugai").click(function(){
		$(".page_getaddress").show();
	});

	$(document).on('.dh_btn','click',function(){
		$(".dh_main").hide();
	});

	//商品详细页提示框
	$(".pop_box .cancel").on("click",function(){
		$(".pop_box").hide();
	});
	//其他情况

	//商品支付
	$('.pay_close,.get_close').click(function(){
		$('.dialog_paybox,.dialog_getbox').hide();
		$(".dh_main .dh_content").animate({bottom:'-600px'},800);
		//$(".dh_main").delay(500).fadeOut();
		$(".dh_main").hide(500);
		$(".page_goodsdetail").removeClass("jz");
	});

	//收支明细页tab切换
	var thisId = window.location.hash;
	if(thisId != "" && thisId != undefined){
		showBox(false);
	}
	xssCheck();
});


//收支明细
function showBox(obj){
	if(obj){
		$('.goods_noselect').css({"background":"#FFF","color":"#FF6633"});
		$('.inout_select').css({"background":"#FF6633","color":"#FFF"});
		$('.inout_listbox').show();
		$('.goods_list').hide();
	}else{
		$('.inout_select').css({"background":"#FFF","color":"#FF6633"});
		$('.goods_noselect').css({"background":"#FF6633","color":"#FFF"});
		$('.inout_listbox').hide();
		$('.goods_list').show();
	}
}

//前端过滤xss
function xssCheck(str,reg){
	return str ? str.replace(reg || /[&<">'](?:(amp|lt|quot|gt|#39|nbsp|#\d+);)?/g, function (a, b) {
		if(b){
			return a;
		}else{
			return {
				'<':'&lt;',
				'&':'&amp;',
				'"':'&quot;',
				'>':'&gt;',
				"'":'&#39;',
			}[a]
		}
	}) : '';
}