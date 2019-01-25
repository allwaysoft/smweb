<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>森马--贷款管理系统</title>
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

<link rel="stylesheet" type="text/css" href="/<?php echo c('VIEW_PATH');?>Loanpi/Layout/css/layout.css"  />
</head>
<body>

<a name="top" id="top"></a> <header>
  <nav class="navbar navbar-inverse  navbar-fixed-top">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="#"><img src="/<?php echo c('VIEW_PATH');?>Loanpi/Admin/images/logow.png" width="120px"  alt="贷款申请管理"/></a> </div>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right">
          <li 
           class='dropdown <?php if($url == 'Register'): ?>active<?php endif; ?>'
          ><a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">贷款管理  <span class="caret"></span></a>
           <ul class="dropdown-menu">
              <li><a href="<?php echo U('Register/index');?>">日常贷款</a></li>
              <li><a href="<?php echo U('Register/special');?>">特殊贷款</a></li>
            </ul>
          </li>
          <li class="dropdown <?php if($url == 'Repayment'): ?>active<?php endif; ?>
            " > <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">还款管理 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo U('Repayment/index');?>">还款</a></li>
              <li><a href="<?php echo U('Repayment/history');?>">还款纪录</a></li>
            </ul>
          </li>
            <li 
          <?php if($url == 'Statement'): ?>class='active'<?php endif; ?>
          ><a href="<?php echo U('Statement/index');?>">对账函</a>
          </li> 
          <li 
          <?php if($url == 'History'): ?>class='active'<?php endif; ?>
          ><a href="<?php echo U('History/index');?>">历史数据</a>
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
     
      <h1><span class="glyphicon glyphicon-eye-open"></span> 贷款管理 <small>>> 贷款申请</small>  </h1>
    </div>
  </div>
  <!-- top ----->
  <div class="h20"></div>
  <!-- main ----->
  <div class="row">
    <div class="col-sm-12">
      <form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="<?php echo U('Register/reg_add_do/t/N');?>" role="form">
        <div class="my-form form-horizontal"> 
        
         <!-- item --> 
        <?php if($reData['MESS_FLAG'] == 'S' ): ?><div class="alert alert-success" role="alert">
              <div class="media">
                <div class="media-left lead"><i class="fa fa-bell-o " aria-hidden="true"></i> </div>
                <div class="media-body">
                <p> <strong>申请成功: </strong></p>
                 
                 <p>SAP编号：<?php echo ($data['sap_code']); ?>，审批流程已经开始，请耐心等候审批结果！</p>
                   
                  <p>可在 贷款管理> 日常管理 查看具体信息。</p>
                
                </div>
              </div>
            </div>
          <?php else: ?>
         	 <div class="alert alert-warning" role="alert">
              <div class="media">
                <div class="media-left lead"><i class="fa fa-bell-o " aria-hidden="true"></i> </div>
                <div class="media-body">
                <p> <strong>申请失败:</strong>
                 <p> <strong>  <?php echo ($reData['MESSAGE']); ?>  </strong></p>
                </div>
              </div>
           	 </div><?php endif; ?>
         
          <!--item -->
          <!-- item -->
          
          <!--item -->
          
          <hr />
          <!-- modal body start -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="">贷款人</label>
            <div class="col-sm-8 "> 
               <p class="form-control-static rightFont"><?php echo ($thisUser['user_name']); ?> / <?php echo ($thisUser['name']); ?></p>
            </div>
          </div>
          <!--item -->
            <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="type">贷款类型</label>
            <div class="col-sm-4">
             <?php if($data['reg_type'] == 'N' ): ?><p class="form-control-static rightFont"> 日常贷款 </p>
              <?php else: ?>
               <p class="form-control-static rightFont"> 特殊贷款 </p><?php endif; ?>
            </div>
            
          </div>
           <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="reg_start_time">贷款日期</label>
            <div class="col-sm-4">
               <p class="form-control-static rightFont"> <?php echo ($data['reg_start_time']); ?> </p> 
            </div>
            
          </div>
           <!--item -->
            <div id="inputVal">
             <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="reg_amount">贷款金额</label>
            <div class="col-sm-4">
              <p class="form-control-static rightFont"> <?php echo ($data['reg_amount']); ?> </p>
            </div>
             <div class="col-sm-5">
            <span class="rightMsg" id="msgAmount"></span>
            </div>
          </div>
           <!--item -->
           <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="reg_cycle">贷款周期</label>
            <div class="col-sm-4">
              <p class="form-control-static rightFont"> <?php echo ($data['reg_cycle']); ?> </p>
            </div>
            <div class="col-sm-5">
            <span class="rightMsg" id="msgCycle"></span>
            </div>
          </div>
           <!--item -->
            </div>
           
           <!--item -->
          
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