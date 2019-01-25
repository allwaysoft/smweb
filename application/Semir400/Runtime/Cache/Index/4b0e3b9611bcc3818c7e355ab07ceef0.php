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

 
<div class="container"> 
<div id="msgShow"></div>
  <!-- top ----->
  <div class="row">
    <div class="col-xs-12">
       <div class="topRightBut pull-right"> <a href="<?php echo U('Index/index');?>" class=" "><i class="fa fa-mail-reply" aria-hidden="true"></i> 返回</a>  </div>
      <h1><span class="glyphicon glyphicon-eye-open"></span> 服务投诉 <small>>> 投诉申请</small> </h1>
    </div>
  </div>
  <!-- top ----->
  <div class="h20"></div>
  <!-- main ----->
  <div class="row">
    <div class="col-sm-12">
      <form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="<?php echo U('index/indexrefer');?>" role="form">
        <div class="my-form form-horizontal"> 
          <!-- modal body start -->
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="com_code">投诉编号</label>
            <div class="col-sm-8 "> 
               <p class="form-control-static rightFont"><?php echo ($ComplaintNo); ?></p>
               <input type="hidden"  name="com_code" value="<?php echo ($ComplaintNo); ?>"/>
            </div>
          </div>
          <!--item -->
            <!--item -->
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="deptname">店铺名称</label>
            <div class="col-sm-4">
              <p class="form-control-static rightFont"> <?php echo ($thisUser["province"]); ?>/<?php echo ($thisUser["deptname"]); ?> </p>
              <input type="hidden"  name="agent_province" value="<?php echo ($thisUser["province"]); ?>"/>
              <input type="hidden"  name="agent_name" value="<?php echo ($thisUser["deptname"]); ?>"/>
            </div>
          </div>
          <div class="form-group  ">
            <label class="col-sm-2 control-label" for="agent_area">区域</label>
            <div class="col-sm-4">
              <select name="agent_area" id="agent_area" class="form-control">
              	<option value="">请选择区域</option>
              	<?php if(is_array($arealist)): $i = 0; $__LIST__ = $arealist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["areaname"]); ?>"><?php echo ($vo["areaname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
            </div>
              <label class="col-sm-1 control-label" for="agent_storename">店铺名称</label>
	            <div class="col-sm-4">
	              	<input type="text" class="form-control" name="agent_storename"  id="agent_storename" placeholder="请输入店铺名称" value="">
	            </div>
          </div>
           <div class="form-group ">
            	<label class="col-sm-2 control-label" for="agent_person">联系人</label>
	            <div class="col-sm-4">
	              	<input type="text" class="form-control" name="agent_person"  id="agent_person" placeholder="请输入联系人" value="">
	            </div>
	           
           
            	<label class="col-sm-1 control-label" for="agent_tel">联系电话</label>
	            <div class="col-sm-2">
	              	<input type="text" class="form-control" name="agent_tel"  id="agent_tel" placeholder="请输入联系电话" value="">
	            </div>
	            
          </div>
         
            <div id="inputVal">
             <!--item -->
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="com_contents">服务投诉内容</label>
            <div class="col-sm-6">
              <textarea class="form-control" name="com_contents"  id="com_contents" placeholder="请输入投诉内容"></textarea>
            </div>
             
          </div>
           <!--item -->
            </div>
           
           <!--item -->
          <div class="form-group ">
            <label class="col-sm-2 control-label" for=""></label>
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
  <script>
  $(function(){
	  $('#subForm').bootstrapValidator({
	       message: 'This value is not valid',
	         feedbackIcons: {
	           valid: 'glyphicon glyphicon-ok fui-check',
	            invalid: 'glyphicon glyphicon-remove fui-cross',
	            validating: 'glyphicon glyphicon-refresh'
	        }, 
	        fields: {
	        	agent_area: {
	                message: '请选择区域',
	                validators: {
						notEmpty: {
	                        message:  '请选择区域'
	                    }
	                }
	            },
				 agent_storename: {
		               message: '请输入店铺名称',
		               validators: {
							notEmpty: {
		                       message:  '请输入店铺名称'
		                   }
		               }
		           },
	            agent_tel: {
	                message: '请输入联系方式',
	                validators: {
						notEmpty: {
	                        message:  '请输入联系方式'
	                    },
	                  /*  stringLength: {
	                         min: 11,
	                         max: 11,
	                         message: '请输入11位手机号码'
	                     },
	                     regexp: {
	                         regexp: /^1[[0-9]{1}[0-9]{9}$/,
	                         message: '请输入正确的手机号码'
	                     }*/
	                }
	            },
	            agent_person: {
	                message: '请输入联系人',
	                validators: {
						notEmpty: {
	                        message:  '请输入联系人'
	                    }
	                }
	            },
	            com_contents: {
	                message: '请输入服务投诉内容',
	                validators: {
						notEmpty: {
	                        message:  '请输入服务投诉内容'
	                    }
	                }
	            },
			}
	    }).on('success.form.bv', function(e) {
		 
		});
  });
  </script>