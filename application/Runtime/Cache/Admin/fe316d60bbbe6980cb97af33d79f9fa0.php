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
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">系统设置</a>><a href="index">超链接设置</a>><a href="add">添加</a></div>
<div class="bloc">
  <div class="wrap ">
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" action="#">
    <table class="add">
      <tbody>
        <tr>
          <th>链接名称：<font class="red">*</font></th>
          <td><input name="name" maxlength="100" type="text" class="input" id="title" style="width:400px;" value=""></td>
        </tr>
        <tr>
          <th>显示位置：<font class="red">*</font></th>
          <td>
            <select select id="type_id" name="type_id" class="valid">
			  <option value="">﹄ 请选择...</option>
			  <option value=1>﹄ 顶部</option>
			  <option value=2>﹄ 底部</option>
			  <option value=3>﹄ 右侧</option>
			  <option value=4>﹄ 实用工具</option>
		    </select>
		  </td>
        </tr>
        <tr id="small_img"> 
		    <th>上传图标：</th>
		    <td>
		    <input name="image" maxlength="100" type="text" class="input" id="simage" style="width:400px;" value="" />      
		    <br />
		    <input id="image_upload" type="file" name="Filedata" /> 
		    <span class="imgbox"><img src="" height="38" id="spic" style="margin-top:8px;" /></span> 
		    <td>
		</tr>
        <tr>
          <th>显示方式：</th>
          <td><input name="ispic" type="radio" value="1" checked="checked">图片&nbsp;&nbsp;<input name="ispic" type="radio" value="0">文字</td>
        </tr>
        <tr>
          <th>链接方式：</th>
          <td><input name="isin" type="radio" value="1" checked="checked">站内&nbsp;&nbsp;<input name="isin" type="radio" value="0">站外</td>
        </tr>
        <tr>
          <th>区域筛选：</th>
          <td><input name="isarea" type="radio" value="0" checked="checked">否&nbsp;&nbsp;<input name="isarea" type="radio" value="1">是</td>
        </tr>
        <tr>
          <th>链接地址：</th>
          <td><input name="url" maxlength="100" type="text" class="input" id="title" style="width:400px;" value=""></td>
        </tr>
        <tr>
          <th>排序：<font class="red">*</font></th>
          <td><input name="sort" type="text" class="input" value="0" id="sort" maxlength="5" style="width:50px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"></td>
        </tr>
        <tr>
          <th>前台隐藏：</th>
          <td><input name="display" type="radio" value="0" checked="checked">否&nbsp;&nbsp;<input name="display" type="radio" value="1" >是</td>
        </tr>
        <th></th>
			<td>
			  <input name="btnSubmit" type="submit" id="btnSubmit" value="确定">
			  <input name="btnReset" type="reset" id="btnReset" value="清除">
			  <input name="btnBack" type="button" id="btnBack" value="返回">
			</td>
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
$(function() {
		$('#image_upload').uploadify({
		  'uploader'  : '/Public/admin/uploadify/uploadify.swf',
		  'script'    : '<?php echo U("Upload/upload");?>',
		  'folder'	  : '',
		  'cancelImg' : '/Public/admin/uploadify/cancel.png',
		  'removeCompleted' : true,
		  'auto':true,
		  'buttonText': 'SELECT IMAGE',
		  'fileExt'     : '*.jpg; *.gif; *.png',
		  'fileDesc'    : 'Select Files *.jpg; *.gif; *.png',
		  'onCancel'    : function(event,ID,fileObj,data) {
      		  $("#btnSubmit").attr("disabled",false);
    	  },
		  'onSelect':function(event,ID,fileObj) {
			  $("#btnSubmit").attr("disabled",true);
		  },
		  'onComplete' :function(event,queueID,fileObj,response,data){
			   $("#simage").val(response);
			   $("#spic").attr("src",response);
			   $("#btnSubmit").attr("disabled",false);
		  }
		});	

	
		showSmallImg($("#autoSimg").attr("checked"));
	});
if($("#contents").val()!=undefined){
		var editor = CKEDITOR.replace( 'contents' );
		CKFinder.setupCKEditor( editor, '/Public/admin/js/ckfinder/' ) ;
	}

</script>