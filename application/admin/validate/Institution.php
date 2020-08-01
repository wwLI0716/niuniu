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

class Institution extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'name' =>  'require',
        'area_id' =>  'require',
        'parent_id' =>  'require',
        'sort' => 'require',
    ];

    /**
     * 提示消息
     */
    protected $message  =   [
        'name.require' => '机构名必填',
        'area_id.require' => '地区必选',
        'parent_id.require' => '父机构必选',
        'sort.require' => '排序必填',
    ];
}