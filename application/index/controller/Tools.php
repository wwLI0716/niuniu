<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/19
 * Time: 15:52
 */
namespace app\index\controller;

use think\Db;

/**
 * 工具
 * Class Index
 * @package app\wap\controller
 */
class Tools extends Base
{
    public $activityCategory;
    public $activity;
    public $news;
    public $newsType;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->activityCategory = Db::table('ecshecom_activity_category');
        $this->activity = Db::table('ecshecom_activity');
        $this->news = Db::table('ecshecom_portal_post');
        $this->newsType = Db::table('ecshecom_portal_category');
    }

    /**
     * 会员留言
     */
    public function membershipMessage(){
        return $this->fetch();
    }

    /**
     * 保存留言
     */
    public function messageSubmit()
    {
        if (!isset($this->params['liuyan']))
        {
            $this->apiReturn('200', lang('data_exception'), []);
        }
        foreach ($this->params as $k => $v) {
            if ($v == '') {
                $this->apiReturn('200', lang('data_exception'), []);
            }
        }
        if($this->params['liuyan'] == "请输入反馈意见，您的意见是我们改进的动力")
        {
            $this->apiReturn('200', lang('data_exception'), []);
        }

        //当天只能反馈两条
        $beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $where[] = ['user_id','=',$this->userId];
        $where[] = ['status','=',0];
        $where[] = ['created_at', 'between time', [$beginToday, $endToday]];
        $count = $this->activity->where($where)->count();
        if($count >= 2)
        {
            $this->apiReturn('200', "您今日反馈次数已达上限！", []);
        }


        //保存
        $saveData['user_id'] = $this->userId;
        $saveData['description'] = $this->params['liuyan'];
        $saveData['category_id'] = 0;
        $saveData['status'] = 0;
        $saveData['created_at'] = time();

        $res = Db::name('activity')->insert($saveData);
        if($res)
        {
            $this->apiReturn('100', lang('do_success'), []);
        }

        $this->apiReturn('200', lang('do_error'), []);

    }

    /**
     * FAQ文档
     */
    public function faqWord(){
        $typeWhere['show_home'] = 1;
        $typeWhere['is_faq'] = 1;
        $lang = str_replace('-','_',$this->lang);
        $types = $this->newsType->where($typeWhere)->field('id,' . $lang . '_name')->select();
        $newTypes = array();
        for($a=0;$a<count($types);$a++)
        {
            $articleWhere['category_id'] = $types[$a]['id'];
            $articleWhere['post_status'] = 1;
            $articles = Db::name('portal_post')->where($articleWhere)->field($lang.'_post_title,' . $lang . '_post_content')->select();
            $newArticles = array();
            for($b=0;$b<count($articles);$b++)
            {
                $newArticles[$b]['title'] = $articles[$b][$lang.'_post_title'];
                $newArticles[$b]['content'] = $articles[$b][$lang.'_post_content'];
            }
            $newTypes[$a]['articles'] = $newArticles;
            $newTypes[$a]['catename'] = $types[$a][$lang . '_name'];
        }

        $this->assign([
            'newTypes' => $newTypes,
        ]);
        return $this->fetch();
    }
}