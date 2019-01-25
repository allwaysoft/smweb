<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>贷款申请</title>
<meta http-equiv="semir" content="Yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo c('VIEW_PATH');?>Loanpi/public/jquery.min1.11.3.js"></script>
<!-- Loading Bootstrap -->
<script type="text/javascript" src="<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap.min.js"></script>
<link href="<?php echo c('VIEW_PATH');?>Loanpi/public/css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-dialog/bootstrap-dialog.min.js"></script>
<link href="<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-dialog/css/bootstrap-dialog.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="<?php echo c('VIEW_PATH');?>Loanpi/public/jquery.form.js"></script><!-- up file blug -->

<!-- GRAPHIC THEME -->

<link rel="stylesheet" type="text/css" href="<?php echo c('VIEW_PATH');?>Loanpi/Home/css/layout.css"  />
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
        
            	<h6> <a href="#" > <img src="<?php echo c('VIEW_PATH');?>Loanpi/Home/images/logo.png" width="150px"  alt="森马"/></a> </h6>
                <h3>贷款申请信息提交</h3>   
        	 
        </div>
         <div class="col-xs-12 col-sm-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title">管理员登陆</h4>
            </div>
            <div class="panel-body login_form">
             <div  id="errShow" class="errShow"></div>
              <form id="form1" name="form1" class="backLogin"  method="post" action="" >
                <div class="form-group  form-group-sm">
                  <label for="uname"><span class="fui-user"></span> 登陆账号</label>
                  <input name="uname" type="text" class="form-control" id="uname"  maxlength="10"   placeholder="登陆账号"  value="<?php echo (cookie('uname')); ?>"  />
                </div>
                <div class="form-group form-group-sm">
                  <label for="password"><span class="fui-credit-card"></span> 密码</label>
                  <input type="password" name="password" id="password" class="form-control"  placeholder="登陆密码"   value="<?php echo (cookie('pw')); ?>" />
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
<script type="text/javascript" src="/Public/home/js/login.js"></script>
 <!-- footer -->
<footer>
 <div class="container">
  <div class="row  footer" > 
    <!-- main  -->
    <div class="col-xs-12 col-md-10 col-md-offset-2"> 
     <p class="" >  
    
 	  商品售后服务热线：400-8877-588 ,  技术支持专线：0577-85789999<br />
      All Rights Reserved &copy;  <?php echo date('Y');?> 森马</p>
    </div>
     
    </div>
 </div>
</footer>
<!-- footer -->
 
</body>
</html>