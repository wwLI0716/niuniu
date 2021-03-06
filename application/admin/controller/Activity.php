<?php

namespace app\admin\controller;
use think\response\Json;
use app\common\model\Activity as ActivityType;
use think\Db;

class Activity extends Base
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->activity = Db::table('ecshecom_activity');
        $this->category = Db::table('ecshecom_activity_category');
    }
    //活动列表
    public function index()
    {
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $title = request()->param('title');
            $type = request()->param('type');
            $datestart = request()->param('datestart');
            $dateend = request()->param('dateend');
            $status = request()->param('status');
            if(!empty($title)){
                $map[] = ['a.name', 'like', "%$title%"];
            }
            if(!empty($type)){
                $map[] = ['a.category_id', '=', $type];
            }
            if(!empty($datestart)){
                $map[] = ['a.start_time', '>=', strtotime($datestart)];
            }
            if(!empty($dateend)){
                $map[] = ['a.end_time', '<=', strtotime($dateend)];
            }
            if($status==""){

            }else{
                $map[] = ['a.status', 'eq', (int)$status];
            }
            $map[] = ['a.is_deleted', '<>', 1];
            $map[] = ['a.extend', 'eq', 2];
            $zfList = $this->activity->alias('a')
                ->join('ecshecom_activity_category ac','ac.id=a.category_id')
                ->where($map)
                ->page($page, $limit)
                ->order('a.created_at desc')
                ->field('a.*,ac.name as acname')
                ->select();

            foreach($zfList as $key=>$val){
                $zfList[$key]['status'] = isset(ActivityType::$status_config[$val['status']])?ActivityType::$status_config[$val['status']]:'';
                $zfList[$key]['belong_type'] = isset(ActivityType::$belong_type[$val['belong_type']])?ActivityType::$belong_type[$val['belong_type']]:'';
                $zfList[$key]['start_time']=date('Y-m-d H:i:s',$zfList[$key]['start_time']);
                $zfList[$key]['end_time']=date('Y-m-d H:i:s',$zfList[$key]['end_time']);
            }
            $count = $this->activity->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $zfList
            ];
            return json($data);
        }
        $group = $this->category->where('status', 1)->field('id, name')->select();
        $this->assign('group', $group);
        return $this->fetch('activity_list');
    }
    public function activityForm(){
        if ($this->request->isPost()) {
            $data = input('data/a', []);
            $title = $data['id'] ? '编辑' : '新增';

            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            if (!empty($data['id'])) {     //编辑
                $rs = $this->activity->update($data);
            }else{
                $data['created_at']=time();
                $rs = $this->activity->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->activity->where('id='.$aid)->find($aid);
            $group = $this->category->where('status', 1)->column('id, name');
            $groups = [];
            foreach ($group as $key => $val) {
                $temp['id'] = $key;
                $temp['name'] = $val;
                $groups[] = $temp;
            }
            $groupJson = json_encode($groups);
                if($info){
                    $info['start_time']=date('Y-m-d H:i:s',$info['start_time']);
                    $info['end_time']=date('Y-m-d H:i:s',$info['end_time']);
                }

            $this->assign('group', $group);
            $this->assign('groupJson', $groupJson);
            $this->assign('info', $info);
            return $this->fetch('activity_forms');
        }
    }
    public function delActivity()
    {
        $ids = array_unique(input('post.id/a', []));
        foreach ($ids as $val) {
            $rs = Db::table('ecshecom_activity')->where('id', $val)->delete();
        }
        unset($val);
        $this->success('删除成功');
    }
    //活动分类
    public function category(){
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $map[] = ['status', '<>', 2];
            $cgList = $this->category
                ->where($map)
                ->page($page, $limit)
                ->order('created_at desc')
                ->select();
            foreach($cgList as $key=>$val){
                $cgList[$key]['status'] = isset(ActivityType::$category_config[$val['status']])?ActivityType::$category_config[$val['status']]:'';
                $cgList[$key]['created_at']=date('Y-m-d H:i:s',$cgList[$key]['created_at']);
            }
            $count = $this->category->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $cgList
            ];
            return json($data);
        }
        return $this->fetch('category_list');
    }
    public function delCategory()
    {
        $ids = array_unique(input('post.id/a', []));
        foreach ($ids as $val) {
            $rs = Db::table('ecshecom_activity_category')->where('id', $val)->setField('status', '2');
        }
        unset($val);
        $this->success('刪除成功');
    }
    public function categoryForm(){
        if ($this->request->isPost()) {
            $data = input('');
            $title = $data['id'] ? '编辑' : '新增';

            //状态
            $data['status'] = (isset($data['status']) ? '1' : '0');
            if ($data['id']) {     //编辑
                $rs = $this->category->update($data);
            }else{
                $data['created_at']=time();
                $rs = $this->category->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->category->where('id='.$aid)->find($aid);
            $this->assign('info', $info);
            return $this->fetch();
        }
    }
    //上传
    public function uploadImg(){
        $path = "static/upload/";//上传路径
        $typeArr = array("jpg", "png", "gif",'jpeg');
        if (isset($_POST)) {
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $name_tmp = $_FILES['file']['tmp_name'];
            if (empty($name)) {
                return Json(['error'=>'您还未选择图片']);
                exit;
            }
            $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型

            if (!in_array($type, $typeArr)) {
                return Json(['error'=>'请上传jpg,png或gif类型的图片']);
                exit;
            }
            if ($size > (1024 * 1024 * 10)) {
                return Json(['error'=>'图片大小已超过10MB！']);
                exit;
            }

            $pic_name = time() . rand(10000, 99999) . "." . $type;//图片名称
            $pic_url = $path . $pic_name;//上传后图片路径+名称
            if(!is_dir($path)){
                mkdir($path,0777,true);
            }
            if (move_uploaded_file($name_tmp, $pic_url)) { //临时文件转移到目标文件夹
                $url='/'.$pic_url;
                return Json(['code'=>'0','url'=>$url]);

            } else {
                return Json(['code'=>'1']);
            }
        }
    }
    //广告
    public function advert(){
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $status = request()->param('status');
            $map = array();
            if($status!=""){
                $map[] = ['a.status', 'eq', (int)$status];
            }

            $zfList = $this->activity->alias('a')
                ->join('user u','a.user_id = u.id')
                ->where($map)
                ->page($page, $limit)
                ->order('a.created_at desc')
                ->field('a.*,u.username')
                ->select();
            foreach($zfList as $key=>$val){
                if($zfList[$key]['status'] == 0)
                {
                    $zfList[$key]['statusText'] = '未回复';
                } else {
                    $zfList[$key]['statusText'] = '已回复';
                }
                $zfList[$key]['created_at']=date('Y-m-d H:i:s',$zfList[$key]['created_at']);

            }
            $count = $this->activity->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $zfList
            ];
            return json($data);
        }

        return $this->fetch('advert_list');
    }
    public function advertForm(){
        if ($this->request->isPost()) {
            $data = input('post.', []);
            $title = $data['id'] ? '编辑' : '新增';

            $data['back_at']=time();
            $data['status'] = 1;

            if (!empty($data['id'])) {     //编辑
                $rs = $this->activity->update($data);
            }else{
                $data['created_at']=time();
                unset($data['id']);
                $rs = $this->activity->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->activity->where('id='.$aid)->find($aid);
            $this->assign('info', $info);
            return $this->fetch('advert_form');
        }
    }

    //上传

    
}
