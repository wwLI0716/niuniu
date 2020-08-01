<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 2018/12/4
 * Time: 10:44 PM
 */

namespace app\common\model;


use think\Model;

class SiteBar extends Model
{
    const OFF = 0;
    const ON  = 1;

    const DELETE_NO = 0;
    const DELETE_YES  = 1;

    const SIGN   = 1;
    const URL    = 2;
    const FORUM  = 3;
    const THREAD = 4;
    const TOPIC  = 5;
    const SIDE   = 6;
    const POST_THREAD   = 7;
    const POST_SIDE     = 8;

    CONST EVENT_BAR_CLICK = 'bar click';

}