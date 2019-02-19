<?php /* Smarty version Smarty-3.1.11, created on 2016-07-14 03:40:04
         compiled from "templates\Dxsemir\sww_news_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32045763b6de0c1a21-78357344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30fd24cb3dcb7dab878c029bd4eddb02e3f6d757' => 
    array (
      0 => 'templates\\Dxsemir\\sww_news_info.tpl',
      1 => 1468460322,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32045763b6de0c1a21-78357344',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5763b6de1cca52_18559444',
  'variables' => 
  array (
    'web_title' => 0,
    'web_template' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5763b6de1cca52_18559444')) {function content_5763b6de1cca52_18559444($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wwwroot\\httpdocs20160331\\httpdocs\\semirdx\\application\\libraries\\Smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=zh-CN" />
<title><?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
</title>
<meta name="Generator" content="PHP CI">
<meta name="KEYWords" content="<?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
">
<meta name="Description" content="<?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
">
<meta name="Author" content="<?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
">
<meta name="Robots" content= "all">
<link rel="icon" type="image/gif" href="/favicon.jpg">
<link href="/semirdx/templates/public/css/bootstrap.min.css" rel="stylesheet">
<link href="/semirdx/templates/Dxsemir/moban1211/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/semirdx/templates/public/jquery.min.js"></script>
<script type="text/javascript" src="/semirdx/templates/public/js/bootstrap.min.js"></script>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
    <script src="/semirdx/templates/public/respond-1.1.0.min.js"></script>
    <script src="/semirdx/templates/public/html5shiv.js"></script>
    <script src="/semirdx/templates/public/html5element.js"></script>
 <![endif]-->
 <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?2840c87a016f056d075fee306b860d76";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</head>
<body >
<!--Header_top-->
<div  class="top_box">
  <div class="container">
    <div class="hottel  text-right">技术支持电话: 0577-85789999转1号键
      &nbsp;&nbsp;&nbsp;&nbsp;
       技术支持QQ: <img  style="CURSOR: pointer" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=800086115&o=技术支持&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:800086115:3 alt="点击这里给我发消息">
      </div>
    <div  class="logo"><img src="/semirdx/templates/<?php echo $_smarty_tpl->tpl_vars['web_template']->value;?>
/moban1211/images/log.png"></div>
  </div>
</div>
<!--Header_top--> 
<div class="container">
<div class="newsShow">
<?php if (($_smarty_tpl->tpl_vars['data']->value)){?>
<h3><?php echo $_smarty_tpl->tpl_vars['data']->value->title;?>
</h3>
<div class="timeShow"><i class="fa fa-clock-o"></i> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value->time,'%Y-%m-%d %H:%M:%S');?>
</div>
<div class="newscontent"><?php echo $_smarty_tpl->tpl_vars['data']->value->contents;?>
</div>
<?php }else{ ?>
信息已经过时或不存在，请确认！！
<?php }?>
</div>
</div>
</body>
</html><?php }} ?>