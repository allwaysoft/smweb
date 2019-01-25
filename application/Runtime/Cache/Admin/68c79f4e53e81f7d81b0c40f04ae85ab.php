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
<script charset="utf-8" src="/Public/admin/js/kindeditor-min.js"></script>
<script charset="utf-8" src="/Public/admin/js/zh_CN.js"></script>
<link rel="stylesheet" href="/Public/admin/css/default/default.css" />
<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="text"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
			});
</script>
<!--   CONTENT  ---->
<div id="content" class="white">
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">系统设置</a>><a href="<?php echo U('Banner/index');?>">首页子Banner设置</a>><a href="<?php echo U('Admin/Banner/subset_edit');?>">修改</a></div>
<div class="bloc">
  <div class="wrap ">
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" action="#">
    <table class="add">
      <tbody>
      	<tr>
      	<th>名称：</th>
      	<td>首页子Banner</td>
      	</tr>
        <tr>
          <th>显示类型：</th>
          <td>
          	<select name="type">
          	<?php if($sub["type"] == 'text'): ?><option value="text" selected>文字</option>
           	   <option value="pic">图片</option>
           	   <option value="tp">文字+图片</option>
           	   <?php elseif($sub["type"] == 'pic'): ?>
           	   <option value="text">文字</option>
           	   <option value="pic" selected>图片</option>
           	   <option value="tp">文字+图片</option>
           	   <?php elseif($sub["type"] == 'tp'): ?>
           	   <option value="text">文字</option>
           	   <option value="pic">图片</option>
           	   <option value="tp" selected>文字+图片</option><?php endif; ?>
            </select>
           </td>
        </tr>
        <tr>
          <th>文字内容：</th>
          <td><textarea name="text" style="width:700px;height:60px;visibility:hidden;"><?php echo ($sub["text"]); ?></textarea></td>
        </tr>
        <tr id="small_img"> 
		    <th>背景图片：</th>
		    <td>
		    <input name="backgroundimg" maxlength="100" type="text" class="input" id="simage" style="width:400px;" value="<?php echo ($sub["backgroundimg"]); ?>" />      
		    <br />
		    <input id="image_upload" type="file" name="Filedata" /> 
		    <span class="imgbox"><img src="<?php echo ($sub["image"]); ?>" height="38" id="spic" style="margin-top:8px;" /></span> 
		    <td>
		</tr>
        <tr id="small_img1"> 
		    <th>普通图片：</th>
		    <td>
		    <input name="image" maxlength="100" type="text" class="input" id="simage1" style="width:400px;" value="<?php echo ($sub["image"]); ?>" />      
		    <br />
		    <input id="image_upload1" type="file" name="Filedata1" /> 
		    <span class="imgbox"><img src="<?php echo ($sub["image"]); ?>" height="38" id="spic1" style="margin-top:8px;" /></span> 
		    <td>
		</tr>
        <tr>
          <th>外链：</th>
          <td><input name="url" type="text" class="input"  id="url"  style="width:400px;" value="<?php echo ($sub["url"]); ?>"/></td>
        </tr>
        <tr>
        <th></th>
			<td>
			  <input name="btnSubmit" type="submit" id="btnSubmit" value="确定">
			  <input name="btnReset" type="reset" id="btnReset" value="清除">
			  <input name="btnBack" type="button" id="btnBack" value="返回">
			</td>
        </tbody>
      
    </table>
  </form>
</div>
</body>
</html>
<script type="text/javascript"> 
$(document).ready(function() {
	$("#form1").validate({
		rules: {
			title: { required: true},
			type_id:{ required: true},
			time:{required:true},
			endtime:{required:true}
		}/* ,
		submitHandler:function(form){
			$("#btnSubmit").attr("disabled",true);
			form.submit();
		} */
	});
})
$(function() {
		$('#image_upload').uploadify({
		  'uploader'  : '/Public/admin/uploadify/uploadify.swf',
		  'script'    : '<?php echo U("Upload/upload");?>',
		  'folder'	  : '',
		  'cancelImg' : '/Public/admin/uploadify/cancel.png',
		  'removeCompleted' : true,
		  'auto':true,
		  'buttonText': 'SELECT IMAGE',
		  'fileExt'     : '*.jpg; *.gif; *.png',
		  'fileDesc'    : 'Select Files *.jpg; *.gif; *.png',
		  'onCancel'    : function(event,ID,fileObj,data) {
      		  $("#btnSubmit").attr("disabled",false);
    	  },
		  'onSelect':function(event,ID,fileObj) {
			  $("#btnSubmit").attr("disabled",true);
		  },
		  'onComplete' :function(event,queueID,fileObj,response,data){
			   $("#simage").val(response);
			   $("#spic").attr("src",response);
			   $("#btnSubmit").attr("disabled",false);
		  }
		});	

	//showSmallImg($("#autoSimg").attr("checked"));
		$('#image_upload1').uploadify({
		  'uploader'  : '/Public/admin/uploadify/uploadify.swf',
		  'script'    : '<?php echo U("Upload/upload");?>',
		  'folder'	  : '',
		  'cancelImg' : '/Public/admin/uploadify/cancel.png',
		  'removeCompleted' : true,
		  'auto':true,
		  'buttonText': 'SELECT IMAGE',
		  'fileExt'     : '*.jpg; *.gif; *.png',
		  'fileDesc'    : 'Select Files *.jpg; *.gif; *.png',
		  'onCancel'    : function(event,ID,fileObj,data) {
      		  $("#btnSubmit").attr("disabled",false);
    	  },
		  'onSelect':function(event,ID,fileObj) {
			  $("#btnSubmit").attr("disabled",true);
		  },
		  'onComplete' :function(event,queueID,fileObj,response,data){
			   $("#simage1").val(response);
			   $("#spic1").attr("src1",response);
			   $("#btnSubmit").attr("disabled",false);
		  }
		});	
	}
);

</script>