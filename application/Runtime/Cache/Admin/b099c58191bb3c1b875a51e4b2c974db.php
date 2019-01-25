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
  <div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="<?php echo U('index');?>">廉洁森马</a>><a href="<?php echo U('index');?>">投诉列表</a></div>
  <div class="bloc">
    <div class="wrap ">
    <form action="" method="get">
      <dl class="dl_line">
        <dt></dt>
        <dd style="width:500px; float:right; margin-top:10px;  text-align:right;">
          <select id="Status" name="Status" style="display:inline-block;">
            <option value="">﹄ 请选择...</option>
            <option value="0" <?php if(($_GET['Status']) == "0"): ?>selected="selected"<?php endif; ?>>﹄ 未处理</option>
            <option value="1" <?php if(($_GET['Status']) == "1"): ?>selected="selected"<?php endif; ?>>﹄ 处理中 </option>
            <option value="2" <?php if(($_GET['Status']) == "2"): ?>selected="selected"<?php endif; ?>>﹄ 完结 </option>
          </select>
          <input type="submit" name="button" id="btnSearch" value=" 搜 索 " />
        </dd>
      </dl>
   </form>
    </div>
  </div>
  <div class="wrap">
    <form method="post" action="" id="form1">
      <table width="100%" cellpadding="0" cellspacing="0" class="list">
        <thead>
          <tr>
            <th style="width:50px;"><input type="checkbox" id="all" /></th>
            <th>序号</th>
            <th class="text-left">投诉人</th>
            <th>投诉人类型</th>
            <th>联系电话</th>
            <th>联系邮箱</th>
            <th>投诉日期</th>
            <th>处理状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><input type="checkbox" name="id[]" value="2" /></td>
             <td><?php echo ($i); ?></td>
            <td style="text-align:left;"><?php echo ($vo["ReportName"]); ?></td>
            <td>
            	<?php if(($vo["ReportObjectId"]) == "1"): ?>员工<?php endif; ?>
            	<?php if(($vo["ReportObjectId"]) == "2"): ?>供应商<?php endif; ?>
            	<?php if(($vo["ReportObjectId"]) == "3"): ?>代理商<?php endif; ?>
            	<?php if(($vo["ReportObjectId"]) == "4"): ?>合作伙伴/其他<?php endif; ?>
            </td>
            <td><?php echo ($vo["Mobile"]); ?></td>
            <td><?php echo ($vo["Email"]); ?></td>
            <td><?php echo ($vo["CreateTime"]); ?></td>
            <td>
            	<?php if(($vo["Status"]) == "0"): ?>未处理<?php endif; ?>
            	<?php if(($vo["Status"]) == "1"): ?>处理中<?php endif; ?>
            	<?php if(($vo["Status"]) == "2"): ?>完结<?php endif; ?>
            </td>
            <td><a href="<?php echo U('Reportcms/detail',array('id'=>$vo['Id']));?>" class="edit">查看</a><a href="<?php echo U('Reportcms/del',array('id'=>$vo['Id']));?>" class="edit">删除</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
      <div class="page">
        <div class="pagination"><?php echo ($page); ?></div>
      </div>
    </form>
  </div>
</div>
</body>
</html>