<?php
//后台入口文件
if(version_compare(PHP_VERSION, '5.3.0','<')) die('require PHP > 5.3.0!');
define('APP_DEBUG', TRUE);				//开启调试模式
define('BIND_MODULE', 'Admin');			//绑定Admin模块
define('APP_PATH', './Application/');	//定义应用目录
require './ThinkPHP/ThinkPHP.php';		//引用Thinkphp入口文件