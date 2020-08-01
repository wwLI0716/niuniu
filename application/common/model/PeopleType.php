<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6
 * Time: 10:12
 */

namespace app\common\model;


use think\Model;

class PeopleType extends Model
{
    const DS = 0;
    const ZC = 1;
    const WTG = 2;
    const SC = 3;
    const ZD = 4;
    const GQ = 5;
    const CX = 6;

    const BM = 0;
    const NA = 1;
    const NV = 2;

    const STATU_NO = 0;
    const STATU_YES = 1;
    public static $gender_config=[
        self::BM   => '保密',
        self::NA   => '男',
        self::NV   => '女',
    ];

    public static $status_config=[
        self::DS   => '待审',
        self::ZC   => '正常',
        self::WTG   => '未通过',
        self::SC   => '删除',
        self::ZD   => '找到',
        self::GQ   => '过期',
        self::CX   => '撤销',
    ];

}