<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 9:22
 */

namespace app\common\component;

use app\api\tool\Tool;
use think\facade\Env;
use app\admin\model\Config; //短信配置类

class Sms
{
    private $_client_id;
    private $_password;
    private $_template_id;
    private $_template_content;
    private $_interface_url;
    private $_limit_minute;

    public function __construct($identity = 1)
    {
        if( $identity == 1 ){// 找警网
            $config = Config::where('name','like','yzx_wz_%')
                            ->field('name,value')
                            ->select();
            $nowConfig = array();
            foreach ($config as $k=>$v)
            {
                $nowConfig[$v['name']] = $v['value'];
            }

            $this->_client_id = $nowConfig['yzx_wz_client_id'];
            $this->_password = $nowConfig['yzx_wz_password'];
            $this->_template_id = $nowConfig['yzx_wz_template_id'];
            $this->_template_content = $nowConfig['yzx_wz_template_content'];
            $this->_interface_url = $nowConfig['yzx_wz_template_url'];
            $this->_limit_minute = intval(Env::get('sms.time_interval')) / 60;
        }elseif( $identity == 2 ){//公安外网
            $config = Config::where('name','like','yzx_ww_%')
                ->field('name,value')
                ->select();
            $nowConfig = array();
            foreach ($config as $k=>$v)
            {
                $nowConfig[$v['name']] = $v['value'];
            }

            $this->_client_id = $nowConfig['yzx_ww_client_id'];
            $this->_password = $nowConfig['yzx_ww_password'];
            $this->_template_id = $nowConfig['yzx_ww_template_id'];
            $this->_template_content = $nowConfig['yzx_ww_template_content'];
            $this->_interface_url = $nowConfig['yzx_ww_template_url'];
            $this->_limit_minute = intval(Env::get('sms.time_interval')) / 60;

        }elseif( $identity == 3 ){//微警务
            $config = Config::where('name','like','yzx_wjw_%')
                ->field('name,value')
                ->select();
            $nowConfig = array();
            foreach ($config as $k=>$v)
            {
                $nowConfig[$v['name']] = $v['value'];
            }

            $this->_client_id = $nowConfig['yzx_wjw_client_id'];
            $this->_password = $nowConfig['yzx_wjw_password'];
            $this->_template_id = $nowConfig['yzx_wjw_template_id'];
            $this->_template_content = $nowConfig['yzx_wjw_template_content'];
            $this->_interface_url = $nowConfig['yzx_wjw_template_url'];
            $this->_limit_minute = intval(Env::get('sms.time_interval')) / 60;
        }elseif( $identity == 4 ){//临时乘机证明申请短信提示
            $config = Config::where('name','like','yzx_lscw_%')
                ->field('name,value')
                ->select();
            $nowConfig = array();
            foreach ($config as $k=>$v)
            {
                $nowConfig[$v['name']] = $v['value'];
            }

            $this->_client_id = $nowConfig['yzx_lscw_client_id'];
            $this->_password = $nowConfig['yzx_lscw_password'];
            $this->_template_id = $nowConfig['yzx_lscw_template_id'];
            $this->_template_content = $nowConfig['yzx_lscw_template_content'];
            $this->_interface_url = $nowConfig['yzx_lscw_template_url'];
            $this->_limit_minute = intval(Env::get('sms.time_interval')) / 60;
        }

    }

    /**
     * 封装发送方法
     * @param $tel
     * @param $content
     * @return mixed
     */
    public function sendTo($tel,$content){
        $url = str_replace('{0}',$this->_client_id,$this->_interface_url);
        $post_data['clientid'] =$this->_client_id;
        $post_data['password'] = md5($this->_password);
        $post_data['mobile'] = strval($tel);
        $post_data['content'] = str_replace(['{0}','{1}'],[$content,$this->_limit_minute],$this->_template_content);
        $post_data['smstype'] = "4";
        $post_data['extend'] = "";
        $post_data['uid'] = "";

        //
        $post = Tool::requestForSms($url,$post_data);
        $objVal = json_decode($post, true);
        //
        if ($objVal['data'][0]['code']=='0') {
            return true;
        } else {
            return "短信发送失败，错误码".$objVal['data'][0]['msg']."。";
        }

    }

    /**
     * 封装发送警员短信方法
     * @param $tel
     * @param $content
     * @return mixed
     */
    public function sendToPolice($tel,$sendUsername,$fromUsername){
        $url = str_replace('{0}',$this->_client_id,$this->_interface_url);
        $post_data['clientid'] =$this->_client_id;
        $post_data['password'] = md5($this->_password);
        $post_data['mobile'] = strval($tel);
        $post_data['content'] = str_replace(['{某}','{某某}'],[$sendUsername,$fromUsername],$this->_template_content);
        $post_data['smstype'] = "4";
        $post_data['extend'] = "";
        $post_data['uid'] = "";

        //
        $post = Tool::requestForSms($url,$post_data);
        $objVal = json_decode($post, true);
        //
        if ($objVal['data'][0]['code']=='0') {
            return true;
        } else {
            return "短信发送失败，错误码".$objVal['data'][0]['msg']."。";
        }

    }

}