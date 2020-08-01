<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9
 * Time: 15:13
 */
namespace app\common\command;

use app\admin\model\Umeng;
use app\admin\model\UmengLog;
use app\common\component\CJSON;
use app\common\component\UmengPush;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;

class Push extends Command
{
    public function configure()
    {
        $this->setName('push')
            ->addArgument('pid', Argument::OPTIONAL, "push id")
            ->setDescription('UMenG PUSH');
    }

    protected function execute(Input $input, Output $output)
    {
        $pid = trim($input->getArgument('pid'));
        $pid = $pid ? $pid : 0;
        //
        if( !config('param.push_android_key') or !config('param.push_android_secret') ){
            $output->writeln("友盟安卓配置错误\n" );
            return false;
        }

        //
        if( !config('param.push_ios_key') or !config('param.push_ios_secret') ){
            $output->writeln("友盟苹果配置错误\n" );
            return false;
        }

        $info = $pid ? Umeng::get($pid) : model('admin/Umeng')
            ->where(['status' => 0])
            ->where('push_at','<=',time())
            ->order('id DESC')
            ->find();

        if( !$info ){
            $output->writeln("不存在的任务ID[$pid]");
            return false;
        }

        $pid = $info->id;
        $data = [];
        switch ( $info->target_type ){
            case 10:
                $data = ['type' => 10, 'id' => $info->target_value];//跳转资讯详情
                break;
            case 20:
                $data = ['type' => 20];//跳转首页
                break;
            case 30:
                $data = ['type' => 30,'id' => $info->target_value];//跳转本地圈详情 预留
                break;
            case 40:
                $data = ['type'=> 40,'id' => $info->target_value,'tagname'=>'话题名称'];//话题 本地圈预留
                break;
            case 50:
                $data = ['type'=> 50,'id'=>$info->target_value];//跳转H5页面
                break;
            default:
                $data = [];
                break;
        }

        $logs = UmengLog::where('pid',$pid)->select();

        if( !$logs ){
            $output->writeln("不存在的任务记录[$pid]");
            return false;
        }

        //更新一下状态
        $info->status = 1;
        $info->save();

        $flag = -1;
        foreach($logs as $log){

            if($log->device_type == 'ios' ){
                $ios = new UmengPush(config('param.push_ios_key'),config('param.push_ios_secret'));
                //$result = $ios->sendIOSCustomizedFilecast($info->text_ios,$data,$log->groupid);
                $result = $ios->sendIOSBroadcast(['title' => $info->title,'subtitle' => '','body' => $info->text_ios],$data);
                $ios_data = CJSON::decode($result);
                $output->writeln($result);
                if( $ios_data['ret']=='SUCCESS' ){
                    $log->created_at = time();
                    $log->task_id = $ios_data['data']['task_id'];
                    $log->save();
                    $output->writeln("success[pid:$pid][ios][group:{$log->groupid}][{$log->task_id}]\n");
                }else{
                    $output->writeln("fail[pid:$pid][ios][group:{$log->groupid}]\t{$ios_data}\n");
                }
            }

            if($log->device_type == 'android'){
                $android = new UmengPush(config('param.push_android_key'),config('param.push_android_secret'));
                //$result = $android->sendAndroidCustomizedFilecast($info->title,$info->text_android,$data,$log->groupid);
                $result = $android->sendAndroidBroadcast($info->text_android,$data,$info->title);
                $android_data = CJSON::decode($result);
                if( $android_data['ret']=='SUCCESS' ){
                    $log->created_at = time();
                    $log->task_id = $android_data['data']['task_id'];
                    $log->save();
                    $output->writeln("success[pid:$pid][android][group:{$log->groupid}][{$log->task_id}]\n");
                }else{
                    $output->writeln("fail[pid:$pid][android][group:{$log->groupid}]\t$android_data\n");
                }
            }

            if($flag!=$log->groupid)
            {
                sleep(1);
            }
            else
            {
                $output->writeln("sleep 10 seconds\n");
                sleep(10);
            }

            $flag = $log->groupid;
        }

        $output->writeln("Hello," . $pid . '!' );
    }

}