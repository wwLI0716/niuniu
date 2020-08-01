/**
 * Created by Administrator on 2015/10/16.
 */
$(document).ready(function(){
    checkIsInApp();
})
$(document).on('click','a.v-icon-close',function(){
    $('#j-od-weixin').hide();
    $('#j-od-common').hide();
})
function checkIsInApp(){
    if(!isInApp()){
        openDialog();
        $('#over_layer').show();
        $('#over_layer').find('#start_play').hide();
    }
}
function isInApp() {
    var index = navigator.userAgent.indexOf('QianFan');
    if (index == -1)
    {
        return false;
    }
    else
    {
        return true;
    }
}
function openDialog() {
    var checkVerson = checkVersonObj();
    //如果是微信浏览器
    var download_url = $('.download_url').attr('data-url');
    if(checkVerson.is_ios()){
        url = download_url;
    }else if(checkVerson.is_android()){
        url = download_url;
    }
    if(checkVerson.is_wechat()){
        $('#j-od-weixin').show();
        setUrl('j-od-weixin',download_url);
    }else{
        $('#j-od-common').show();
        setUrl('j-od-common',download_url);
    }
}

function setUrl(obj,url){
    $('#'+ obj).find('.download_url').attr('href',url);
    return obj;
}
/*查看版本，判断是安卓、ios、或者微信*/
var checkVersonObj = function(){
    var browser = {
        versions: function () {
            var u = navigator.userAgent, app = navigator.appVersion;
            return {         //移动终端浏览器版本信息
                trident: u.indexOf('Trident') > -1, //IE内核
                presto: u.indexOf('Presto') > -1, //opera内核
                webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
                iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
                iPad: u.indexOf('iPad') > -1, //是否iPad
                webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
            };
        }(),
        language: (navigator.browserLanguage || navigator.language).toLowerCase(),
        is_ios:function() {
            if (browser.versions.ios || browser.versions.iPhone || browser.versions.iPad) {
                return true;
            }
            return false;
        },
        is_android:function() {
            if (browser.versions.android) {
                return true;
            }
            return false;
        },
        is_wechat:function() {
            var ua = navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == 'micromessenger') {
                return true;
            } else {
                return false;
            }
        }
    };
    return browser;
};
/*查看版本，判断是安卓、ios、或者微信*/
function checkVerson() {
    var browser = {
        versions: function () {
            var u = navigator.userAgent, app = navigator.appVersion;
            return {
                trident: u.indexOf('Trident') > -1,
                presto: u.indexOf('Presto') > -1,
                webKit: u.indexOf('AppleWebKit') > -1,
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,
                mobile: !!u.match(/AppleWebKit.*Mobile.*/),
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1,
                iPhone: u.indexOf('iPhone') > -1,
                iPad: u.indexOf('iPad') > -1,
                webApp: u.indexOf('Safari') == -1
            };
        }(), language: (navigator.browserLanguage || navigator.language).toLowerCase(), is_ios: function () {
            if (browser.versions.ios || browser.versions.iPhone || browser.versions.iPad)
            {
                return true;
            }
            return false;
        }, is_android: function () {
            if (browser.versions.android)
            {
                return true;
            }
            return false;
        }, is_wechat: function () {
            var ua = navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == 'micromessenger')
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    };
    return browser;
}
