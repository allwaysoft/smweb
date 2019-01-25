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
<script type="text/javascript" src="/Public/admin/js/jquery.fbmodel.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/admin/css/fbmodal.css" />
<div id="content" class="white">
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">用户管理</a>><a href="<?php echo U('FenxiaoUser/index');?>">分销用户</a></div>
<div class="bloc">
<!-- 代码 begin -->
<div  class=" wrap">
<form action="" method="get">
  <dl class="dl_line">
    <dd >
    	<select name="condition">
    		<option value=''></option>
    		<option <?php if(($condition) == "L_active"): ?>selected="selected"<?php endif; ?> value='L_active'>登陆活跃</option>
    		<option <?php if(($condition) == "L_free"): ?>selected="selected"<?php endif; ?> value='L_free'>登陆空闲</option>
    		<option <?php if(($condition) == "L_lock"): ?>selected="selected"<?php endif; ?> value='L_lock'>登陆锁定</option>
    		<option <?php if(($condition) == "S_open"): ?>selected="selected"<?php endif; ?> value='S_open'>账号启用</option>
    		<option <?php if(($condition) == "S_lock"): ?>selected="selected"<?php endif; ?> value='S_lock'>账号禁用</option>
    	</select>
      <input type="text" name="keyword" id="keyword" value="<?php echo ($keyword); ?>" onfocus="this.value='';" title="根据账号或者姓名搜索" />
      <input type="submit" id="btnSearch" value=" 搜 索 " />
    </dd>
  </dl>
  </form>
  <form action="<?php echo U('FenxiaoUser/FenxiaoUserdel');?>" method="post">
  <dl class="dl_line">
    <dt><a href="import" class="daoru " style=" width:80px;" >同步分销用户</a>  <input type="submit" class="schu" value="删除" onclick="return listDelete(this.form.name);" id="btnDelete" /></dt>
  </dl>
  <div class="content">
    <table class="list">
      <thead>
        <tr>
          <th ><input type="checkbox" id="all" /></th>
          <th>序号</th>
          <th>账号</th>
          <th>姓名</th>
          <th>部门</th>
          <th>省份</th>
          <th>归属区域1</th>
          <th>归属区域2</th>
          <th>当前状态</th>
          <th>ip状态</th>
          <th>账号状态</th>
          <th>属性</th>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" /></td>
            <td><a href="#"><?php echo ($i); ?></a></td>
            <td><a href="#"><?php echo ($vo["user_name"]); ?></a></td>
            <td><a href="#"><?php echo ($vo["name"]); ?></a></td>
            <td><a href="#"><?php echo ($vo["deptname"]); ?></a></td>
            <td><a href="#"><?php echo ($vo["province"]); ?></a></td>
            <td><a href="#"><?php echo ($vo["area1"]); ?></a></td>
            <td><a href="#"><?php echo ($vo["area2"]); ?></a></td>
            <td id="td_<?php echo ($vo["id"]); ?>"><?php if($vo["login_state"] == 0): ?>活跃<?php elseif($vo["login_state"] == 1): ?>空闲<?php elseif($vo["login_state"] == 2): ?><a href="javascript:void()" onclick="ChangeLoginState(<?php echo ($vo["id"]); ?>)"><span style="color:red;">超时锁定</span></a><?php endif; ?></td>
              <td><?php if($vo["qure"] == 0): ?>IP正常<?php else: ?><span style="color:red;">IP异常</span><?php endif; ?></td>
               <td><?php if($vo["states"] == 0): ?>启用<?php else: ?>禁用<?php endif; ?></td>
            <td><a href="<?php echo U('FenxiaoUser/logs',array('id'=>$vo['id']));?>">查看</a><a href="<?php echo U('FenxiaoUser/edit',array('id'=>$vo['id']));?>" style="margin:0px 10px;">编辑</a><a  style="padding-left:10px;" href="<?php echo U('FenxiaoUser/del',array('id'=>$vo['id']));?>">删除</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </div>
  </form>
</div>
<div class="page">
  <div class="pagination"><?php echo ($page); ?></div>
</div>
<div class="test">
    <p style="line-height:2;text-indent:1.5em;"></p>
  </div>
</div>
</div>
</body>
</html>
<script>
function ChangeLoginState(obj){
	var url="<?php echo U('LocalUser/Getinfo');?>";
	$.post(url,{id:obj},function(msg){
		$(".test p").html('用户：'+msg+'因超时登陆被锁定，确定解锁，恢复至活跃状态吗？');
		$(".test").fbmodal({
	         modalwidth: "400"}
	     	,function(callback){
	          if(callback == 1){
	        	 var url1="<?php echo U('LocalUser/ChangeLoginState');?>";
	        	 $.post(url1,{id:obj},function(msg){
	        		 if(msg=='1'){
	        			 $('#td_'+obj).html('活跃');
	        			 alert('修改成功');
	        		 }else{
	        			 alert('修改失败');
	        		 }
	        	 })
	             
	         }
				if(callback == 2){
	             alert("你点了取消按钮");
	         }
	     });  
	})
	 
}
</script>