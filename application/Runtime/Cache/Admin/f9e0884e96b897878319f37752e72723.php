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
 <div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">新闻管理</a>><a href="type">新闻分类</a></div>
<div class="bloc">
  <div class="wrap ">
      <dl class="dl_line">
        <dt><a href="typeadd" class="xz">新增</a></dt>
      </dl>
    </div>
</div>
<div class="wrap">
 <div class="wrap"> 
   <table width="100%" cellpadding="0" cellspacing="0" class="list" id="list-table"> 
    <thead> 
    <tr> 
      <th class="text-left" style="padding-left:10px;">分类名称</th> 
	  <th>文章数量</th> 
      <th>排序</th> 
      <th style="width:200px;">操作</th> 
    </tr> 
    </thead>
        <?php if(is_array($alist)): $i = 0; $__LIST__ = $alist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="<?php echo ($vo["pid"]); ?>" id="<?php echo ($vo["pid"]); ?>_<?php echo ($vo["id"]); ?>"> 
		      <td style="padding-left:10px; text-align:left">
		      <?php $__FOR_START_28350__=1;$__FOR_END_28350__=$vo['level'];for($i=$__FOR_START_28350__;$i < $__FOR_END_28350__;$i+=1){ ?>&nbsp;&nbsp;&nbsp;<?php } ?>
		      <img src="/Public/admin/images/menu_minus.gif" id="icon_<?php echo ($vo["pid"]); ?>_<?php echo ($vo["id"]); ?>" onclick="rowClicked(this)" border="0" height="9" width="9"> 
		      <a href="<?php echo U('News/index',array('type_id'=>$vo['id']));?>"><u><?php echo ($vo["name"]); ?></u></a></td> 
			  <td><?php echo ($vo["count"]); ?></td> 
		      <td><?php echo ($vo["sort"]); ?></td> 
		      <td>
		      
		      <a href="<?php echo U('News/typeedit',array('id'=>$vo['id']));?>" class="edit">修改</a>
		      <a href="<?php echo U('News/typedel',array('id'=>$vo['id']));?>" onclick="return confirm('确定删除吗？')" class="delete">删除</a>
		      </td> 
		    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
     	</table> 
 	
         
</div>
</body>
</html>