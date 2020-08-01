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
	//购买商品确定按钮
	//$(".dh_btn").click(function(){
	//	$(".dh_main").hide();
	//});
	$(document).on('.dh_btn','click',function(){
		$(".dh_main").hide();
	});
	//兑换详情动画3s后消失
	//$(".box_dhan").delay(3000).fadeOut();
	//$(".box_dhan").hide();
	//$(".box_dhan").one("click",function(){
	//	$(".box_dhan").hide();
	//});
	//商品详细页提示框
	$(".pop_box .cancel").on("click",function(){
		$(".pop_box").hide();
	});
	//已兑换
	$("#dialog_ydh .bg").addClass("bg_ydh");
	$("#dialog_ydh .text").text("已经兑换过啦");
	//等待开奖
	$("#dialog_kj .bg").addClass("bg_kjing");
	$("#dialog_kj .text").text("等待开奖中……");
	//抢光
	$("#dialog_qg .bg").addClass("bg_qg");
	$("#dialog_qg .text").text("商品被抢光啦");
	//商品已下架
	$("#dialog_xiajia .bg").addClass("bg_xiajia");
	$("#dialog_xiajia .text").text("商品已下架");
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

	//我的兑换记录tab
	$('#dh_shops').click(function(){
		$(this).css({'background':'#FF6633','color':'#FFF','border-color':'#FF6633'});
		$('#db_shops,#dzp_shops').css({'background':'#FFF','color':'#999','border-color':'#C9C9C9'});
	});
	$('#db_shops').click(function(){
		$(this).css({'background':'#FF6633','color':'#FFF','border-color':'#FF6633'});
		$('#dh_shops,#dzp_shops').css({'background':'#FFF','color':'#999','border-color':'#C9C9C9'});
	});
	$('#dzp_shops').click(function(){
		$(this).css({'background':'#FF6633','color':'#FFF','border-color':'#FF6633'});
		$('#dh_shops,#db_shops').css({'background':'#FFF','color':'#999','border-color':'#C9C9C9'});
	});

	$('.code_box .close').click(function(){
		$('.code_box').hide();
	});
	$('.getshops_tbox .close').click(function(){
		$('.getshops_tbox').hide();
	});
});
//抽奖活动加载进度条
window.onload =function(){
	//$(".box_dhan").delay(3000).fadeOut();
	$(".box_dhan").hide(3000);
	$("ul li").each(function(){
		var kk = $(this).find('.red_right').html();
		$(this).find(".cjjd_bar span").animate({width:kk},1000);
	})
	//图片宽高比例
	img_scale();
}
$(document).ready(function(){
	var datamax = $("#add2").attr("data-max");
	if(datamax == 1){
		$(".jian,.add").css({color:"#b7b7b7",background:"#F9F9F9"});
		return
	}
	$("#add").on("touchstart",function(){
		var n = $("#num").html();
		var price = $(".price .price_num").text();
		var num = parseInt(n)+1;
		var datamax = $("#add").attr("data-max");
		var datamax_n = parseInt(datamax)+1;
		$(".count_box .jian").css({color:"#333",background:"#F2F2F2"});
		if(datamax == 0){
			$(".count_box .add").css({color:"#b7b7b7",background:"#F9F9F9"});
			return
		}
		if(datamax == 1){
			return
		}
		if(num==datamax_n){
			//alert("最大数量为" + datamax);
			$(".count_box .add").css({color:"#b7b7b7",background:"#F9F9F9"});
			return
		}
		$("#num,#num2").html(num);
		//抽奖页面给input number赋值
		$('#choujiang #number').val(num);
	});

	$("#jian").on("touchstart",function(){
		var n=$("#num").html();
		var num=parseInt(n)-1;
		$(".count_box .add").css({color:"#333",background:"#F2F2F2"});
		if(num==0){
 		//alert("不能为0!");
			$(".count_box .jian").css({color:"#b7b7b7",background:"#F9F9F9"});
			return
		}
		$("#num,#num2").html(num);
		$('#choujiang #number').val(num);
	});
	$("#add2").on("touchstart",function(){
		var n=$("#num2").html();
		var single_price = $(".price_num").html();
		var num2 = parseInt(n)+1;

		var total_price = (single_price*num2);
		var datamax = $("#add2").attr("data-max");
		var datamax_n2 = parseInt(datamax)+1;
		// 修复一个计数的bug
		if(num2<datamax_n2)
			$("#number").val(num2);

		$(".total_qlb,.dialog_pay .total").html(total_price.toFixed(2)*100/100);
		$(".count_box .jian").css({color:"#333"});
		if(num2==(datamax_n2)){
			//alert("最大数量为"+ datamax);
			totalprice();
			$(".count_box .add").css({color:"#b7b7b7",background:"#F9F9F9"});
			return
		}else{
			$(".count_box .add").css({color:"#333",background:"#F2F2F2"});
		}
		if(datamax_n2 == 2){
			$(".count_box .jian").css({color:"#b7b7b7",background:"#F9F9F9"});
			$(".count_box .add").css({color:"#b7b7b7",background:"#F9F9F9"});
			return false;
		}
		$("#num2,#num").html(num2);
	});

	$("#jian2").on("touchstart",function(){
		totalprice();
		var n = $("#num2").html();
		var single_price = $(".price_num").html();
		var num2 = parseInt(n)-1;
		var endnumber = $("#number").val(num2);
		var total_price = (single_price*num2);
		$(".count_box .add").css({color:"#333",background:"#F2F2F2"});
		$(".total_qlb,.dialog_pay .total").html(total_price.toFixed(2)*100/100);
		//对0的情况对处理
		if(num2==0){
			$(".total_qlb").html(single_price);
			var endnumber = $("#number").val(1);
			$(".count_box .jian").css({color:"#b7b7b7",background:"#F9F9F9"});
 		//alert("不能为0!");
			return
		}
		$("#num2,#num").html(num2);
	});
});
//加减计数
function totalprice(){
	var single_price = $(".price_num").html();
	var num_text = $(".common_num").html();
	var total_price = (single_price*num_text);
	$(".total_qlb,.dialog_pay .total").html(total_price.toFixed(2)*100/100);
}
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
//js控制图片宽高比
function img_scale(){
	var img = $(".goods_good li:first-child img");
	var mw = $(".goods_good li:first-child img").width();
	$(".goods_good img").height(mw*(2/3));
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
//商品展示页(考虑商品数是奇数的情况下，不美观)

