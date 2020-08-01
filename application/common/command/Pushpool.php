<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 9:22
 * 用户信息过期消息推送
 */

namespace app\common\command;

use app\api\model\OpenimUser;
use app\api\model\PushPool as UserPushPool;
use app\api\model\User;
use app\admin\model\Config;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;

class Pushpool extends Command
{
    private $_new_peccancy_notice_open; #新违章通知配置
    private $_new_peccancy_notice_time;
    private $_new_peccancy_notice_content;
    private $_new_peccancy_notice_content_already;

    private $_license_expire_notice_open; #驾照到期通知配置
    private $_license_expire_notice_time;
    private $_license_expire_notice_content;
    private $_license_expire_notice_content_already;

    private $_license_clearing_notice_open;  #驾照清分通知配置
    private $_license_clearing_notice_time;
    private $_license_clearing_notice_content;
    private $_license_clearing_notice_content_already;

    private $_card_expire_notice_open;  #身份证到期通知配置
    private $_card_expire_notice_time;
    private $_card_expire_notice_content;
    private $_card_expire_notice_content_already;

    //加载配置
    public function beforeImplement()
    {
        $config = Config::where('name','like','%_notice_%')
            ->field('name,value')
            ->select();

        $nowConfig = array();
        foreach ($config as $k=>$v)
        {
            $nowConfig[$v['name']] = $v['value'];
        }
        $this->_new_peccancy_notice_open = $nowConfig['new_peccancy_notice_open']; #新违章通知配置
        $this->_new_peccancy_notice_time = $nowConfig['new_peccancy_notice_time'];
        $this->_new_peccancy_notice_content = $nowConfig['new_peccancy_notice_content'];
        $this->_new_peccancy_notice_content_already = $nowConfig['new_peccancy_notice_content_already'];
        $this->_license_expire_notice_open = $nowConfig['license_expire_notice_open']; #驾照到期通知配置
        $this->_license_expire_notice_time = $nowConfig['license_expire_notice_time'];
        $this->_license_expire_notice_content = $nowConfig['license_expire_notice_content'];
        $this->_license_expire_notice_content_already = $nowConfig['license_expire_notice_content_already'];
        $this->_license_clearing_notice_open = $nowConfig['license_clearing_notice_open']; #驾照清分通知配置
        $this->_license_clearing_notice_time = $nowConfig['license_clearing_notice_time'];
        $this->_license_clearing_notice_content = $nowConfig['license_clearing_notice_content'];
        $this->_license_clearing_notice_content_already = $nowConfig['license_clearing_notice_content_already'];
        $this->_card_expire_notice_open = $nowConfig['card_expire_notice_open']; #身份证到期通知配置
        $this->_card_expire_notice_time = $nowConfig['card_expire_notice_time'];
        $this->_card_expire_notice_content = $nowConfig['card_expire_notice_content'];
        $this->_card_expire_notice_content_already = $nowConfig['card_expire_notice_content_already'];
    }

    public function configure()
    {
        $this->setName('pushpool')
            ->setDescription('push pool');
    }

    //循环推送消息
    protected function execute(Input $input, Output $output)
    {
        $this->beforeImplement();
        $pushPoolData = UserPushPool::where(['push_status'=>0])
                                    ->limit(50)
                                    ->order('overdue_at asc')
                                    ->select();

        if(count($pushPoolData) > 0)
        {
            $items = [
                User::ALERT_SZET =>['key'=>'ALERT_SZET','name'=>'失踪儿童通知'],
                User::ALERT_XWZ =>['key'=>'ALERT_XWZ','name'=>'新违章通知'],
                User::ALERT_JZDQ =>['key'=>'ALERT_JZDQ','name'=>'驾照到期通知'],
                User::ALERT_JZQF =>['key'=>'ALERT_JZQF','name'=>'驾照清分通知'],
                User::ALERT_SFZDQ=>['key'=>'ALERT_SFZDQ','name'=>'身份证到期通知']
            ];

            foreach ($pushPoolData as $k => $v)
            {
                $data = []; //redis缓存读取用户端接收设置
                foreach($items as $ki=>$vi)
                {
                    $ret = redis()->HGet('user_alert_ignore_' .$v['push_id'],$vi['key']);
                    $item_is_ignore =  isset($ret) && $ret? true:false;
                    $data[] = ['item'=>$ki,'item_name'=>$vi['name'],'ignore_notice'=>$item_is_ignore];
                }
                if(isset($data))
                {
                    $nowData = array();
                    foreach ($data as $ka=>$va)
                    {
                        $nowData[$va['item']] = $va['ignore_notice'];
                    }
                }

                if($v['push_type'] == 2) //新违章通知
                {
                    if((isset($nowData) && $nowData[$v['push_type']] == true) || $this->_new_peccancy_notice_open == 0) //后台关闭或用户端关闭
                    {
                        $this->setStatus($v['id'],2);
                        continue;
                    }

                    $showContent = $this->_new_peccancy_notice_content;

                    if($v['is_already'] == 1) //已过期
                    {
                        $showContent = $this->_new_peccancy_notice_content_already;
                    }
                }
                if($v['push_type'] == 3) //驾照到期
                {
                    if((isset($nowData) && $nowData[$v['push_type']] == true) || $this->_license_expire_notice_open == 0) //后台关闭或用户端关闭
                    {
                        $this->setStatus($v['id'],2);
                        continue;
                    }

                    $showContent = $this->_license_expire_notice_content;

                    if($v['is_already'] == 1) //已过期
                    {
                        $showContent = $this->_license_expire_notice_content_already;
                    }
                }
                if($v['push_type'] == 4) //驾照清分
                {
                    if((isset($nowData) && $nowData[$v['push_type']] == true) || $this->_license_clearing_notice_open == 0) //后台关闭或用户端关闭
                    {
                        $this->setStatus($v['id'],2);
                        continue;
                    }

                    $showContent = $this->_license_clearing_notice_content;

                    if($v['is_already'] == 1) //已过期
                    {
                        $showContent = $this->_license_clearing_notice_content_already;
                    }
                }
                if($v['push_type'] == 5) //身份证到期通知
                {
                    if((isset($nowData) && $nowData[$v['push_type']] == true) || $this->_card_expire_notice_open == 0) //后台关闭或用户端关闭
                    {
                        $this->setStatus($v['id'],2);
                        continue;
                    }

                    $showContent = $this->_card_expire_notice_content;

                    if($v['is_already'] == 1) //已过期
                    {
                        $showContent = $this->_card_expire_notice_content_already;
                    }
                }
                $result = OpenimUser::sendMicroMessage('ywcustomcute_police',$v['push_id'],$showContent,[]);
                if($result)
                {
                    $this->setStatus($v['id'],1);
                    continue;
                }
                $this->setStatus($v['id'],3);
            }
        }
    }

    //状态设置
    public function setStatus($id,$status)
    {
        $userPushPool = UserPushPool::get($id);
        $userPushPool->push_at = time();
        $userPushPool->push_status = $status;
        $userPushPool->save();
    }

}