<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 19:13
 */

namespace app\common\component;


use app\common\tool\Tool;
use think\facade\Request;

class Wap
{
    //调试阶段IP数组
    protected static $debugIpList = [
        '127.0.0.1',
        'localhost',
        '::1',
        '192.168.31.106',
        '192.168.0.56',
        '192.168.0.20',
        '192.168.0.113'
    ];

    /**
     * 手机端组件
     */
    public static function getUser(){
        if ( (config('app.app_debug') || config('app.debug')) && in_array(Tool::getClientIp(), self::$debugIpList)) {
            return array(
                'site_id' => 1,
                'user_id' => 10000,
                'username' => 'ycga',
                'avatar' => '',
                'device' => md5('---'),
                'mobile'=>'0515110',
                'created_at' => 1449676800
            );
        }

        if (!isset($_COOKIE['third_app_token']) || empty($_COOKIE['third_app_token']) || $_COOKIE['third_app_token'] == 'null') {
            if (isset($_COOKIE['lysoo_deviceid']) && !empty($_COOKIE['lysoo_deviceid']))
                return array(
                    'site_id' => 0,
                    'user_id' => 0,
                    'username' => '',
                    'avatar' => '',
                    'device' => $_COOKIE['lysoo_deviceid'],
                    'created_at' => 0
                );
            else {
                $token =  Request::param('third_app_token');
                if (empty($token))
                    return array();
            }
        }
        else{
            $token = $_COOKIE['third_app_token'];
        }

    }
}