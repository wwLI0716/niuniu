<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/19
 * Time: 15:58
 */

namespace app\index\controller;

use app\index\model\User;
use think\facade\Config;
use app\index\model\UserCoin;
use app\index\model\UserNotice;

class Base extends Common
{

    protected $isLogin = false;     //登录状态
    protected $userId = '';
    protected $userEmail = '';
    protected $moble = '';
    protected $roleId = ''; //角色id
    protected $roleName = ''; //角色名称
    /**
     * 初始化
     */
    protected function initialize(){
        parent::initialize();
        //session(null);
        //登录验证
        if (!$this->isLogin()) {
            $this->redirect('index/Login/login');
        }

        //获取用户数据
        $username = User::where(['u.id'=>$this->userId])
                          ->alias('u')
                          ->join('user_role r','u.role_id = r.id')
                          ->field('u.username,u.status,u.check_email_c,u.level,u.email,u.invit_1,u.country,u.moble,r.role_id')->find();
        $this->userEmail = $username['email'];
        $this->moble = $username['moble'];
        $this->roleId = $username['role_id'];
        $this->roleName = \config("config.userRole")[$username['role_id']];

        //判读是否有未读消息
        $noticeStatus = 0;
        if(UserNotice::where(['user_id'=>$this->userId,'status'=>0])->find())
        {
            $noticeStatus = 1;
        }

        $this->assign([
            'username' => $username['username'],
            'userrole' => $this->roleName,
            'userStatus' => $username['status'],
            'checkText' => $username['check_email_c'],
            'noticeStatus' => $noticeStatus,
            'pos' => request()->controller(),
        ]);
    }

    /**
     * 检测是否登录
     * @return boolean
     */
    public function isLogin()
    {
        if ($this->isLogin) {
            return true;
        }

        $userLoginId = session('head_user_id');

        if (!$userLoginId) {
            return false;
        }

        if(time() > session('user_login_over_time'))
        {
            session(null);
            return false;
        }

        //验证是否有该用户及ip是否正确
        $reversibleKey = getenv('REVERSIBLE_KEY'); //可逆转key
        $userId = decrypt($userLoginId,$reversibleKey); //解密
        $userId = (explode(' ',$userId)[0] + 3) / 9;
        if(!isset($userId) || $userId < 1)
        {
            session(null);
            return false;
        }

        //验证ip
        /*$nowIp = get_real_ip();
        if(!isset($nowIp) || $nowIp == FALSE || $nowIp == '')
        {
            session(null);
            return false;
        }
        $userIp = User::where(['id'=>$userId])->value('ip');
        if($nowIp !== $userIp)
        {
            session(null);
            return false;
        }*/

        $this->userId = $userId;
        $this->isLogin = true;
        return true;
    }

}