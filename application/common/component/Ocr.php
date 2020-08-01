<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/23
 * Time: 17:45
 */

namespace app\common\component;


use TencentCloud\Common\Credential;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Ocr\V20181119\Models\IDCardOCRRequest;
use TencentCloud\Ocr\V20181119\OcrClient;
use think\facade\Env;

class Ocr
{

    const SIDE_FRONT = 'FRONT';//正面
    const SIDE_BACK = 'BACK';//背面

    private $cred;

    public function __construct()
    {
        $this->cred = new Credential( Env::get('qcloud.q_secret_id'), Env::get('qcloud.q_secret_key'));
    }

    /**
     * 识别身份证信息
     * @param string $file
     * @param int $type
     * @param bool $cropIdCard
     * @param bool $cropPortrait
     */
    public function distinguish($file = '',$type = 0,$cropIdCard = false,$cropPortrait = false){
        try {
            $httpProfile = new HttpProfile();
            $httpProfile->setEndpoint("ocr.tencentcloudapi.com");
            //
            $clientProfile = new ClientProfile();
            $clientProfile->setHttpProfile($httpProfile);
            $client = new OcrClient($this->cred, "ap-shanghai", $clientProfile);
            $req = new IDCardOCRRequest();

            $params = [];
            if( stripos($file,'https://') === FALSE && stripos($file,'http://') === FALSE ){
                $params['ImageBase64'] = $file;
            }else{
                $params['ImageUrl'] = $file;
            }

            $params['CardSide'] = $type ? self::SIDE_BACK : self::SIDE_FRONT;
            if( $cropIdCard && !$cropPortrait ){
                $params['Config'] = '{"CropIdCard":true}';//$cropIdCard;
            } elseif( $cropPortrait && !$cropIdCard ){
                $params['Config'] = '{"CropPortrait":true}';//$cropPortrait;
            }elseif( $cropIdCard && $cropPortrait ){
                $params['Config'] = '{"CropIdCard":true,"CropPortrait":true}';
            }

            $req->fromJsonString( json_encode($params) );
            $resp = $client->IDCardOCR($req);

            $json = $resp->toJsonString();
            $jsonObj = json_decode($json,true);
            //
            if( isset($jsonObj['Error']) ){
                return [
                    'status' => 'fail',
                    'message' => $jsonObj['Error']['Message']
                ];

            }else{
                return [
                    'status' => 'ok',
                    'message' => 'OK',
                    'data' => $jsonObj
                ];
            }
        }
        catch(TencentCloudSDKException $e) {
            echo $e;
        }
    }
}