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
<style>
.add tr th{text-align:right;}
</style>
<div id="content" class="white">
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">系统设置</a>><a href="javascript:void(0)">密码重置设定</a></div>
<div class="bloc">
  <div class="wrap ">
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" action="<?php echo U('Resetpwd/insert');?>">
    <table class="add" style="border: 1px solid #CCC;width:80%; margin:40px auto;">
      <tbody>
        <tr>
          <th>前台本地用户：</th><td><input type="text" name="reception_pwd" value="<?php echo C('reception_pwd');?>" style="width:400px;"/></td>
        </tr>
        <tr>
          <th>后台用户：</th><td><input type="text" name="backstage_pwd" value="<?php echo C('backstage_pwd');?>" style="width:400px;"/></td>
        </tr>
        <tr>
          <th>是否发送邮件：</th><td><input type="radio" name="send_mail" <?php if(($send_mail) == "1"): ?>checked="checked"<?php endif; ?> value="1"/>是&nbsp;&nbsp;<input type="radio" name="send_mail" <?php if(($send_mail) == "0"): ?>checked="checked"<?php endif; ?> value="0"/>否</td>
        </tr>
        <tr>
        	<th></th>
	        <td>
         	<input type="hidden" name="files" value="resetpwd.php"/>
         	</td>
         </tr>
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
<script>
$(document).ready(function() {
	$("#form1").validate({
		rules: {
			reception_pwd: { required: true},
			backstage_pwd:{ required: true},
			send_mail:{required:true}
		}
	});
})
</script>