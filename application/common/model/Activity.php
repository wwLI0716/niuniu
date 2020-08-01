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

class Activity extends Model
{

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'created_at';

    const HOME     = 1;
    const SLIDE    = 2;
    const ACTIVITY = 4;
    const DISCOVER = 8;
    const HOME_SLIDER = 16;
    const H5_SIGN = 32;
    const SIDE_LIST = 64;
    const THREAD_TOP = 128;//资讯详情页
    const THREAD_HOT = 256;//资讯本版热贴(无图)
    const MALL_SLIDER = 512;//商城轮播

    public static $position_config = [
        Activity::HOME     => '首页',
        Activity::SLIDE    => '盐警圈轮播',
        Activity::ACTIVITY => '活动',
        Activity::DISCOVER => '发现窗',
        Activity::HOME_SLIDER => '首页轮播',
        Activity::H5_SIGN => 'h5签到',
        Activity::SIDE_LIST => '盐警圈推荐列表',
        Activity::THREAD_TOP => '资讯详情关联阅读上方通栏',
        Activity::THREAD_HOT => '资讯详情关联阅读文字推荐',
        self::MALL_SLIDER => '积分商城轮播'
    ];

    const OFF      = 0;
    const ON       = 1;
    const NO_START = 2;
    const END      = 3;

    //
    public static $status_config = [
        self::OFF => '关闭',
        self::ON => '开启',
        self::NO_START => '尚未开始',
        self::END => '已结束'
    ];

    const IS_DELETED_NO = 0;   //是否删除  否
    const IS_DELETED_YES = 1;  //是否删除  是


    const TYPE_NEWS = 1;//资讯
    const TYPE_TOPIC = 2;//话题
    const TYPE_URL_INNER = 3;//外链 内部浏览器
    const TYPE_FORUM = 4;//版块
    const TYPE_SIDE = 5;//盐警圈
    const TYPE_URL_OUTER = 6;//外链 外部浏览器
    const TYPE_HOT = 7;//热门
    const TYPE_STORE = 8;//积分商城
    const TYPE_SCORE = 9;//积分中心

    public static $type_config = [
        self::TYPE_NEWS => '资讯',
        self::TYPE_TOPIC => '话题',
        self::TYPE_URL_INNER => '外链（内部浏览器）',
        self::TYPE_FORUM => '版块',
        self::TYPE_SIDE => '盐警圈',
        self::TYPE_URL_OUTER => '外链（外部浏览器）',
        self::TYPE_HOT => '热门',
        self::TYPE_STORE => '积分商城',
        self::TYPE_SCORE => '积分中心'
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

    const COFF      = 0;
    const CON       = 1;
    const CDEL = 2;

    //
    public static $category_config = [
        self::COFF => '关闭',
        self::CON => '开启',
        self::CDEL => '删除'
    ];

    const PZX      = 1;
    const PHT       = 2;
    const PWL = 3;
    const PBK      = 4;
    const PBDQ      = 5;
    const PWLWB       = 6;
    const PRM = 7;
    const PSC      = 8;

    public static $position_type = [
        self::PZX => '资讯',
        self::PHT => '话题',
        self::PWL => '外链',
        self::PBK => '板块',
        self::PBDQ => '本地圈',
        self::PWLWB => '外链外部浏览器',
        self::PRM => '热门',
        self::PSC => '商城首页'
    ];
}