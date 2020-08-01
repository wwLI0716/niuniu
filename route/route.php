<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::domain('hqlyapp.jinzhifm.com', 'index'); //会员中心
Route::domain('hqlyma.jinzhifm.com', 'admin'); //后台

Route::get('hello/:name', 'index/hello');
Route::post('getArticleList','article/index/getArticleList');
Route::get('getArticleDetail/:id','article/index/getArticleDetail');
return [

];
