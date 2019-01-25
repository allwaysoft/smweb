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
<!-- <script type="text/javascript" src="/Public/admin/js/jquery-1.2.6.pack.js"></script> -->
<script type="text/javascript"
	src="/Public/admin/js/jquery.imagePreview.1.0.js"></script>
<script type="text/javascript">
	$(function() {
		$("a.preview").preview();
	});
</script>
<style>
.photo_list li {
	list-style: none;
	float: left;
}

th {
	font-weight: 800;
}
</style>
<!--   CONTENT  ---->
<div id="content" class="white">
	<div class="mbxie">
		<a href="" class="first_a"><img
			src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img
			src="/Public/admin/images/home1.jpg" width="20" height="12" /><a
			href="<?php echo U('Admin/Main/main');?>" style="padding-left: 3px;">首页</a>><a
			href="javascript:void(0)">商品管理</a>><a href="<?php echo U('Product/index');?>">商品列表</a>><a
			href="<?php echo U('Product/edit',array('id'=>$thisInfo['id']));?>">修改商品</a>
	</div>
	<div class="bloc">
		<div class="wrap "></div>
	</div>
	<div class="wrap">
		<table class="add">
			<tbody>
				<tr>
					<th colspan="4" style="font-size: 14px; text-align: left;"><font
						class="red">*</font>举报人的信息</th>
				</tr>
				<tr>
					<th>投诉人：</th>
					<td width="150"><?php echo ($info["ReportName"]); ?></td>
					<th>投诉人类型：</th>
					<td><?php if(($info["ReportObjectId"]) == "1"): ?>员工<?php endif; ?> <?php if(($info["ReportObjectId"]) == "2"): ?>供应商<?php endif; ?> <?php if(($info["ReportObjectId"]) == "3"): ?>代理商<?php endif; ?> <?php if(($info["ReportObjectId"]) == "4"): ?>合作伙伴/其他<?php endif; ?></td>
				</tr>
				<tr>
					<th>联系电话：</th>
					<td><?php echo ($info["Mobile"]); ?></td>
					<th>联系邮箱：</th>
					<td><?php echo ((isset($info["Email"]) && ($info["Email"] !== ""))?($info["Email"]):'--'); ?></td>
				</tr>
				<tr>
					<th colspan="4" style="font-size: 14px; text-align: left;"><font
						class="red">*</font>被举报人的信息</th>
				</tr>
				<tr>
					<th>姓名：</th>
					<td><?php echo ($info["Name"]); ?></td>
					<th>所在部门：</th>
					<td><?php echo ($info["Department"]); ?></td>
				</tr>
				<tr>
					<th>职位：</th>
					<td><?php echo ($info["Position"]); ?></td>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th>举报内容：</th>
					<td colspan="3"><textarea style="width: 79%; height: 80px;"
							readonly="readonly" class="input" id="description"><?php echo ($info["Content"]); ?></textarea></td>
				</tr>
				<?php if(!empty($info["FilesUrl"])): ?><tr>
					<th>举报材料：</th>
					<td colspan="3">
						<table cellpadding="0" cellspacing="0"
							style="width: 80%; border: 1px solid #CCC">

							<tr>
								<td>
									<ul class="photo_list" style="text-align: center">
										<?php if(is_array($info["FilesUrl"])): $i = 0; $__LIST__ = $info["FilesUrl"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="margin: 0 15px;"><a class="preview"
											href="<?php echo ($vo); ?>" title="<?php echo ($vo); ?>"> <img src="<?php echo ($vo); ?>"
												width="80" height="100" />
										</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</td>
							</tr>
						</table>
					</td>
				</tr><?php endif; ?>
			</tbody>
		</table>
		<table class="add">
			<tbody>
				<?php if(!empty($info["Result"])): ?><tr>
					<th style="font-size: 14px; text-align: left;"><font
						class="red">*</font>处理结果</th>
				</tr>
				<?php if(is_array($info["Result"])): $i = 0; $__LIST__ = $info["Result"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td>
						<div style="border: 1px solid #ccc; width: 70%; margin: 0 13%">
							<table>
								<tr>
									<th>处理人：</th>
									<td width="100"><?php echo ($vo["HandleUser"]); ?></td>
									<th>处理状态：</th>
									<td width="100"><?php if(($vo["ReportStatus"]) == "1"): ?>处理中<?php endif; ?>
										<?php if(($vo["ReportStatus"]) == "2"): ?>完结<?php endif; ?></td>
									<th>处理时间：</th>
									<td><?php echo ($vo["HandleTime"]); ?></td>
								</tr>
								<tr>
									<th>处理意见：</th>
									<td colspan="5"><?php echo ($vo["HandleResult"]); ?></td>
								</tr>
							</table>
						</div>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</tbody>
		</table>
		<?php if(($info["Status"]) == "2"): ?><table class="add">
			<tbody>
				<tr>
					<th></th>
					<td><input name="btnBack" type="button" id="btnBack"
						value="返回"></td>
				</tr>
			</tbody>
		</table>
		<?php else: ?>
		<form id="form1" name="form1" method="post" action="<?php echo U('edit');?>">
			<table class="add">
				<tbody>
					<input type="hidden" name="Id" value="<?php echo ($info["Id"]); ?>">
					<tr>
						<th colspan="4" style="font-size: 14px; text-align: left;"><font
							class="red">*</font>处理操作</th>
					</tr>
					<tr>
						<th>处理状态：</th>
						<td colspan="3"><input type="radio" name="Status" value="1"
							checked="checked">处理中&nbsp;&nbsp; <input type="radio"
							name="Status" value="2">完结&nbsp;&nbsp;</td>
					</tr>
					<tr>
						<th>处理意见：</th>
						<td colspan="3"><textarea style="width: 79%; height: 80px;"
								name="HandleResult" class="input" id="HandleResult"><?php echo ($info["HandleResult"]); ?></textarea></td>
					</tr>
					<tr>
						<th></th>
						<td><input name="btnSubmit" type="submit" id="btnSubmit"
							value="确定"> <input name="btnBack" type="button"
							id="btnBack" value="返回"></td>
					</tr>
				</tbody>
			</table>
		</form><?php endif; ?>
	</div>
	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#form1").validate({
				rules : {
					HandleResult : {
						required : true
					}
				}
			});
		})
	</script>