<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/21
 * Time: 13:59
 */

namespace app\common\event;

/**
 * 邀请助力事件
 * Class InviteEvent
 * @package app\common\event
 */
class InviteEvent extends Event
{
    public $from_uid ;  //邀请者的uid
    public $to_uid;     //被邀请者的uid
}