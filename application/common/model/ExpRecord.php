<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/15
 * Time: 10:06
 */

namespace app\common\model;


use app\common\event\PostEvent;
use app\common\json\PublicRe;
use think\Model;

class ExpRecord extends Model
{
    // 通用类型
    CONST TYPE_LOGIN = 1; //CONST EXP_ADD_MRDL = 'add_exp_item_MRDL';//每日登录
    CONST TYPE_SHARE = 2; //CONST EXP_ADD_FX = 'add_exp_item_FX';//分享   （帖子、本地圈、个人主页、Html5、话题）
    CONST TYPE_SIGN = 3;  // add_exp_item_ASSIGN 签到
    CONST TYPE_RESIGN = 4;  // add_exp_item_ASSIGN_BQ 补签
    CONST TYPE_TASK = 5;    // add_exp_item_TASK 完成挑战任务
    // 本地圈相关
    CONST TYPE_SIDE_POST = 11; //CONST EXP_ADD_FBBDQ = 'add_exp_item_FBBDQ';//发布本地圈
    CONST TYPE_SIDE_DELETE = 12; //CONST EXP_RDC_SCBDQ = 'rdc_exp_item_SCBDQ';//删除本地圈
    CONST TYPE_SIDE_REPLY = 13; //CONST EXP_ADD_HFBDQ = 'add_exp_item_HFBDQ';//回复本地圈
    CONST TYPE_SIDE_REPLY_DELETE = 14; //CONST EXP_RDC_SCHF = 'rdc_exp_item_SCHF';//删除本地圈回复
    CONST TYPE_SIDE_LIKE = 15; //CONST EXP_ADD_BDQDZ = 'add_exp_item_BDQDZ';//本地圈点赞
    CONST TYPE_SIDE_UNLIKE = 16; //CONST EXP_RDC_QXDZ = 'rdc_exp_item_QXDZ';//取消点赞
    CONST TYPE_SIDE_DELETE_BY_ADMIN = 17; // 被管理员删除本地圈
    CONST TYPE_SIDE_REPLY_DELETE_BY_ADMIN = 18; // 被管理员删除本地圈回复
    // 话题相关
    CONST TYPE_TOPIC_POST = 21; //CONST EXP_ADD_CJHT = 'add_exp_item_CJHT';//创建话题
    CONST TYPE_TOPIC_DELETE = 22; //CONST EXP_RDC_BSCHT = 'rdc_exp_item_BSCHT';//被删除话题
    // 论坛相关
    CONST TYPE_BBS_POST = 31; //CONST EXP_ADD_FT = 'add_exp_item_FT';//发帖
    CONST TYPE_BBS_LIKE = 32; //CONST EXP_ADD_SQDZ = 'add_exp_item_SQDZ';//社区点赞
    CONST TYPE_BBS_REPLY = 33; //CONST EXP_ADD_HT = 'add_exp_item_HT';//回帖
    // 分享类型
    CONST TYPE_SHARE_SIDE = 41;     // 分享本地圈
    CONST TYPE_SHARE_THREAD = 42;      // 分享论坛帖子
    CONST TYPE_SHARE_USER = 43;     // 分享个人主页
    CONST TYPE_SHARE_HTML5 = 44;    // 分享H5页面
    CONST TYPE_SHARE_TOPIC = 45;    // 分享话题

    //查看公告
    CONST TYPE_NOTICE_WATCH = 46; //查看公告

    // 增加经验的操作聚合
    public static $increase_types = [
        self::TYPE_LOGIN,
        self::TYPE_SHARE,
        self::TYPE_SIDE_POST,
        self::TYPE_SIDE_REPLY,
        self::TYPE_SIDE_LIKE,
        self::TYPE_TOPIC_POST,
        self::TYPE_BBS_POST,
        self::TYPE_BBS_LIKE,
        self::TYPE_BBS_REPLY,
        self::TYPE_SIGN,
        self::TYPE_RESIGN,
        self::TYPE_TASK,
        self::TYPE_SHARE_SIDE,
        self::TYPE_SHARE_THREAD,
        self::TYPE_SHARE_USER,
        self::TYPE_SHARE_HTML5,
        self::TYPE_SHARE_TOPIC,
        self::TYPE_NOTICE_WATCH,
    ];
    // 减少经验的操作聚合
    public static $reduce_types = [
        self::TYPE_SIDE_DELETE,
        self::TYPE_SIDE_REPLY_DELETE,
        self::TYPE_SIDE_UNLIKE,
        self::TYPE_TOPIC_DELETE,
        self::TYPE_SIDE_DELETE_BY_ADMIN,
        self::TYPE_SIDE_REPLY_DELETE_BY_ADMIN,
    ];
    // 分享类型聚合
    public static $share_types = [
        self::TYPE_SHARE,
        self::TYPE_SHARE_SIDE,
        self::TYPE_SHARE_THREAD,
        self::TYPE_SHARE_USER,
        self::TYPE_SHARE_HTML5,
        self::TYPE_SHARE_TOPIC,
    ];
    // 类型描述
    public static $types = [
        self::TYPE_LOGIN           => '每日登陆',
        self::TYPE_SHARE           => '分享',
        self::TYPE_SIGN            => '签到',
        self::TYPE_RESIGN          => '补签',
        self::TYPE_TASK            => '完成任务',
        self::TYPE_SIDE_POST       => '本地圈发帖',
        self::TYPE_SIDE_REPLY      => '本地圈回复',
        self::TYPE_SIDE_LIKE       => '本地圈点赞',
        self::TYPE_TOPIC_POST      => '创建话题',
        self::TYPE_BBS_POST        => '发表资讯',
        self::TYPE_BBS_LIKE        => '资讯点赞',
        self::TYPE_BBS_REPLY       => '资讯回复',
        self::TYPE_SIDE_DELETE     => '本地圈删除',
        self::TYPE_SIDE_REPLY_DELETE => '删除回复',
        self::TYPE_SIDE_UNLIKE     => '取消赞',
        self::TYPE_TOPIC_DELETE    => '删除话题',
        self::TYPE_SIDE_DELETE_BY_ADMIN    => '被管理员删除本地圈',
        self::TYPE_SIDE_REPLY_DELETE_BY_ADMIN    => '被管理员删除本地圈回复',
        self::TYPE_SHARE_SIDE       => '分享本地圈',
        self::TYPE_SHARE_THREAD     => '分享资讯',
        self::TYPE_SHARE_USER       => '分享个人主页',
        self::TYPE_SHARE_HTML5      => '分享H5页面',
        self::TYPE_SHARE_TOPIC      => '分享话题',
        self::TYPE_NOTICE_WATCH     => '查看公告',

    ];
    // 跟旧的对应关系
    public static $map = [
        'add_exp_item_MRDL' => self::TYPE_LOGIN,
        'add_exp_item_FX' => self::TYPE_SHARE,
        'add_exp_item_FBBDQ' => self::TYPE_SIDE_POST,
        'rdc_exp_item_SCBDQ' => self::TYPE_SIDE_DELETE,
        'add_exp_item_HFBDQ' => self::TYPE_SIDE_REPLY,
        'rdc_exp_item_SCHF' => self::TYPE_SIDE_REPLY_DELETE,
        'add_exp_item_BDQDZ' => self::TYPE_SIDE_LIKE,
        'rdc_exp_item_QXDZ' => self::TYPE_SIDE_UNLIKE,
        'add_exp_item_CJHT' => self::TYPE_TOPIC_POST,
        'rdc_exp_item_BSCHT' => self::TYPE_TOPIC_DELETE,
        'add_exp_item_FT' => self::TYPE_BBS_POST,
        'add_exp_item_SQDZ' => self::TYPE_BBS_LIKE,
        'add_exp_item_HT' => self::TYPE_BBS_REPLY,
        'add_exp_item_ASSIGN' => self::TYPE_SIGN,
        'add_exp_item_ASSIGN_BQ' => self::TYPE_RESIGN,
        'add_exp_item_TASK' => self::TYPE_TASK,
        'add_exp_item_CKGG' => self::TYPE_NOTICE_WATCH,
    ];

    /**
     * 创建新的经验记录
     * @param int $uid
     * @param int $exp
     * @param int $current_exp
     * @param int $type
     * @param int $relation_id
     * @return bool|mixed|static
     */
    public static function create($uid=0, $exp=0, $current_exp=0, $type=0, $relation_id=0)
    {
        $expRecord = new ExpRecord;
        $expRecord->uid = $uid;
        $expRecord->type = $type;
        $expRecord->exp = $exp;
        $expRecord->current_exp = $current_exp;
        $expRecord->relation_id = $relation_id;
        $expRecord->created_at = time();
        return $expRecord->save() ? true :false;
    }

    // 帖子点赞加经验
    public static function threadLike(PostEvent $event)
    {

        $uid            = isset($event->uid) ? $event->uid : 0;
        $relation_id    = isset($event->tid) ? $event->tid : 0;
        $rej = [];
        // 如果为0 那么就不需要做任何操作了
        $exp = Setting::getVal('add_exp_item_SQDZ');
        if( $exp == 0 ){
            $rej['hasaffair'] = 4;
            $rej['affair'] = [
                'title' => '资讯点赞',
                'desc'  => '已赞',
                'level' => -1,
                'exp'   => 0,
            ];
            PublicRe::$rej = PublicRe::rejPublic($rej);
            return false;
        }
        // 开始计算每日发布和删除的数量
        $sTime = strtotime(date('Y-m-d 00:00:00'));
        $eTime = strtotime(date('Y-m-d 00:00:00')) + 24 * 3600;
        $query = ExpRecord::where('uid','eq',$uid)
                    ->where('created_at','>=',$sTime)
                    ->where('created_at','<',$eTime);
        $count = $query->where('type','eq',ExpRecord::TYPE_BBS_LIKE)->count();
        // 每日上限（可获得经验）
        $limit = Setting::getVal('add_exp_item_SQDZ_DAY');
        $limit = $limit ? $limit : 10;   // 默认为10
        if($count >= $limit){    // 已经达到每日上限
            $rej['hasaffair'] = 4;
            $rej['affair'] = [
                'title' => '资讯点赞',
                'desc'  => '已赞',
                'level' => -1,
                'exp'   => 0,
            ];
            PublicRe::$rej = PublicRe::rejPublic($rej);
            return false;
        }
        // 保存经验 金币变化
        $result = UserExt::saveExp($uid, ExpRecord::TYPE_BBS_LIKE, $exp, $relation_id);
                  UserExt::saveGold($uid,$exp,CommonRecord::POST_LIKE,'portal_like',$relation_id);
                  //
        if($result===false){
            return false;
        }else{
            list($levelup, $level, $experience) = array_values($result);
            // 全局通知
            $rej['hasaffair'] = $levelup ? 2 : 4;
            $rej['affair']  = [
                'title' => '资讯点赞',
                'desc'  => $levelup ? ("恭喜,您已经升到{$level}级") : "已赞,经验值+{$exp},积分+{$exp}",
                'level' => $levelup ? $level : -1,
                'exp'   => $experience,
                'rank'  => $levelup ? User::where('experience','>',$experience)->count() + 1 : 0,
            ];
            PublicRe::$rej = PublicRe::rejPublic($rej);
            return true;
        }
    }

    // 帖子评论加经验
    public static function threadReply(PostEvent $event)
    {
        $uid            = isset($event->uid) ? $event->uid : 0;
        $relation_id    = isset($event->tid) ? $event->tid : 0;

        $rej = [];
        // 如果为0 那么就不需要做任何操作了
        $exp = Setting::getVal('add_exp_item_HT');
        if($exp==0){
            $rej['hasaffair'] = 4;
            $rej['affair'] = [
                'title' => '资讯回复',
                'desc'  => '已回复',
                'level' => -1,
                'exp'   => 0,
            ];
            PublicRe::$rej = PublicRe::rejPublic($rej);
            return false;
        }
        // 开始计算每日发布和删除的数量
        $sTime = strtotime(date('Y-m-d 00:00:00'));
        $eTime = strtotime(date('Y-m-d 00:00:00')) + 24 * 3600;
        $query = ExpRecord::where('uid','eq',$uid)
                    ->where('created_at','>=',$sTime)
                    ->where('created_at','<',$eTime);
        $count = $query->where('type','eq',ExpRecord::TYPE_BBS_REPLY)
                    ->count();
        // 每日上限（可获得经验）
        $limit = Setting::getVal('add_exp_item_HT_DAY');
        $limit = $limit ? $limit : 15;   // 默认为15
        if($count >= $limit){    // 已经达到每日上限
            $rej['hasaffair'] = 4;
            $rej['affair'] = [
                'title' => '资讯回复',
                'desc'  => '已回复',
                'level' => -1,
                'exp'   => 0,
            ];
            PublicRe::$rej = PublicRe::rejPublic($rej);
            return false;
        }
        // 保存经验变化
        $result = UserExt::saveExp($uid, ExpRecord::TYPE_BBS_REPLY, $exp, $relation_id);
                  UserExt::saveGold($uid,$exp,CommonRecord::POST_REPLY,'portal_reply',$relation_id);
        if($result===false){
            return false;
        }else{
            list($levelup, $level, $experience) = array_values($result);
            // 全局通知
            $rej['hasaffair'] = $levelup ? 2 : 4;
            $rej['affair']  = [
                'title' => '资讯回复',
                'desc'  => $levelup ? ("恭喜,您已经升到{$level}级") : "已回复,经验值+{$exp},积分+{$exp}",
                'level' => $levelup ? $level : -1,
                'exp'   => $experience,
                'rank'  => $levelup ? User::where('experience','>',$experience)->count() + 1 : 0,
            ];
            PublicRe::$rej = PublicRe::rejPublic($rej);
            return true;
        }

    }

    // 帖子发布加经验
    public static function threadPost(PostEvent $event)
    {
        $sender         = $event->sender;
        $uid            = isset($sender->id) ? $sender->id : 0;
        $relation_id    = isset($event->tid) ? $event->tid : 0;
        $rej = [];
        // 如果为0 那么就不需要做任何操作了
        $exp = Setting::get('add_exp_item_FT');
        if($exp==0){
            $rej['hasaffair'] = 4;
            $rej['affair'] = [
                'title' => '帖子创建',
                'desc'  => '已发布',
                'level' => -1,
                'exp'   => 0,
            ];
            PublicRe::$rej = PublicRe::rejPublic($rej);
            return false;
        }
        // 开始计算每日发布和删除的数量
        $sTime = strtotime(date('Y-m-d 00:00:00'));
        $eTime = strtotime(date('Y-m-d 00:00:00')) + 24 * 3600;
        $query = ExpRecord::find()->where(['uid'=>$uid])->andWhere(['>=','created_at',$sTime])->andWhere(['<','created_at',$eTime]);
        $count = $query->andWhere(['type'=>ExpRecord::TYPE_BBS_POST])->count();
        // 每日上限（可获得经验）
        $limit = Setting::get('add_exp_item_FT_DAY');
        $limit = $limit ? $limit : 5;
        if($count >= $limit){    // 已经达到每日上限
            $rej['hasaffair'] = 4;
            $rej['affair'] = [
                'title' => '帖子创建',
                'desc'  => '已发布',
                'level' => -1,
                'exp'   => 0,
            ];
            PublicRe::$rej = PublicRe::rejPublic($rej);
            return false;
        }
        // 保存经验变化
        $result = UserExt::saveExp($uid, ExpRecord::TYPE_BBS_POST, $exp, $relation_id);
        if($result===false){
            return false;
        }else{
            list($levelup, $level, $experience) = array_values($result);
            // 全局通知
            $rej['hasaffair'] = $levelup ? 2 : 4;
            $rej['affair']  = [
                'title' => '帖子创建',
                'desc'  => $levelup ? "恭喜,您已经升到{$level}级"  : "已发布,经验值+{$exp}",
                'level' => $levelup ? $level : -1,
                'exp'   => $experience,
                'rank'  => $levelup ? CommonUser::find()->where(['>','experience',$experience])->count() + 1 : 0,
            ];
            PublicRe::$rej = PublicRe::rejPublic($rej);
            return true;
        }

    }

}