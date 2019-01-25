<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
 <div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">大爆款模块</a>>产品季管理</div>
  <div class="bloc">
    <div class="content">
        <dl class="dl_line">
			<dt><a href="season_add" class="xz">新增</a> </dt>
			 
        </dl>
	    <form method="post" action="<?php echo U('HotSales/season_del');?>" id="form1">
		<table id="alist" border="0" cellpadding="0" cellspacing="0" width="100%" class="list" style="float:left" >  
			<tbody>
			<tr>
			<th style="width:116px"><input type="checkbox" id="all" class="checkall"/></th>
			<th>序号</th>
			<th >名称</th>  
			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"/></td>
				<td><?php echo ($i); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
			 
				 
			  </tr><?php endforeach; endif; else: echo "" ;endif; ?>        
			</tbody>
		</table>
		<div class="page">
			<dl class="dl_line">
				<dt><input type="submit" class="schu" style="width: 64px; text-align: right; height: 32px; position: absolute; top: 66px; left: 100px; " value="删除" onclick="return listDelete(this.form.name);" id="btnDelete" /></dt>
			</dl>
			<div class="pagination"><?php echo ($page); ?></div>
        </div>
	    </form>
	</div>
</div>
</body>
<script>
$('#type_id').change(function(){
	var type_id=$(this).val();
	var url="<?php echo U('Banner/index');?>";
	window.location.href = url + "?type_id=" + type_id;
})
</script>
</html>