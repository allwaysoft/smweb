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
  <div class="mbxie"><a href="" style="padding-left:0px;"><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>">首页</a>><a href="javascript:void(0)">用户管理</a>><a href="<?php echo U('FenxiaoUser/edit',array('id'=>$user['id']));?>">分销用户修改</a></div>
  <div class="bloc">
 <dl  class="t_1_h">

    <div class="wrap">
    <form id="form1" name="form1" method="post" action="">
    <input type="hidden" name="id" value="<?php echo ($user["id"]); ?>"/>
      <table class="add">
        <tbody>
          <tr>
            <th>登录用户名：<font class="red">*</font></th>
            <td><input name="username" maxlength="20" readonly="readonly" class="input" id="username" style="width:200px;" type="text" value="<?php echo ($user["user_name"]); ?>" />
              <span> 登录用户名不能重复</span> </td>
          </tr>
          <tr>
            <th>姓名：<font class="red">*</font></th>
            <td><input name="name" maxlength="20" class="input" id="name" style="width:200px;" type="text" value="<?php echo ($user["name"]); ?>" readonly="readonly"/>
            </td>
          </tr>
           <tr>
            <th>邮箱：<font class="red">*</font></th>
            <td><input name="email" maxlength="50" class="input" id="email" style="width:200px;" type="text" readonly="readonly"  value="<?php echo ($user["email"]); ?>"/>
              <span> 找回密码时使用</span> </td>
          </tr>
          <tr>
            <th>部门：<font class="red">*</font></th>
            <td><input name="deptname" maxlength="20" class="input" id="deptname"  value="<?php echo ($user["deptname"]); ?>" style="width:200px;" type="text" readonly="readonly" />
            </td>
          </tr>
           <tr>
            <th>省份：<font class="red">*</font></th>
            <td>
            <select name="province" id="province">
             <?php if(is_array($listPro)): $i = 0; $__LIST__ = $listPro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo["province"]); ?>"   <?php if($vo['province'] == $user['province']): ?>selected="selected"<?php endif; ?> ><?php echo ($vo["province"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
             <option value="1">其它</option>
            </select>
            <input name="p1" id="p1" maxlength="50" class="input"   type="text" style="display:none;"/>
            </td>
          </tr>
            <tr>
            <th>归属区域1：<font class="red">*</font></th>
            <td>
             <select name="area1">
             <?php if(is_array($listA1)): $i = 0; $__LIST__ = $listA1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area1"]); ?>" <?php if($vo['area1'] == $user['area1']): ?>selected="selected"<?php endif; ?>  ><?php echo ($vo["area1"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
             <option value="1">其它</option>
            </select>
             <input name="a1" id="a1" maxlength="50" class="input"   type="text" style="display:none;"/>
            </td>
          </tr>
          <tr>
            <th>归属区域2：<font class="red">*</font></th>
            <td>
              <select name="area2">
             <?php if(is_array($listA2)): $i = 0; $__LIST__ = $listA2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area2"]); ?>"  <?php if($vo['area2'] == $user['area2']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["area2"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
             <option value="1">其它</option>
            </select>
             <input name="a2" id="a2" maxlength="50" class="input"  type="text"  style="display:none;"/>
            </td>
          </tr>
          
          <tr>
            <th>手机：<font class="red"> </font></th>
            <td><input name="mobile" maxlength="50" class="input" id="mobile" style="width:200px;" type="text" value="<?php echo ($user["phone"]); ?>"/>
              <span> 获取验证码时使用</span> </td>
          </tr>
          <tr>
            <th>所属状态：<font class="red">*</font></th>
            <td> <select id="state" name="state" style="width:210px;">
                <option value="">﹄ 请选择</option>
                <option <?php if($user["states"] == 1): ?>selected="selected"<?php endif; ?> value="1">﹄ 禁止</option>
                <option  <?php if($user["states"] == 0): ?>selected="selected"<?php endif; ?> value="0">﹄ 启用</option>
              </select>
            </td>
          </tr>
          <tr>
            <th></th>
            <td><input name="btnSubmit" id="btnSubmit" value="确定" type="submit">
              <input name="btnReset" id="btnReset" value="清除" type="reset">
              <input name="btnBack" id="btnBack" value="返回" type="button">
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</dl>
</div>
</body>
</html>
<script type="text/javascript"> 
$(document).ready(function() {
	$("#form1").validate({
		rules: {
			 state:{required:true}
		}/* ,
		submitHandler:function(form){
			$("#btnSubmit").attr("disabled",true);
			form.submit();
		} */
	});
	///////////////////
	/////////////////////
	$("#province").click(function(){
		var val = $(this).val();
		if (val == 1){
			$("#p1").show();
		}else{
			$("#p1").hide();
		}
	});
	$("select[name=area1]").click(function(){
		var v1 = $(this).val();
		if (v1 == 1){
			$("#a1").show();
		}else{
			$("#a1").hide();
		}
	});
	$("select[name=area2]").click(function(){
		var v2 = $(this).val();
		if (v2 == 1){
			$("#a2").show();
		}else{
			$("#a2").hide();
		}
	});
	///////////////////////
})

</script>