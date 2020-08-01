<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/29
 * Time: 16:22
 */

namespace app\admin\controller;


use app\common\component\Tree;

class Access extends Base
{
    public $auth;
    public function initialize(){
        parent::initialize();
        $this->auth = model('admin/AdminAuthRule');
    }

    public function index(){
        return $this->fetch();
    }

    //
    public function ajaxList(){
        //
        if( $this->request->isAjax() ){
            $result     = $this->auth->order('sort ASC,id ASC')->select()->toArray();
            $rows = [];
            foreach ($result as $key => $value) {
                $row['id'] = $value['id'];
                $row['pid'] = $value['pid'];
                $row['sort'] = $value['sort'];
                $row['title'] = $value['title'];
                $row['name'] = $value['name'];
                $row['module'] = $value['module'];
                $row['icon'] = $value['icon'];
                $row['is_show'] = $value['is_show'];
                $row['is_menu'] = $value['is_menu'];
                $row['status'] = $value['status'];

                $rows[] = $row;

            }

            $count = count($rows);
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $rows
            ];
            return json($data);
        }
    }

}