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
  <div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="<?php echo U('Main/pmess',array('id'=>$mess['id']));?>">个人信息</a></div>
  <div class="wrap">
    <form method="post" action="" id="form1">
      <table width="100%" cellpadding="0" cellspacing="0" class="list" >
        <thead>
          <tr class="first">
            <th class="text-left">登录用户名 </th>
            <th>姓名</th>
            <th>角色</th>
            <th>状态</th>
            <th>最后登录时间</th>
            <th>创建时间</th>
            <th >操作</th>
          </tr>
        </thead>
        <tbody>
          <tr class="odd">
            <td ><?php echo ($mess["user_id"]); ?></td>
            <td><?php echo ($mess["username"]); ?></td>
            <td><?php echo ($role["name"]); ?></td>
            <td><?php if($mess["state_id"] == 1): ?><img src="/Public/admin/images/success.gif" /><?php else: ?><img src="/Public/admin/images/error.gif" /><?php endif; ?></td>
            <td><?php echo (date("Y-m-d H:i:s",$mess["last_time"])); ?></td>
            <td><?php echo (date("Y-m-d H:i:s",$mess["create_time"])); ?></td>
            <td><a href="<?php echo U('Admin/Main/pedit',array('id'=>$mess['id']));?>" class="edit">修改</a></td>
          </tr>  
        </tbody>
      </table>
    </form>
  </div>
</div>
</body>
</html>