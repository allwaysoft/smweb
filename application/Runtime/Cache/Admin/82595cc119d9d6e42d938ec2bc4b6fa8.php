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
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">新闻管理</a>><a href="<?php echo U('News/index');?>">新闻列表</a>><a href="">新闻修改</a></div>
<div class="bloc">
  <div class="wrap ">
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" action="">
    <input type="hidden" name="id" value="<?php echo ($infos["id"]); ?>">
    <table class="add">
      <tbody>
        <tr>
          <th width="72">公告名称：<font class="red">*</font></th>
          <td colspan="3"><input name="title" maxlength="100" type="text" class="input" id="title" style="width:400px;" value="<?php echo ($infos["title"]); ?>">&nbsp;&nbsp;<input type="checkbox" name="isnew" disabled="disabled" value="1" <?php if($infos['isnew'] == 1): ?>checked="checked"<?php endif; ?> />最新&nbsp;&nbsp;<input type="checkbox" name="istop" disabled="disabled" value="1" <?php if($infos['istop'] == 1): ?>checked="checked"<?php endif; ?> />置顶</td>
        </tr>
        <tr style="display:none;">
          <th>文章分类：<font class="red">*</font></th>
          <td colspan="3">
          <select select id="type_id" name="type_id" class="valid">
              <option value="">﹄ 请选择...</option>
              <?php if(is_array($alist)): $i = 0; $__LIST__ = $alist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($infos['type_id'] == $vo['id']): ?>selected="selected"<?php endif; ?> value="<?php echo ($vo["id"]); ?>"><?php $__FOR_START_19083__=1;$__FOR_END_19083__=$vo['level'];for($i=$__FOR_START_19083__;$i < $__FOR_END_19083__;$i+=1){ ?>&nbsp;&nbsp;&nbsp;<?php } ?>﹄ <?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
			</td>
        </tr>
        <tr id="small_img"> 
		    <th>上传图片：</th>
		    <td colspan="3">
		    <input name="image" maxlength="100" type="text" class="input" id="simage" style="width:400px;" value="<?php echo ($infos["image"]); ?>" />      
		      <span>新闻的形象缩略图，最佳尺寸比例为4:3</span> 
		    <input id="image_upload" type="file" name="Filedata" /> 
		    <span class="imgbox"><img src="<?php echo ($infos["image"]); ?>" height="38" id="spic" style="margin-top:8px;" /></span> 
		    <td width="8">
		</tr>
        <tr>
          <th>发布日期：<font class="red">*</font></th>
          <td width="268"><input name="time" id="time" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  class="input" value="<?php echo (date("Y-m-d H:i:s",$infos["time"])); ?>"></td>
          <td width="108">截止日期：<font class="red">*</font></td>
          <td width="826"><input name="endtime" id="endtime" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  class="input" value="<?php echo (date("Y-m-d H:i:s",$infos["endtime"])); ?>"></td>
        </tr>
       
        <tr>
          <th>作者：</th>
          <td><input name="author" id="author" type="text" class="input" style="width:100px;" value="<?php echo ($infos["author"]); ?>"></td>
          <td>排序：<font class="red">*</font></td>
          <td><input name="sort" type="text" class="input" value="<?php echo ($infos["sort"]); ?>" id="sort" maxlength="5" style="width:50px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"></td>
        </tr>
       
        <!--<tr>
          <th>关键字：</th>
          <td colspan="3"><textarea style=" width:79%; height:50px;" name="keyword" class="input" id="keyword"><?php echo ($infos["keyword"]); ?></textarea>
            <span>网页SEO优化，多个用","号隔开</span></td>
        </tr>-->
        <tr  style="display:none;">
          <th>简单描述：</th>
          <td colspan="3"><textarea style=" width:79%; height:50px;" name="description" class="input" id="description"><?php echo ($infos["description"]); ?></textarea>
            <span>文章的简单描述</span></td>
        </tr>
        <tr>
          <th>文章描述：</th>
          <td colspan="3">  <span>编辑框内上传的图片限制不能大于100k；如需要，可以下载图片处理工具：
<a href="/Public/admin/UploadModel/图片处理工具.rar">点击下载</a></span> 
<textarea name="contents" style="width:90%;height:500px;visibility:hidden;"><?php echo ($infos["contents"]); ?></textarea>
<!-- <textarea id="contents" name="contents" rows="5"  style="width:90%;"><?php echo ($infos["contents"]); ?>
</textarea> --></td>
        </tr>
      <tr>
        <th></th>
        <td colspan="3"><input name="btnSubmit" type="submit" id="btnSubmit" value="确定">
          <input name="btnReset" type="reset" id="btnReset" value="清除">
          <input name="btnBack" type="button" id="btnBack" value="返回"></td>
      </tr>
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

	
		showSmallImg($("#autoSimg").attr("checked"));
	});
/* if($("#contents").val()!=undefined){
		var editor = CKEDITOR.replace( 'contents' );
		CKFinder.setupCKEditor( editor, '/Public/admin/js/ckfinder/' ) ;
	} */
	
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="contents"]', {
			allowFileManager : true
		});
	});
</script>