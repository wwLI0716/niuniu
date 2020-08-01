<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 17:15
 */

namespace app\index\model;


use think\facade\Env;

class SmsLogs extends \app\common\model\SmsLogs
{
    /**
     * 记录发送日志
     * @param $mobile
     * @param $content
     */
    public static function saveLog($mobile, $content)
    {
        $model = [];
        $model['mobile'] = $mobile;
        $model['content'] = $content;
        $model['created_at'] = time();
        //
        return model('api/SmsLogs')->data($model)->save();

    }

    /**
     * 上限检测
     * @param $mobile
     * @return bool
     */
    public static function checkDailyMax( $mobile )
    {
        $cfg = Env::get('sms.daily_limit');
        if( !empty($cfg) && $cfg )
        {

            $start = strtotime( date('Y-m-d 00:00:00') );
            $end = time();

            $num = model('api/SmsLogs')
                ->where(['mobile' => $mobile])
                ->where('created_at','between time',[$start , $end])
                ->count();

            if( $num >= $cfg )
            {
                return true;
            }
        }

        return false;
    }

    /**
     * 检测发送间隔
     * @param $mobile
     * @return bool
     */
    public static function checkInterval( $mobile )
    {
        $cfg = Env::get('sms.time_interval',300);

        if( !empty($cfg) && $cfg )
        {
            $lastSendTime = model('api/SmsLogs')
                ->where(['mobile' => $mobile])
                ->order('created_at desc')
                ->value('created_at');

            if( $lastSendTime && (time() - $lastSendTime < intval($cfg)) )
            {
                return true;
            }
        }

        return false;
    }
}