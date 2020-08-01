<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/23
 * Time: 15:02
 */

namespace app\admin\controller;


use app\admin\model\Config;
use think\Db;

class System extends Base
{
    /**
     * 系统后台设置
     * @param int $group
     */
    public function index( $group = 0 )
    {
        $this->title = '设置';

        $errors = array();
        $success = false;

        if ( $this->request->isPost() ) {

            // 清缓存
            cache('_store_settings',null);
            cache('settings',null);

            foreach($_POST['settings'] as $key=>$value){
                if ($key == 'assign_switches' || $key == 'assign_rule_desc' || $key == 'assign_rule_bq_desc') {
                }else {
                    if($value==''){
                        $errors[$key] = "必填项，不能为空";
                    }
                }
            }

            if(empty($errors)){
                foreach($_POST['settings'] as $key=>$value){
                    if (is_array($value)) {
                        $value = implode(',', $value);
                    }

                    /* @var $sql \think\string */
                    $sql = "update `ecshecom_setting` set `value`=:value where `key`=:key";
                    Db::execute( $sql ,['key'=>$key,'value'=>$value]);
                }
                $success = true;
                $this->success('设置成功');
            }
        }

        $settings = model('admin/Setting')->where(['group' => $group])->order('sort DESC')->select();
        $this->assign('settings',$settings);
        $this->assign('errors',$errors);
        $this->assign('success',$success);
        return $this->fetch();
    }

    public function setting(){
        if ($this->request->isPost()) {
            $data = input('data/a', []);
            $res = model('admin/Config')->saveConfig($data);
            if ($res) {
                //重置当前缓存
                $newData = array();
                foreach ($data as $k => $v){
                    $newData[] = $k;
                }
                $configs = model('admin/Config')->where(['status'=>1])
                                              ->where(['name'=>$newData])
                                              ->field('name,value')
                                              ->select();
                if( !empty($configs) )
                {
                    $cfg = [];
                    foreach( $configs as $config )
                    {
                        $cfg[$config['name']] = $config['value'];
                    }
                    if( !empty($cfg) )
                    {
                        cache('LYS-YCG-COMMON-CONFIG',$cfg);
                    }
                }
                $this->success('设置成功');
            } else {
                $this->error('设置失败');
            }
        } else {
            $config = model('admin/Config')->queryConfig();
            $this->assign('config', $config);
            return $this->fetch();
        }
    }

    public function getCode()
    {
        if (request()->isPost()) {
            //手机验证码发送
            if(sendAdminMobileMeg('0938586398'))
            {
                return 'success';
            }
            return 'error';
        }
    }

    //谷歌验证设置
    public function googlesetting(){
        if ($this->request->isPost()) {
            $data = input('data/a', []);
            $megWhere['mobile'] = '0938586398';
            $megWhere['code'] = $data['code'];
            $sendTime = Db::name('sms_logs')->where($megWhere)->order('time desc')->value('time');
            if(!$sendTime) //短信15分钟内有效
            {
                $this->error('验证码错误');
            }
            if($sendTime + 60*15 < time())
            {
                $this->apiReturn('200',lang('msg_overdue'),[]);
            }
            $ga = new PHPGangstaGoogleAuthenticator();
            $secret = $ga->createSecret();
            $data['googel_pw'] = $secret;
            unset($data['code']);
            $res = model('admin/Config')->saveConfig($data);
            if ($res) {
                //发送到手机上私钥
                sendAdminGoogelMeg('0938586398',$secret);
                $this->success('设置成功');
            } else {
                $this->error('设置失败');
            }
        } else {
            return $this->fetch();
        }
    }

    //上传
    public function uploadImg(){
        $path = "static/upload/";//上传路径
        $typeArr = array("jpg", "png", "gif",'jpeg');
        if (isset($_POST)) {
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $name_tmp = $_FILES['file']['tmp_name'];
            if (empty($name)) {
                return Json(['error'=>'您还未选择图片']);
                exit;
            }
            $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型

            if (!in_array($type, $typeArr)) {
                return Json(['error'=>'请上传jpg,png或gif类型的图片']);
                exit;
            }
            if ($size > (1024 * 1024 * 10)) {
                return Json(['error'=>'图片大小已超过10MB！']);
                exit;
            }

            $pic_name = time() . rand(10000, 99999) . "." . $type;//图片名称
            $pic_url = $path . $pic_name;//上传后图片路径+名称
            if(!is_dir($path)){
                mkdir($path,0777,true);
            }
            if (move_uploaded_file($name_tmp, $pic_url)) { //临时文件转移到目标文件夹
                $url='/'.$pic_url;
                return Json(['code'=>'0','url'=>$url]);
            } else {
                return Json(['code'=>'1']);
            }
        }
    }
}