<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="/Public/admin/js/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/Public/admin/css/min.css" />
<script type="text/javascript" src="/Public/admin/js/min.js"></script>
</head>

<body>
<!--  top -->
<div id="head">
  <div class="left left_a"><a href="#" title="森马"><img src="/Public/admin/images/logo_1.png" width="159" height="40" /></a></div>
  <div class="middle midddle_a"> <a href=""><img src="/Public/admin/images/renwu.png" height="20"  /></a>您好, <a href="#"><?php echo ($thisAdmin["username"]); ?></a><!--<span>代办事务10条  </span> <span>您有1119项事务需要处理</span>-->
<a href="http://114.141.158.34/" target="_blank" alt="访问网站"><img src="/Public/admin/images/wanz.png"  />访问网站</a> 
<a href="<?php echo U('Admin/Main/pass_ed');?>" alt="修改密码" target="main"><img src="/Public/admin/images/mima.png"  alt="修改密码" />修改密码</a><a href="<?php echo U('Admin/Main/loginout');?>" target="_top"><img src="/Public/admin/images/tuichu.png"  />安全退出</a></div>
</div>


</body>
</html>