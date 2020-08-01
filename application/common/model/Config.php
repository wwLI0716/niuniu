<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/24
 * Time: 9:06
 */

namespace app\common\model;


use think\Model;

class Config extends Model
{
    protected $table = COMMON . 'config';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    /**
     *
     * @param string $key
     */
    public static function getVal($key = ''){
        if(!$key){
            return '';
        }

        $key = strtolower($key);

        if( cache('LYS-YCG-COMMON-CONFIG') )
        {
            $cfg = cache('LYS-YCG-COMMON-CONFIG');
            if( !empty($cfg) && isset($cfg[$key]) )
            {
                return $cfg[$key];
            }
        }
        else
        {
            $configs = self::where(['status'=>1])->select();
            if( !empty($configs) )
            {
                $cfg = [];
                foreach( $configs as $config )
                {
                    $cfg[$config['name']] = $config['value'];
                }
                if( !empty($cfg) )
                {
                    cache('LYS-YCG-COMMON-CONFIG',$cfg);
                }
            }
        }
        if( !empty($cfg) && isset($cfg[$key]) )
        {
            return $cfg[$key];
        }

        return false;
    }

    /**
     * 获取系统设置的最大关注数
     */
    public static function getMaxFollowNumber(){
        return 500;
    }

}