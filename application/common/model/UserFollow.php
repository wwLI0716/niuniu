<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/21
 * Time: 13:20
 */

namespace app\common\model;


use think\Model;

class UserFollow extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

    const PAGE_SIZE = 20;
    const UN_FOLLOWED = 0;
    const FOLLOWED    = 1;
    const BLACK_LIST  = 2;

    //
    public function follower(){
        return $this->hasOne('User','id','follower_id');
    }

    public function user(){
        return $this->hasOne('User','id','user_id');
    }

}