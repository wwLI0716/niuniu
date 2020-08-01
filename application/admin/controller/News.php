<?php

namespace app\admin\controller;
use think\response\Json;
use app\common\model\NewsType;
use think\Db;

class News extends Base
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->news = Db::table('ecshecom_portal_post');
        $this->reply = Db::table('ecshecom_portal_reply');
        $this->like = Db::table('ecshecom_portal_like');
        $this->type = Db::table('ecshecom_portal_category');
        $this->tag = Db::table('ecshecom_portal_tag');
        $this->cityTree = model('admin/CityTree');
        $this->newTree = model('admin/NewTree');
        $this->banner = Db::table('ecshecom_banner');
    }
    //文章列表
    public function index()
    {
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $title = request()->param('title');
            $type = request()->param('type');
            $keywords = request()->param('keywords');
            if(!empty($title)){
                $map[] = ['a.post_title', 'like', "%$title%"];
            }
            if(!empty($type)){
                $map[] = ['a.category_id', '=', $type];
            }
            if(!empty($keywords)){
                $map[] = ['a.post_keywords', 'like', "%$keywords%"];
            }else{

            }
            $map[]=['post_status','neq',2];
            $zfList = $this->news->alias('a')
                ->join('ecshecom_portal_category ac','ac.id=a.category_id')
                ->where($map)
                ->page($page, $limit)
                ->order('a.create_time desc')
                ->field('a.*,ac.zh_tw_name as acname')
                ->select();
            foreach($zfList as $key=>$val){
                $zfList[$key]['post_status'] = isset(NewsType::$status_config[$val['post_status']])?NewsType::$status_config[$val['post_status']]:'';
                $zfList[$key]['create_time']=date('Y-m-d H:i:s',$zfList[$key]['create_time']);
                $zfList[$key]['update_time']=date('Y-m-d H:i:s',$zfList[$key]['update_time']);
            }
            $count = $this->news->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $zfList
            ];
            return json($data);
        }
        $group = $this->type->where('status', 1)->field('id,zh_tw_name')->select();
        $this->assign('group', $group);
        return $this->fetch('news_list');
    }
    public function newsForm(){
        if ($this->request->isPost()) {
            $data = input('');
            $title = $data['id'] ? '编辑' : '新增';
            $user=session('admin_auth');
            $data['user_id']=$user['uid'];
            $data['post_status'] = (isset($data['post_status']) ? '1' : '0');
            $data['comment_status'] = (isset($data['comment_status']) ? '1' : '0');
            $data['is_top'] = (isset($data['is_top']) ? '1' : '0');
            if($data['post_status']==1){
                $data['published_time']=time();
            }else{
                $data['published_time']='';
            }
            if (!empty($data['id'])) {     //编辑
                $data['update_time']=time();
                $rs = $this->news->update($data);
            }else{
                $data['create_time']=time();
                $rs = $this->news->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->news->where('id='.$aid)->find($aid);
            $Tree = $this->newTree->getTree('id, parent_id, zh_tw_name');
            $this->assign('Tree', $Tree);
            $this->assign('info', $info);
            $this->assign('aid', $aid);
            return $this->fetch('news_form');
        }
    }
    public function delNews()
    {
        $ids = array_unique(input('post.id/a', []));

        foreach ($ids as $key=>$val) {
            Db::table('ecshecom_portal_post')->where('id', $val)->update(['post_status'=>2, 'delete_time'=>time()]);
        }

        $this->success('刪除成功');
    }
    //分类
    public function type(){
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $map[]=['status','eq',1];
            $zfList = $this->type
                ->where($map)
                ->page($page, $limit)
                ->select();
            $count = $this->type->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $zfList
            ];
            return json($data);
        }
        return $this->fetch('type_list');
    }

    public function typeForm(){
        if ($this->request->isPost()) {
            $data = input('');
            $title = $data['id'] ? '编辑' : '新增';
            $data['status']=1;

            if(!empty($data['show_home']) && $data['show_home'] == 'on')
            {
                $data['show_home'] = 1;
            } else {
                $data['show_home'] = 0;
            }
            if(!empty($data['is_faq']) && $data['is_faq'] == 'on')
            {
                $data['is_faq'] = 1;
            } else {
                $data['is_faq'] = 0;
            }
            if (!empty($data['id'])) {     //编辑
                $data['zh_cn_description']=$data['zh_cn_name'];
                $data['en_us_description']=$data['en_us_name'];
                $data['zh_tw_description']=$data['zh_tw_name'];
                $rs = $this->type->update($data);
            }else{
                $data['zh_cn_description']=$data['zh_cn_name'];
                $data['en_us_description']=$data['en_us_name'];
                $data['zh_tw_description']=$data['zh_tw_name'];
                $rs = $this->type->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->type->where('id='.$aid)->find($aid);
            $this->assign('info', $info);
            return $this->fetch('type_form');
        }
    }
    public function typeList(){
        $parentId = 0;
        $data = $this->showNodes($parentId);
        //echo json_encode($data);
        return json($data);
    }
    public function showNodes($parent)
    {

        $data = array();

        $list = Db::table('ecshecom_portal_category')->where('parent_id=' . $parent)->select();
        foreach ($list as $key => $val) {
            $node = array();
            $node['id'] = $val['id'];
            $node['text'] = $val['name'];
            $node['pid'] = $val['parent_id'];
            $node['nodes'] = $this->showNodes($val['id']);
            array_push($data, $node);
        }
        return $data;

    }
    public function addType(){
        $data['parent_id']=$_POST['pid'];
        $data['description']=$_POST['name'];
        $data['name']=$_POST['name'];
        $info =  Db::table('ecshecom_portal_category')->insert($data);
        if($info){
            return json(array('status'=>'ok','msg'=>'添加成功'));
        }else{
            return json(array('status'=>'fail','msg'=>'添加失败'));
        }
    }
    public function editType(){
        //echo 11;die();
        $id=$_POST['pid'];
        $name=$_POST['name'];
        $info =  Db::table('ecshecom_portal_category')->where(array("id" => $id))->update(array("name" => $name));
        if($info){
            return json(array('status'=>'ok','msg'=>'修改成功'));
        }else{
            return json(array('status'=>'fail','msg'=>'修改失败'));
        }
    }
    public function delType(){
        $ids = array_unique(input('post.id/a', []));

        foreach ($ids as $key=>$val) {
            Db::table('ecshecom_portal_category')->where('id', $val)->update(['status'=>2, 'delete_time'=>time()]);
        }

        $this->success('刪除成功');

    }
    //标签
    public function tag(){
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $map[] = ['status', '<>', 2];
            $cgList = $this->tag
                ->where($map)
                ->page($page, $limit)
                ->order('id desc')
                ->select();
            foreach($cgList as $key=>$val){
                $cgList[$key]['status'] = isset(NewsType::$tag_config[$val['status']])?NewsType::$tag_config[$val['status']]:'';
            }
            $count = $this->tag->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $cgList
            ];
            return json($data);
        }
        return $this->fetch('tag_list');
    }
    public function tagForm(){
        if ($this->request->isPost()) {
            $data = input('');
            $title = $data['id'] ? '编辑' : '新增';
            //状态
            $data['status'] = (isset($data['status']) ? '1' : '0');
            if ($data['id']) {     //编辑
                $rs = $this->tag->update($data);
            }else{
                $rs = $this->tag->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->tag->where('id='.$aid)->find($aid);
            $this->assign('info', $info);
            return $this->fetch();
        }
    }
    public function delTag()
    {
        $ids = array_unique(input('post.id/a', []));
        foreach ($ids as $val) {
            $rs = Db::table('ecshecom_portal_tag')->where('id', $val)->delete();
        }
        unset($val);
        $this->success('刪除成功');
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
    //列表
    public function reply()
    {
        $aid =request()->param('aid');
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $map[]=['r.post_id','eq',$aid];
            $map[]=['r.status','neq',4];
            $zfList = $this->reply->alias('r')
                ->where($map)
                ->page($page, $limit)
                ->order('r.created_at desc')
                ->select();
            $word   = Db::table('ecshecom_sensitive_word')->select();
            foreach($zfList as $key=>$val){
                $user = Db::table('ecshecom_user')->where(['id'=>$val['user_id']])->find();
                if($user){
                    if($user['is_vest']==1){
                        $zfList[$key]['nickname']=$user['nickname']."<span style='font-size: 6px;color:green;'>[马甲]</span>";
                    }else{
                        $zfList[$key]['nickname']=$user['nickname'];
                    }
                }else{
                    $zfList[$key]['nickname']='匿名用户';
                }
                foreach($word as $k=>$v){
                    if(stristr($val['content'],$v['word'])){
                        $zfList[$key]['content']=str_replace($v['word'],"<span style='color:red;'>$v[word]</span>",$zfList[$key]['content']);
                    }
                }

                $zfList[$key]['status'] = isset(NewsType::$reply_config[$val['status']])?NewsType::$reply_config[$val['status']]:'';
                $zfList[$key]['created_at']=date('Y-m-d H:i:s',$zfList[$key]['created_at']);
            }
            $count = $this->reply->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $zfList
            ];
            return json($data);
        }
        $this->assign('aid',$aid);
        return $this->fetch('reply_list');
    }
    public function replyIndex()
    {
        $aid =request()->param('aid');
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $map[]=['r.status','neq',4];
            $zfList = $this->reply->alias('r')
                ->where($map)
                ->page($page, $limit)
                ->order('r.created_at desc')
                ->select();
            $word   = Db::table('ecshecom_sensitive_word')->select();
            foreach($zfList as $key=>$val){
                $user = Db::table('ecshecom_user')->where(['id'=>$val['user_id']])->find();
                if($user){
                    if($user['is_vest']==1){
                        $zfList[$key]['nickname']=$user['nickname']."<span style='font-size: 6px;color:green;'>[马甲]</span>";
                    }else{
                        $zfList[$key]['nickname']=$user['nickname'];
                    }
                }else{
                    $zfList[$key]['nickname']='匿名用户';
                }
                foreach($word as $k=>$v){
                    if(stristr($val['content'],$v['word'])){
                        $zfList[$key]['content']=str_replace($v['word'],"<span style='color:red;'>$v[word]</span>",$zfList[$key]['content']);
                    }
                }
                $zfList[$key]['status'] = isset(NewsType::$reply_config[$val['status']])?NewsType::$reply_config[$val['status']]:'';
                $zfList[$key]['created_at']=date('Y-m-d H:i:s',$zfList[$key]['created_at']);
            }
            $count = $this->reply->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $zfList
            ];
            return json($data);
        }
        $this->assign('aid',$aid);
        return $this->fetch('reply_index');
    }
    public function replyForm(){
        if ($this->request->isPost()) {
            $data = input('');
            $title = $data['id'] ? '编辑' : '新增';
            if (!empty($data['id'])) {     //编辑
                $rs = $this->reply->update($data);
            }else{
                $rs = $this->reply->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->reply->where('id='.$aid)->find($aid);
            $this->assign('info', $info);
            return $this->fetch('reply_form');
        }
    }
    public function delReply()
    {
        $ids = array_unique(input('post.id/a', []));

        foreach ($ids as $val) {
            $rs = $this->reply->where('id', $val)->setField(['status'=>4]);
        }
        unset($val);
        $this->success('删除成功');
    }
    public function vestForm(){
        if ($this->request->isPost()) {
            $data = input('');
            $title = $data['id'] ? '编辑' : '新增';
            //查敏感词
            $sen=Db::table('ecshecom_sensitive_word')->field('word')->select();
            foreach($sen as $key=>$vo){
                if(strstr($data['content'],$vo['word'])){
                    $this->error('评论失败，该内容含有敏感词');
                }
            }
            $data['created_at']=time();
            if (!empty($data['id'])) {     //编辑
                $rs = $this->reply->update($data);
            }else{
                $data['status']=1;
                $rs = $this->reply->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->reply->where('id='.$aid)->find($aid);

            //查询马甲账号
            $user = Db::table('ecshecom_user')->where(['is_vest'=>1,'status'=>1])->field('id,nickname')->select();
            $this->assign('user',$user);
            $this->assign('aid',$aid);
            $this->assign('info', $info);
            return $this->fetch();
        }
    }
    //点赞记录
    public function like(){
        $aid =request()->param('aid');
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $map[]=['r.post_id','eq',$aid];

            $zfList = $this->like->alias('r')
                ->join('ecshecom_user o','o.id=r.user_id')
                ->where($map)
                ->page($page, $limit)
                ->order('r.created_at desc')
                ->field('r.*,o.is_vest,o.nickname')
                ->select();

            foreach($zfList as $key=>$val){

                if($val['is_vest']==1){
                    $zfList[$key]['nickname']=$zfList[$key]['nickname']."<span style='font-size: 6px;color:green;'>[马甲]</span>";
                }
                $zfList[$key]['created_at']=date('Y-m-d H:i:s',$zfList[$key]['created_at']);
            }
            $count = $this->like->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $zfList
            ];
            return json($data);
        }
    }
    public function delLike()
    {
        $ids = array_unique(input('post.id/a', []));

        foreach ($ids as $val) {
            $rs = $this->like->where('id', $val)->delete();
        }
        unset($val);
        $this->success('删除成功');
    }

    //横幅
    public function banner()
    {
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $title = request()->param('title');
            $datestart = request()->param('datestart');
            $dateend = request()->param('dateend');
            $status = request()->param('status');
            if(!empty($title)){
                $map[] = ['a.name', 'like', "%$title%"];
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

            $map[] = ['a.extend', 'eq', 1];
            $zfList = $this->banner->alias('a')
                ->where($map)
                ->page($page, $limit)
                ->order('a.created_at desc')
                ->field('a.*')
                ->select();
            foreach($zfList as $key=>$val){
                if($val['status'] == 1)
                {
                    $zfList[$key]['statusText'] = '开启';
                } else {
                    $zfList[$key]['statusText'] = '关闭';
                }
                if($val['cover']){
                    $zfList[$key]['cover'] = json_decode($val['cover'])[0];
                }else{
                    $zfList[$key]['cover'] ='';
                }

                $zfList[$key]['start_time']=date('Y-m-d H:i:s',$zfList[$key]['start_time']);
                $zfList[$key]['end_time']=date('Y-m-d H:i:s',$zfList[$key]['end_time']);
            }
            $count = $this->banner->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $zfList
            ];
            return json($data);
        }

        return $this->fetch();
    }

    //横幅编辑
    public function bannerForm()
    {
        if ($this->request->isPost()) {
            $data = input('post.', []);
            $title = $data['id'] ? '编辑' : '新增';

            $data['start_time']=time();
            $data['end_time']=time();
            //$data['position'] = array_sum($data['position']);

            if (!empty($data['id'])) {     //编辑
                $rs = $this->banner->update($data);
            }else{
                $data['created_at']=time();
                unset($data['id']);
                $rs = $this->banner->insert($data);
            }
            if ($rs) {
                $this->success($title . '成功');
            } else {
                $this->error($title . '失败');
            }
        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->banner->where('id='.$aid)->find($aid);
            if($info){
                $info['start_time']=date('Y-m-d H:i:s',$info['start_time']);
                $info['end_time']=date('Y-m-d H:i:s',$info['end_time']);
            }
            $this->assign('info', $info);
            return $this->fetch();
        }
    }

    //删除
    public function delBanner()
    {
        $ids = array_unique(input('post.id/a', []));
        foreach ($ids as $val) {
            $rs = Db::table('ecshecom_banner')->where('id', $val)->delete();
        }
        unset($val);
        $this->success('刪除成功');
    }
}