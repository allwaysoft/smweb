<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>后台管理--代理商贷款</title>
<meta http-equiv="semir" content="Yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/<?php echo c('VIEW_PATH');?>Loanpi/public/css/bootstrap.css" rel="stylesheet">
<link href="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-dialog/css/bootstrap-dialog.css" rel="stylesheet">
 <!-- Loading Flat UI -->
   
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/jquery.min1.11.3.js"></script>
<!-- Loading Bootstrap -->
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-dialog/bootstrap-dialog.min.js"></script>

<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/jquery.form.js"></script><!-- up file blug -->
<link href="/<?php echo c('VIEW_PATH');?>Loanpi/public/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" type="text/css" href="/<?php echo c('VIEW_PATH');?>Loanpi/Admin/css/layout.css"  />
</head>
<body>

<a name="top" id="top"></a> 
 <!--  DD 扫码登陆测试 -->
  <div class="container">
    <div class="hidden-xs " style=" height:100px;">
     
   </div>
    <div class="row" >
     <div  class=" col-xs-12 col-md-8  col-md-offset-2">
        <div class="col-xs-12 col-sm-5" >
        
            	<h6> <a href="#" >代理商贷款管理系统 <!-- img src="/<?php echo c('VIEW_PATH');?>Loanpi/Layout/images/logo.png" width="150px"  alt="森马"/ --></a> </h6>
                <h3>管理员登陆</h3>   
        	 
        </div>
         <div class="col-xs-12 col-sm-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title">登陆</h4>
            </div>
            <div class="panel-body login_form">
             <div  id="errShow" class="errShow"></div>
              <form id="form1" name="form1" class="backLogin"  method="post" action="" >
                <div class="form-group  form-group-sm">
                <i class="fa fa-user" aria-hidden="true"></i>
                  <label for="uname"><span class="fui-user"></span> 用户名</label>
                  <input name="uname" type="text" class="form-control" id="uname"  maxlength="30"   placeholder="Login name"  value=""  />
                </div>
                <div class="form-group form-group-sm">
                  <label for="password"><i class="fa fa-unlock-alt" aria-hidden="true"></i> 密码</label>
                  <input type="password" name="password" id="password" class="form-control"  placeholder="Password"   value="" />
                </div> 
                  <input type="submit" name="button" id="button" value="立即登陆 &gt;&gt;" class="btn btn-block  btn-success" /> 
              </form>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- -->  
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/Admin/js/login.js"></script>
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