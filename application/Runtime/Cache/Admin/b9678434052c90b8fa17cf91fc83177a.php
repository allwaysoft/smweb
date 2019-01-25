<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>森马管理后台</title>
<!-- jQuery AND jQueryUI -->
<script type="text/javascript" src="/Public/admin/js/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/Public/admin/css/min.css" />
<script type="text/javascript" src="/Public/admin/js/min.js"></script>
<style type="text/css">
html { overflow-x: hidden; overflow-y: auto; } 
</style>
<script type="text/javascript">
$(function(){
	//$(".nav li ul li").addClass("selected");
	$("#sidebar li").toggle(
		function(){
			$(this).find("ul").animate({height: 'toggle', opacity: 'toggle'}, { duration: 200 })	
		},
		function(){
			$(this).find("ul").animate({height: 'toggle', opacity: 'toggle'}, { duration: 200 })	
		}
	)
	
	$("#sidebar li").hover(
		function(){
			$(this).find("a[class=top_item]").animate({paddingRight: "25px" }, { duration: 200 })	
		},
		function(){
			$(this).find("a[class=top_item]").animate({paddingRight: "15px" }, { duration: 200 })	
		}
	)
	
	$("#sidebar li ul li a").click(
		function () {
			parent.main.location.href=(this.href);
			$("#sidebar li ul li a").removeClass('selected_1');
			$(this).addClass("selected_1");
			return false;
		}
	); 
})
</script>
</head>
<body>
<!--  SIDEBAR  -->
<div id="sidebar" >
  <ul>
  <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="javascript:void(0)"><?php echo ($vo["name"]); ?></a>
  		<ul>
  		<?php if(is_array($vo["menu_c"])): $i = 0; $__LIST__ = $vo["menu_c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li ><a href="<?php echo U('Admin/'.$v['controller'].'/'.$v['action']);?>" ><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	    </ul>
  	</li><?php endforeach; endif; else: echo "" ;endif; ?>
    
  </ul>
</div>
</body>
</html>