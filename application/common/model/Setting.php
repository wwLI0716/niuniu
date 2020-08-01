<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/13
 * Time: 10:03
 */

namespace app\common\model;


use think\Model;

class Setting extends Model
{
    /**
     *
     */
    public static function whole(){
        $all = model('common/Setting')->field('key,value')->select();
        return mapHelper($all,'key','value');
    }

    /**
     * @param string $key
     * @return array|mixed|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getVal($key=''){
        $result = [];
        cache('_store_settings',null);
        if(!cache('_store_settings')){
            $result = self::whole();
            cache('_store_settings', $result, 1800);
        }else{
            $result = cache('_store_settings');
        }
        if($key==''){
            return $result;
        }else{
            if(isset($result[$key])){
                return $result[$key];
            }else{
                return '';
            }
        }
    }
}