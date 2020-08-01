<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/30
 * Time: 15:21
 */

namespace app\common\event;


abstract class Event
{
    /******************事件类型******************/
    /**
     * 广告
     */
    const TYPE_AD = 1;
    /**
     * 帖子详情
     */
    const TYPE_THREAD = 2;
    /**
     * 本地圈详情
     */
    const TYPE_SIDE = 3;
    /**
     * 发现窗
     */
    const TYPE_DISCOVER = 4;

    /******************操作类型******************/
    /**
     * 浏览
     */
    const ACTION_VIEW = 1;
    /**
     * 点击
     */
    const ACTION_CLICK = 2;
    /**
     * 收藏
     */
    const ACTION_COLLECT = 3;
    /**
     * 取消收藏
     */
    const ACTION_COLLECT_CANCEL = 4;
    /**
     * 关注
     */
    const ACTION_FOLLOW = 5;
    /**
     * 取消关注
     */
    const ACTION_FOLLOW_CANCEL = 6;


}