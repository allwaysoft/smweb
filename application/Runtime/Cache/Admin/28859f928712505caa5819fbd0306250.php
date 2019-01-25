<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>森马管理后台</title>
<!-- jQuery AND jQueryUI -->
<!-- <link rel="stylesheet" href="/Public/admin/css/min.css" /> -->
<script src="/Public/uploadify/jquery.min.js" type="text/javascript"></script>
<script src="/Public/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Public/uploadify/uploadify.css"/>
<style>
body {
    font-size: 12px;
    font-family: "微软雅黑";
}
#content {
    font-size: 12px;
    margin-left: 20px;
}
.mbxie {
    line-height: 44px;
    border-bottom: 1px solid #E1E1E1;
}
#content a {
    color: #000;
}
.mbxie a {
    text-decoration: none;
    padding: 0px 8px;
}
</style>
</head>
<body>
<!--   CONTENT  ---->
<div id="content" class="white" >
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">商品管理</a>><a href="<?php echo U('Photo/index');?>">图片管理</a>><a href="">图片上传</a></div>
<div style=" margin:30px 0 15px; color:red; font-size:14px;">备注：上传图片前，请先确认对应款号产品信息是否导入!</div>
<div style="margin-bottom:10px;">图片处理工具：<a href="/Public/admin/UploadModel/图片处理工具.rar">点击下载</a></div>
<form>
		<input id="file_upload" name="file_upload" type="file" multiple="true"/>
		<div id="image" class="image"></div>
		<input type="hidden" id="dirname" value="<?php echo ($dirname); ?>"/>
		<input type="hidden" id="url" value="/admin.php/Photo"/>
	</form>
	<script type="text/javascript">

		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					/* '<?php echo session_name();?>': '<?php echo session_id();?>',//此处获取SESSIONID
					'timestamp' : '<?php echo ($time); ?>',            //时间
					'token'     : '<?php echo (md5($time )); ?>',		//加密字段 */
					 '<?php echo session_name();?>': '<?php echo session_id();?>',
					'dirname'	: $('#dirname').val(),				//root
					'url'		: $('#url').val()+'/batchupload/'
				},

				'fileTypeDesc' : 'Image Files',					//类型描述
				'removeCompleted' : true,    //是否自动消失
        		'fileTypeExts' : '*.jpg',		//允许类型
        		'fileSizeLimit' : '2048',					//允许上传最大值
				'swf'      : '/Public/uploadify/uploadify.swf',	//加载swf
				'uploader' : '<?php echo U("Upload/batchupload");?>',					//上传路径
				'buttonText' :'文件上传',									//按钮的文字

				'onUploadSuccess' : function(file, data, response) {			//成功上传返回
            									//100以内的随机数
            	var pname=data.split('/')[3];							
            	//插入到image标签内，显示图片的缩略图
				$('#image').append('<div class="photo" style="width:150px; text-align:center"><img src="'+data+'"  height=100 width=80 /><div>'+pname+'</div></div>');
				}

			});
		});



	</script>
</div>
  

</body>
</html>