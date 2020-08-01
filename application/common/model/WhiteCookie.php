<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/29
 * Time: 11:14
 */

namespace app\common\model;


use think\Model;

class WhiteCookie extends Model
{
    /**
     * @return array|mixed
     */
    public static function allWhite()
    {
        if( !cache('LYS-white-domain') )
        {
            $domains = self::column('cookie_name');//
            cache('LYS-white-domain', $domains, 600);
        }
        else
        {
            $domains = cache('LYS-white-domain');
        }

        return $domains;
    }
}