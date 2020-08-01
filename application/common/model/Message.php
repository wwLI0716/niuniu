<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/27
 * Time: 15:11
 */

namespace app\common\model;


use think\Model;

class Message extends Model
{
    const PUSH_POST = 10;
    const PUSH_HOME = 20;
    const PUSH_SIDE = 30;
    const PUSH_TAG  = 40;
    const PUSH_H5   = 50;
    const PUSH_SIDE_MESSAGE = 60;

    const SIDE_LIKE  = 0;
    const SIDE_REPLY = 1;
    const POST_LIKE  = 2;
    const POST_REPLY = 3;
    const FOLLOW     = 4;
    const REWARD     = 5;//打赏 add by ge
    const COMMENT_LIKE = 7;//帖子评论


    const DELETE     = 1;
    const NO_DELETE  = 0;
    const PAGE_SIZE  = 20;

    const SIDE_AT    = 5;   //add by fox
    const READ_NO    = 0;   //未读
    const READ_YES   = 1;   //已读

    /**
     *
     */
    public function user(){
        return $this->hasOne('User','id','user_id');
    }

    //
    public function friend(){
        return $this->hasOne('User','id','friend_id');
    }






}