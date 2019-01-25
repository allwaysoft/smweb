<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="utf-8">
<head>
<title><?php echo C('site_title');?></title>
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('description');?>" />
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1.5, user-scalable=yes"> 
<!-- Loading Bootstrap -->
<link href="/<?php echo c('VIEW_PATH');?>wxqyh/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" media="screen,projection" type="text/css" href="/<?php echo c('VIEW_PATH');?>wxqyh/dist/css/wx.css" />
<link rel="icon" type="image/gif" href="/favicon.jpg">

<!-- GRAPHIC THEME -->

<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>wxqyh/dist/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>wxqyh/dist/js/bootstrap.min.js"></script> 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
      <script src="<?php echo c('VIEW_PATH');?>wxqyh/dist/js/vendor/html5shiv.js"></script>
      <script src="<?php echo c('VIEW_PATH');?>wxqyh/dist/js/vendor/respond.min.js"></script>
    <![endif]-->

 
   
</head>
<body>
<a name="top" id="top"></a> 
<div class="container">

<div class="row">


 <!-- news categary-->
<nav class="navbar navbar-default navbarWx navbar-fixed-top">
  <div class="container-full ">
  <div class="dropdown pull-left">
      <button class="topBtn " type="button" id=" " data-toggle=" " onclick="javascript:history.go(-1);" aria-haspopup="true" aria-expanded="true"> <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> </button>
      
    </div>
  <div class="dropdown pull-right">
      <button class="topBtn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span> </button>
      <ul class="dropdown-menu " aria-labelledby="dropdownMenu2">
        <li>
        <div class="userInfo">
          <span class="glyphicon glyphicon-info-sign pull-left userIco"></span>
          <div class="info"><?php echo ($thisUser["name"]); ?><br />
          <?php echo ($thisUser["deptname"]); ?>
          </div>
        </div>  
          </li>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo U('Main/loginout');?>" class=" "><span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;安全退出</a></li>
      </ul>
    </div>
  
   <div class="topNav"> <?php echo ($pinfo["name"]); ?></div>
  
     
  </div>
  
</nav> 
 
<div class="col-xs-12 newsinfo" >
        <h5><?php echo ($newsinfo["title"]); ?></h5>
        <div class="newstime"><?php echo ($newsinfo["author"]); ?> &nbsp;&nbsp;<?php echo (date("Y年m月d日 H:i:s",$newsinfo["time"])); ?> &nbsp;&nbsp;点击:<?php echo ($newsinfo["count"]); ?></div>
        <?php if($newsinfo["image"] != ''): ?><p> <img src="<?php echo ($newsinfo["image"]); ?>"   /></p><?php endif; ?> 
      
       <?php echo ($newsinfo["contents"]); ?>
 </div> 
<!----home_con_R--->
 <!-- foot nav -->
   <!--  <nav class="navbar navbar-default navbarWx navbar-fixed-bottom">
      <div class="container-full">
      <div class=" col-xs-8">link1</div>
      <div class=" col-xs-4">link2</div>
      </div>
    </nav>-->
  <!-- foot nav -->
 </div>
</div>
<div id="scrollUp" class="scrollUp" style="display:none">  
<a id="aa"  href="#top"  >
<span class="glyphicon glyphicon-menu-up"></span>
</a>
</div>
 
<script type="text/javascript">	
 $(document).ready(function($){
	 
	 // $('#topbar').scrollupbar();
	  $(window).scroll(function () {
	  var sTop=$(document).scrollTop();
	//console.log(sTop);
		if(sTop>=30){
		  // $('#nav2013').css("display","block");
		   $('#scrollUp').css("display","block");
		}else{
			 $('#scrollUp').css("display","none");
			 
		}
		});
	$("#scrollUp").click(function(event){	
		$('html,body').animate({scrollTop:0}, 300);
		return false;
	});
});	

</script>
</body></html>