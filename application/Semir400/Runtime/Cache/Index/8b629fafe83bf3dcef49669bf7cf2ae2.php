<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>森马--400客服平台</title>
<meta http-equiv="semir" content="Yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo RES;?>/public/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo RES;?>/public/js/bootstrap-dialog/css/bootstrap-dialog.css" rel="stylesheet">
 <!-- Loading Flat UI -->
   
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.min1.11.3.js"></script> 

<!-- Loading Bootstrap -->
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-dialog/bootstrap-dialog.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-validator/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.form.js"></script><!-- up file blug -->
<link href="<?php echo RES;?>/public/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/public/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/Index/css/layout.css"  />
</head>
<body>

<a name="top" id="top"></a> <header>
  <nav class="navbar navbar-inverse  navbar-fixed-top">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="#"><img src="/<?php echo c('VIEW_PATH');?>Semir400/Index/images/logow.png" width="120px"  alt="Semir400"/></a> </div>      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right">
            <li <?php if(ACTION_NAME == 'index'): ?>class='active'<?php endif; ?>><a href="<?php echo U('Index/index');?>"><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉</a></li>
              <li <?php if(ACTION_NAME == 'service'): ?>class='active'<?php endif; ?>><a href="<?php echo U('Index/service');?>" ><span class="glyphicon glyphicon-eye-open"></span> 服务投诉</a></li> 
              <li  <?php if(ACTION_NAME == 'sampling'): ?>class='active'<?php endif; ?> ><a href="<?php echo U('Index/sampling');?>"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> 终端抽检</a></li>
           
          </li>
          <p class="navbar-text">|</p>
           <p class="navbar-text"><i class="fa fa-user" aria-hidden="true"></i> <!-- {$thisUser['user_name']}--> <?php echo ($thisUser['name']); ?></p>
          <li >
          <a href="<?php echo U('Login/loginout');?>"><i class="fa fa-lock" aria-hidden="true"></i> 安全退出</a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container-fluid --> 
  </nav>
</header>

<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/public/upload/css/css.css?<?php echo time();?>" />
<!-- <script src="<?php echo RES;?>/public/upload/js/jquery.js"></script> -->
<script src="<?php echo RES;?>/public/upload/js/LocalResizeIMG.js"></script>
<script src="<?php echo RES;?>/public/upload/js/mobileBUGFix.mini.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link href="<?php echo RES;?>/public/js/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script type="text/javascript">
$(document).ready(function(){
  ////////////////////
  $('.form_date').datetimepicker({
    language: 'zh-CN',
    weekStart: 1,
    todayBtn: 1,
	  autoclose: 1,
	  todayHighlight: 1,
	  startView: 2,
	  minView: 2,
	  forceParse: 0
});

});
</script>
<style>
.upload-image { 
    width: 100px;   
}
</style>
<div class="container"> 
<div id="msgShow"></div>
  <!-- top ----->
  <div class="row">
    <div class="col-xs-12">
       <div class="topRightBut pull-right"> <a href="javascript:history.go(-1);" class=" "><i class="fa fa-mail-reply" aria-hidden="true"></i> 返回</a> </div>
      <h1><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉 <small>>> 质量投诉申请</small> <small>>> 重新投诉</small></h1>
     
    </div>
  </div>
  <!-- top ----->
  <div class="h20"></div>
  <!-- main ----->
  <div class="row">
    <div class="col-sm-12">
      <form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="<?php echo U('index/qualityrefer_again');?>" role="form">
        <div class="my-form form-horizontal"> 
          <!-- modal body start -->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="com_code">投诉编号</label>
            <div class="col-sm-8 "> 
               <p class="form-control-static rightFont"><?php echo ($info["com_code"]); ?></p>
               <input type="hidden"  name="com_code" value="<?php echo ($info["com_code"]); ?>"/>
            </div>
          </div>
          
            <?php if(($feedback["tra_type"]) == "3"): ?><div class="form-group">
	            <label class="col-sm-3 control-label" for="com_type">投诉类别</label>
	            <div class="col-sm-4">
	            	<p class="form-control-static rightFont">照片鉴定</p>
	               <input type="hidden"  name="com_type" value="1"/>
	            </div>
            </div>
            <div class="form-group" id="pic">
            	<label class="col-sm-3 control-label" for="reg_amount">上传照片</label>
            	
	            <div class="col-sm-5">
	            <div><label class="control-label">请分别上传问题点局部、全图 、洗唛正面 、洗唛反面四张照片</label></div>
	              	<div class="upload-image">
						<i class="icon icon-camerafill x6"></i>选择图片
						<input type="file" name="upfile" id="post-pictures-file" accept="image/*" style="opacity: 0; left: 0;top: 0;bottom: 0;margin: 0; position: absolute;  width: 100px;cursor:pointer;" />
					</div>
					<div class="showLine"></div>
	            </div>
	            <div class="col-sm-5">
	            	<span class="rightMsg" id="msgAmount"></span>
	            </div>
          </div><?php endif; ?>
            
          <?php if(($feedback["tra_type"]) == "4"): ?><div class="form-group">
	            <label class="col-sm-3 control-label" for="com_type">投诉类别</label>
	            <div class="col-sm-4">
	            	<p class="form-control-static rightFont">实物鉴定</p>
	               <input type="hidden"  name="com_type" value="2"/>
	            </div>
          </div>
          <div id="expressinfo">
	           <div class="form-group">
	            	<label class="col-sm-3 control-label" for="fol_express">快递公司</label>
		            <div class="col-sm-4">
		              	<input type="text" class="form-control" name="fol_express"  id="fol_express" placeholder="请输入快递公司" value="">
		            </div>
		            <div class="col-sm-5">
		            	<span class="rightMsg" id="color_id"></span>
		            </div>
	          </div>
	          <div class="form-group">
	            	<label class="col-sm-3 control-label" for="fol_express_number">快递单号</label>
		            <div class="col-sm-4">
		              	<input type="text" class="form-control" name="fol_express_number"  id="fol_express_number" placeholder="请输入快递单号" value="">
		            </div>
		            <div class="col-sm-5">
		            	<span class="rightMsg" id="color_id"></span>
		            </div>
	          </div>
	          <div class="form-group">
	            	<label class="col-sm-3 control-label" for="fol_express_address">快递回寄地址</label>
		            <div class="col-sm-4">
		              	<input type="text" class="form-control" name="fol_express_address"  id="fol_express_address" placeholder="请输入快递回寄地址" value="">
		            </div>
		            <div class="col-sm-5">
		            	<span class="rightMsg" id="color_id"></span>
		            </div>
	          </div>
          </div><?php endif; ?>
          
           <!--item -->
           
          <div class="form-group">
            <label class="col-sm-3 control-label" for="fol_contents">问题描述</label>
            <div class="col-sm-4">
              <textarea class="form-control" name="fol_contents"  id="fol_contents" placeholder="请输入问题描述"></textarea>
            </div>
             <div class="col-sm-5">
            <span class="rightMsg" id="com_contents"></span>
            </div>
          </div>
           
           <!--item -->
          <div class="form-group">
            <label class="col-sm-3 control-label" for=""></label>
            <div class="col-sm-4">
             <button  class="btn btn-success btn-sm" type="submit"> 
            <span class='glyphicon glyphicon-ok-circle'></span> 提交投诉申请 
            </button>
            
            </div>
          </div>
           <!--item -->
        </div>
      
      </form>
    </div>
  </div> 
  </div> 
 <!-- footer -->
   <div class="h20"></div>
<footer>
 <div class="container">
  <div class="row  footer" > 
    <!-- main  -->
    <div class="col-xs-12 "> 
     <p class="" >  
    
 	  商品售后服务热线：400-8877-588 ,  技术支持专线：0577-85789999<br />
      All Rights Reserved &copy;  <?php echo date('Y');?> 森马</p>
    </div>
     
    </div>
 </div>
</footer>
<!-- footer -->
<script src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/jquery.dataTables.js"></script> 
<script src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/dataTables.bootstrap.js"></script>  
</body>
</html>
<script type="text/javascript">
$(function(){
	$('#subForm').bootstrapValidator({
		   message: 'This value is not valid',
		     feedbackIcons: {
		       valid: 'glyphicon glyphicon-ok fui-check',
		        invalid: 'glyphicon glyphicon-remove fui-cross',
		        validating: 'glyphicon glyphicon-refresh'
		    }, 
		    fields: {
		    	
		    	   fol_express: {
		               message: '请输入快递公司',
		               validators: {
							notEmpty: {
		                       message:  '请输入快递公司'
		                   }
		               }
		           },
		           fol_express_number: {
		               message: '请输入快递单号',
		               validators: {
							notEmpty: {
		                       message:  '请输入快递单号'
		                   }
		               }
		           },
		           fol_express_address: {
		               message: '请输入快递回寄地址',
		               validators: {
							notEmpty: {
		                       message:  '请输入快递回寄地址'
		                   }
		               }
		           },
		           fol_contents: {
		               message: '请输入问题描述',
		               validators: {
							notEmpty: {
		                       message:  '请输入问题描述'
		                   }
		               }
		           },
			}
		}).on('success.form.bv', function(e) {
		 
		});
	

})

</script>
  <script>
  $('#post-pictures-file').on('click',function(){
	  if($('.uploadResult').length>=4){
		  BootstrapDialog.show({
				type:"type-danger",
				title: '上传图片错误：',
				message: '你只能上传4张照片',
				buttons: [{
					label: 'Close',
					action: function(dialogRef) {
						dialogRef.close();
					}
				}]
			}); 
          return false;
	  }
	    $(this).localResizeIMG({
	        width: 1000,
	        quality: 0.9,
	        before: function() {
	            if (checkHtml5Support() == false) {
	            	BootstrapDialog.show({
						type:"type-danger",
						title: '浏览器错误：',
						message: '你的老掉牙浏览器不支持HTML5，请使用先进浏览器',
						buttons: [{
							label: 'Close',
							action: function(dialogRef) {
								dialogRef.close();
							}
						}]
					}); 
	                return false;
	            }
	        },
	        success: function(result) {
	            var img = new Image();
	            img.src = result.base64;
	            var rand = new Date().getTime();
	            var newDiv = '<div id=\"uploadFile' + rand + '\" class=\"uploadResult\"><div class=\"info\">压缩上传中...</div><img class=\"previewImage\"></div>';
	            $('.showLine').before(newDiv);
	            $.ajax({
	                xhr: function(){
	                    var xhr = new window.XMLHttpRequest();
	                    xhr.upload.addEventListener("progress", function(evt){
	                        if (evt.lengthComputable) {
	                            // 获取进度百分比
	                            var percentComplete = parseInt((evt.loaded / evt.total)*100);
	                            $(".info:last").html("已上传："+percentComplete + "%");
	                        }
	                    });
	                    return xhr;
	                },
	                url: '<?php echo U("index/upload");?>',
	                type: 'POST',
	                data: {
	                    'base64': result.base64
	                },
	                timeout: 45000,
	                error: function() {
	                    alert('上传发生错误或超时，请重试');
	                    $('#uploadFile' + rand).hide();
	                },
	                success: function(data) {
	                	var newDiv2 = $('<div class=\"delPic\" onclick=\"javascript:delUploadImage(\'uploadFile' + rand + '\');\" title=\"删除\" style=\"display: block;\"><i class=\"icon icon-roundclose x2\"></i><input type="hidden" name="fol_pic[]" value="'+data+'"/></div>');
	                    $('#uploadFile' + rand + ' img').after(newDiv2);
	                    $('#uploadFile' + rand + ' img').attr("src", result.base64);
	                    $('#uploadFile' + rand + ' .info').html('上传完成');
	                }
	            });
	        }
	    });
	});
function checkHtml5Support() {
    if (window.applicationCache) {
        return true;
    } else {
        return false;
    }
}
function delUploadImage(id){
	$('#'+id).remove();
}
</script>