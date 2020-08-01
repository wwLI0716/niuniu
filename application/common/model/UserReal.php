<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/16
 * Time: 10:06
 */

namespace app\common\model;


use app\common\QcloudImage\CIClient;
use think\facade\Env;
use think\Model;

class UserReal extends Model
{
    /**
     * 身份证识别
     * @param string $filePath 图片路径（网络图片、或者本地绝对路径图片）
     * @param int $type 0证明 1反面
     */
    public static function distinguish($filePath = '',$type = 0){

        $client = new CIClient(
                                Env::get('qcloud.q_app_id'),
                                Env::get('qcloud.q_secret_id'),
                                Env::get('qcloud.q_secret_key'),
                                Env::get('qcloud.q_bucket'));
        //设置超时时间/秒
        $client->setTimeout(30);//单个或多个图片Url,识别身份证正面
        $detect = [];
        $detectObj = $client->idcardDetect(array('urls'=>$filePath), $type);
        $detect = json_decode($detectObj,true);
        $result = [];
        if( $detect && isset($detect['result_list'])){
            $result = $detect['result_list'][0];
        }
        return $result;
    }
}