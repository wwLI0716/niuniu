<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/29
 * Time: 18:22
 */

namespace app\common\model;


use app\common\component\SimpleDict;
use think\Db;
use think\Model;

class SensitiveWord extends Model
{
    /**
     * 格式化关键词字典
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function makeDictFormat(){

        $words = Db::name('sensitive_word')->order('created_at','DESC')->select();
        $rows = [];
        foreach ($words as $v){
            if( strpos($v['word'],',') === false ){
                $rows[] = [
                    'word' => $v['word'],
                    'value' => intval($v['id'])
                ];
            }else{
                $wordsArr = explode(',',$v['word']);
                foreach ($wordsArr as $vv){
                    $rows[] = [
                        'word' => $vv,
                        'value' => intval($v['id'])
                    ];
                }
            }
        }

        if ( $rows ){
            @unlink (RUNTIME_PATH . 'dict.bin');
            @SimpleDict::makeFromArray($rows , RUNTIME_PATH . 'dict.bin');
            unset($words);
            unset($rows);
        }

        return true;

    }


    /**
     * 是否含有关键词
     * @param $content
     * @return bool
     */
    public static function hasKeywordFromDict($content){
        // sampleDict
        $filterFile = RUNTIME_PATH . 'dict.bin';
        if (!file_exists($filterFile)){
            @ini_set('memory_limit', '512M');
            //重新格式化信息关键字字典
            self::makeDictFormat();
        }
        $dict = new SimpleDict( $filterFile );
        $re = $dict->search($content);
        return count($re) > 0 ? 1 : 0;
    }

    /**
     * 是否
     * @param $content
     * @return mixed
     */
    public static function getKeywordFromDict($content){
        // sampleDict
        $filterFile = RUNTIME_PATH . 'dict.bin';
        if (!file_exists($filterFile)){
            @ini_set('memory_limit', '512M');
            //重新格式化信息关键字字典
            self::makeDictFormat();
        }
        $dict = new SimpleDict( $filterFile );
        $re = $dict->search($content);
        return $re;
    }
}