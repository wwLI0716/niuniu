<?php
namespace app\common\model;

use app\common\component\RedisHelp;
use app\common\event\AssignEvent;
use app\common\event\Event;
use app\common\event\InviteEvent;
use app\common\event\LoginEvent;
use think\Model;

class User extends Model {

    const REAL_NO = 0;//未实人认证
    const REAL_FAIL = 1;//实人认证失败
    const REAL_REVIEW = 2;//实人认证审核中
    const REAL_SUCCESS = 3;//实人认证成功

    /**
     * 实人认证状态
     * @var array
     */
    public static $REAL = [
        self::REAL_NO => '未实人认证',
        self::REAL_FAIL => '实人认证失败',
        self::REAL_REVIEW => '实人认证审核中',
        self::REAL_SUCCESS => '实人认证成功'
    ];

    const ALERT_SZET = 1;//失踪儿童
    const ALERT_XWZ = 2;//新违章通知
    const ALERT_JZDQ = 3;//驾照到期
    const ALERT_JZQF = 4;//驾照清分
    const ALERT_SFZDQ = 5;//身份证到期


    const EVENT_INVITE = 'invite';//邀请用户
    const EVENT_ASSIGN = 'assign';//用户签到
    const EVENT_LOGIN_EVERYDAY = 'login everyday';


    const PROFILE_AVATAR = 1;
    const PROFILE_NICKNAME = 2;
    const PROFILE_GENDER = 4;
    const PROFILE_BIRTHDAY = 8;
    const PROFILE_REMARK = 16;

    /**
     * @var array
     */
    public static $profile = [
        self::PROFILE_AVATAR => '头像',
        self::PROFILE_NICKNAME => '昵称',
        self::PROFILE_GENDER => '性别',
        self::PROFILE_BIRTHDAY => '生日',
        self::PROFILE_REMARK => '签名'
    ];



    public static function init(){
        self::event(self::EVENT_INVITE,'taskInvite');
        self::event(self::EVENT_ASSIGN,'taskAssign');
        self::event(self::EVENT_LOGIN_EVERYDAY,'taskLogin');


        bind(self::EVENT_LOGIN_EVERYDAY,'\app');


    }

    //
    public function ext(){
        $this->hasOne('UserExt','user_id','id');
    }
    //
    public function status(){
        $this->hasOne('UserStatus','user_id','id');
    }
    //
    public function openim(){

    }

    /**
     * 每日登陆任务
     * @param Event $event
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function taskLogin(){
        $user_id = \app\api\model\User::current_id();
        /*查看用户是否领取了这条任务，任务是否有效*/
        $user_task = TaskUser::with("task")->where(['uid'=>$user_id,'status'=>TaskUser::STATUS_ONGOING,'task_type'=>TaskRecord::TYPE_LOGIN])->order('id desc')->find();

        if($user_task && !empty($user_task)){
            $todayStart = strtotime(date('Y-m-d 00:00:00'));
            $todayEnd = strtotime(date('Y-m-d 23:59:59'));

            /*如果任务过期，就把用户的任务状态改成已关闭*/
            $task = $user_task->task;
            /* @var $task Task */
            if($task->status != Task::STATUS_ONLINE || ($user_task->expired_at < $todayStart && $user_task->expired_at!=0)){
                $user_task->status = TaskUser::STATUS_EXPIRE;
                $user_task->save();
                return false;
            }
            /*查看今天登陆有没有记录*/
            $today_login_record = TaskRecord::where(['uid'=>$user_id,'target_type'=>TaskRecord::TYPE_LOGIN])
                ->where('created_at','>',$todayStart)
                ->where('created_at','<',$todayEnd)
                ->find();

            if($today_login_record){
                //已经登陆过了
                return false;
            }

            //没有登陆过的情况
            $model = new TaskRecord();
            $model->uid = $user_id;
            $model->task_user_id = $user_task->id;
            $model->target_type = TaskRecord::TYPE_LOGIN;
            $model->target_id = 0;
            $model->target_sub_id = 0;
            $model->created_at = time();
            $model->save();

            //获取当前连续登陆次数
            $query=TaskRecord::where(['uid'=>$user_id,'target_type'=>TaskRecord::TYPE_LOGIN])->where('created_at','>=',$user_task->created_at);
            if( $user_task->expired_at > 0 )
                $query->where("created_at","<=",$user_task->expired_at);
            $login_records=$query->field("created_at")->order("created_at asc")->select()->asArray();

            $max_num=0;
            $last_day=0;
            foreach($login_records as $r){
                $this_day=strtotime(date("Y-m-d",$r['created_at']));
                if($this_day - $last_day == 24*3600)
                    $max_num++;
                else
                    $max_num=1;
                $last_day=$this_day;
            }

            if($max_num <= $user_task->progress )
                return false;
            $progress_before=$user_task->progress;
            $user_task->progress=$max_num;
            $user_task->status = self::isComplete($user_task->task_id, $user_task->progress);
            $user_task->save();
            Task::IsNeedTongZhi($user_id,$user_task->task_id,$max_num,$progress_before);
        }
    }

    /**
     * 签到任务
     * @param Event $event
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function taskAssign(AssignEvent $event){
        $uid = \app\api\model\User::current_id();
        // 判断当前用户是否有打赏任务
        $task_user = TaskUser::where(['uid' => $uid, 'task_type' => Task::TYPE_SIGN, 'status' => TaskUser::STATUS_ONGOING])->order('id desc')->find();

        if(!$task_user)
            return false;

        $todayStart = strtotime(date('Y-m-d 00:00:00'));
        $todayEnd = strtotime(date('Y-m-d 23:59:59'));

        $today_assign_record = TaskRecord::where(['uid'=>$uid,'target_type'=>TaskRecord::TYPE_ASSIGN])->where('created_at','>',$todayStart)->where('created_at','<',$todayEnd)->find();
        if($today_assign_record)
            return false;

        $record = new TaskRecord();
        $record->uid = $uid;
        $record->task_user_id = $task_user->id;
        $record->target_type = TaskRecord::TYPE_ASSIGN;
        $record->target_id = 0;
        $record->target_sub_id = 0;
        $record->created_at = time();
        $record->save();

        //获取当前连续登陆次数
        $query=TaskRecord::where(['uid'=>$uid,'target_type'=>TaskRecord::TYPE_LOGIN])->where('created_at','>=',$task_user->created_at);
        if($task_user->expired_at > 0){
            $query->where("created_at","<=",$task_user->expired_at);
        }
        $records=$query->field("created_at")->order("created_at desc")->select()->toArray();

        $max_num=0;
        $last_day=0;
        foreach($records as $r){
            $this_day=strtotime(date("Y-m-d",$r['created_at']));
            if($last_day ==0 || $last_day - $this_day == 24*3600)
                $max_num++;
            else
                break;
            $last_day=$this_day;
        }

        if($max_num <= $task_user->progress )
            return false;
        $progress_before=$task_user->progress;
        $task_user->progress=$max_num;
        $task_user->status = self::isComplete($task_user->task_id, $task_user->progress);
        $task_user->save();
        Task::IsNeedTongZhi($uid,$task_user->task_id,$max_num,$progress_before);
        return true;
    }

    /**
     * 获取某个任务是否已经完成
     * @param int $task_id  任务id
     * @param int $progress 当前进度
     * @return bool
     */
    public static function isComplete($task_id=0, $progress=0){
        $complete = 0;
        $task = Task::getTask($task_id);
        if(!empty($task)){
            if($progress >= $task['conditions'])
                $complete  = 1;
        }
        return $complete;
    }

    /**
     * 邀请任务
     * @param InviteEvent $event
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function taskInvite(InviteEvent $event){

        $from_uid = $event->from_uid;
        $to_uid = $event->to_uid;
        // 判断当前用户是否有打赏任务
        $task_from_user = TaskUser::where(['uid' => $from_uid, 'task_type' => Task::TYPE_INVITE, 'status' => TaskUser::STATUS_ONGOING])->order('id desc')->find();
        /* @var $task_from_user TaskUser*/
        if(!$task_from_user)
            return false;
        $task = Task::get($task_from_user->task_id);
        //是否超过每日的任务上限
        $daily_limit = Task::getDailyLimit($task->id, $task_from_user->step);

        $count = TaskRecord::where(["task_user_id" => $task_from_user->id, "uid"=>$task_from_user->uid])
                ->where("created_at", ">",strtotime(date("Ymd")))
                ->count();
        if ($count > $daily_limit && $daily_limit > 0)
            return false;



        $record = new TaskRecord();
        $record->uid = $from_uid;
        $record->task_user_id = $task_from_user->id;
        $record->target_type = TaskRecord::TYPE_INVITE;
        $record->target_id = $to_uid;
        $record->target_sub_id = 0;
        $record->created_at = time();
        $record->save();

        //状态
        $task_from_user->progress += 1;
        $task_from_user->status = Task::isComplete($task_from_user->task_id, $task_from_user->progress);
        $task_from_user->save();
        Task::IsNeedTongZhi($from_uid,$task_from_user->task_id,$task_from_user->progress);
        return true;
    }

    /**
     * 金币总排名(现有积分)
     */
    public static function getTotalGoldRank($refresh = false){
        $key = 'TotalGoldRank';
        $rank_list = [];
        $gold_unselected = RedisHelp::getGoldUnselected();

        if(!cache($key) || $refresh){

            $rank_list = User::where('id','NOT IN',$gold_unselected)
                            ->order('gold_num DESC,reg_time ASC')
                            ->limit(30)
                            ->select()
                            ->toArray();

            cache($key,$rank_list,3600);
        }else{
            $rank_list = cache($key);
        }
        return $rank_list;
    }

    /**
     * 个人金币排名
     */
    public static function getUserGoldRank($uid,$refresh = false){

        $key = $uid.'GoldRank';

        if(!cache($key) || $refresh){
            $user_rank = 0;
            $gold_unselected = RedisHelp::getGoldUnselected();
            if($uid){
                $user = User::get( $uid )->toArray();
                $gold_num = floatval($user['gold_num']);
                $experience = $user['experience'];
                $createdat = $user['reg_time'];
                //
                if($user && !empty($user)){
                    $user_rank = User::where('gold_num','>',$gold_num)
                                    ->where('id','NOT IN',$gold_unselected)
                                    ->count();

                    //金币并列的用户数
                    $user_and_exp = User::where('gold_num',$gold_num)
                                        ->where('experience','>',$experience)
                                        ->where('id','NOT IN',$gold_unselected)
                                        ->count();

                    //
                    $user_and_created = User::where('gold_num',$gold_num)
                                        ->where('experience','=',$experience)
                                        ->where('reg_time','<',$createdat)
                                        ->where('id','NOT IN',$gold_unselected)
                                        ->count();
                    //
                    $user_rank = intval($user_rank) + intval($user_and_created) + intval($user_and_exp);
                    $user_rank = ($user_rank > 0)?($user_rank + 1 )  : 1;
                }
                cache($key,$user_rank,3600);
            }
        }else{
            $user_rank = cache($key);
        }
        return $user_rank;
    }

    /**
     * 等级总排名
     */
    public static function getTotalGradeRank($refresh = false){
        $key = 'TotalGradeRank';
        $rank_list = array();
        $grade_unselected = RedisHelp::getGradeUnselected();
        if(!cache($key) || $refresh){
            $grade = Grade::getAllGrades();
            $re = [];
            foreach($grade as $k=>$v){
                $re[$v['id']] = $v;
            }
            $grade = $re;
            $grade_list = User::where('gid','>',0)
                            ->where('id','NOT IN',$grade_unselected)
                            ->order('gid DESC,experience desc,reg_time asc')
                            ->limit(30)
                            ->select();
            cache($key,$grade_list,3600);
        }else{
            $grade_list = cache($key);
        }

        return $grade_list;
    }

    /**
     * 个人等级排名
     */
    public static function getUserGradeRank($uid,$gid="",$refresh = false){
        $key = $uid.'GradeRank';
        $user_rank = 0;
        $grade_unselected = RedisHelp::getGradeUnselected();
        if(!cache($key) || $refresh){
            if($uid){
                if(!$gid){
                    $user =User::get($uid);
                    $experience = $user['experience'];
                    $gid = $user['gid'];
                    $createdat = $user['reg_time'];
                }
                if(isset($gid) && $gid > 0){

                    $user_rank = User::where('gid','>',$gid)
                                    ->where('id','NOT IN',$grade_unselected)
                                    ->count();

                    //等级并列的用户数
                    $user_and_exp = User::where('gid',$gid)
                                        ->where('experience','>',$experience)
                                        ->where('id','NOT IN',$grade_unselected)
                                        ->count();

                    $user_and_created = User::where('gid',$gid)
                                            ->where('experience',$experience)
                                            ->where('reg_time','<',$createdat)
                                            ->where('id','NOT IN',$grade_unselected)
                                            ->count();

                    $user_rank = intval($user_rank) + intval($user_and_created) + intval($user_and_exp);
                    $user_rank = ($user_rank > 0) ? ($user_rank + 1) : 1;
                }
                cache($key,$user_rank,3600);
            }
        }else{
            $user_rank = cache($key);
        }
        return $user_rank;
    }

    /**
     * 打赏总排名，被打赏总排行，type：0被打赏，1打赏
     */
    public static function getTotalRewardRank($type,$refresh = false){

    }


    /**
     * 个人金币排名
     */
    public static function getUserRewardRank($uid,$type,$refresh = false)
    {

    }




}