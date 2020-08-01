<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/21
 * Time: 10:53
 */

namespace app\common\component;

require 'openim/TopSdk.php';

use think\facade\Env;

class Openim
{
    private $topClient;

    public function __construct()
    {
        //import('Org.Util.OpenIM.TopSdk');

        $this->topClient = new \TopClient();
        $this->topClient->appkey = Env::get('taobao.im_app_key');
        $this->topClient->secretKey = Env::get('taobao.im_app_secret');
        $this->topClient->format = 'json';

    }

    /**
     *  单个用户注册
     */
    public function openRegister($params = [])
    {

        $req = new \OpenimUsersAddRequest();

        $userinfos = new \Userinfos();
        //
        if (isset($params['nick']) && $params['nick']) {
            $userinfos->nick = $params['nick'];
        }
        //
        if (isset($params['icon_url']) && $params['icon_url']) {
            $userinfos->icon_url = $params['icon_url'];
        }
        //
        if (isset($params['mobile']) && $params['mobile']) {
            $userinfos->mobile = $params['mobile'];
        }
        //
        if (isset($params['userid']) && $params['userid']) {
            $userinfos->userid = $params['userid'];
        }

        if (isset($params['password']) && $params['password']) {
            $userinfos->password = $params['password'];
        }
        //
        if (isset($params['name']) && $params['name']) {
            $userinfos->name = $params['name'];
        }

        $req->setUserinfos(json_encode($userinfos));
        return $resp = $this->topClient->execute($req);
    }

    /**
     * 批量用户注册
     */
    public function accreditRegister($params = [])
    {

        $req = new \OpenimUsersAddRequest();

        $userinfo = [];
        $userinfos = new \Userinfos();

        foreach ($params as $key => $value) {
            //
            if (isset($value['nick']) && $value['nick']) {
                $userinfos->nick = $value['nick'];
            }
            //
            if (isset($value['icon_url']) && $value['icon_url']) {
                $userinfos->icon_url = $value['icon_url'];
            }
            //
            if (isset($value['mobile']) && $value['mobile']) {
                $userinfos->mobile = $value['mobile'];
            }
            //
            if (isset($value['userid']) && $value['userid']) {
                $userinfos->userid = $value['userid'];
            }

            if (isset($value['password']) && $value['password']) {
                $userinfos->password = $value['password'];
            }
            //
            if (isset($value['name']) && $value['name']) {
                $userinfos->name = $value['name'];
            }

            $userinfo[] = $userinfos;

        }

        $req->setUserinfos(json_encode($userinfo));
        return $resp = $this->topClient->execute($req);

    }


    /**
     * 获取指定用户的详情
     * 10001,10002,10003
     */
    public function usersDetail($userids)
    {
        $req = new \OpenimUsersGetRequest();
        $req->setUserids($userids);
        return $resp = $this->topClient->execute($req);
    }

    /**
     * 重置用户密码
     * @param $options ['username'] 用户名
     * @param $options ['password'] 密码
     * @param $options ['newpassword'] 新密码
     */
    public function usersUpdate($params = [])
    {
        //
        $req = new \OpenimUsersUpdateRequest();
        $userinfos = new \Userinfos();
        //
        if (isset($params['nick']) && $params['nick']) {
            $userinfos->nick = $params['nick'];
        }
        //
        if (isset($params['icon_url']) && $params['icon_url']) {
            $userinfos->icon_url = $params['icon_url'];
        }
        //
        if (isset($params['mobile']) && $params['mobile']) {
            $userinfos->mobile = $params['mobile'];
        }
        //
        if (isset($params['userid']) && $params['userid']) {
            $userinfos->userid = $params['userid'];
        }

        if (isset($params['password']) && $params['password']) {
            $userinfos->password = $params['password'];
        }
        //
        if (isset($params['name']) && $params['name']) {
            $userinfos->name = $params['name'];
        }
        //
        $req->setUserinfos(json_encode($userinfos));
        return $resp = $this->topClient->execute($req);
    }

    /**
     * @param $userids
     * 10002,10003,10004
     */
    public function usersDelete($userids)
    {
        $req = new \OpenimUsersDeleteRequest();
        $req->setUserids($userids);
        return $resp = $this->topClient->execute($req);
    }

    /**
     * @param
     */
    public function custMsgPush($params = [])
    {

        $req = new \OpenimCustmsgPushRequest();
        $custmsg = new \CustMsg();
        $custmsg->from_user = $params['from_user'];
        $custmsg->to_appkey = "0";
        $custmsg->to_users = $params['to_users'];
        $custmsg->summary = $params['summary'];
        $custmsg->data = $params['data'];
        //有这个参数IOS才会显示推送
        $custmsg->aps = json_encode(['alert' => $params['summary']]);
        //$custmsg->apns_param = json_encode([]);
        $custmsg->invisible = 0;
        $custmsg->from_nick = $params['from_nick'];
        $custmsg->from_taobao = "0";
        $req->setCustmsg(json_encode($custmsg));
        return $resp = $this->topClient->execute($req);

    }

    /**
     *
     */
    public function imMsgPush($params = [])
    {

        $req = new \OpenimImmsgPushRequest();
        $immsg = new \ImMsg();
        $immsg->from_user = $params['from_user'];
        $immsg->to_users = $params['to_users'];
        $immsg->msg_type = isset($params['msg_type']) ? $params['msg_type'] : "0";
        $immsg->context = $params['context'];
        $immsg->to_appkey = "0";

        if (isset($params['media_attr']) && $params['media_attr']) {
            $immsg->media_attr = $params['media_attr'];
        }
        $immsg->from_taobao = "0";

        $req->setImmsg(json_encode($immsg));
        return $resp = $this->topClient->execute($req);

    }

    public function relationsGet()
    {
    }

    public function chatLogsGet()
    {
    }

    public function appChatLogsGet()
    {
    }

    /**
     * 创建群
     */
    public function tribeCreate()
    {
    }

    public function tribeGetAllTribe()
    {
    }

    public function tribeGetTribeInfo()
    {
    }

    /**
     * 主动退出群
     */
    public function tribeQuit()
    {
    }

    /**
     * 主动加入群主
     */
    public function tribeJoin()
    {
    }

    /**
     * 提出群成员
     */
    public function tribeExpel()
    {

    }

    /**
     * 设置群管理员
     */
    public function tribeSetManager()
    {

    }

    /**
     * 解散群
     */
    public function tribeDismiss()
    {
    }

    public function tribeInvite()
    {
    }

    /**
     * 群成员获取
     */
    public function tribeGetMembers()
    {
    }

    /**
     * 取消管理员
     */
    public function tribeUnsetManager()
    {
    }

    /**
     * 修改群消息
     */
    public function tribeModifyTribeInfo()
    {
    }


}