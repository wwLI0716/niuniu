/**
 * Created by Administrator on 2019/6/29.
 */
function setCookie(key, value, days) {
    if (!value) {
        localStorage.removeItem(key);
    } else {
        var Days = days || 7;
        var exp = new Date();
        localStorage[key] = JSON.stringify({
            value,
            expires: exp.getTime() + Days * 24 * 60 * 60 * 1000,
        })
    }
}

function getCookie(name) {
    try {
        let o = JSON.parse(localStorage[name]);
        if (!o || o.expires < Date.now()) {
            return null;
        } else {
            return o.value;
        }
    } catch (e) {
        return localStorage[name];
    }
}

//初始语言设置
if(getCookie('language') && getCookie('language') != '')
{
    //判断当前语言和缓存语言是否一致
    if($('.checkLanguage').val() != getCookie('language'))
    {
        let url = window.location.pathname + window.location.search; //当前路径
        if(url.indexOf('?') == -1) //判定是否和缓存里的设置一致，不一致则跳转
        {
            window.location.href = url + '?lang=' + getCookie('language');
        } else {
            if(url.indexOf('lang') == -1)
            {
                window.location.href = url + '&lang=' + getCookie('language');
            }
        }
    }
}

function countdown(s, sendObj,content) {
    s--;
    if (s == 0) {
        sendObj.attr('value',content);
    } else {
        sendObj.attr('value',s + 's');
        setTimeout(function() {
            countdown(s, sendObj,content)
        }, 1000)
    }
}

//标记
$('.sidebar-menu li').each(function(){
    let that = $(this);
    let url = window.location.pathname;
    that.find('a').each(function(){
        if($(this).attr('data-href') == url)
        {
            that.addClass('active');
            return;
        }
    })
});

$('.checkLanguage').click(function(){
    setCookie('language',$(this).attr('data-lang'),300);
    let url = window.location.pathname + window.location.search; //当前路径
    window.location.href = url + '&lang=' + getCookie('language');
})

$('.specialA').click(function(){
    let carry = '';
    let lang = '';
    if(getCookie('language') && getCookie('language') != '')
    {
        lang = getCookie('language');
    }
    carry = '?lang=' + lang;
    if($(this).attr('data-parameter') != '')
    {
        carry += '&parameter=';
        carry += $(this).attr('data-parameter');
    }
    if($(this).attr('data-href') == undefined)
    {
        return false;
    }
    window.location.href = $(this).attr('data-href') + carry;
});

