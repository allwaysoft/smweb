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
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">系统设置</a>><a href="javascript:void(0)">站点设置</a></div>
<div class="bloc">
  <div class="wrap ">
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" action="<?php echo U('Site/insert');?>">
    <table class="add">
      <tbody>
        <tr>
          <th>网站名称：<font class="red">*</font></th>
          <td><input name="site_name" maxlength="100" type="text" class="input" id="title" style="width:400px;" value="<?php echo C('site_name');?>"></td>
        </tr>
        <tr>
          <th>网站标题：<font class="red">*</font></th>
          <td><input name="site_title" maxlength="100" type="text" class="input" id="title" style="width:400px;" value="<?php echo C('site_title');?>"></td>
        </tr>
        <tr>
          <th>网站地址：<font class="red">*</font></th>
          <td><input name="site_url" maxlength="100" type="text" class="input" id="title" style="width:400px;" value="<?php echo C('site_url');?>"><span>&nbsp;&nbsp;例:http://pigcms.cn</span></td>
        </tr>
        <tr>
          <th>网站备案：<font class="red">*</font></th>
          <td><input name="ipc" maxlength="100" type="text" class="input" id="title" style="width:400px;" value="<?php echo C('ipc');?>"></td>
        </tr>
        <tr>
          <th>客服QQ：<font class="red">*</font></th>
          <td><input name="site_qq" maxlength="100" type="text" class="input" id="title" style="width:400px;" value="<?php echo C('site_qq');?>"></td>
        </tr>
        <tr>
          <th>网站关键字：</th>
          <td><textarea style=" width:79%; height:50px;" name="keyword" class="input" id="keyword"><?php echo C('keyword');?></textarea>
            <span>网页SEO优化，多个用","号隔开</span></td>
        </tr>
        <tr>
          <th>网站描述：</th>
          <td><textarea style=" width:79%; height:50px;" name="description" class="input" id="description"><?php echo C('description');?></textarea>
            <span>网页SEO优化，文章的简单描述</span></td>
        </tr>
        <tr>
          <th>网站版权：<font class="red">*</font></th>
          <td><input name="copyright" maxlength="100" type="text" class="input" id="title" style="width:400px;" value="<?php echo C('copyright');?>"></td>
        </tr>
        <input type="hidden" name="files" value="site.php"/>
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
			title: { required: true},
			type_id:{ required: true},
			time:{required:true},
			endtime:{required:true}
		}/* ,
		submitHandler:function(form){
			$("#btnSubmit").attr("disabled",true);
			form.submit();
		} */
	});
})
</script>