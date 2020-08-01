<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/26
 * Time: 14:05
 */

namespace app\admin\controller;


use app\admin\model\AdminLog;
use app\admin\model\InviteRecord;
use think\Db;

class Invite extends Admin
{
    //邀请记录
    public function index(){
        $title = '邀请记录';
        //
        if( $this->request->isAjax() ){

            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);

            $query = InviteRecord::with('code');

            $code = request()->param('code');
            if( $code ){
                $query->where('code.code','eq',$code);
                $query->whereOr('code_id','eq',$code);
            }

            $from_uid = request()->param('from_uid');
            if( $from_uid ){
                $query->where('from_uid','eq',$from_uid);
            }

            $from_username = request()->param('from_username');
            if( $from_username ){
                $query->where('from_username','LIKE',"%$from_username%");
            }

            $to_uid = request()->param('to_uid');
            if( $to_uid ){
                $query->where('to_uid','eq',$to_uid);
            }

            $to_username = request()->param('to_username');
            if( $to_username ){
                $query->where('to_username','LIKE',"%$to_username%");
            }

            $c_query = clone $query;

            $list = $query->with('code')
                ->page($page, $limit)
                ->order('id desc')
                ->select();

            $count = $c_query->count();

            $rows = [];
            foreach ( $list as $key => $value ){
                $rows[$key]['id'] = $value['id'];
                $rows[$key]['code'] = isset($value->code) ? $value->code->code : '';
                $rows[$key]['from_username'] = $value['from_username'];
                $rows[$key]['from_num'] = $value['from_num'];
                $rows[$key]['to_username'] = $value['to_username'];
                $rows[$key]['to_num'] = $value['to_num'];
                $rows[$key]['created_at'] = date('Y-m-d H:i:s',$value['created_at']);
            }

            $data = [
                'code' => 0,
                'message' => '数据返回成功',
                'count' => $count,
                'data' => $rows
            ];

            AdminLog::setTitle('获取邀请记录列表');
            return json( $data );
        }

        return $this->fetch();
    }

    /**
     * 邀请码记录
     */
    public function code(){

        $title = '邀请码记录列表';
        if( $this->request->isAjax() ){

            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);

            $query = Db::name('invite_code');
            $username = request()->param('username');
            if( $username ){
                $query->where('username','LIKE',"%$username%");
            }

            $uid = request()->param('uid');
            if( $uid ){
                $query->where('uid','eq',$uid);
            }
            $code = request()->param('code');
            if( $code ){
                $query->where('code','eq',$code);
            }

            $list = $query->page($page,$limit)
                ->order('id DESC')
                ->select();

            $count = $query->count();
            $rows = [];

            foreach ( $list as $key => $value ){
                $rows[$key]['id'] = $value['id'];
                $rows[$key]['uid'] = $value['uid'];
                $rows[$key]['username'] = $value['username'];
                $rows[$key]['code'] = $value['code'];
                $rows[$key]['invite_count'] = $value['invite_count'];
                $rows[$key]['created_at'] = date('Y-m-d H:i:s',$value['created_at']);
            }

            $data = [
                'code' => 0,
                'message' => '数据返回成功',
                'count' => $count,
                'data' => $rows
            ];

            AdminLog::setTitle('邀请码记录列表');
            return json($data);

        }

        $this->assign('title',$title);
        return $this->fetch();

    }

}