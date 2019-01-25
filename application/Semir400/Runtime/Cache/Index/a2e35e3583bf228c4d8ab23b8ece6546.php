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

<!--  container  -->

<div class="container">

<div id="msgShow"></div>
  <!-- top ----->
  <div class="row">
    <div class="col-xs-12">
      <div class="topRightBut pull-right">
      <a href="<?php echo U('Index/index_apply');?>" class="btn btn-success "><i class="fa fa-plus-circle" aria-hidden="true"></i> 服务投诉申请</a> 
       <!--  <a href="javascript:;" class="btn btn-info  btn-sm uploanStatus"><span class="glyphicon glyphicon-refresh"></span> 更新所有状态</a> --> 
      </div>
      <h1><span class="glyphicon glyphicon-eye-open"></span> 服务投诉</h1>
    </div>
  </div>
  <!-- top ----->
  <div class="h20"></div>
  <!-- main ----->
  <div class="row">
    <div class="col-xs-12">
      <form action="" method=" ">
        <table  id="listTable" class="table table-striped table-bordered "  cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>提交日期 <span class="sr-only"></span></th>
              <th>投诉编号 <span class="sr-only"></span></th> 
              <th>区域<span class="sr-only"></span></th> 
              <th>联系人<span class="sr-only"></span></th>
              <th>状态<span class="sr-only"></span></th>
              <th>查看<span class="sr-only"></span></th>  
            </tr>
          </thead>
        </table>
      </form>
    </div>
  </div>
  <!-- main --> 
</div>
<!--  container  --> 
<script type="text/javascript">
 
</script>
<script type="text/javascript" src="<?php echo RES;?>/Index/js/index.js"></script>
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