<?php


namespace app\common\component;

use think\Log;

class Weixin
{
    private $host = "https://open.lysoo.com";
    private $site_id;
    private $sign;

    function __construct($site_id)
    {
        $this->site_id = $site_id;
    }

    public function share($title, $description, $img_url, $url)
    {
        $this->sign = $this->doSign();
        if (empty($this->sign))
            return "";

        $title = (str_replace(array("\r", "\n", "\t"), "", strip_tags($title)));
        $description = (str_replace(array("\r", "\n", "\t"), "", strip_tags($description)));

        return <<<EOF
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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

    private function doSign()
    {
        $result = $this->getJsApiTicket();
        if(!isset($result->jsticket) || !isset($result->appid))
            return array();
        
        $ticket = $result->jsticket;
        $appId = $result->appid;
        if (empty($ticket)) {
            return array();
        }

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId" => $appId,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );

        return $signPackage;
    }

    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }

        return $str;
    }

    private function getJsApiTicket()
    {
        $site_ticket = 'LC_YCGA_ticket';
        if(!cache($site_ticket)){
            $response = $this->httpGet($this->host . '/api/weixin/get-js-ticket?site_id=' . $this->site_id);
            if ($response) {
                $resobj = json_decode($response);
                if ($resobj && !empty($resobj->data)) {
                    cache($site_ticket,$resobj->data,60);
                    return $resobj->data;
                } else {
                    Log::write("site: {$this->site_id}:" . $response . 'weixin_jsticket');
                }
            } else {
                Log::write("site: {$this->site_id}: empty response" . 'weixin_jsticket');
            }
            return "";
        }else{
            $ticket = cache($site_ticket);
            return $ticket;
        }
    }

    private function getAccessToken()
    {
        $response = $this->httpGet($this->host . '/api/weixin/get-access-token?site_id=' . $this->site_id);
        if ($response) {
            $resobj = json_decode($response);
            if ($resobj && !empty($resobj['data'])) {
                return $resobj['data'];
            } else {
                Log::write("site: {$this->site_id}:" . $response, 'weixin_accesstoken');
            }
        } else {
            Log::write("site: {$this->site_id}: empty response", 'weixin_accesstoken');
        }
        return "";
    }

    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
}
