<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="utf-8">
<head>
<title><?php echo C('site_title');?></title>
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('description');?>" />
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1.5, user-scalable=yes"> 
<!-- Loading Bootstrap -->
<link href="/<?php echo c('VIEW_PATH');?>wxqyh/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" media="screen,projection" type="text/css" href="/<?php echo c('VIEW_PATH');?>wxqyh/dist/css/wx.css" />
<link rel="icon" type="image/gif" href="/favicon.jpg">

<!-- GRAPHIC THEME -->

<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>wxqyh/dist/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>wxqyh/dist/js/bootstrap.min.js"></script> 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
      <script src="<?php echo c('VIEW_PATH');?>wxqyh/dist/js/vendor/html5shiv.js"></script>
      <script src="<?php echo c('VIEW_PATH');?>wxqyh/dist/js/vendor/respond.min.js"></script>
    <![endif]-->

 
   
</head>
<body>
<a name="top" id="top"></a> 
<div class="container">

<div class="row">


 
<div class="container">

<div class="row">
<div class="col-md-12" >
<div class="logo"><img src="/Public/home/images/logo_03.png" class="img-responsive"  /> </div>
 <div class="panel  panel-default">
 <div class="panel-heading">
   用户登录
  </div>
  <div class="panel-body">
  	 <form action="" id="loginform" name="loginform" role="form"    >
    <div class="form-group ">
      <label class=" control-label" for="sendname">登录账号</label>
      <input name="sendname" type="text" class="form-control" id="sendname"  placeholder="请输入您的登录账号" />
    </div>
    <div class="form-group ">
      <label class="control-label" for="pword">登陆密码</label>
      <input name="pword" type="password" class="form-control" id="pword"  placeholder="请输入您的登录密码"/>
    </div>
    <div class="form-group ">
      <input name="sendemail" type="submit" class="btn btn-large btn-block btn-primary" id="sendemail" value="立即登陆" />
    </div>
  </form>
  </div>
  <div class="panel-footer">
 	<small>商品售后服务热线：400-8877-588，技术支持专线：0577-85789999</small>
   </div>
  </div>
  </div>
  </div>
</div>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>wxqyh/bootstrapvalidator/js/bootstrapValidator.js"></script> 
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>wxqyh/dist/login.js"></script>
</body></html>