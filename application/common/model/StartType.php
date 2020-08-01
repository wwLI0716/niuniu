<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/23
 * Time: 14:04
 */

namespace app\common\model;


use think\Model;

class StartType extends Model
{
    const OFF = 0;
    const ON = 1;
    const DEL = 2;

    public static $status= [
        self::OFF     => '禁用',
        self::ON         => '开启',
        self::DEL       => '删除',
    ];
    const IMG = 0;
    const FLASH = 1;
    const VIDEO = 2;
    public static $attach_type=[
        self::IMG   => '图片',
        self::FLASH   => '动图',
        self::VIDEO   => '视频',
    ];

    const NEW = 1;
    const ARTICLE = 2;
    const URL = 3;
    const NONE = 4;
    public static $target_type=[
        self::NEW   => '资讯',
        self::ARTICLE   => '话题',
        self::URL   => '外链',
        self::NONE   => '无跳转',
    ];
}