<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6
 * Time: 10:12
 */

namespace app\common\model;


use think\Model;

class Report extends Model
{
    const FORUM = 1;//版块
    const SIDE  = 2;//盐警圈
    const MSG   = 3;//私信
    const POST = 4;//资讯
    const PRODUCT = 5;//产品反馈
    const USER = 6;//用户

    const THEME = 1;
    const REPLY = 2;

    const STATU_NO = 0;
    const STATU_YES = 1;
    public static $status_config=[
        self::STATU_NO   => '未处理',
        self::STATU_YES   => '已处理',
    ];

    public static $type_config=[
        self::FORUM   => '版块',
        self::SIDE   => '盐警圈',
        self::MSG   => '私信',
        self::POST   => '资讯',
        self::PRODUCT   => '产品反馈',
        self::USER   => '用户',
    ];

}