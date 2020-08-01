<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Container;
use app\common\model\Config;
use app\index\model\SmsLogs;
use app\index\model\UserLogin;
use app\index\model\User;
use app\index\model\UserNotice;
use think\facade\Env;
/*use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use app\index\controller\SignatureHelper;

require_once "common/ucpaas/autoloader.php";
//设置
/**
 * 获取警察头像
 * @param string $username
 * @return mixed
 */
function police_avatar($username = ''){
    $default = Env::get('POLICE_ICON','https://qr.yc-police.com/jphoto/{JH}.jpg');
    if( $username ){
        $jh = substr( $username ,-6,6);
        $icon = str_replace('{JH}',$jh,$default);
        return $icon;
    }
    return $default;
}

/**
 * ucpaas
 */
function ucpass($caller,$callee,$sid){
    $c=new safetyCalls();
    $rs= $c->allocNumber($caller,$callee,$sid);
    return $rs;
}
/**
 * 获取到网站根目录
 * @return mixed
 * @author 奕潇
 */
function get_root()
{
    // 基础替换字符串
    $request = Container::get('request');
    $root = $request->root();
    return $root;
}

/**
 * @param $time //时间戳
 * @param string $format
 * @return false|string
 * @author sun slf02@ourstu.com
 * @date 2018/9/25 16:27
 * 格式化时间函数
 */
function time_format($time = NULL, $format = 'Y-m-d H:i')
{
    $time = $time === NULL ? time() : intval($time);
    return date($format, $time);
}

/*
 * 获取文档封面图片
 */
function get_cover($cover_id, $field = null)
{

    if (empty($cover_id)) {
        return false;
    }
    $tag = 'picture_' . $cover_id;
    $picture = cache($tag);
    if (empty($picture)) {
        $picture = db('Picture')->where(array('status' => 1,'id'=>$cover_id))->find();
        cache($tag, $picture);
    }

    $picture['path'] = get_pic_src($picture['path']);
    return empty($field) ? $picture : $picture[$field];
}

/**
 * @param $cover_id
 * @return array|bool|mixed|null|PDOStatement|string|\think\Model
 * @author:lin(lt@ourstu.com)
 */
function pic($cover_id)
{
    return get_cover($cover_id, 'path');
}

/**
 * 渲染图片链接
 * @param $path
 * @return mixed
 * @author:lin(lt@ourstu.com)
 */
function get_pic_src($path)
{
    //不存在http://
    $not_http_remote = (strpos($path, 'http://') === false);
    //不存在https://
    $not_https_remote = (strpos($path, 'https://') === false);
    if ($not_http_remote && $not_https_remote) {
        //本地url
        return str_replace('//', '/', get_root() . $path); //防止双斜杠的出现
    } else {
        //远端url
        return $path;
    }
}

/**
 * 系统非常规MD5加密方法
 * @param $str
 * @param string $key
 * @return string
 * @author:wdx(wdx@ourstu.com)
 */
function think_ucenter_md5($str, $key = 'ThinkUCenter')
{
    return '' === $str ? '' : md5(sha1($str) . $key);
}

/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key 加密密钥
 * @param int $expire 过期时间 (单位:秒)
 * @return string
 */
function think_ucenter_encrypt($data, $key, $expire = 0)
{
    $key = md5($key);
    $data = base64_encode($data);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }
    $str = sprintf('%010d', $expire ? $expire + time() : 0);
    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
    }
    return str_replace('=', '', base64_encode($str));
}

/**
 * 系统解密方法
 * @param string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param string $key 加密密钥
 * @return string
 */
function think_ucenter_decrypt($data, $key)
{
    $key = md5($key);
    $x = 0;
    $data = base64_decode($data);
    $expire = substr($data, 0, 10);
    $data = substr($data, 10);
    if ($expire > 0 && $expire < time()) {
        return '';
    }
    $len = strlen($data);
    $l = strlen($key);
    $char = $str = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }
    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        } else {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}

/**
 * 获取登录管理员id
 * @return mixed
 * @author:wdx(wdx@ourstu.com)
 */
function get_aid()
{
    $admin = session('admin_auth');
    if (session('admin_auth_sign') == data_auth_sign($admin)) {
        return $admin['uid'];
    } else {
        return false;
    }
}

/**
 * 获取登录用户id
 * @return mixed
 * @author:wdx(wdx@ourstu.com)
 */
function get_uid()
{
    $user = session('user_auth');
    if (session('user_auth_sign') == data_auth_sign($user)) {
        return $user['uid'];
    } else {
        return false;
    }
}

/**
 * text函数用于过滤标签，输出没有html的干净的文本
 * @param string text 文本内容
 * @return string 处理后内容
 */
function text($text, $addslanshes = false)
{
    $text = nl2br($text);
    $text = real_strip_tags($text);
    if ($addslanshes)
        $text = addslashes($text);
    $text = trim($text);
    return $text;
}

/**
 * @param $str
 * @param string $allowable_tags
 * @return string
 * @author:lin(lt@ourstu.com)
 */
function real_strip_tags($str, $allowable_tags = "")
{
    return strip_tags($str, $allowable_tags);
}

/**
 * html函数用于过滤不安全的html标签，输出安全的html
 * @param string $text 待过滤的字符串
 * @param string $type 保留的标签格式
 * @return string 处理后内容
 */
function html($text, $type = 'html')
{
    // 无标签格式
    $text_tags = '';
    //只保留链接
    $link_tags = '<a>';
    //只保留图片
    $image_tags = '<img>';
    //只存在字体样式
    $font_tags = '<i><b><u><s><em><strong><font><big><small><sup><sub><bdo><h1><h2><h3><h4><h5><h6>';
    //标题摘要基本格式
    $base_tags = $font_tags . '<p><br><hr><a><img><map><area><pre><code><q><blockquote><acronym><cite><ins><del><center><strike>';
    //兼容Form格式
    $form_tags = $base_tags . '<form><input><textarea><button><select><optgroup><option><label><fieldset><legend>';
    //内容等允许HTML的格式
    $html_tags = $base_tags . '<ul><ol><li><dl><dd><dt><table><caption><td><th><tr><thead><tbody><tfoot><col><colgroup><div><span><object><embed><param>';
    //专题等全HTML格式
    $all_tags = $form_tags . $html_tags . '<!DOCTYPE><meta><html><head><title><body><base><basefont><script><noscript><applet><object><param><style><frame><frameset><noframes><iframe>';
    //过滤标签
    $text = real_strip_tags($text, ${$type . '_tags'});
    // 过滤攻击代码
    if ($type != 'all') {
        // 过滤危险的属性，如：过滤on事件lang js
        while (preg_match('/(<[^><]+)(ondblclick|onclick|onload|onerror|unload|onmouseover|onmouseup|onmouseout|onmousedown|onkeydown|onkeypress|onkeyup|onblur|onchange|onfocus|action|background[^-]|codebase|dynsrc|lowsrc)([^><]*)/i', $text, $mat)) {
            $text = str_ireplace($mat[0], $mat[1] . $mat[3], $text);
        }
        while (preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i', $text, $mat)) {
            $text = str_ireplace($mat[0], $mat[1] . $mat[3], $text);
        }
    }
    return $text;
}

/**
 * 判断管理员是否登录
 * @return bool
 * @author:wdx(wdx@ourstu.com)
 */
function is_admin_login()
{
    $aid = get_aid();
    if ($aid) {
        return true;
    } else {
        return false;
    }
}

/**
 * 判断用户是否登录
 * @return bool
 * @author:wdx(wdx@ourstu.com)
 */
function is_user_login()
{
    $uid = get_uid();
    if ($uid) {
        return true;
    } else {
        return false;
    }
}

/**
 * 数据签名认证
 * @param $data
 * @return string
 * @author:wdx(wdx@ourstu.com)
 */
function data_auth_sign($data)
{
    //数据类型检测
    if (!is_array($data)) {
        $data = (array)$data;
    }
    ksort($data);                //排序
    $code = http_build_query($data);     //url编码并生成query字符串
    $sign = sha1($code);                 //生成签名
    return $sign;
}

/**
 * 获取全球唯一标识
 * @return string
 */
function uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

/**
 * 状态转换
 * @param array $arr        传入数组
 * @param string $field     字段名
 * @return array
 * @author:wdx(wdx@ourstu.com)
 */
function to_status(&$arr, $field = 'status')
{
    if (isset($arr[$field])) {
        $statusConfig = config('status_replace_str');
        $arr[$field] = $statusConfig[$arr[$field]];
    }
    return $arr;
}

/**
 * 显示转换
 * @param $arr
 * @param $field string
 * @return mixed
 * @author:wdx(wdx@ourstu.com)
 */
function to_is_show(&$arr, $field = 'is_show')
{
    if (isset($arr[$field])) {
        if ($arr[$field] == 1) {
            $arr[$field] = '显示';
        } else {
            $arr[$field] = '隐藏';
        }
    }
    return $arr;
}

/**
 * 是否转换
 * @param $arr
 * @param $field string
 * @return mixed
 * @author:wdx(wdx@ourstu.com)
 */
function to_yes_no(&$arr, $field = '')
{
    if (isset($arr[$field])) {
        if ($arr[$field] == 1) {
            $arr[$field] = '是';
        } else {
            $arr[$field] = '否';
        }
    }
    return $arr;
}

/**
 * 时间转换
 * @param array $arr        传入数组
 * @param string $field     字段名
 * @param string $format    格式
 * @return mixed
 * @author:wdx(wdx@ourstu.com)
 */
function to_time(&$arr, $field = 'time', $format = 'Y-m-d H:i:s')
{
    if (isset($arr[$field])) {
        $arr[$field] = date($format, $arr[$field]);
    }
    return $arr;
}

/**
 * ip转换
 * @param array $arr        传入数组
 * @param string $field     字段名
 * @return mixed
 * @author:wdx(wdx@ourstu.com)
 */
function to_ip(&$arr, $field = 'ip')
{
    if (isset($arr[$field])) {
        $arr[$field] = long2ip($arr[$field]);
    }
    return $arr;
}

/**
 * 将数组转化成树
 * @param $list
 * @param string $pk
 * @param string $pid
 * @param string $child
 * @param int $root
 * @return array
 * @author:wdx(wdx@ourstu.com)
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            if (empty($list[$key]['child'])) {
                $list[$key]['child'] = null;
            }
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];

                    if ($parent == null) {
                        $parent[$child][] = null;
                    } else {
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree 原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array $list 过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = '_child', $order = 'id', &$list = array())
{
    if (is_array($tree)) {
        $refer = array();
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if (isset($reffer[$child])) {
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby = 'asc');
    }
    return $list;
}

/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list, $field, $sortby = 'asc')
{
    if (is_array($list)) {
        $refer = $resultSet = array();
        foreach ($list as $i => $data)
            $refer[$i] = &$data[$field];
        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc': // 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ($refer as $key => $val)
            $resultSet[] = &$list[$key];
        return $resultSet;
    }
    return false;
}

function ret($data = null, $status = 'ok', $message = ''){
    $status === null and $status = 'ok';
    $re = [
        'status'  => $status,
        'message' => $message,
    ];
    $data !== null and $re['data'] = $data;

    return json_encode($re);
}

function requestUrl($url, $option, $header = 0, $type = 'POST') {
    //
    header('Content-Type:text/html;charset=utf-8');
    $curl = curl_init (); // 启动一个CURL会话
    $header = [
        'REMOTE-PORT:' . (isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : 0),
        //'Content-Type:multipart/form-data;charset=utf-8',
        'Content-Type:text/html;charset=utf-8',
        "Expect:"
    ];

    curl_setopt ( $curl, CURLOPT_URL, $url ); // 要访问的地址
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE ); // 对认证证书来源的检查
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE ); // 从证书中检查SSL加密算法是否存在
    curl_setopt ( $curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)' ); // 模拟用户使用的浏览器

    if( !empty($option) ){
        //var_dump(urlencode(http_build_query($option)));
        curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query($option));//urlencode(http_build_query($option))); // Post提交的数据包
    }

    curl_setopt ( $curl, CURLOPT_TIMEOUT, 60 ); // 设置超时限制防止死循环
    curl_setopt ( $curl, CURLOPT_HEADER, 0 ); // 设置HTTP头
    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回
    curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, $type );
    $result = curl_exec ( $curl ); // 执行操作
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if( $status != 200 ){

    }

    curl_close ( $curl ); // 关闭CURL会话
    return $result;
}
/**
 * CURL Post
 */
function sp_curl($url, $option, $header = 0, $type = 'POST') {
    //
    $curl = curl_init (); // 启动一个CURL会话

//    $header = [
//        'REMOTE-PORT:' . (isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : 0),
//        'Content-Type:multipart/form-data;charset=utf-8',
//        "Expect:"
//    ];

    curl_setopt ( $curl, CURLOPT_URL, $url ); // 要访问的地址
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE ); // 对认证证书来源的检查
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE ); // 从证书中检查SSL加密算法是否存在
    curl_setopt ( $curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)' ); // 模拟用户使用的浏览器

    $data = [];
    if( !empty($option) ){
        $data['nonce'] = keygen(32);
        $data['timestamp'] = time();
        $data['data'] = json_encode($option);
        $secret = md5('H3Fh9IgPyoWmSxvqAIHHHqIFR04GCxs'. 'pack_salt');
        $checkStr = $data['data'] . $data['nonce'] . $secret . $data['timestamp'];
        $data['sign'] = strtoupper(md5($checkStr));
        curl_setopt ( $curl, CURLOPT_POSTFIELDS, $option ); // Post提交的数据包
    }

    curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
    curl_setopt ( $curl, CURLOPT_HEADER, $header ); // 设置HTTP头
    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回
    curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, $type );
    $result = curl_exec ( $curl ); // 执行操作
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if( $status != 200 ){

    }

    curl_close ( $curl ); // 关闭CURL会话
    return $result;
}
//生成随机数  用户大后台请求
function keygen($length = 16)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++)
    {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }

    return $str;
}

function sp_params($params){
    ksort($params);
    $sp = [];
    foreach ($params as $k=>$v){
        if("@" != substr($v,0,1)){
            $sp[] = "$k=$v";
        }
    }
    return implode("&",$sp);
}

function getValue($array, $key, $default = null)
{
    if ($key instanceof \Closure) {
        return $key($array, $default);
    }

    if (is_array($key)) {
        $lastKey = array_pop($key);
        foreach ($key as $keyPart) {
            $array = getValue($array, $keyPart);
        }
        $key = $lastKey;
    }

    if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array)) ) {
        return $array[$key];
    }

    if (($pos = strrpos($key, '.')) !== false) {
        $array = getValue($array, substr($key, 0, $pos), $default);
        $key = substr($key, $pos + 1);
    }

    if (is_object($array)) {
        // this is expected to fail if the property does not exist, or __get() is not implemented
        // it is not reliably possible to check whether a property is accessable beforehand
        return $array->$key;
    } elseif (is_array($array)) {
        return (isset($array[$key]) || array_key_exists($key, $array)) ? $array[$key] : $default;
    } else {
        return $default;
    }
}

function mapHelper($array, $from, $to, $group = null,$config = false )
{
    $result = array();
    foreach ($array as $element) {
        $key = getValue($element, $from);
        $value = getValue($element, $to);
        if ($group !== null) {
            $result[getValue($element, $group)][$key] = $value;
        } else {
            $result[$key] = $value;
        }
        //参数配置
        if( $config ){
            config($key,$value);
        }

    }

    return $result;
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function get_client_ip($type = 0, $adv = false)
{
    $type      = $type ? 1 : 0;
    static $ip = null;
    if (null !== $ip) {
        return $ip[$type];
    }

    if ($adv) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) {
                unset($arr[$pos]);
            }

            $ip = trim($arr[0]);
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u", ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}
/**
 *
 */
function deep_in_array($value, $array) {
    foreach($array as $item) {
        if(!is_array($item)) {
            if ($item == $value) {
                return true;
            } else {
                continue;
            }
        }

        if(in_array($value, $item)) {
            return true;
        } else if(deep_in_array($value, $item)) {
            return true;
        }
    }
    return false;
}


function get_short_url($url_long,$source = ''){
    // 参数检查
    if( !$url_long ){
        return false;
    }

    if( empty($source) ){
        $source_setting = Config::getVal('WEIBO_APP_KEY');
        $source = $source_setting ? $source_setting : \think\facade\Env::get('WEIBO_APP_KEY');
    }

    $url_param = '&url_long=' . urlencode($url_long);//implode('', $url_param);
    // 新浪生成短链接接口
    $api = 'http://api.t.sina.com.cn/short_url/shorten.json';// 请求url
    $request_url = sprintf($api.'?source=%s%s', $source, $url_param);
    $result = array();    // 执行请求
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $request_url);
    $data = curl_exec($ch);
    if($error = curl_errno($ch)){
        return false;
    }
    curl_close($ch);
    $result = json_decode($data, true);
    if( isset($result[0]['url_short']) && $result[0]['url_short'] ){
        return $result[0]['url_short'];
    }
    return false;
}

//验证数据时间
function checkTime($time)
{
    $yesBegin = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
    $todayBegin = mktime(0,0,0,date('m'),date('d'),date('Y'));
    if(($time + 2020)/2019 != $yesBegin && ($time + 2020)/2019 != $todayBegin)
    {
        return false;
    }
    return true;
}

/**
 * 验证输入的邮件地址是否合法
 * @access  public
 * @param   string      $email      需要验证的邮件地址
 * @return bool
 */
function is_email($email)
{
    $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
    if (strpos($email, '@') !== false && strpos($email, '.') !== false)
    {
        if (preg_match($chars, $email))
        {
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

/**
 * 验证输入的手机号码是否合法
 * @access public
 * @param string $mobile_phone
 * 需要验证的手机号码
 * @return bool
 */
function is_mobile_phone($mobile_phone)
{
    $chars = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/";
    if(preg_match($chars, $mobile_phone))
    {
        return true;
    }
    return false;
}

//webservices 接口
function sync($path,$data)
{
    $dat = is_array( $data ) ? http_build_query($data) : $data;
    //return file_get_contents("http://221.231.109.86:81".$path."&".$data);
    $url = 'http://221.231.109.86:81/sync/Service.asmx';
    $client = new SoapClient($url.'?WSDL');
    $xml ='<?xml version="1.0" encoding="utf-8"?>
			<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
			  <soap:Body>
				<SyncData xmlns="http://lysoo.com/">
				  <path>'.$path.'</path>
				   <data><![CDATA['.$dat.']]></data>
				</SyncData>
			  </soap:Body>
			</soap:Envelope>';

    $xml =  $client->__doRequest($xml,$url,'http://lysoo.com/SyncData',1, 0) ;

    $st =stripos($xml,'<SyncDataResult>');
    $ed =stripos($xml,'</SyncDataResult>');

    $c=strlen ('<SyncDataResult>');

    if(stripos($xml,'<SyncDataResult />')>0)
    {
        return $xml;
    }
    //echo substr($xml,($st+$c),($ed-$st-$c));
    return html_entity_decode(substr($xml,($st+$c),($ed-$st-$c)));
}

//发送手机短信
function sendMobileMeg($mobile)
{

    $params = array ();

    // *** 需用户填写部分 ***
    // fixme 必填：是否启用https
    $security = false;

    // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
    $accessKeyId = config('config.smsConfig')['accessKeyId'];
    $accessKeySecret = config('config.smsConfig')['accessKeySecret'];

    // fixme 必填: 短信接收号码
    $params["PhoneNumbers"] = $mobile;

    // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
    $params["SignName"] = config('config.smsConfig')['sign'];

    // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
    $params["TemplateCode"] = config('config.smsConfig')['demoId'];

    //手机验证码发送
    $code = rand(111111, 999999);
    // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
    $params['TemplateParam'] = Array (
        "code" => $code,
    );

    // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
    if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
        $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
    }

    // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
    $helper = new SignatureHelper();

    // 此处可能会抛出异常，注意catch
    $content = $helper->request(
        $accessKeyId,
        $accessKeySecret,
        "dysmsapi.aliyuncs.com",
        array_merge($params, array(
            "RegionId" => "cn-hangzhou",
            "Action" => "SendSms",
            "Version" => "2017-05-25",
        )),
        $security
    );

    //发送成功
    if($content->Code == "OK")
    {
        //保存
        $smsLogs = new SmsLogs();
        $smsLogs->save([
            'mobile'=> $mobile,
            'code' => $code,
            'type' => 1,//1代表手机号码
            'time' => time(),
        ]);
        return true;
    }

    return false;
}

/*function sendMobileMeg($mobile)
{
    //手机验证码发送
    $code = rand(111111, 999999);
    $sms = new \app\index\controller\Smshttp();
    $userID = "0938586398";    //发送帳号
    $password = "uqgp";    //发送密码
    $subject = "短信验证";    //简讯主旨，主旨不會隨著简讯內容发送出去。用以註記本次发送之用途。可傳入空字串。
    $content = "您本次的验证码为" . $code . ',请及時操作。';   //简讯內容
    //$mobile = "+8618921154984";    //接收人之手机号码。格式为: +886912345678或09123456789。多筆接收人時，请以半形逗點隔开( , )，如0912345678,0922333444。
    $sendTime = "";        //简讯預定发送时间。-立即发送：请傳入空字串。-預約发送：请傳入預計发送时间，若傳送时间小於系统接單时间，將不予傳送。格式为YYYYMMDDhhmnss；例如:預約2009/01/31 15:30:00发送，則傳入20090131153000。若傳遞时间已逾現在之时间，將立即发送。
    if ($sms->sendSMS($userID, $password, $subject, $content, $mobile, $sendTime)) {
        //保存
        $smsLogs = new SmsLogs();
        $smsLogs->save([
            'mobile'=> $mobile,
            'code' => $code,
            'type' => 1,//1代表手机号码
            'time' => time(),
        ]);
        return true;
    }else{
        return false;
    }
}*/

function sendAdminMobileMeg($mobile)
{
    //手机验证码发送
    $code = rand(111111, 999999);
    $sms = new \app\index\controller\Smshttp();
    $userID = "0938586398";    //发送帳号
    $password = "uqgp";    //发送密码
    $subject = "短信验证";    //简讯主旨，主旨不會隨著简讯內容发送出去。用以註記本次发送之用途。可傳入空字串。
    $content = "您本次的验证码为" . $code . ',请及時操作。';   //简讯內容
    //$mobile = "+8618921154984";    //接收人之手机号码。格式为: +886912345678或09123456789。多筆接收人時，请以半形逗點隔开( , )，如0912345678,0922333444。
    $sendTime = "";        //简讯預定发送时间。-立即发送：请傳入空字串。-預約发送：请傳入預計发送时间，若傳送时间小於系统接單时间，將不予傳送。格式为YYYYMMDDhhmnss；例如:預約2009/01/31 15:30:00发送，則傳入20090131153000。若傳遞时间已逾現在之时间，將立即发送。
    if ($sms->sendSMS($userID, $password, $subject, $content, $mobile, $sendTime)) {
        //保存
        $smsLogs = new SmsLogs();
        $smsLogs->save([
            'mobile'=> $mobile,
            'code' => $code,
            'type' => 1,//1代表手机号码
            'is_show' => 0,//0代表不显示
            'time' => time(),
        ]);
        return true;
    }else{
        return false;
    }
}

//后台发送谷歌私钥
function sendAdminGoogelMeg($mobile,$serect)
{
    //手机验证码发送
    $sms = new \app\index\controller\Smshttp();
    $userID = "0938586398";    //发送帳号
    $password = "uqgp";    //发送密码
    $subject = "短信验证";    //简讯主旨，主旨不會隨著简讯內容发送出去。用以註記本次发送之用途。可傳入空字串。
    $content = "您本次的验证码为" . $serect . ',请及時操作。';   //简讯內容
    //$mobile = "+8618921154984";    //接收人之手机号码。格式为: +886912345678或09123456789。多筆接收人時，请以半形逗點隔开( , )，如0912345678,0922333444。
    $sendTime = "";        //简讯預定发送时间。-立即发送：请傳入空字串。-預約发送：请傳入預計发送时间，若傳送时间小於系统接單时间，將不予傳送。格式为YYYYMMDDhhmnss；例如:預約2009/01/31 15:30:00发送，則傳入20090131153000。若傳遞时间已逾現在之时间，將立即发送。
    if ($sms->sendSMS($userID, $password, $subject, $content, $mobile, $sendTime)) {
        return true;
    }else{
        return false;
    }
}

//后台发送消息提示
function sendAdminNoticeMeg($mobile,$title,$content)
{
    //手机验证码发送
    $sms = new \app\index\controller\Smshttp();
    $userID = "0938586398";    //发送帳号
    $password = "uqgp";    //发送密码
    $subject = $title;    //简讯主旨，主旨不會隨著简讯內容发送出去。用以註記本次发送之用途。可傳入空字串。
    //$mobile = "+8618921154984";    //接收人之手机号码。格式为: +886912345678或09123456789。多筆接收人時，请以半形逗點隔开( , )，如0912345678,0922333444。
    $sendTime = "";        //简讯預定发送时间。-立即发送：请傳入空字串。-預約发送：请傳入預計发送时间，若傳送时间小於系统接單时间，將不予傳送。格式为YYYYMMDDhhmnss；例如:預約2009/01/31 15:30:00发送，則傳入20090131153000。若傳遞时间已逾現在之时间，將立即发送。
    if ($sms->sendSMS($userID, $password, $subject, $content, $mobile, $sendTime)) {
        return true;
    }else{
        return false;
    }
}

/**
*验证台灣手机号码
*/
function twCod($id) {
    $id=strtoupper($id);
    $d1=substr($id,0,1);
    if(mb_strlen($id)!=10) {return FALSE;}
    if(!is_numeric(substr($id,1,9))) {return FALSE;}
    return TRUE;
}

//发送邮箱
function sendEmailMeg($email,$title,$content)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;

    $mail->Port = 587;
    $mail->Host = "smtp.office365.com";
    $mail->Username = "anttrade@anttrade.co";
    $mail->Password = "@Yoyo0907";
    $mail->From = "anttrade@anttrade.co";
    $mail->SMTPSecure = "tls";

    $mail->FromName = "ANTTRADE";
    $mail->CharSet = "utf-8";
    $mail->AddAddress ($email,$email);
    $mail->IsHTML( true);
    $mail->Subject = $title;
    $mail->Body = $content;
    $mail->AltBody = "text/html";
    if($mail->Send())
    {
        return true;
    }

    return false;

    /*$mail = new Message;
    $mail->setFrom('15251137102@163.com')
        ->addTo($email)
        ->setSubject($title)
        ->setBody($content);

    $mailer = new SmtpMailer([
        'host' => 'smtp.163.com',
        'username' => '15251137102@163.com',
        'password' => 'wangjun123',
        'secure' => 'ssl',
        'context' =>  [
            'ssl' => [
                'capath' => '/path/to/my/trusted/ca/folder',
            ],
        ],
    ]);

    $mailer->send($mail);
    */
}

//发送邮箱验证码
function sendEmailCode($email)
{
    $code = rand(111111, 999999);

    //保存
    $smsLogs = new SmsLogs();
    $smsLogs->save([
        'email'=> $email,
        'code' => $code,
        'type' => 2, //2代表邮件
        'time' => time(),
    ]);

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;

    $mail->Port = 587;
    $mail->Host = "smtp.office365.com";
    $mail->Username = "anttrade@anttrade.co";
    $mail->Password = "@Yoyo0907";
    $mail->From = "anttrade@anttrade.co";
    $mail->SMTPSecure = "tls";

    $mail->FromName = "ANTTRADE";
    $mail->CharSet = "utf-8";
    $mail->AddAddress ($email,$email);
    $mail->IsHTML( true);
    $mail->Subject = '【ANTTRADE】';
    $mail->Body = lang('you_code') . $code . lang('write_now');
    $mail->AltBody = "text/html";
    if($mail->Send())
    {
        return true;
    }

    return false;
}

//获取随机数
function tradenoa($len=12)
{
    return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $len);
}

//获取随机数,数字加字母
function tradenoah($len=12)
{
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789'), 0, $len);
}

function check_arr($rs)
{
    foreach ($rs as $v) {
        if (!$v) {
            return false;
        }
    }

    return true;
}

//可以加密
function encrypt($data, $key)
{
    $key = md5($key);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';
    $str = '';
    for ($i = 0; $i < $len; $i++)
    {
        if ($x == $l)
        {
            $x = 0;
        }
        $char .= $key{$x};
        $x++;
    }
    for ($i = 0; $i < $len; $i++)
    {
        $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
    }
    return base64_encode($str);
}

//可逆解密
function decrypt($data, $key)
{
    $key = md5($key);
    $x = 0;
    $data = base64_decode($data);
    $len = strlen($data);
    $l = strlen($key);
    $char = '';
    $str = '';
    for ($i = 0; $i < $len; $i++)
    {
        if ($x == $l)
        {
            $x = 0;
        }
        $char .= substr($key, $x, 1);
        $x++;
    }
    for ($i = 0; $i < $len; $i++)
    {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
        {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }
        else
        {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return $str;
}

function saveLoginInfo($userId,$device,$platform,$loginType,$ip,$clientVersion,$deviceName)
{
    //保存
    $UserLogin = new UserLogin();
    $UserLogin->save([
        'user_id'=> $userId,
        'device' => $device,
        'platform' => $platform,
        'login_type' => $loginType,
        'ip' => $ip,
        'client_version' => $clientVersion,
        'device_name' => $deviceName,
        'created_at' => time(),
    ]);
}

//验证用户信息
function checkUserInfo($userId,$userCode,$uuid)
{
    $reversibleKey = getenv('REVERSIBLE_KEY'); //可逆转key
    $userId = decrypt($userId,$reversibleKey); //用户id
    $userCode = decrypt($userCode,$reversibleKey); //随机验证码
    $where['id'] = (int)$userId;
    $where['check_code'] = $userCode;

    if($userUuid = User::where($where)->value('device_only'))
    {
        if($userUuid != '' && $uuid != '' && $userUuid != $uuid) //获取数据时唯一识别号不符则返回错误
        {
            return false;
        }
        return (int)$userId;
    }
    return false;
}

//随机生成字母
function getRandomString($len, $chars=null)
{
    if (is_null($chars)) {
        $chars = "0123456789abcdefghijklmnopqrstuvwxyz";
    }
    mt_srand(10000000 * (double)microtime());
    for ($i = 0, $str = '', $lc = strlen($chars) - 1; $i < $len; $i++) {
        $str .= $chars[mt_rand(0, $lc)];
    }
    return $str;

}


//验证身份证
function validateIdCard($value)
{
    if (!preg_match('/^\d{17}[0-9xX]$/', $value)) { //基本格式校验
        return false;
    }

    $parsed = date_parse(substr($value, 6, 8));
    if (!(isset($parsed['warning_count'])
        && $parsed['warning_count'] == 0)) { //年月日位校验
        return false;
    }

    $base = substr($value, 0, 17);

    $factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];

    $tokens = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];

    $checkSum = 0;
    for ($i=0; $i<17; $i++) {
        $checkSum += intval(substr($base, $i, 1)) * $factor[$i];
    }

    $mod = $checkSum % 11;
    $token = $tokens[$mod];

    $lastChar = strtoupper(substr($value, 17, 1));

    return ($lastChar === $token); //最后一位校验位校验
}

//获取id
function get_real_ip()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] AS $xip) {
            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                $ip = $xip;
                break;
            }
        }
    } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    }
    return $ip;
}

//模拟get请求
function requestGet($url = '')
{
    $postUrl = $url;
    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    $data = curl_exec($ch);//运行curl
    curl_close($ch);
    return $data;
}

//火币签名
function huobiSign($accessKey='',$secretKey='',$url='')
{
    //***HmacSHA256***
    $combination = '';
    //请求方法（GET 或 POST），后面添加换行符 “\n”
    $combination = $combination . 'GET\n';
    //添加小写的访问地址，后面添加换行符 “\n”
    $combination = $combination . 'api.huobi.pro\n';
    //访问方法的路径，后面添加换行符 “\n”
    $combination = $combination . '/v1/order/orders\n';
    //按照ASCII码的顺序对参数名进行排序。例如，下面是请求参数的原始顺序，进行过编码后,*****时间进行进行 URI 编码****
    $combination = $combination . '&AccessKeyId=' . $accessKey . '&SignatureMethod=HmacSHA256' . '&SignatureVersion=2' . '&Timestamp=' . urlencode(date('Y-m-d\Th:i:s', time())) . '&order-id=1234567890';

    //将上一步得到的请求字符串和 API 私钥作为两个参数，调用HmacSHA256哈希函数来获得哈希值。
    $sig = hash_hmac('sha256', $combination, $secretKey);
    //将此哈希值用base-64编码，得到的值作为此次接口调用的数字签名。
    $newSig = base64_encode($sig);

    //访问路径到服务器的 API 请求
    $toUrl = $url . 'order/orders?' . 'AccessKeyId=' . $accessKey . '&SignatureMethod=HmacSHA256' . '&SignatureVersion=2' . '&Timestamp=' . urlencode(date('Y-m-d\TH:i:s', time())) . '&order-id=1234567890&' . 'Signature=' . $newSig;
    return $toUrl;
}

/*十三位时间戳，包含毫秒1535423356248*/
function msectime()
{
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectime;
}

//用户消息通知添加
function addNotice($content='',$userId=0,$appleId=0)
{
    $userNotice = new UserNotice;
    $userNotice->description = $content;
    $userNotice->apple_id = $appleId;
    $userNotice->user_id = $userId;
    $userNotice->created_at = time();
    $userNotice->save();
    return true;
}

function object_to_array($obj)
{
    $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
    foreach ($_arr as $key => $val) {
        $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
        $arr[$key] = $val;
    }
    return $arr;
}

//检测是否是移动端
function isMobile(){
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
        return TRUE;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    //if (isset ($_SERVER['HTTP_VIA'])){
    //    return stristr($_SERVER['HTTP_VIA'], "wap") ? TRUE : FALSE;// 找不到为flase,否则为TRUE
    //}
    // 判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array ('mobile','nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
            return TRUE;
        }
    }
    if (isset ($_SERVER['HTTP_ACCEPT'])){ // 协议法，因为有可能不准确，放到最后判断
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))){
            return TRUE;
        }
    }
    return FALSE;
}
