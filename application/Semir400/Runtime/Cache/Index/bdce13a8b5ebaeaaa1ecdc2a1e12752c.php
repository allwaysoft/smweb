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
<link rel="stylesheet"  href="<?php echo RES;?>/public/zoom/css/zoom.css" media="all" />

<div class="container">
  <div id="msgShow"></div>
  <!-- top ----->
  <div class="row">
    <div class="col-xs-12">
      <div class="topRightBut pull-right"> <a href="<?php echo U('Index/sampling');?>" class=" "><i class="fa fa-mail-reply" aria-hidden="true"></i> 返回</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo U('Index/sampling_apply');?>" class="btn btn-success  btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> 终端抽检申请</a> </div>
      <h1><i class="fa fa-lightbulb-o" aria-hidden="true"></i> 终端抽检 <small>>> 详细信息</small> </h1>
    </div>
  </div>
  <!-- top ----->
  <div class="h20"></div>
  <!-- main ----->
  <div class="row"> 
    <!--item -->
    <div class="col-sm-12" id="info">
      <div class="col-sm-2" >
        <p class="lead">基本信息</p>
      </div>
      <div class="col-sm-10" >
        <p class="pull-right small"><?php echo (date("Y-m-d H:i:s",$info["add_time"])); ?></p>
        <p >投诉编号：<?php echo ($info["com_code"]); ?> </p>
        <p >投 诉 人：<?php echo ($info["agent_code"]); ?>  /  <?php echo ($info["agent_storename"]); ?>  /  <?php echo ($info["agent_name"]); ?>  / <?php echo ($info["agent_province"]); ?> / <?php echo ($info["agent_area"]); ?></p>
        <p >联 系 人：<?php echo ($info["agent_person"]); ?>  /  <?php echo ($info["agent_tel"]); ?></p>
        <hr>
        <div class="row">
          <div class="col-sm-4" >
            <p >款 号：<?php echo ($info["style_id"]); ?></p>
            <p > 色号：<?php echo ($info["color_id"]); ?> </p>
            <p > 抽检数量：<?php echo ($info["number"]); ?></p>
          </div>
          <?php if(!empty($info["com_pic"])): ?><div class="col-sm-8" >
              <div class="uploadResult gallery">
                <ul>
                  <li> <a href="<?php echo ($info["com_pic"]); ?>"><img src="<?php echo ($info["com_pic"]); ?>" class="previewImage"/> </a> </li>
                </ul>
              </div>
            </div><?php endif; ?>
        </div>
        <hr>
        <p >处理状态：
          <?php if(($info["com_status"]) == "1"): ?>待处理<?php endif; ?>
          <?php if(($info["com_status"]) == "2"): ?>处理中...<?php endif; ?>
          <?php if(($info["com_status"]) == "3"): ?>处理结束<?php endif; ?>
        </p>
      </div>
      <!--item -->
      <div class="col-sm-12" >
        <hr />
      </div>
      <!--item --> 
      
      <!--item -->
      
      <?php if(($info["com_status"]) == "3"): ?><div class="col-sm-12" id="track" >
          <div class="col-sm-2" >
            <p class="lead">客服回复  <i class="fa fa-comments-o" aria-hidden="true"></i></p>
          </div>
          <div class="col-sm-10" >
            <?php if(is_array($feedback)): $i = 0; $__LIST__ = $feedback;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><blockquote>
                <div class="row">
                  <div  class="col-sm-2"> <span class="text-danger">
                    <?php if(($vo["tra_type"]) == "1"): ?>拒收/驳回<?php endif; ?>
                    <?php if(($vo["tra_type"]) == "2"): ?>处理中<?php endif; ?>
                    <?php if(($vo["tra_type"]) == "3"): ?>接收回复<?php endif; ?>
                     <?php if(($vo["tra_type"]) == "99"): ?>废弃<?php endif; ?>
                    </span> </div>
                  <div  class="col-sm-10"> <?php echo ($vo["tra_contents"]); ?> </div>
                </div>
                <div class="row">
                  <footer class="col-sm-10 col-md-offset-2"> <cite title="Source Title ">客服： <?php echo ($vo["com_user"]); ?> / <?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></cite> </footer>
                </div>
              </blockquote><?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
        </div><?php endif; ?>
      
      <!--item --> 
      
    </div>
  </div>
</div> 
<script type="text/javascript" src="<?php echo RES;?>/public/zoom/js/zoom.min.js"></script> 
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