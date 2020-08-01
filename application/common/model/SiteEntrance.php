<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/23
 * Time: 14:04
 */

namespace app\common\model;


use think\Model;

class SiteEntrance extends Model
{
    const SIGN_IN = 1;
    const URL = 2;
    const FORUM = 3;
    const THREAD = 4;
    const TOPIC = 5;
    const SIDE = 6;
    const POST_THREAD = 7;
    const POST_SIDE = 8;

    const OUT_URL = 9;
    const PARTY = 10;
    const INVITE_FRIEND = 11;
    const SHOP = 12;
    const GOLD = 13;
    const DAILY_HOT = 14;
    const CHALLENGE = 15;
    const RANK = 16;
    const FRIEND_RECOMMEND = 17;   //交友推荐页
    const FRIEND_MEET = 18;     //交友邂逅页面
    const ALL_FORUM = 19;
    const NAME_CARD = 21;   //改名卡

    const DEL_NO = 0;
    const DEL_YES = 1;


    //类型  1签到  2外链  3板块  4帖子  5话题  6本地圈  7快速发帖  8快速发圈子
    public static $types = [
        self::SIGN_IN     => '签到',
        self::URL         => '外链',
        self::FORUM       => '板块',
        self::THREAD      => '帖子',
        self::TOPIC       => '话题',
        self::SIDE        => '本地圈',
        self::POST_THREAD => '快速发帖',
        self::POST_SIDE   => '快速发本地圈',
        self::OUT_URL     => '跳转外部浏览器',
        self::PARTY       => '活动页',
        self::INVITE_FRIEND   => '邀请好友',
        self::SHOP        => '商城',
        self::GOLD		  => '金币中心',
        self::DAILY_HOT   => '今日头条',
        self::CHALLENGE   => '挑战任务',
        self::RANK		  => '排行榜',
        self::FRIEND_RECOMMEND => '交友推荐页',
        self::FRIEND_MEET => '交友邂逅页',
        self::ALL_FORUM	  => '全部版块',
        self::NAME_CARD	  => '改名卡',
    ];
    const STATU_NO = 0;
    const STATU_YES = 1;
    public static $status_config=[
        self::STATU_NO   => '关闭',
        self::STATU_YES   => '开启',
    ];

    const HOME_ENTRANCE = 1;//首页
    const COMMUNITY = 2;
    const BAR = 4;
    const LIFE = 8;
    const MISSING_OBJECT = 16;

    public static $position_config = [
        SiteEntrance::HOME_ENTRANCE     => '首页快捷入口（默认图标）',
        SiteEntrance::COMMUNITY         => '我的社区',
        SiteEntrance::BAR               => '平安加油站',
        SiteEntrance::LIFE              => '平安生活',
        SiteEntrance::MISSING_OBJECT    => '失物招领',
    ];
    //
    public static $setting_config = [
        self::HOME_ENTRANCE => 'HOME_ENTRANCE_SHOW',
        self::COMMUNITY => 'HOME_COMMUNITY_OPEN',
        self::BAR => 'HOME_SITE_BAR_SHOW',
        self::LIFE => 'HOME_LIFE_OPEN',
        self::MISSING_OBJECT => 'MISS_OBJECT'
    ];

}