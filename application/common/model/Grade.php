<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/15
 * Time: 9:38
 */

namespace app\common\model;


use think\Model;

class Grade extends Model
{

    /**
     * 获取已开启的等级
     * @param bool|false $desc
     * @return []
     */
    public static function getAllGrades($desc = false)
    {
        if ($desc) {
            $order = 'experience_value DESC';
        } else {
            $order = 'experience_value ASC';
        }

        $grades = self::where('switch',1)
                ->order($order)
                ->select();

        return $grades;
    }

    /**
     * 获取经验等级设置
     * @return array
     */
    public static function getExpSets()
    {
        $select = model('common/Setting')->field('key,value')->select();
        $settings = mapHelper($select,'key','value');

        return [
            'SQDZ'      => isset($settings['add_exp_item_SQDZ']) ? $settings['add_exp_item_SQDZ'] : 0,
            'SQDZ_DAY'  => isset($settings['add_exp_item_SQDZ_DAY']) ? $settings['add_exp_item_SQDZ_DAY'] : 0,
            'BDQDZ'     => isset($settings['add_exp_item_BDQDZ']) ? $settings['add_exp_item_BDQDZ'] : 0,
            'BDQDZ_DAY' => isset($settings['add_exp_item_BDQDZ_DAY']) ? $settings['add_exp_item_BDQDZ_DAY'] : 0,
            'FT'        => isset($settings['add_exp_item_FT']) ? $settings['add_exp_item_FT'] : 0,
            'FT_DAY'    => isset($settings['add_exp_item_FT_DAY']) ? $settings['add_exp_item_FT_DAY'] : 0,
            'HT'        => isset($settings['add_exp_item_HT']) ? $settings['add_exp_item_HT'] : 0,
            'HT_DAY'    => isset($settings['add_exp_item_HT_DAY']) ? $settings['add_exp_item_HT_DAY'] : 0,
            'HFBDQ'     => isset($settings['add_exp_item_HFBDQ']) ? $settings['add_exp_item_HFBDQ'] : 0,
            'HFBDQ_DAY' => isset($settings['add_exp_item_HFBDQ_DAY']) ? $settings['add_exp_item_HFBDQ_DAY'] : 0,
            'FBBDQ'     => isset($settings['add_exp_item_FBBDQ']) ? $settings['add_exp_item_FBBDQ'] : 0,
            'FBBDQ_DAY' => isset($settings['add_exp_item_FBBDQ_DAY']) ? $settings['add_exp_item_FBBDQ_DAY'] : 0,
            'MRDL'      => isset($settings['add_exp_item_MRDL']) ? $settings['add_exp_item_MRDL'] : 0,
            'MRDL_DAY'  => isset($settings['add_exp_item_MRDL_DAY']) ? $settings['add_exp_item_MRDL_DAY'] : 0,
            'CJHT'      => isset($settings['add_exp_item_CJHT']) ? $settings['add_exp_item_CJHT'] : 0,
            'CJHT_DAY'  => isset($settings['add_exp_item_CJHT_DAY']) ? $settings['add_exp_item_CJHT_DAY'] : 0,
            'FX'        => isset($settings['add_exp_item_FX']) ? $settings['add_exp_item_FX'] : 0,
            'FX_DAY'    => isset($settings['add_exp_item_FX_DAY']) ? $settings['add_exp_item_FX_DAY'] : 0,
            'BSCHT'     => isset($settings['rdc_exp_item_BSCHT']) ? $settings['rdc_exp_item_BSCHT'] : 0,
            'SCFT'      => isset($settings['rdc_exp_item_SCFT']) ? $settings['rdc_exp_item_SCFT'] : 0,
            'SCHF'      => isset($settings['rdc_exp_item_SCHF']) ? $settings['rdc_exp_item_SCHF'] : 0,
            'QXDZ'      => isset($settings['rdc_exp_item_QXDZ']) ? $settings['rdc_exp_item_QXDZ'] : 0,
            'SCBDQ'     => isset($settings['rdc_exp_item_SCBDQ']) ? $settings['rdc_exp_item_SCBDQ'] : 0,
            'BXBSC'     => isset($settings['rdc_exp_item_BXBSC']) ? $settings['rdc_exp_item_BXBSC'] : 0,
        ];
    }

    /**
     * 根据经验值匹配等级
     * @param int $exp
     */
    public static function matchGid($exp=0){
        $grade = self::where('experience_value','<=',$exp)->order('id desc')->find();
        return $grade ? $grade->index : 0;
    }

}