<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义目录分隔符
define('DS', DIRECTORY_SEPARATOR);
// 定义应用目录
define('APP_PATH', dirname(__DIR__) . '/application/');
//定义公共目录
define('PUBLIC_PATH', __DIR__ . DS);
// 定义根目录
define('ROOT_PATH', dirname(__DIR__) . '/');
define('RUNTIME_PATH',dirname(dirname(__DIR__)) . '/data/runtime/');

// 加载框架引导文件
require dirname(__DIR__) . '/framework/start.php';
