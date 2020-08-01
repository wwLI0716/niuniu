<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/14
 * Time: 18:34
 */

namespace app\common\component;


use app\wap\model\Task;

class RedisHelp {

    CONST REDIS_PREFIX = 'STORE:TASK:';

    public static function saveGrade($uid,$change){
        redis()->rpush('LC.Gold.UID_{' . $uid . '}:GRADE',$change);
    }

    public static function saveExp($uid,$change){
        redis()->rpush('LC.Gold.UID_{' . $uid . '}:EXP',$change);
    }

    public static function saveGold($uid,$change){
        redis()->rpush('LC.Gold.UID_{' . $uid . '}:GOLD',$change);
    }

    /**
     * 根据id获取任务
     * @param int $task_id 任务id
     * @return array
     */
    public static function getTask($task_id = 0){
        if(!redis()->exists(self::REDIS_PREFIX.$task_id)){
            $task = Task::get($task_id);//Task::model()->findByPk($task_id);
            if($task){
                //如果是阶段任务
                if($task->group == Task::GROUP_PHASE){
                    //获取阶段任务的主任务
                    $main_task = $task->parent_id == 0 ? $task : Task::get($task->parent_id);
                    $data = model('wap/Task')->where(['id' => $main_task->id])->find();
                    //把所有子任务都存redis
                    $sub_tasks = Task::where(['parent_id' => $main_task->id])
                        ->where(['status' => Task::STATUS_ONLINE])
                        ->order('conditions ASC')
                        ->select();//DbHelper::createFindCommand(Task::model()->tableName(),$model)->queryAll();
                    $steps_list = [];
                    $sub_id_list = [];
                    $condition = 0;
                    if($sub_tasks && !empty($sub_tasks)){
                        foreach($sub_tasks as $k=>$v){
                            $steps_list[] = $v['conditions'];
                            $sub_id_list[] = $v['id'];
                            $condition = $v['conditions'];
                            $v['step'] = $k+1;
                            redis()->hmset(self::REDIS_PREFIX.$v['id'], $v);
                        }
                    }
                    $data['steps'] = implode(',',$steps_list);
                    $data['sub_id'] = implode(',',$sub_id_list);
                    $data['conditions'] = $condition;   // 阶段总任务条件 = 最后一阶段的条件
                    redis()->hmset(self::REDIS_PREFIX.$main_task->id, $data);
                }else{
                    redis()->hmset(self::REDIS_PREFIX.$task_id,model('wap/Task')->where(['id' => $task->id])->find());
                }
            }
        }

        $task_list = redis()->hgetall(self::REDIS_PREFIX.$task_id);
        return $task_list;
    }


    /**
     * 根据任务id和阶段获取阶段子任务详情，非阶段任务返回空数组
     * @param int $task_id  主任务id
     * @param int $step 阶段
     * @return array
     */
    public static function getSubTask($task_id=0,$step=1){
        $sub_task = [];
        $main_task = self::getTask($task_id);
        if($main_task && !empty($main_task)){
            if($main_task['group']==Task::GROUP_PHASE){
                $sub_task = self::getSubTaskByStr($main_task['sub_id'], $step);
            }
        }
        return $sub_task;
    }

    /**
     * 根据子任务id聚合字符串和阶段获取子任务
     * @param string $sub_id_string 子任务id聚合字符串（例如：1,3,5,6,9）
     * @param int $step 当前阶段
     * @return array
     */
    public static function getSubTaskByStr($sub_id=0,$step=1){
        $sub_task = [];
        $sub_id_list = explode(',',$sub_id);
        if(isset($sub_id_list[$step-1])){
            $sub_task = self::getTask($sub_id_list[$step-1]);
        }
        return $sub_task;
    }

    /**
     * 根据阶段任务主任务id和进度获取当前处于第几阶段 非阶段任务返回0
     * @param int $task_id  主任务id
     * @param int $progress 进度
     * @return int
     */
    public static function getStep($task_id=0,$progress=0){
        $step = 0;
        $task = self::getTask($task_id);
        if(!empty($task)){
            if($task['group']==Task::GROUP_PHASE){
                $step = self::getStepByStr($task['steps'],$progress);
            }
        }
        return $step;
    }


    /**
     * 根据条件聚合字符串和进度获取当前处于第几阶段 非阶段任务返回0
     * @param string $conditions_string 条件聚合字符串 例如：10,100,500,1000
     * @param int $progress 当前进度
     * @return int
     */
    public static function getStepByStr($conditions_string='',$progress=0){
        $step = 1;
        $conditions = explode(',',$conditions_string);
        foreach($conditions as $v){
            if($progress>=$v){
                $step++;
            }else{
                break;
            }
        }
        $step = min($step,sizeof($conditions)); // 已经完成任务 阶段会超出
        return $step;
    }

    /**
     * 获取某个任务是否已经完成
     * @param int $task_id  任务id
     * @param int $progress 当前进度
     * @return bool
     */
    public static function isComplete($task_id=0, $progress=0){
        $complete = false;
        $task = self::getTask($task_id);
        if(!empty($task)){
            if($progress>=$task['conditions'])
                $complete  = true;
        }
        return $complete;
    }

    /**
     * 获取任务的每日限制
     * @param int $task_id  任务id，阶段任务需要主任务id
     * @param int $progress 当前进度
     * @return int
     */
    public static function getDailyLimit($task_id=0, $progress=0){
        $limit = 0;
        $task = self::getTask($task_id);
        if(!empty($task)){
            if($task['group']==Task::GROUP_PHASE) { // 阶段任务需要先获得阶段 再返回该阶段的每日上限
                $step = self::getStepByStr($task['steps'], $progress);
                $sub_task = self::getSubTaskByStr($task['sub_id'], $step);
                $limit = $sub_task['daily_limit'];
            }else{  // 非阶段任务 直接返回每日上限
                $limit = $task['daily_limit'];
            }
        }
        return $limit;
    }

    public static function TongZhi($uid,$name,$end_time=0,$step=0){
        if($step){
            $msg='恭喜，您已完成'.$name.'【阶段'.$step.'】的挑战任务，请';
            if(!empty($end_time))
                $msg.='在'.date('Y-m-d',$end_time).'之前';
            $msg.='到任务页面领取您的奖励哟！';
        }else{
            $msg='恭喜，您已完成'.$name.'的挑战任务，请';
            if(!empty($end_time))
                $msg.='在'.date('Y-m-d',$end_time).'之前';
            $msg.='到挑战列表领取您的奖励哟！';
        }
        //发送领取奖品的消息
//        $url = 'http://'. Yii::app()->params['default_domain'] .'/remotenote/message/system-more';
//        $secret = ApiHelper::getSecret();
//        $post_data = array(
//            'receiver'=>$uid,
//            'message'=>$msg,
//            'nonce' => ApiHelper::nonce(32),
//        );
//        $post_data['codeSign'] = ApiHelper::sign($post_data, $secret);
//        HttpHelper::post($url,$post_data);
        return true;
    }

    /*查找签到未上榜的用户列表*/
    public static function getAssignUnselected(){
        return redis()->smembers('LC.Gold.gold_assign_unselected');
    }


    /*查找金币未上榜的用户列表*/
    public static function getGoldUnselected(){
        return redis()->smembers('LC.Gold.gold_unselected');
    }

    /*查找等级未上榜的用户列表*/
    public static function getGradeUnselected(){
        return redis()->smembers('LC.Gold.grade_unselected');
    }

    /*查找被打赏的用户列表*/
    public static function getRewardUnselected(){
        return redis()->smembers('LC.Gold.reward_unselected');
    }
    /*查找打赏的用户列表*/
    public static function getHasrewardUnselected(){
        return redis()->smembers('LC.Gold.has_reward_unselected');
    }
}
