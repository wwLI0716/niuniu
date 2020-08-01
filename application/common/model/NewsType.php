<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/23
 * Time: 14:05
 */

namespace app\common\model;


use app\common\tool\Tool;
use think\Model;

class NewsType extends Model
{

    const OFF      = 0;
    const ON       = 1;

    //
    public static $status_config = [
        self::OFF => '未发布',
        self::ON => '已发布'
    ];




    const COFF      = 0;
    const CON       = 1;

    //
    public static $tag_config = [
        self::COFF => '关闭',
        self::CON => '开启'
    ];

    const RCOFF      = 0;
    const RCON       = 1;
    const RCONS       = 2;

    //
    public static $reply_config = [
        self::RCOFF => '待审',
        self::RCON => '通过',
        self::RCONS => '不通过'
    ];

}