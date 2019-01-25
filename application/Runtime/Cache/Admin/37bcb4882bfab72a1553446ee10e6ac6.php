<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>森马管理后台</title>
<!-- jQuery AND jQueryUI -->
<script type="text/javascript" src="/Public/admin/js/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/Public/admin/css/min.css" />
<!-- <script type="text/javascript" src="/Public/admin/js/min.js"></script> -->
<script type="text/javascript" src="/Public/admin/js/jquery.validate.js"></script>
<script  type="text/javascript" src="/Public/admin/js/validate_expand.js"></script>
<link rel='stylesheet' type='text/css' href='/Public/admin/treetable/admin_style.css' /> 
<script type="text/javascript" src="/Public/admin/treetable/jquery.treetable.js"></script>
<script type="text/javascript" src="/Public/admin/js/My97DatePicker/WdatePicker.js"></script>
<!-- <script type="text/javascript" src="/Public/admin/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/Public/admin/js/ckfinder/ckfinder.js"></script> -->
<!-- <script type="text/javascript" charset="utf-8" src="/Public/admin/js/ueditor1_4_3-utf8-php/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/admin/js/ueditor1_4_3-utf8-php/ueditor.all.min.js"> </script> -->
<link rel="stylesheet" href="/Public/admin/js/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/Public/admin/js/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/Public/admin/js/kindeditor/lang/zh_CN.js"></script>
<link rel='stylesheet' type='text/css' href='/Public/admin/treetable/css/jquery.treeTable.css' />
<script language="javascript" type="text/javascript" src="/Public/admin/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<link rel="stylesheet" href="/Public/admin/uploadify/uploadify.css" type="text/css" /> 
<script language="javascript" type="text/javascript" src="/Public/admin/uploadify/swfobject.js"></script>
<script language="javascript" type="text/javascript" src="/Public/admin/js/html.js"></script>
</head>
<style>
label{color:red; margin-left:4px;}
</style>
<body>
<!--   CONTENT  ---->
<div id="content" class="white">
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">系统设置</a>><a href="javascript:void(0)">前台用户状态设置</a></div>
<div class="bloc">
  <div class="wrap ">
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" action="<?php echo U('Stateset/insert');?>">
    <table class="add" style="border: 1px solid #CCC;width:80%; margin:15px 0;">
      <tbody>
        <tr>
          <td colspan="6">本地用户：</td>
        </tr>
        <tr>
          <th>活跃：<font class="red">*</font></th>
          <td><input name="local_active" type="number" class="input" id="title" style="width:50px;" value="<?php echo C('local_active');?>">天</td>
        
          <th>空闲：<font class="red">*</font></th>
          <td><input name="local_free" type="number" class="input" id="title" style="width:50px;" value="<?php echo C('local_free');?>">天</td>
        
          <th>锁定：<font class="red">*</font></th>
          <td><input name="local_lock"  type="number" class="input" id="title" style="width:50px;" value="<?php echo C('local_lock');?>">天</td>
        </tr>
        </tbody>
    </table>
    <table class="add" style="border: 1px solid #CCC;width:80%; margin:15px 0;">
      <tbody>
        <tr>
          <td colspan="6">网域用户：</td>
        </tr>
        <tr>
          <th>活跃：<font class="red">*</font></th>
          <td><input name="domain_active" type="number" class="input" id="title" style="width:50px;" value="<?php echo C('domain_active');?>">天</td>
        
          <th>空闲：<font class="red">*</font></th>
          <td><input name="domain_free" type="number" class="input" id="title" style="width:50px;" value="<?php echo C('domain_free');?>">天</td>
        
          <th>锁定：<font class="red">*</font></th>
          <td><input name="domain_lock"  type="number" class="input" id="title" style="width:50px;" value="<?php echo C('domain_lock');?>">天</td>
        </tr>
    </table>
     <table class="add" style="border: 1px solid #CCC;width:80%; margin:15px 0;">
      <tbody>
        <tr>
          <td colspan="6">分销用户：</td>
        </tr>
        <tr>
          <th>活跃：<font class="red">*</font></th>
          <td><input name="drp_active" type="number" class="input" id="title" style="width:50px;" value="<?php echo C('drp_active');?>">天</td>
        
          <th>空闲：<font class="red">*</font></th>
          <td><input name="drp_free" type="number" class="input" id="title" style="width:50px;" value="<?php echo C('drp_free');?>">天</td>
        
          <th>锁定：<font class="red">*</font></th>
          <td><input name="drp_lock"  type="number" class="input" id="title" style="width:50px;" value="<?php echo C('drp_lock');?>">天</td>
        </tr>
    </table>
    <table class="add" >
      <tbody>
        <input type="hidden" name="files" value="stateset.php"/>
        <tr>
	      	<th></th>
	        <td><input type="submit" id="btnSubmit" value="保存"></td>
	      </tr>
        </tbody>
      
    </table>
  </form>
</div>
</body>
</html>