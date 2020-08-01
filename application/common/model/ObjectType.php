<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6
 * Time: 10:12
 */

namespace app\common\model;


use think\Model;

class ObjectType extends Model
{
    const DS = 0;
    const ZC = 1;
    const WTG = 2;
    const SC = 3;
    const ZH = 4;

    const BM = 0;
    const NA = 1;

    const ZJ   = 1;
    const XB   = 2;
    const XJ   = 3;
    const CL   = 4;
    const SJ   = 5;
    const DN   = 6;
    const TS   = 7;
    const FS   = 8;
    const ZB   = 9;
    const QT   = 10;

    public static $type_config=[
        self::BM   => '寻物',
        self::NA   => '寻主',
    ];

    public static $status_config=[
        self::DS   => '待审',
        self::ZC   => '通过',
        self::WTG   => '不通过',
        self::SC   => '删除',
        self::ZH   => '已找回'
    ];
    public static $object_config=[
        self::ZJ   => '证件',
        self::XB   => '箱包',
        self::XJ   => '现金',
        self::CL   => '车辆',
        self::SJ   => '手机数码',
        self::DN   => '电脑电器',
        self::TS   => '图书音像',
        self::FS   => '服饰百货',
        self::ZB   => '钟表珠宝',
        self::QT   => '其他'
    ];

}