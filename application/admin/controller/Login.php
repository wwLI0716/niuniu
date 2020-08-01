<?php
/**----------------------------------------------------------------------
 * OpenCenter V3
 * Copyright 2014-2018 http://www.ocenter.cn All rights reserved.
 * ----------------------------------------------------------------------
 * Author: wdx(wdx@ourstu.com)
 * Date: 2018/9/21
 * Time: 14:38
 * ----------------------------------------------------------------------
 */

namespace app\admin\controller;

use app\admin\model\AdminLog;
use app\common\model\Coin;
use Symfony\Component\Serializer\Tests\Fixtures\DummyMessageInterface;
use think\App;
use think\Controller;
use think\captcha\Captcha;
use think\Db;
use think\facade\Cache;
use AndreasGlaser\PPC\PPC;
use KuCoin\SDK\PublicApi\Symbol;
use KuCoin\SDK\Auth;
use KuCoin\SDK\PrivateApi\Account;
use KuCoin\SDK\PrivateApi\Order;
/*use KuCoin\SDK\Http\SwooleHttp;*/
use KuCoin\SDK\Exceptions\HttpException;
use KuCoin\SDK\Exceptions\BusinessException;


class Login extends Controller
{
    protected $admin;
    protected $adminAuthRule;
    protected $adminAuthGroup;
    protected $aid;
    protected $token;
    protected $commonConfig;

    public function initialize()
    {
        $this->admin = model('admin/Admin');
        $this->adminAuthRule = model('admin/AdminAuthRule');
        $this->adminAuthGroup = model('admin/AdminAuthGroup');
        $this->commonConfig = Db::name('common_config');
    }

    /**
     * 登录
     * @author:wdx(wdx@ourstu.com)
     */
    public function login()
    {
        if (is_admin_login()) {
            $this->aid = get_aid();
//            $this->error('请不要重复登录', url('admin/index/index'));
            return redirect('admin/index/index');
        }

        if ($this->request->isPost()) {
            $data = input('post.data/a', []);
            if (config('app.admin_login_captcha')) {
                $captcha = $data['vercode'];
//                print_r($captcha);exit;
                if(!captcha_check($captcha)){
                    // 验证失败
                    $this->error('验证码错误');
                };
            }

            //检测谷歌验证
            /*$ga = new PHPGangstaGoogleAuthenticator();
            $googleSerect = $this->commonConfig->where(['name'=>'googel_pw'])->value('value');
            //$oneCode = $ga->getCode($googleSerect);
            $checkResult = $ga->verifyCode($googleSerect, $data['google-password'], 2);
            if(!$checkResult)
            {
                $this->error('谷歌验证错误');
            }*/

            $username = trim($data['username']);
            $password = trim($data['password']);
            $remember = isset($data['remember']) ? 1 : 0;
            $adminInfo = $this->admin
                ->where('username', $username)
                ->find();
            if (!$adminInfo) {
                $this->error('用户名错误');
            }
            if ($adminInfo['status'] != 1) {
                $this->error('用户被禁用');
            }

            if (think_ucenter_md5($password) !== $adminInfo['password']) {
                $this->error('密码错误');
            }
            //登录成功
            $this->doLogin($adminInfo);
            //刷新自动登录的时效
            $this->keepLogin($remember);
            $this->success('登录成功，正在跳转', 'admin/index/index');
        } else {

            if ($this->autoLogin()) {
                return redirect('admin/index/index');
            }
            $captcha = config('app.admin_login_captcha');
            $this->assign('captcha', $captcha);

            return $this->fetch();
        }
    }

    /**
     * 执行登录
     * @param array $adminInfo
     * @return bool
     * @author:wdx(wdx@ourstu.com)
     */
    public function doLogin($adminInfo)
    {
        //拥有权限
        if ($adminInfo['id'] === 1) {
            $rules = '*';
        } else {
            $groupIds = explode(',', $adminInfo['group_id']);
            $groupRule = $this->adminAuthGroup
                ->whereIn('id', $groupIds)
                ->where('status', 1)
                ->column('rules');
            if (count($groupRule) >1) {
                $rules = '';
                foreach ($groupRule as $val) {
                    $rules .= ($val . ',');
                }
                $rules = explode(',', $rules);
                array_pop($rules);
                $rules = array_unique($rules);
            } else {
                $rules = $groupRule[0];
                $rules = explode(',', $rules);
            }
        }
        //当前权限组未被分配，则分配第一个权限组
        $group = explode(',', $adminInfo['group_id']);
        if (!in_array($adminInfo['current_group'], $group)) {
            $adminInfo['current_group'] = $group[0];
            $this->admin->where('id', $adminInfo['id'])->setField('current_group', $adminInfo['current_group']);
        }
        $auth = [
            'uid' => $adminInfo['id'],
            'username' => $adminInfo['username'],
            'last_login_time' => $adminInfo['last_login_time'],
            'role_id' => $adminInfo['group_id'],
            'current_role' => $adminInfo['current_group'],
            'rules' => $rules,
            'status' => $adminInfo['status'],
            'area_id' => $adminInfo['area_id'],
            'institution_id' => $adminInfo['institution_id'],
        ];
        session('admin_auth', $auth);
        session('admin_auth_sign', data_auth_sign($auth));
        $this->aid = get_aid();
        $this->token = uuid();
        //更新admin表信息
        $aid = $auth['uid'];
        $update = [
            'last_login_time' => time(),
            'last_login_ip' => ip2long($this->request->ip())
        ];
        $this->admin->where('id', $aid)->update($update);
        //管理日志
        AdminLog::setTitle('登录');
        return true;
    }

    public function getCode()
    {
        if (request()->isPost()) {
            //手机验证码发送
            $code = rand(111111, 999999);
            include 'smsapi.fun.php';
            $uid = 'bingcheng1a';
            $pwd = 'b73acd587a9b78ced559f2d9cd983ff5';
            $content = '【THR TOKEN】您的验证码是' . $code . '，请及时填写。';
            $content1 = urlencode(mb_convert_encoding($content, "gb2312", "UTF-8"));
            $phone = db('config')->where(['id'=>1])->value('canshu18');
            db('config')->where(['id'=>1])->update(['canshu19'=>$code]);
            sendSMS($uid, $pwd, $phone, $content1);
            return 'success';
        }
    }

    /**
     * 自动登录
     * @return bool
     * @author:wdx(wdx@ourstu.com)
     */
    public function autoLogin()
    {
        $keepLogin = cookie('keep_login');
        if (!$keepLogin) {
            return false;
        }
        list($aid, $expireTime, $key) = explode('|', $keepLogin);
        if ($aid && $expireTime && $key && $expireTime > time()) {
            $admin = $this->admin->where('id', $aid)->where('status', 1)->find()->toArray();
            if (!$admin) {
                return false;
            }
            $this->doLogin($admin);
            //刷新自动登录的时效
            $this->keepLogin(true);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 刷新保持登录的Cookie
     * @param $remember
     * @return bool
     * @author:wdx(wdx@ourstu.com)
     */
    protected function keepLogin($remember)
    {
        if ($remember) {
            $expireTime = time() + 3600;
            $key = md5(md5($this->aid) . md5($expireTime) . $this->token);
            $data = [$this->aid, $expireTime, $key];
            cookie('keep_login', implode('|', $data), 3600);
            return true;
        }
        return false;
    }

    /**
     * 注销
     * @author:wdx(wdx@ourstu.com)
     */
    public function logout()
    {
        session('admin_auth', null);
        session('admin_auth_sign', null);
        cookie('keep_login', null);
        AdminLog::setTitle('管理员退出登录');
        $this->success('成功退出', 'admin/login/login');
    }

    /**
     * 更换验证码
     * @author:wdx(wdx@ourstu.com)
     */
    public function updateCaptcha()
    {
        $captcha = new Captcha();
        return $captcha->entry();
    }
}