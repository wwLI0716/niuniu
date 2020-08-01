<?php
/**----------------------------------------------------------------------
 * OpenCenter V3
 * Copyright 2014-2018 http://www.ocenter.cn All rights reserved.
 * ----------------------------------------------------------------------
 * Author: wdx(wdx@ourstu.com)
 * Date: 2018/9/30
 * Time: 14:00
 * ----------------------------------------------------------------------
 */
namespace app\admin\validate;

use think\Validate;

class Community extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'name' =>  'require',
        'area_id' =>  'require',
        'institution_id' =>  'require',
        'lat' => 'require',
        'lng' => 'require',
        'address' => 'require',
        'status' => 'require',
        'need_verify' => 'require',
    ];

    /**
     * 提示消息
     */
    protected $message  =   [
        'name.require' => '机构名必填',
        'area_id.require' => '地区必选',
        'institution_id.require' => '机构必选',
        'lat.require' => '经度必填',
        'lng.require' => '纬度必填',
        'address.require' => '地址必填',
        'status.require' => '状态必选',
        'need_verify.require' => '加入社区是否需要审核必选',
    ];
}