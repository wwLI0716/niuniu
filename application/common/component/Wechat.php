<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/29
 * Time: 17:55
 */

namespace app\common\component;


use think\facade\Cache;

class Wechat
{
    private $appId;
    private $appSecret;
    private $request;
    private $sign;

    public function __construct()
    {
        $this->appId = 'wxa6e5c60d941b1ab6';
        $this->appSecret = 'f6837171841bfebd84c70bdb91f06d83';
        $this->request = new HttpClient();
    }

    /**
     * 微信分享
     * @param $title
     * @param $description
     * @param $img_url
     * @param $url
     * @return string
     */
    public function share($title, $description, $img_url, $url)
    {
        $this->sign = $this->makeSignature();
        if (empty($this->sign))
            return "";

        $title = (str_replace(array("\r", "\n", "\t"), "", strip_tags($title)));
        $description = (str_replace(array("\r", "\n", "\t"), "", strip_tags($description)));

        return <<<EOF
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
	wx.config({
		debug: false,
		appId: '{$this->sign["appId"]}',
		timestamp: '{$this->sign["timestamp"]}',
		nonceStr: '{$this->sign["nonceStr"]}',
		signature: '{$this->sign["signature"]}',
		jsApiList: [
			'onMenuShareTimeline',
			'onMenuShareAppMessage',
			'getLocation'
		]
	});
	wx.ready(function () {
		wx.onMenuShareAppMessage({
			title: '{$title}',
			desc: '{$description}',
			link: '{$url}',
			imgUrl: '{$img_url}',
			trigger: function (res) {

            },
            success: function (res) {
                doComplete(res);
            },
            cancel: function (res) {

            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
		});
		wx.onMenuShareTimeline({
			title: '{$title}',
			link: '{$url}',
			imgUrl: '{$img_url}',
			trigger: function (res) {

            },
            success: function (res) {
                doComplete(res);
            },
            cancel: function (res) {

            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
		});
	});
</script>
EOF;
    }

    /**
     *
     */
    public function getAccessToken(){

        if( !Cache::get('LC_ACCESS_TOKEN') ){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret={$this->appSecret}";
            $obj = $this->request->sendRequest(['url' => $url]);

            if( isset($obj->access_token) && $obj->access_token ){
                Cache::set('LC_ACCESS_TOKEN',$obj->access_token,7200 );
            }
        }

        return Cache::get('LC_ACCESS_TOKEN');

    }

    /**
     *
     */
    public function getJsApiTicket($access_token = ''){
        $access_token = $access_token ? $access_token : $this->getAccessToken();
        if( !Cache::get('LC_JS_API_TICKET') ){
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=jsapi";
            $json = $this->request->sendRequest(['url' => $url]);
            if( isset($json->ticket) && $json->ticket ){
                Cache::set('LC_JS_API_TICKET',$json->ticket , 7200 );
            }
        }
        //
        return Cache::get('LC_JS_API_TICKET');
    }

    /**
     * 生成签名
     * @param array $params
     */
    public function makeSignature($params = []){

        $ticket = $this->getJsApiTicket();
        if ( empty($ticket) ) {
            return [];
        }

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $stringA = "jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1( $stringA );
        $signPackage = array(
            "appId" => $this->appId,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $stringA
        );

        return $signPackage;
    }

    /**
     * 生成随机码
     * @param int $length
     * @return string
     */
    public function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }


}