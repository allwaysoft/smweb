<?php
return array(
	//'配置项'=>'配置值'
		'LOAD_EXT_CONFIG'  =>   'db,tags,safe,site,email,sms,stateset,resetpwd',				 //加载扩展配置文件
		'TMPL_L_DELIM'     =>   '<{',				 //左界定符
		'TMPL_R_DELIM'     =>   '}>',                //右界定符
		'TMPL_CACHE_ON'	   =>   false,				 //关闭缓存
		'VIEW_PATH'        =>   './Tpl/',            //模板目录
		'SHOW_PAGE_TRACE'  =>	false,                //开启页面trace
);
?>