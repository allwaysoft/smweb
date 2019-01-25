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
  <div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">系统设置</a>><a href="index">服务器信息</a></div>
  <div class="bloc">
    <div class="wrap ">
    <form action="<?php echo U('del');?>" method="get">
      <dl class="dl_line">
        <dt>
	        <dl class="dl_line">
	        <dt><a href="add" class="xz">新增</a>
	        <input type="submit" class="schu" value="批量删除" onclick="return listDelete(this.form.name);" id="btnDelete" />
	        </dt>
	      </dl>
        </dt>
        <dd style="width:500px; float:right; margin-top:10px;  text-align:right;">
          <input type="text" name="keyword" id="keyword" value="<?php echo ($_REQUEST['keyword']); ?>" title="产品款号搜索" onfocus="this.value='';" style="width:150px; display:inline-block;"/>
          <input type="submit" name="button" id="btnSearch" value=" 搜 索 " />
        </dd>
      </dl>
      <table width="100%" cellpadding="0" cellspacing="0" class="list">
        <thead>
          <tr>
            <th style="width:50px;"><input type="checkbox" id="all" /></th>
            <th>序号</th>
            <th class="text-left">名称</th>
            <th>服务器外网地址</th>
            <th>服务器内网地址</th>
            <th>数据库地址</th>
            <th>日期</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><input type="checkbox" name="Id[]" value="<?php echo ($vo["Id"]); ?>" /></td>
             <td><?php echo ($i); ?></td>
            <td style="text-align:left;"><?php echo ($vo["Name"]); ?></td>
            <td>
             <?php echo ($vo["ExtranetUrl"]); ?>
            </td>
            <td><?php echo ($vo["IntranetUrl"]); ?></td>
            <td><?php echo ($vo["DatabaseUrl"]); ?></td >
            <td><?php echo ($vo["CreateTime"]); ?></td>
            <td><a href="<?php echo U('info',array('Id'=>$vo['Id']));?>" class="edit">查看</a><a href="<?php echo U('del',array('Id'=>$vo['Id']));?>" class="edit">删除</a></td>
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