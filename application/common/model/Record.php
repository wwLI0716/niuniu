<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/21
 * Time: 17:52
 */

namespace app\common\model;


use think\Db;
use think\Model;

class Record extends Model
{
    /**
     * 得到对方APP版本号
     * @param $user_id
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getVer($user_id)
    {
        //
        $record = Db::name('record')
                    ->where(['user_id'=>$user_id])
                    ->order('created_at desc')
                    ->limit(1)
                    ->find();
        //
        if($record && isset($record['api_version']))
            return $record['api_version'];
        else
            return false;
    }
}