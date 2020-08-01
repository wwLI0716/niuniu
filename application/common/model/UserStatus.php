<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/29
 * Time: 16:20
 */

namespace app\common\model;


use think\Model;

class UserStatus extends Model
{

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

    //
    const PUSH_ID_EXPIRED = 1;//身份证到期提醒
    const PUSH_DL_EXPIRED = 2;//DL Driver License 驾驶证到期提醒
    const PUSH_DL_SCORED = 4;//驾驶证消分提醒
    const PUSH_CAR_EXPIRED = 8;//机动车到期年检



}