<?php
namespace app\index\model;
use think\Db;
class IndexModel{
    //用户添加
    public function yonghutianjia($yonghuxinxi,$tujing){
        $user = Db::table('grzx_yonghu');
        if(!empty($yonghuxinxi['weixin_openid'])){
            $xinxi['tujing'] =$tujing;
            $xinxi['openid'] =$yonghuxinxi['weixin_openid'];
            $xinxi['unionid'] =$yonghuxinxi['weixin_unionid'];
            $xinxi['name'] =$yonghuxinxi['weixin_user_name'];
            $xinxi['img'] =$yonghuxinxi['weixin_headimgurl'];
            $xinxi['sex'] =$yonghuxinxi['weixin_sex'];
            $xinxi['shengfen'] =$yonghuxinxi['weixin_province'];
            $xinxi['chengshi'] =$yonghuxinxi['weixin_city'];
            $xinxi['time'] =date('Y-m-d H:i:s');
            //判断openid重复
            $condition1['openid'] = $yonghuxinxi['weixin_openid'];
            $data1 = $user->where($condition1)->select();
            if (!empty($data1)) {
                $data = $user->where($condition1)->data($xinxi)->update();
            }else{
                $data = $user->data($xinxi)->insert();
            }
        }else{
            $data ='';
        }
        return $data;
    }
    //手机验证
    public function yanzhengpanduan($tel){
        $tab=Db::connect('mysql://ycwjw:ycwjw@116.62.113.243:3306/ycwjw#utf8');
        $user = $tab->table('grzx_yonghu_yanzheng');
        $condition['tel'] =$tel;
        $data = $user->where($condition)->order('id desc')->select();
        if(!empty($data[0]['yanzheng'])){
            $zero1=strtotime(date('Y-m-d H:i:s')); //当前时间
            $zero2=strtotime($data[0]['time']);  //验证时间
            $shijian=ceil(($zero1-$zero2)/300); //60s*5
            //查看验证是否超时
            if($shijian>3){
                $jieguo['status'] = "ok";
                $jieguo['message'] = "正常发送！";
            }else{
                $jieguo['status'] = "fail";
                $jieguo['message'] = "该手机距离上次发送验证信息时间未超过3分钟！";
            }
        }else{
            $jieguo['status'] = "ok";
            $jieguo['message'] = "正常发送！";
        }
        return $jieguo;
    }
    //手机验证
    public function shoujiyanzheng($openid,$tel,$yanzheng){
        $tab=Db::connect('mysql://ycwjw:ycwjw@116.62.113.243:3306/ycwjw#utf8');
        $user = $tab->table('grzx_yonghu_yanzheng');
        $xinxi['openid'] =$openid;
        $xinxi['tel'] =$tel;
        $xinxi['yanzheng'] =$yanzheng;
        $xinxi['time'] =date('Y-m-d H:i:s');
        $data = $user->data($xinxi)->insert();
        if (!empty($data)) {
            $jieguo['status'] = "ok";
            $jieguo['message'] = "手机验证信息！";
        }else{
            $jieguo['status'] = "fail";
            $jieguo['message'] = "未收查到该手机验证信息！";
        }
        return $jieguo;
    }
    //移车短信录入
    public function yicheduanxinluru($openid,$tel,$neirong,$templateid){
        $user = Db::table('mc_duanxin');
        $xinxi['openid'] =$openid;
        $xinxi['tel'] =$tel;
        $xinxi['neirong'] =$neirong;
        $xinxi['templateid'] =$templateid;
		$xinxi['tujing'] = 12;
        $xinxi['time'] =date('Y-m-d H:i:s');
        $data = $user->data($xinxi)->insert();
        if (!empty($data)) {
            $jieguo['status'] = "ok";
            $jieguo['message'] = "手机验证信息！";
        }else{
            $jieguo['status'] = "fail";
            $jieguo['message'] = "未收查到该手机验证信息！";
        }
        return $jieguo;
    }
    /*
    *zysc 新增方法
    */
     public function getUInfoByOpenid($openid){
        $user = Db::table('grzx_yonghu');
        $userdianhua = Db::table('grzx_yonghu_dianhua');
        $userzhengjian = Db::table('grzx_yonghu_zhengjian');
        $userdizhi = Db::table('grzx_yonghu_dizhi');

        $data  = $user->where(array('openid' =>$openid))->select(); 
        $conditiondizhi['openid'] =$data[0]['openid'];
        $data[0]['dianhua'] =$userdianhua->where($conditiondizhi)->order('id desc')->select();
        $data[0]['dizhi'] =$userdizhi->where($conditiondizhi)->order('id desc')->select();
        $data[0]['zhengjian'] =$userzhengjian->where($conditiondizhi)->order('id desc')->select();
        $data[0]['name'] = $this->replace_emoji($data[0]['name']);
        return $data;
     }
     //用户昵称转换
    public function replace_emoji($text){
        return preg_replace_callback('/@E(.{6}==)/', function($r) {return base64_decode($r[1]);}, $text);
    }
    //手机验证
    public function yanzhengtianjia($openid,$tel,$yanzheng){
        $tab=Db::connect('mysql://ycwjw:ycwjw@116.62.113.243:3306/ycwjw#utf8');
        $user = $tab->table('grzx_yonghu_yanzheng');
        $condition['tel'] =$tel;

        $data = $user->where($condition)->order('id desc')->select();

        //查看是否有此手机短信
        if (empty($data)) {
            $jieguo['status'] = "fail";
            $jieguo['message'] = "未收查到该手机验证信息！";
        }else{
            //查看验证是否正确
            if($yanzheng==$data[0]['yanzheng']){

                $zero1=strtotime(date('Y-m-d H:i:s')); //当前时间
                $zero2=$data[0]['time'];  //验证时间
                //$shijian=(int)ceil(($zero2-$zero1)/300); //60s*5
                //查看验证是否超时

                //修改电话号码信息
                $userdianhua = $tab->table('grzx_yonghu_dianhua');
                //判断用户是否有数据
                $conditionyonghu['tel'] =$tel;
                $yonghuchongfu = $userdianhua->where($conditionyonghu)->select();
                $xinxi['openid'] = $openid;
                $xinxi['tel'] = $tel;
                //$xinxi['yanzheng'] =$yanzheng;
                $xinxi['time'] =date('Y-m-d H:i:s');
                //无数据添加、有数据修改
                if (empty($yonghuchongfu)) {
                    $dianhuajieguo = $userdianhua->data($xinxi)->insert();
                }else{
                    $dianhuajieguo = $userdianhua->where(['id'=>$yonghuchongfu[0]['id']])->data(['tel'=>$xinxi['tel'],'time' => $xinxi['time']])->update();
                }

                if (empty($dianhuajieguo)) {
                    $jieguo['status'] = "fail";
                    $jieguo['message'] = "该手机号添加失败了，请重新验证！";
                }else{
                    $jieguo['status'] = "ok";
                    $jieguo['message'] = "该手机号添加成功！";
                }

            }else{
                $jieguo['status'] = "fail";
                $jieguo['message'] = "该条手机验证信息不正确，请重新发送！";
            }
        }

        return $jieguo;
    }

}