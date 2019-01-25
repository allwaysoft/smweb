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
  <div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">新闻管理</a>><a href="<?php echo U('News/manager');?>">子管理员列表</a></div>
  <div class="bloc">
    <div class="wrap ">
    <form action="" method="get" id="searchForm">
      <dl class="dl_line">
        <dd >
          <input type="text" name="keyword" id="keyword" value="" onfocus="this.value='';" value="<?php echo ($keyword); ?>" />
          <input type="submit" name="button" id="btnSearch" value=" 搜 索 " />
        </dd>
      </dl>
      </form>
      <form method="post" action="<?php echo U('News/managerdel');?>" id="form1">
      <?php if(($_SESSION['uid']) != "1"): ?><dl class="dl_line">
        <dt><a href="manageradd.html" class="xz">新增</a><input type="submit" class="schu" value="批量删除" onclick="return listDelete(this.form.name);" id="btnDelete" /></dt>
      </dl><?php endif; ?>
      <div class="content">
      	 <table width="100%" cellpadding="0" cellspacing="0" class="list" >
        <thead>
          <tr class="first">
            <th ><input type="checkbox" id="all" /></th>
            <th class="text-left">登录用户名 </th>
            <th>姓名</th>
            <th>角色</th>
            <th>状态</th>
            <th>最后登录时间</th>
            <th>创建时间</th>
            <?php if(($_SESSION['role_id']) != "1"): ?><th >操作</th><?php endif; ?>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd">
            <td><?php if($vo["id"] != 1): ?><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" /><?php endif; ?></td>
            <td ><?php echo ($vo["user_id"]); ?></td>
            <td><?php echo ($vo["username"]); ?></td>
            <td><?php echo ($vo["role_name"]); ?></td>
            <td><?php if($vo["state_id"] == 1): ?><img src="/Public/admin/images/success.gif" /><?php else: ?><img src="/Public/admin/images/error.gif" /><?php endif; ?></td>
            <td><?php echo (date("Y-m-d H:i:s",$vo["last_time"])); ?></td>
            <td><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
            <?php if(($_SESSION['uid']) != "1"): ?><td>
            	<a href="<?php echo U('News/manageredit',array('id'=>$vo['id']));?>">修改</a>
            	<a href="<?php echo U('News/managerdel',array('id'=>$vo['id']));?>">删除</a>
            	<a href="<?php echo U('News/newsnode',array('id'=>$vo['id']));?>">模块分配</a>
            	<a id="no<?php echo ($vo["id"]); ?>" href="javascript:void(0)" onclick="ResetPwd(<?php echo ($vo["id"]); ?>)">密码重置</a>
            </td><?php endif; ?>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>   
        </tbody>
      </table>
      </div>
      </form>
      <div class="page">
        <div class="pagination"><?php echo ($page); ?></div>
    </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
function ResetPwd(obj){
	$.ajax({
		type:"get",
		url :"<?php echo U('News/resetPwd');?>",
		data:{id:obj},
		beforeSend :function(){
			$("#no"+obj).html("<img src='/Public/admin/images/onload.gif' align='middle'/>");
		},
		success: function(msg){
			if(msg=="1"){
				alert('重置成功');
			}else{
				alert('重置失败');
			}
			$("#no"+obj).html("密码重置");
		},
		error: function(){
			alert('发生错误');
			$("#no"+obj).html("密码重置");
		}
	})
}
</script>