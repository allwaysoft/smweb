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
<!--  CONTEN  ---->
<div id="content" class="white">
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">图库管理</a>><a href="type">店铺分区</a>><a href="typeadd">添加分区</a></div>
<div class="bloc">
  <div class="wrap ">
    
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" action="">
    <table class="add">
      <tbody>
        <tr>
          <th>分类名称：<font class="red">*</font></th>
          <td><input name="name" maxlength="50" type="text" class="input" id="name" style="width:200px;"></td>
        </tr>
        <tr>
          <th>上级分类：<font class="red">*</font></th>
          <td  width="70p" ><select select id="pid" name="pid" class="valid">
              <option value="">﹄ 请选择...</option>
              <option value="0">﹄ 顶级分类</option>
              <?php if(is_array($alist)): $i = 0; $__LIST__ = $alist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php $__FOR_START_31223__=1;$__FOR_END_31223__=$vo['level'];for($i=$__FOR_START_31223__;$i < $__FOR_END_31223__;$i+=1){ ?>&nbsp;&nbsp;&nbsp;<?php } ?>﹄ <?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select></td>
        </tr>
        <tr id="small_img"> 
		    <th>上传图片：</th>
		    <td>
		    <input name="image" maxlength="100" type="text" class="input" id="simage" style="width:400px;" value="" />      
		    <br />
		    <input id="image_upload" type="file" name="Filedata" /> 
		    <span class="imgbox"><img src="" height="38" id="spic" style="margin-top:8px;" /></span> 
		    <td>
		</tr>
        <tr>
          <th>排序：<font class="red">*</font></th>
          <td><input name="sort" type="text" value="0" maxlength="5" class="input" id="sort" style="width:50px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"></td>
        </tr>
        <tr>
          <th>描述：</th>
          <td><textarea style=" width:400px; height:50px;" name="description" class="input" id="description"></textarea></td>
        </tr>
        <tr>
          <th></th>
          <td><input name="btnSubmit" type="submit" id="btnSubmit" value="确定">
            <input name="btnReset" type="reset" id="btnReset" value="清除">
            <a href="lanmu_list.html"><input name="btnBack" type="button" id="btnBack" value="返回"></a></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
<script type="text/javascript"> 
$(document).ready(function() {
	//表单验证
	$("#form1").validate({
		rules: {
			name: {required: true},
			pid: {required:true},
			sort:{ required:true}
		},
		submitHandler: function (form) {
			$("#btnSubmit").attr("disabled",true);
			form.submit();
		}

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
	});
</script>
</div>
</body>
</html>