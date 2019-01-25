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
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">系统设置</a>><a href="javascript:void(0)">邮件设置</a></div>
<div class="bloc">
  <div class="wrap ">
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" action="<?php echo U('Site/insert');?>">
    <table class="add">
      <tbody>
        <tr>
          <th>邮件服务器：<font class="red">*</font></th>
          <td><input name="email_server" maxlength="100" type="text" class="input" id="email_server" style="width:400px;" value="<?php echo C('email_server');?>">
          <span>如：smtp.126.com</span>
          </td>
        </tr>
        <tr>
          <th>服务器端口：<font class="red">*</font></th>
          <td><input name="email_port" maxlength="100" type="text" class="input" id="email_port" style="width:400px;" value="<?php echo C('email_port');?>">
          <span>一般为25</span>
          </td>
        </tr>
        <tr>
          <th>用户名：<font class="red">*</font></th>
          <td><input name="email_user" maxlength="100" type="text" class="input" id="email_user" style="width:400px;" value="<?php echo C('email_user');?>"></td>
        </tr>
        <tr>
          <th>密  码：<font class="red">*</font></th>
          <td><input name="email_pwd" maxlength="100" type="text" class="input" id="email_pwd" style="width:400px;" value="<?php echo C('email_pwd');?>"></td>
        </tr>
        <tr>
          <th>发送测试邮件：</th>
          <td><input maxlength="100" type="text" class="input" id="toEmail" style="width:300px;"><font id="txtTest"><a href="#" onclick="ToTest();"><u>点我发送测试邮件</u></a></font></td>
        </tr>
        <tr>
          <th>邮件标题</th>
          <td><input name="email_title" maxlength="100" type="text" class="input" id="title" style="width:400px;" value="<?php echo C('email_title');?>"></td>
        </tr>
        <tr>
          <th>邮件内容：</th>
          <td><textarea style=" width:79%; height:50px;" name="email_content" class="input" id="keyword"><?php echo C('email_content');?></textarea>
           </td>
        </tr>
        <input type="hidden" name="files" value="email.php"/>
        <tr>
	      	<th></th>
	        <td><input type="submit" id="btnSubmit" value="确定"></td>
	      </tr>
        </tbody>
      
    </table>
  </form>
</div>
</body>
</html>
<script type="text/javascript"> 
$(document).ready(function() {
	$("#form1").validate({
		rules: {
			email_server: { required: true},
			email_port:{ required: true},
			email_user:{required:true},
			email_pwd:{required:true}
		}
	});
})
function ToTest(){
	var email = $("#toEmail").val();
	if(emailCheck(email)){
		$.ajax({
			type:"get",
			url :"<?php echo U('Site/sendTest');?>",
			data:{email_server:$("#email_server").val(),email_port:$("#email_port").val(),email_user:$("#email_user").val(),email_pwd:$("#email_pwd").val(),toEmail:$("#toEmail").val()},
			beforeSend :function(){
				$("#txtTest").html("<img src='/Public/admin/images/onload.gif'/>&nbsp;正在发送...");
			},
			success: function(msg){
				if(msg=="1"){
					alert('发送成功');
				}else{
					alert('发送失败');
				}
				$("#txtTest").html("<a href=\"#\" onclick=\"ToTest();\" id=\"txtTest\"><u>点我发送测试邮件</u></a>");
			},
			error: function(){
				alert('发生错误');
				$("#txtTest").html("<a href=\"#\" onclick=\"ToTest();\" id=\"txtTest\"><u>点我发送测试邮件</u></a>");
			}
		})
	}else{
		alert("Email输入错误");
	}
}

function emailCheck (emailStr) {
	var emailPat=/^(.+)@(.+)$/;
	var matchArray=emailStr.match(emailPat);
	if (matchArray==null) {
		return false;
	}
	return true;
}
</script>