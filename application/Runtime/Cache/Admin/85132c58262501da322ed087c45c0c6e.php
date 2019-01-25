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
 <div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">系统设置</a>><a href="<?php echo U('Banner/index');?>">首页子Banner设置</a></div>
  <div class="bloc">
    <div class="content">
		<table id="alist" border="0" cellpadding="0" cellspacing="0" width="100%" class="list" style="float:left" >  
			<tbody>
			<tr>
			<th>名称</th>
			<th>显示方式</th>
			<th>文字</th>
			<th>图片</th>
			<th>背景图片</th>
			<th>外链</th>
			<th >操作</th>
			</tr>
			<tr>
			  	<td>首页子Banner</td>
				<td><?php echo ($sub["type"]); ?></td>
				<td><?php echo ($sub["text"]); ?></td>
				<td><img src="<?php echo ($sub["image"]); ?>" width="100" height="33"></td>
				<td><img src="<?php echo ($sub["backgroundimg"]); ?>" width="100" height="33"></td>
				<td><?php echo ((isset($sub["url"]) && ($sub["url"] !== ""))?($sub["url"]):""); ?></td>
				<td class="actions" style="text-align:center; margin-left:10px;"><a href = "<?php echo U('Admin/Banner/subset_edit',array('id'=>$vo['id']));?>" >修改</a> <!-- | <a href="<?php echo U('Admin/Download/viddel',array('id'=>$vo['id']));?>" title="删除">删除</a> --></td>
			 </tr>
			</tbody>
		</table>
	</div>
</div>
</body>
</html>