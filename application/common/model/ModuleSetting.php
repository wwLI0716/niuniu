<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 17:06
 */

namespace app\common\model;


use think\Model;

class ModuleSetting extends Model
{
	const STATUS_NO = 0;
    const STATUS_YES = 1;
    public static $status_config=[
        self::STATUS_NO   => '隐藏',
        self::STATUS_YES   => '显示',
    ];

    const ZX      = 1;
    const HT       = 2;
    const WL = 3;
    const BK      = 4;
    const BDQ      = 5;
    const WLWB       = 6;
    const RM = 7;
    const SC      = 8;

    //
    public static $belong_type = [
        self::ZX => '资讯',
        self::HT => '话题',
        self::WL => '外链',
        self::BK => '板块',
        self::BDQ => '本地圈',
        self::WLWB => '外链外部浏览器',
        self::RM => '热门',
        self::SC => '商城首页'
    ];

    const INFO = 0;
    const AD   = 1;

    const CIRCLE = 0;
    const SQUARE = 1;


    /**
     * @return \think\model\relation\HasOne
     */
    public function type(){
        return $this->hasOne('ModuleType','id','type');
    }

}