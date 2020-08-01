<?php
	/******一般不需要改这个*******/
	define('APP_DIR_UCPAAS',dirname(__file__)); 
	defined('DS') or define('DS', DIRECTORY_SEPARATOR); 
	//加载config
	require  APP_DIR_UCPAAS.DS.'config.php';
	//插件自动加载
	spl_autoload_register('ucpaas_autoload'); 
	function ucpaas_autoload($class){   
		foreach(array(APP_DIR_UCPAAS.DS.$class.'.class.php',
					  APP_DIR_UCPAAS.DS.$class.DS.$class.'.class.php',
					  APP_DIR_UCPAAS.DS.'core'.DS.$class.'.class.php',
					  APP_DIR_UCPAAS.DS.'core'.DS.$class.DS.$class.'.class.php')as $file)
		{
			if(file_exists($file))
			{
				include $file;
				return;
			}
		} 
	} 	
?>