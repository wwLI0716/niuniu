<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/13
 * Time: 14:04
 */
namespace app\admin\controller;
use app\admin\model\AdminLog;
use app\admin\model\Version AS adminVersion;
use think\response\Json;
use think\Db;

/**
 * 版本管理
 * Class Version
 * @package app\admin\controller
 */
class Version extends Base
{

    protected $version;
    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->version = model('admin/Version');
    }

    /**
     * 版本列表
     * @return mixed|Json
     */
    public function versionList()
    {
        if ($this->request->isAjax()) {
            $page = input('get.page/d', 1);
            $limit = input('get.limit/d', 20);
            $name = request()->param('name');
            $map = array();
            $list = $this->version
                ->page($page, $limit)
                ->order('id desc')
                ->select();
            foreach ($list as &$val) {
                $val['platform'] = isset(adminVersion::$platform_config[$val['platform']]) ? adminVersion::$platform_config[$val['platform']] : '';
            }
            unset($val);
            $count = $this->version->where($map)->count();
            $data = [
                'code' => 0,
                'msg' => '数据返回成功',
                'count' => $count,
                'data' => $list,
            ];
            return json($data);
        }

        return $this->fetch();
    }

    /**
     * 版本记录删除
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function delVersion()
    {
        $ids = array_unique(input('post.id/a', []));
        foreach ($ids as $val) {
            $rs = $this->version->where('id', $val)->delete();
        }
        AdminLog::setTitle('删除成功');
        $this->success('删除成功');
    }

    /**
     * 编辑新增版本
     * @return mixed
     */
    public function versionForm()
    {
        if ($this->request->isPost()) {
            $data = input('');
            $title = $data['id'] ? '编辑' : '新增';
            if($data['id'])
            {
                if ($this->version->update($data)) {
                    AdminLog::setTitle($title . '版本成功');
                    $this->success($title . '成功');
                } else {
                    AdminLog::setTitle($title . '版本失败');
                    $this->error($title . '失败');
                }
            } else {
                if ($this->version->save($data)) {
                    AdminLog::setTitle($title . '版本成功');
                    $this->success($title . '成功');
                } else {
                    AdminLog::setTitle($title . '版本失败');
                    $this->error($title . '失败');
                }
            }

        } else {
            $aid = input('get.aid/d', 0);
            $info = $this->version->where('id='.$aid)->find($aid);
            $platform_list = adminVersion::$platform_config;
            $this->assign('info', $info);
            $this->assign('platform_list', $platform_list);
            return $this->fetch();
        }
    }
}