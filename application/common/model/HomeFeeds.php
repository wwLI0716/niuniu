<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5
 * Time: 15:30
 */

namespace app\common\model;


use think\Model;

class HomeFeeds extends Model
{
    //首页信息流
    CONST PIC_WIDTH = 230;
    CONST PIC_HEIGHT = 175;

    CONST PAGE_SIZE = 10;
    CONST VIEWS_LIMIT = 1000;

    CONST IN_FEEDS = 1; // 在信息流中
    CONST IN_POOLS = 2; // 在备选池中

    /*
     * 信息流类型 target_type
     * home_feeds表中只包含
     * 1.帖子
     * 5.圈子 纯文本/带图片/小视频3种格式
     * 7.视频 暂不支持，后期计划
     */
    CONST TYPE_THREAD = 1;      // 论坛帖子
    CONST TYPE_SIDE = 5;        // 本地圈
    CONST TYPE_SIDE_TXT = 11;   // 本地圈 纯文本
    CONST TYPE_SIDE_IMG = 12;   // 本地圈 带图片
    CONST TYPE_SIDE_VDO = 13;   // 本地圈 小视频

    CONST TYPE_VIDEO = 8;       // 视频
    CONST TYPE_TOPIC = 2;       // 话题
    CONST TYPE_ACTIVITY = 3;    // 外链 （活动/广告在Activity表中 首页信息流不再支持）
//    CONST TYPE_FORUM = 4;       // 板块 （不再支持）
//    CONST TYPE_HOT = 6;         // 热门 （不再支持）

    CONST MODE_DEFAULT = 0;         // 默认模式 未指定显示模式 由客户端判读显示模式
    CONST MODE_SIMPLE = 1;          // 单图模式 单张小图(230*175)
    CONST MODE_MULTI = 4;           // 多图模式 三张小图(230*175)
    CONST MODE_VIDEO = 7;         // 视频模式
//    CONST MODE_BANNER_LARGER = 2;   // 广告模式 单张通栏大图(750*315)
//    CONST MODE_BANNER_SMALLER = 3;  // 广告模式 单张通栏小图(710*215)
    CONST MODE_TOPIC = 5;           // 话题模式 话题模式只对应话题类型
//    CONST MODE_ACTIVITY = 6;        // 活动模式


}