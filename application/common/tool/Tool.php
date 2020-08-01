<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/19
 * Time: 18:08
 */

namespace app\common\tool;

use app\common\model\Config;
use think\facade\Request;

class Tool
{

    /**
     *
     * @param null $data
     * @param string $status
     * @param null $message
     * @return array
     */
    public static function reJson($data = null, $status = '', $message = null)
    {
        $status === null and $status = 0;
        $re = [
            'status' => (int)$status,
            'message' => $message,
        ];
        $data !== null and $re['data'] = $data;

        return $re;
    }

    /**
     *
     * @param null $data
     * @param string $status
     * @param null $message
     * @return string
     */
    public static function encodeReJson($data = null, $status = '', $message = null)
    {
        return json_encode(self::reJson($data, $status, $message));
    }


    /**
     * @return mixed
     * @throws \think\Exception
     */
    public static function getVersion(){
        return  Request::post('version', '');
    }

    public static function getPlatform(){
        return  Request::post('platform', '');
    }

    public static function getNetwork()
    {
        if(PHP_SAPI == "cli")
            return 0;

        return Request::post('network', 0);
    }

    public static function getDevice(){
        return Request::post('device', '');
    }

    public static function getAccessToken(){
        return Request::post('access_token', '');
    }

    public static function getLoginToken(){
        return Request::post('login_token', '');
    }

    public static function getUserId(){
        return Request::post('user_id', 0);
    }

    /**
     * 获取安卓 OR IOS
     * 1:ios   2:android 3：wap 新增
     * @return array|mixed
     */
    public static function getSystem(){
        return Request::post('system', 0);
    }

    //获取系统版本
    public static function getSystemVersion(){
        return Request::post('system_version', '');
    }

    /**
     * 获取内部版本号
     * @return array|mixed
     */
    public static function getProductVersion()
    {
        return Request::post('product_version', 0);
    }

    //获取浏览器UA
    public static function getUA(){
        if(isset($_SERVER['HTTP_USER_AGENT']))
            return $_SERVER['HTTP_USER_AGENT'];
        return "";
    }


    /**
     * @param $url
     * @param array $post_data
     * @param string $cookie
     * @param int $timeout
     * @return mixed|string
     */
    public static function requestUrl($url, $post_data = [], $cookie = '', $timeout = 10)
    {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        //IP
        $requestIp = self::getClientIp();

        //设置CURL头信息
        $header = [
            'CLIENT-IP:' . $requestIp,
            'X-FORWARDED-FOR:' . $requestIp,
            'REMOTE-ADDR:' . $requestIp,
            'REMOTE-PORT:' . (isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : 0),
            'Content-Type:multipart/form-data;charset=utf-8',
            "Expect:"
        ];

        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curlHandle, CURLOPT_MAXREDIRS, 3);

        if ($cookie != '') curl_setopt($curlHandle, CURLOPT_COOKIE, $cookie);
        if (isset($_POST['useragent'])) {
            curl_setopt($curlHandle, CURLOPT_USERAGENT, $_POST['useragent']);
        } else if (( Request::header('user-agent'))) {
            curl_setopt($curlHandle, CURLOPT_USERAGENT, Request::header('user-agent') );
        } else {
            curl_setopt($curlHandle, CURLOPT_USERAGENT, 'Yancheng_LYSOO_Server');
        }
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 0);

        if (!empty($post_data)) {
            curl_setopt($curlHandle, CURLOPT_POST, count($post_data));
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);
        }

        if (substr($url, 0, 8) == "https://") {
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
        }

        $data = curl_exec($curlHandle);
        $status = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle);
        if ($status != 200) {
            return '';
        }

        if (substr($data, 0, 3) == "\xEF\xBB\xBF") {
            $data = substr($data, 3);
        }

        return $data;
    }

    /**
     *
     * @param $url
     * @param array $post_data
     * @return bool|mixed
     */
    public static function requestForSms($url, $post_data = [])
    {
        if (empty($url) || empty($post_data)) {
            return false;
        }

        //设置CURL头信息
        $header = array(
            'Accept:application/json;',
            'Content-Type:application/json;charset=utf-8;',
            'Content-Length:x;'
        );

        $postUrl = $url;
        $curlPost = json_encode($post_data);

        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $postUrl); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        //curl_setopt($curl, CURLOPT_HTTPHEADER, $header );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno' . curl_error($curl);//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据
    }

    /**
     * @param $url
     * @param array $post_data
     * @param string $cookie
     * @param int $timeout
     * @return bool|mixed|string
     */
    public static function requestUrlExample($url, $post_data = [], $cookie = '', $timeout = 10)
    {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        //IP
        $requestIp = self::getClientIp();
        //设置CURL头信息
        $header = [
            'CLIENT-IP:' . $requestIp,
            'X-FORWARDED-FOR:' . $requestIp,
            'REMOTE-ADDR:' . $requestIp,
            'REMOTE-PORT:' . (isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : 0),
            'Content-Type:multipart/form-data;charset=utf-8',
            "Expect:"
        ];

        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curlHandle, CURLOPT_MAXREDIRS, 3);

        if ($cookie != '') curl_setopt($curlHandle, CURLOPT_COOKIE, $cookie);
        if (isset($_POST['useragent'])) {
            curl_setopt($curlHandle, CURLOPT_USERAGENT, $_POST['useragent']);
        } else if (isset($_SERVER['HTTP_USER_AGENT'])) {
            curl_setopt($curlHandle, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        } else {
            curl_setopt($curlHandle, CURLOPT_USERAGENT, 'Yancheng_LYSOO_Server');
        }
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 0);

        $params = [];
        $params['nonce'] = "";//随机码
        $params['timestamp'] = time();
        $params['data'] = json_encode($post_data);
        $params['site_id'] = 100099;//乌审旗
        $secret = "Fh9IgPyoWmSxvqAIHHHqIFR03tGCxs";
        $str = $params['data'] . $params['nonce'] . $secret . $params['timestamp'] . $params['site_id'];
        $params['sign'] = strtoupper(md5($str));

        if (!empty($params)) {
            //curl_setopt($curlHandle, CURLOPT_POST, count($post_data));
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $params);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);
        }

        if (substr($url, 0, 8) == "https://") {
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
        }

        $data = curl_exec($curlHandle);
        $status = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle);
        if ($status != 200) {
            return '';
        }

        if (substr($data, 0, 3) == "\xEF\xBB\xBF") {
            $data = substr($data, 3);
        }

        return $data;
    }

    /**
     * 获取网络请求状态
     * @param $url
     * @param int $timeout
     * @return bool
     */
    public static function requestForStatus($url, $timeout = 1)
    {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 1);
        curl_setopt($curlHandle, CURLOPT_NOBODY, 1);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);

        $data = curl_exec($curlHandle);
        $status = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);

        if ($status != 200) {
            return false;
        }

        return true;
    }

    /**
     * 获取请求的IP地址
     * @return mixed
     */
    public static function getClientIp()
    {
        $ip = '';

        if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else if (isset($_SERVER['HTTP_CDN_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CDN_REAL_IP'])) {
            $ip = $_SERVER['HTTP_CDN_REAL_IP'];
        } else if (isset($_SERVER['HTTP_CDN_SRC_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CDN_SRC_IP'])) {
            $ip = $_SERVER['HTTP_CDN_SRC_IP'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        }

        return $ip;
    }

    /**
     * 验证签名 生成能通过验证的大后台链接
     * @param $params
     * @param $secret
     * @return string
     */
    public static function generateSign($params, $secret)
    {
        ksort($params);
        $spa = array();
        foreach ($params as $k => $v) {
            if ("@" != substr($v, 0, 1)) {
                $spa[] = "$k=$v";
            }
        }
        $spa[] = "key=" . $secret;
        return strtoupper(md5(implode("&", $spa)));
    }

    /**
     * 生成眼前参数
     * @param int $len
     * @return string
     */
    public static function generateNonce($len = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $len; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * @param string $mobile
     * @return int
     */
    public static function generateVerifyCode( $mobile = '' )
    {
        $verifyCode = '';
        if( $mobile )
        {
            if( cache('lys-mobile-verify-code-' . $mobile ) )
            {
                $verifyCode = cache( 'lys-mobile-verify-code-' . $mobile );
            }
            else
            {
                $verifyCode = rand(100000, 999999);
                $left = strtotime( date( "Y-m-d 23:59:59" ) ) - time();
                cache( 'lys-mobile-verify-code-' . $mobile, $verifyCode, $left );
            }
        }
        else
        {
            $verifyCode = rand(100000, 999999);
        }

        return $verifyCode;
    }

    /**
     * 本地路径图片转base64编码
     * @param string $imgPath
     * @return string
     */
    public static function imageToBase64($imgPath = '')
    {
        $img_base64 = '';
        if (file_exists($imgPath)) {
            $app_img_file = $imgPath; // 图片路径
            $img_info = getimagesize($app_img_file); // 取得图片的大小，类型等
            $fp = fopen($app_img_file, "r"); // 图片是否可读权限

            if ($fp) {
                $filesize = filesize($app_img_file);
                $content = fread($fp, $filesize);
                $file_content = chunk_split(base64_encode($content)); // base64编码
                switch ($img_info[2]) {           //判读图片类型
                    case 1:
                        $img_type = "gif";
                        break;
                    case 2:
                        $img_type = "jpg";
                        break;
                    case 3:
                        $img_type = "png";
                        break;
                }

                $img_base64 = 'data:image/' . $img_type . ';base64,' . $file_content;//合成图片的base64编码

            }
            fclose($fp);
        }

        return $img_base64; //返回图片的base64
    }

    /**
     * 图片base64转成图片链接
     * @param string $base64
     * @return bool|string
     */
    public static function base64ToUrl($base64 = ''){
        if( !stripos($base64,'data:image:/') ){
            $base64 = 'data:image/jpg;base64,' . $base64;
        }

        $base64 = 'data:image/jpg;base64,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';

        $imageName = md5(time() . mt_rand(1000,9999)) . '.jpg';
        $path = "/ids/" . date('Ymd');
        if( !is_dir(PUBLIC_PATH . $path ) ){
            mkdir(PUBLIC_PATH . $path,0777,true);
        }

        $imageSrc = $path . DS . $imageName;
        $r = file_put_contents( PUBLIC_PATH . $imageSrc, base64_decode($base64) );//返回字节数

        if( !$r ){
            return false;
        }else{
            return $imageSrc;
        }
    }


    /**
     * [将Base64图片转换为本地图片并保存]
     * @param  [Base64] $base64_image_content [要保存的Base64]
     * @param  [目录] $path [要保存的路径]
     */
    public static function base64ImageContent($base64_image_content,$path = '/ids')
    {
        $base64_image_content = 'data:image/jpg;base64,' . $base64_image_content;
        //匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
            $type = $result[2];
            $fileSrc = $path . "/" . date('Ymd', time()) . "/";
            $new_file = PUBLIC_PATH . $fileSrc;
            if (!file_exists($new_file)) {
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file, 0700);
            }
            $fileName = $fileSrc . time() . ".jpg";
            $new_file = PUBLIC_PATH . $fileName;
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
                return $fileName;
            } else {
                return false;
            }
        } else {


            return false;
        }
    }



        //获取天气
    public static function getWeather($city = '',$item = 0){
        //
        $host = "https://ali-weather.showapi.com/";//
        $items = [
            'area-to-weather',//根据地区
            'hour24',//24小时数据
            'day15'//15天数据
        ];
        //AppKey：25597043     AppSecret：852de237506c4a76f64bc3e04719f264
        //$appCode = "42a196268474463ea54b7e9f28b2c720";
        $appCode = "7c7e79a738b74785917e1b7de909b125";

        $headers = [];
        array_push($headers,"Authorization:APPCODE " . $appCode);

        $query = "area=".urlencode($city);

        if( !$item )
            $query .= "&need3HourForcast=0&needAlarm=0&needHourData=0&needIndex=1&needMoreDay=0";


        $url = $host . $items[$item] . "?" . $query;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $data = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $body = '';
        if ($status == 200){
            list($header, $body) = explode("\r\n\r\n", $data, 2);
        }
        return $body;

    }

    /**
     * 根据城市名获取城市天气
     * @param string $city
     */
    public static function getCityWeather($city = ''){

        $city = '盐城';

        $wData = [];

        if( !cache('LYS-YCG-CITY-WEATHER-' . $city ) ) {
            $data = self::getWeather( $city );
            $weather = json_decode($data, true);
            if( $weather && isset( $weather['showapi_res_body'])){
                $body = $weather['showapi_res_body'];
                $temperatures = [
                    $body['f1']['day_air_temperature'],
                    $body['f1']['night_air_temperature']
                ];
                $wData = [
                    'weather_pic' => $body['now']['weather_pic'],//'http://app1.showapi.com/weather/icon/day/301.png',//$now['weather_pic'],
                    'weather_code' => $body['now']['weather_code'],
                    'area' => $body['now']['aqiDetail']['area'],
                    'weather' => $body['now']['weather'],
                    'temperature' => min($temperatures) . '°~' . max($temperatures) .'°',
                    'weather_info' => $body['f1']['index']['clothes']['title'].','.$body['f1']['index']['clothes']['desc'],
                    'advice' => $body['f1']['index']['clothes']['desc']
                ];

                //天气缓存1小时
                cache('LYS-YCG-CITY-WEATHER-' . $city , $wData , ['expire' => 3540]);

            }
        }else{
            $wData = cache('LYS-YCG-CITY-WEATHER-' . $city);
        }
        return $wData;
    }

    /**
     * 异地手机号检测
     * @param $mobile
     * @return bool|string
     */
    public static function register_locate( $mobile )
    {
        // 注册设置
        $register_setting = Config::getVal('register_location_limit');

        // 是否开启区域限制
        if( $register_setting )
        {
            // 获取手机归属地
            $responseString = self::requestUrl('http://cx.shouji.360.cn/phonearea.php?number=' . $mobile);
            $response = json_decode($responseString,true);
            $prov = '';
            $city = '';
            $error = true;
            if( isset($response['code']) && $response['code'] === 0 ) {
                $prov = $response['data']['province'];
                $city = $response['data']['city'];
            }

            //盐城地区内
            if( $register_setting == 1 ){
                //
                if( !in_array($city,['盐城','盐城市']) ){
                    $error = '对不起，目前只允许：盐城市的手机用户注册';
                }

            }elseif( $register_setting == 2 ){
                if( !in_array($prov,['江苏','江苏省']) ){
                    $error = '对不起，目前只允许：江苏省的手机用户注册'.$register_setting;
                }
            }

            return $error;

        }

        return true;
    }

    //清除XSS攻击
    public static function forbidXss($content){
        $content = trim($content);  //清理空格
        $content = strip_tags($content);   //过滤html标签
        //$content = htmlspecialchars($content,ENT_);   //将字符内容转化为html实体
        $content = addslashes($content);
        return $content;
    }

    /**
     * 字符在字符串中是否存在
     * @param $string
     * @param $find
     * @return bool
     */
    public static function strExists($string, $find) {
        return !(strpos($string, $find) === FALSE);
    }

    /**
     * 截断字符串
     * @param $str
     * @param $max_length
     * @param string $suffix
     * @return string
     */
    public static function truncate($str, $max_length, $suffix = '...') {
        if (mb_strlen($str, 'utf-8') <= $max_length)
            return $str;

        return mb_substr($str, 0, $max_length, 'utf-8') . $suffix;
    }

    /**
     * @param array $list
     * @param $row
     * @param int $position
     * @return array
     */
    public static function insertArray($list = [], $row , $position){
        $count = count($list);
        if($position == 0){
            array_unshift($list, $row);
        }elseif($position > $count){
            array_push($list, $row);
        }else{
            $arr1 = array_slice($list, 0, $position);
            $arr2 = array_slice($list, $position, $count-$position);
            $list = array_merge($arr1, [$row], $arr2);
        }
        return $list;
    }

    //  UBB代码转换
    //  这里只做参考 , 没验证之前请勿调用
    public static function  replaceUbb($Text) {
        $Text=preg_replace("\[br\]","<br />",$Text);
        $Text=nl2br($Text);
        $Text=stripslashes($Text);
        $Text=preg_replace("/\\t/is"," ",$Text);
        $Text=preg_replace("/\[url\](http:\/\/.+?)\[\/url\]/is","<a href=\"\\1\" target=\"new\"><u>\\1</u></a>",$Text);
        $Text=preg_replace("/\[url\](.+?)\[\/url\]/is","<a href=\"http://\\1\" target=\"new\"><u>\\1</u></a>",$Text);
        $Text=preg_replace("/\[url=(http:\/\/.+?)\](.+?)\[\/url\]/is","<a href=\"\\1\" target=\"new\"><u>\\2</u></a>",$Text);
        $Text=preg_replace("/\[url=(.+?)\](.+?)\[\/url\]/is","<a href=\"http://\\1\" target=\"new\"><u>\\2</u></a>",$Text);
        $Text=preg_replace("/\[color=(.+?)\](.+?)\[\/color\]/is","<font color=\"\\1\">\\2</font>",$Text);
        $Text=preg_replace("/\[font=(.+?)\](.+?)\[\/font\]/is","<font face=\"\\1\">\\2</font>",$Text);
        $Text=preg_replace("/\[email=(.+?)\](.+?)\[\/email\]/is","<a href=\"mailto:\\1\"><u>\\2</u></a>",$Text);
        $Text=preg_replace("/\[email\](.+?)\[\/email\]/is","<a href=\"mailto:\\1\"><u>\\1</u></a>",$Text);
        $Text=preg_replace("/\[i\](.+?)\[\/i\]/is","<i>\\1</i>",$Text);
        $Text=preg_replace("/\[u\](.+?)\[\/u\]/is","<u>\\1</u>",$Text);
        $Text=preg_replace("/\[b\](.+?)\[\/b\]/is","<b>\\1</b>",$Text);
        $Text=preg_replace("/\[fly\](.+?)\[\/fly\]/is","<marquee width=\"98%\" behavior=\"alternate\" scrollamount=\"3\">\\1</marquee>",$Text);
        $Text=preg_replace("/\[move\](.+?)\[\/move\]/is","<marquee width=\"98%\" scrollamount=\"3\">\\1</marquee>",$Text);
        $Text=preg_replace("/\[shadow=([#0-9a-z]{1,10})\,([0-9]{1,3})\,([0-9]{1,2})\](.+?)\[\/shadow\]/is","<table width=\"*\"><tr><td style=\"filter:shadow(color=\\1, direction=\\2 ,strength=\\3)\">\\4</td></tr></table>",$Text);
        return $Text;
    }

    //过滤 UBB 代码
    public static function offUbb($text = ''){

        $Text=stripslashes($text);
        $Text=preg_replace("/\[img\](http:\/\/.+?)\[\/img\]/is","",$Text);
        $Text=preg_replace("/\[b\](.+?)\[\/b\]/is","\\1",$Text);
        $Text=preg_replace("/\[i\](.+?)\[\/i\]/is","\\1",$Text);
        $Text=preg_replace("/\[size=(.+?)\](.+?)\[\/size\]/is","\\2",$Text);
        $Text=preg_replace("/\[color=(.+?)\](.+?)\[\/color\]/is","\\2",$Text);
        $Text=preg_replace("/\[align=(.+?)\](.+?)\[\/align\]/is","\\2",$Text);
        $Text=preg_replace("/\[url=(.+?)\](.+?)\[\/url\]/is","\\2",$Text);

        return $Text;
    }

    // 隐藏手机中间4位
    public static function hideTel($phone){
        $IsWhat = preg_match('/(0[0-9]{2,3}[\-]?[2-9][0-9]{6,7}[\-]?[0-9]?)/i',$phone); //固定电话
        if($IsWhat == 1){
            return preg_replace('/(0[0-9]{2,3}[\-]?[2-9])[0-9]{3,4}([0-9]{3}[\-]?[0-9]?)/i','$1****$2',$phone);
        }else{
            return  preg_replace('/(1[3587]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$phone);
        }
    }

}