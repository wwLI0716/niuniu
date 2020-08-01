<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/23
 * Time: 16:18
 */

namespace app\admin\controller;
use think\response\Json;
use think\Db;


/**
 * 白名单
 * Class Entrance
 * @package app\admin\controller
 */
class Whitecookie extends Base
{
    /**
     *
     */
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->whitecookie = Db::table('ecshecom_white_cookie');
    }
    //列表
    public function index()
    {
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $map[] = ['id', '<>', 0];
            $List = $this->whitecookie
                ->where($map)
                ->page($page, $limit)
                ->order('id desc')
                ->select();
            foreach($List as $k=>$v){
                $List[$k]['created_at']=date('Y-m-d H:i:s',$List[$k]['created_at']);
            }
            $count = $this->whitecookie->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $List
            ];
            return json($data);
        }

        return $this->fetch('white_list');
    }
    public function delWhite()
    {
        $ids = array_unique(input('post.id/a', []));
        foreach ($ids as $val) {
            $rs = Db::table('ecshecom_white_cookie')->where('id', $val)->delete();
        }
        unset($val);
        $this->success('删除成功');
    }
    public function whiteForm(){
        if ($this->request->isPost()) {
            $data = input('');
            $title = $data['id'] ? '编辑' : '新增';

            if ($data['id']) {     //编辑
                $rs = $this->whitecookie->update($data);
            }else{
                $data['created_at']=time();
                $rs = $this->whitecookie->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->whitecookie->where('id='.$aid)->find($aid);
            $this->assign('info', $info);
            return $this->fetch();
        }
    }
}