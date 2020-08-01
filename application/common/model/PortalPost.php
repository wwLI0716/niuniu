<?php
/**
 * Created by PhpStorm.
 * User: Richard
 * Date: 2018/12/5
 * Time: 8:25 PM
 */

namespace app\common\model;

use think\Model;

class PortalPost extends Model
{

    const REVIEW  = 0;//待审
    const PASS    = 1;//通过
    const NO_PASS = 2;//未通过
    const DELETED = 3;//删除

    /**
     *
     */
    public function like(){
        return $this->hasOne('PortalLike','post_id','id');
    }

    public function collection(){
        return $this->hasOne('PortalCollection','post_id','id');
    }

    public function reply(){
        return $this->hasOne('PortalReply','post_id','id');
    }

    /**
     * 文章分类
     */
    public function category(){
        return $this->hasOne('PortalCategory','id','category_id');
    }

    /**
     * 获取文章发布者
     */
    public function admin(){
        return $this->hasOne('Admin','id','user_id');
    }


    /**
     *
     * @param $isping
     * @return string
     */
    public static function pingStyle( $isping ){
        $pingstyle = '';
        if( $isping == 1){
            $pingstyle = 'have-zan';
        }
        return $pingstyle;
    }


}