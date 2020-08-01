<?php
/**----------------------------------------------------------------------
 * OpenCenter V3
 * Copyright 2014-2018 http://www.ocenter.cn All rights reserved.
 * ----------------------------------------------------------------------
 * Author: wdx(wdx@ourstu.com)
 * Date: 2018/9/12
 * Time: 16:05
 * ----------------------------------------------------------------------
 */
namespace app\admin\model;

use think\Model;

class AdminAuthGroup extends Model
{
    protected $table = ADMIN . 'auth_group';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    /**
     * 权限分组信息验证
     * @param array $data
     * @author:wdx(wdx@ourstu.com)
     */
    public function _checkAdminAuthGroupData($data = [])
    {
        if (!$data['title']) {
            $this->error('请输入分组名称');
        }
        //唯一性校验
        if (isset($data['id'])) {
            if ($this->adminAuthGroup->where('title', $data['title'])->value('id') != $data['id']) {
                $this->error('分组名称已存在');
            }
        } else {
            if ($this->adminAuthGroup->where('title', $data['name'])->value('id')) {
                $this->error('分组名称已存在');
            }
        }
        if (!$data['module']) {
            $this->error('请输入模块名称');
        }
        if (!$data['type']) {
            $this->error('请选择分类');
        }
        if (!$data['end_time']) {
            $this->error('请选择有效期限');
        }
        if (!$data['rules']) {
            $this->error('请分配权限');
        }
    }

    /**
     * 将格式数组转换为树
     * @param array $list
     * @param integer $level 进行递归时传递用的参数
     */
    private $formatTree; //用于树型数组完成递归格式的全局变量

    public function getTree($field = true, $map = [])
    {
        $map[] = ['status', '>=', 0];
        /* 获取所有分类 */
        $list = $this->field($field)->where($map)->select()->toArray();
        $list = $this->toFormatTree($list);
        return $list;
    }

    public function toFormatTree($list, $title = 'title', $pk = 'id', $pid = 'pid', $root = 0)
    {
        $list = list_to_tree($list, $pk, $pid, '_child', $root);
        $this->formatTree = array();
        $this->_toFormatTree($list, 0, $title);
        return $this->formatTree;
    }

    private function _toFormatTree($list, $level = 0, $title = 'title')
    {
        foreach ($list as $key => $val) {
            $tmp_str = str_repeat(" ", $level * 2);
            $tmp_str .= "└";
            $val['level'] = $level;
            $val['title_show'] = $level == 0 ? $val[$title] . " " : $tmp_str . $val[$title] . " ";
            // $val['title_show'] = $val['id'].'|'.$level.'级|'.$val['title_show'];
            if (!array_key_exists('_child', $val)) {
                array_push($this->formatTree, $val);
            } else {
                $tmp_ary = $val['_child'];
                unset($val['_child']);
                array_push($this->formatTree, $val);
                $this->_toFormatTree($tmp_ary, $level + 1, $title); //进行下一层递归
            }
        }
        return;
    }
}