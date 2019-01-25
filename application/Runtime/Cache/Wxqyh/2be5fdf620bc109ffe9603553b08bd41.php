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
 
<script type="text/javascript">
		$(document).ready(function () {
		  var trigger = $('.hamburger'),
		      overlay = $('.overlay'),
		     isClosed = false;

		    trigger.click(function () {
		      hamburger_cross();      
		    });

		    function hamburger_cross() {

		      if (isClosed == true) {          
		        overlay.hide();
		        trigger.removeClass('is-open');
		        trigger.addClass('is-closed');
		        isClosed = false;
		      } else {   
		        overlay.show();
		        trigger.removeClass('is-closed');
		        trigger.addClass('is-open');
		        isClosed = true;
		      }
		  }
		  
		  $('[data-toggle="offcanvas"]').click(function () {
		        $('#wrapper').toggleClass('toggled');
		  });  
		});
	</script>
<div id="wrapper">
        <div class="overlay"></div> 
        <!-- Sidebar -->
       
        <nav class="navbar navbar-default navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <div class="row" style="height:100%;">
        <div class="col-xs-6 " style="height:100%;" >
            <ul class="nav sidebar-nav"> 
             <?php if(is_array($cateList)): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class='dropdown  <?php if($vo["id"] == $pinfo.pid): ?>open<?php endif; ?>'>
                
               <a href="#<?php echo ($vo["id"]); ?>" role="tab" data-toggle="tab"> <?php echo ($vo["name"]); ?> 
               <small>&raquo;</small></a>
                <ul class="dropdown-menu" role="menu">
                 
                    <?php if(is_array($vo["cateListc"])): $i = 0; $__LIST__ = $vo["cateListc"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Main/newcatgary',array('pid'=>$vos['id']));?>"><?php echo ($vos["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                  </ul>
               </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <li role="separator" class="divider"></li>
        <li> <a href="<?php echo U('Main/index');?>"  ><span class="glyphicon glyphicon-chevron-left"></span> 新闻首页</a> 
                
            </ul>
             </div>
              <div class="col-xs-6 " > 
<div class="tab-content">
  <div role="tabpanel" class="tab-pane " id="home">.home..</div>
   	<?php if(is_array($cateList)): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div role="tabpanel" class="tab-pane " id="<?php echo ($vo["id"]); ?>"> 
                <ul class="nav" > 
                    <?php if(is_array($vo["cateListc"])): $i = 0; $__LIST__ = $vo["cateListc"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i; if($vo["id"] == $pinfo.pid): ?>open<?php endif; ?>
                    <li><a href="<?php echo U('Main/newcatgary',array('pid'=>$vos['id']));?>"><?php echo ($vos["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                  </ul> 
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
 
  
</div>
              </div>
            </div>
        </nav>
       
        <!-- /#sidebar-wrapper --> 
</div>
    
     
 <nav class="navbar navbar-default navbarWx navbar-fixed-top">
  <div class="container-full ">
    <div class=" pull-left">
      
       <button type="button" class="topBtn hamburger is-closed animated fadeInLeft" data-toggle="offcanvas" >
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span> 
          </button>
     
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

 <div class="col-xs-12 " >
<ul class="newsList">

  <?php if(is_array($newslist)): $i = 0; $__LIST__ = $newslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
       <a href="<?php echo U('Main/newsdetail',array('nid'=>$v['id']));?>"><?php echo ($v["title"]); ?>
          <?php if($v["isnew"] == 1): ?><img src="/Public/home/images/new.jpg" width="20" /><?php endif; ?>
          &nbsp;
          <?php if($v["istop"] == 1): ?><img src="/Public/home/images/top.jpg" width="20"  /><?php endif; ?>
        <br />
        <small><?php echo (msubstr($v["description"],0,110,'utf-8',true)); ?></small>
        <small><?php echo (date('Y-m-d H:i:s',$v["time"])); ?></small>
     </a>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

<!-- end -->
<nav class="pagination">
 <?php echo ($page); ?>
</nav>
 
 </div>
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