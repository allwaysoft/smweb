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
<!--  CONTEN  ---->
<div id="content" class="white">
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">大爆款</a>><a href="import">导入销售数据</a></div>
<div class="bloc">
  <div class="wrap ">
    
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">
    <table class="add">
      <tbody>
      	<tr>
      		<th>导入模板：</th>
      		<td><img alt="" src="/Public/admin/images/execl.png"/><a href="/Public/admin/UploadModel/hotsales.xls">销售数据导入模板下载(.xls文件)</a></td>
      	</tr>
        <tr>
          <th>导入文件：<font class="red">*</font></th>
          <td><input class="btnGray" type="file" name="inputExcel" id="inputExcel" /></td>
        </tr>
        <tr><th></th><td><input id="loaddata" class="btnGray" type="submit" value="导入数据"/>   <a href="hnImport" target="_blank">导入HANA数据(Test)</a></td></tr>
      </tbody>
    </table>
  </form>
</div>
<script type="text/javascript"> 
$("#loaddata").click(function(){
	  var val=$("#inputExcel").val();
	  if(val!=''){
		  var extStart=val.lastIndexOf(".");
        var ext=val.substring(extStart,val.length).toUpperCase(); 
        if(ext!='.XLS'){
      	  alert("文件格式不正确，请上传xls文件");
      	  return false;
        }
	  }else{
		  alert("请选择上传文件")
		  return false;  
	  }	  
})
</script>
</div>
</body>
</html>