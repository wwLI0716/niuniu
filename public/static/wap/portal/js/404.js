init_rem();
function init_rem(){
    var iw = 750;
    var w = window.innerWidth;
    if(w>750){
        w = 750;
    }
    var irate= 625/(iw/w);
    var str = 'html{font-size:' + irate + '%' + '}';
    var h_style = document.createElement("style");
    h_style.setAttribute("type", "text/css");
    h_style.innerHTML = str;
    document.getElementsByTagName('head')[0].appendChild(h_style);
}