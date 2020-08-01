<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 9:22
 * 用户信息过期消息推送
 */

namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\admin\model\CommunityInformation;
use app\admin\model\Umeng;
use app\admin\model\UmengLog;
use app\api\model\OpenimUser;

class Communitypush extends Command
{
    //加载配置
    public function beforeImplement()
    {

    }

    public function configure()
    {
        $this->setName('communitypush')
            ->setDescription('community push');
    }

    //循环推送消息
    protected function execute(Input $input, Output $output)
    {
        $communityInformation = new CommunityInformation();
        $information = $communityInformation
            ->where(['status' => 0])
            ->order('created_at desc')
            ->field('id,title,content,receiver,created_at,updated_at,send_type,community_id,notice_id')
            ->find();

        if($information)
        {
            if($information['send_type'] == 0) //全体人员
            {
                $um = new Umeng();
                $um->target_type = 50; //跳转H5页面
                $um->target_value = 'http://zjw.lysoo.com/Wap/Community/noticeDetail?id='.$information['notice_id'];
                $um->title = '找警网社区通告';
                $um->content = $information['title'];
                $um->text_android = $information['title'];
                $um->text_ios = $information['title'];
                $um->push_type = 0;
                $um->push_at = 0 ? strtotime( 0 ) : time();
                $um->created_at = time();
                $pk = $um->save() ? $um->id : 0;

                if( $pk ){
                    $uml = new UmengLog();
                    $uml->pid = $pk;
                    $uml->device_type = 'ios';
                    $uml->groupid = 0;
                    $uml->save();

                    $android = new UmengLog();
                    $android->pid = $pk;
                    $android->device_type = 'android';
                    $android->groupid = 0;
                    $android->save();

                    $rootPath = ROOT_PATH;
                    $result = shell_exec("nohup /www/server/php/72/bin/php $rootPath/think push $pk > $rootPath/data/runtime/umeng.log 2>&1 &");
                    $communityInformation->where(['id'=>$information['id']])->update(['status'=>1,'send_at'=>time()]);
                }
            }

            if($information['send_type'] == 1 || $information['send_type'] == 2 || $information['send_type'] == 3) //个人,标签,社区
            {
                $information['receiver'] = explode(',',$information['receiver']);
                $information['receiver'] = json_encode($information['receiver']);
                $content = $information['title'] . ' 点击查看: ' . 'http://zjw.lysoo.com/Wap/Community/noticeDetail?id='.$information['notice_id'];
                $result = OpenimUser::sendMicroMessage('ywcustomcute_police',15068,$content,[]);
                $communityInformation->where(['id'=>$information['id']])->update(['status'=>1,'send_at'=>time()]);
            }
        }
    }

}