<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo C('site_title');?> <?php echo C('site_name');?></title>
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('description');?>" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/global.css"  />
<link rel="stylesheet" type="text/css" href="/Public/home/css/layout.css"  />
<script type="text/javascript" src="/Public/home/js/jquery-1.8.3.min.js"></script>
<script src="/Public/home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<link href="/Public/home/css/rating_bar.css" rel="stylesheet" type="text/css" />
<script src="/Public/home/js/mzp-packed.js" type="text/javascript"></script>
<script src="/Public/home/js/jquery.select-1.3.6.js" type="text/javascript"></script>
<link href="/Public/home/css/selectStyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">	
 $(document).ready(function($){
	 $("select").sSelect();
	$(window).scroll(function(){
	var sTop=$(document).scrollTop();
	//console.log(sTop);
		if(sTop>=110){
		  // $('#nav2013').css("display","block");
		  $('#menuScr').addClass('menuTop_fix');  
		   $('.backTop').css("display","block");
		}else{
			//$('#nav2013').css("display","none");
			$('#menuScr').removeClass('menuTop_fix'); 
			$('.backTop').css("display","none"); 
			 
		}
	});
});	</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?2840c87a016f056d075fee306b860d76";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<link href="/Public/home/css/magiczoomplus.css" type="text/css" rel="stylesheet" />
<!-- <link href="/Public/home/css/163css1.css" type="text/css" rel="stylesheet" /> -->
 
</head>
<body>
<a name="top" id="top"></a> 
<div class="con_home">
   
  <div class="logo">
    <h2><a href="index.html"><img src="/Public/home/images/logo_03.png" width="237" height="46" /></a></h2>
    <div class="navSearch">
   <!-- 搜索 -->
    <form action="<?php echo U('Search/results');?>" method="get">
    
    <div class="serch">
    <div style="float:left; ">
    <DIV style="width:70px;  padding:3px 0 0 5px;">
        <div style="position:absolute;">
        <select name="model" id="s_model" >
                <option <?php if(($model) == "news"): ?>selected="selected"<?php endif; ?> value="news">新闻</option>
                <option <?php if(($model) == "product"): ?>selected="selected"<?php endif; ?> value="product">产品</option>
        </select>	
          </div>
          </div>
      </div>
      <div>
      <input type="text" class="txt" name="keyword" placeholder="请输入搜索内容" value="<?php echo ($keyword); ?>"/>&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" class="btn"  value="搜索 &raquo; " />
     </div>
    </div>
    </form> 
    <!-- ！搜索 -->
    </div>
    <script>
    $('.btn').click(function(){
    	if($('.txt').val()==''||$('#s_model').val()==''){
    		return false;
    	}
    })
    </script>
  </div>
  <div class="clear"></div>
  
  <div id="menuScr" class="nav menuTop">
    <div class="sub_nav">
     <div class="top_div">
      <p><span>欢迎您： <?php echo ($thisUser["name"]); ?>  &nbsp;<?php echo ($thisUser["deptname"]); ?></span> &nbsp;&nbsp;&nbsp;&nbsp;<span><?php if(($_SESSION['user_type']) == "0"): ?><a href="<?php echo U('Infos/updateinfo');?>"  class="changepw">修改密码</a><?php endif; ?></span><span><a href="<?php echo U('Home/Main/loginout');?>" class="logout">退出</a></span></p>
    </div>
      <ul>
        <li><a href="<?php echo U('Main/index');?>"  class=active>首页</a></li><!-- <?php if((CONTROLLER_NAME == 'Main') ): ?>class="active"<?php endif; ?>  -->
		<?php if(is_array($toplist)): $i = 0; $__LIST__ = $toplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["ispic"] == 1): ?><li><a href="<?php echo ($vo["url"]); ?>" <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>><img src="<?php echo ($vo["image"]); ?>"></a></li>
			<?php else: ?>
				<li><a href="<?php echo ($vo["url"]); ?>" <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <li style="background:none;"></li>
      </ul>
    </div>
  </div>
   
 		<div class="rightLinkNav" style=" ">
        <div class="box">
        <div>IT工程师</div>
        <div class="qqlink"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank">&nbsp;</a></div>
        <div class="qqfont"><?php echo C('site_qq');?></div>
        </div>
        <div class="backTop" >
        	<a href="#top">返回顶部</a>
        </div>
        </div>
  
<link rel="stylesheet" type="text/css" href="/Public/home/css/gallery.css"  />
<script type="text/javascript" src="/Public/home/js/jquery.wookmark.js"></script>
<style>
.galleryNav ul{ position:relative}
</style>
<!--banner -->

<div class="banner_div_send">
  <div class="banner_send">
    <?php if($tinfo["image"] != ''): ?><img src="<?php echo ($tinfo["image"]); ?>" /><?php endif; ?>
  </div>
</div>
<!----banner---> 
<!-- page link -->
<div class="page_link"> 
	<a href="<?php echo U('Main/index');?>">首页</a> &raquo; 
    <a href="<?php echo U('Gallery/index');?>">店铺风采</a>   &raquo; 
    <a href="<?php echo U('Gallery/storecatgary',array('pid'=>$pinfo['id']));?>"><?php echo ($pinfo["name"]); ?></a> &raquo;  
    <?php echo ($tinfo["name"]); ?>
    </div>
<!-- page link end --> 
<!----home_con--->
<div class="home_con"> 
  <!----home_con_L--->
  <div class="home_con_L"> 
    <!-- start -->
     
      <div  class="galleryPageNav">
          
          <h2><?php echo ($tinfo["name"]); ?></h2>
         
           <div class="page">
        <div class="pagination"><?php echo ($page); ?></div>
      </div>
       <div class="pageLine"></div>
       <div class="clear"></div>
          <div class="galleryNav">
            <ul>
              <?php if(is_array($newslist)): $i = 0; $__LIST__ = $newslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
                 <div class="list">
                 <div class="img"><a target="_blank" href="<?php echo U('Gallery/storeInfo',array('nid'=>$v['id']));?>"><img src="<?php echo U('Thumb/index',array('thumb'=>$v['cover_image'],'w'=>200,'h'=>150));?>" /></a></div>
                
                 	<div class="title"><a  target="_blank" href="<?php echo U('Gallery/storeInfo',array('nid'=>$v['id']));?>"><?php echo ($v["title"]); ?></a></div>
                    
                 </div>
                 
                 
                 </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </div>
       
      </div>
      
    <!-- end --> 
    <div class="pageLine"></div>
    <div class="page">
        <div class="pagination"><?php echo ($page); ?></div>
      </div>
       <div class="clear"></div>
  </div>
  <div class="in_right"> 
    <!-- news categary-->
    <div class="newRightNav">
      <p class="title"><?php echo ($pinfo["name"]); ?></p>
      <ul>
        <?php if(is_array($cateList)): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
          	<a href="<?php echo U('Gallery/storelist',array('pid'=>$pinfo['id'],'tid'=>$vo['id']));?>" 
            <?php if($tinfo["id"] == $vo['id']): ?>class ="curren"<?php endif; ?>
            >&raquo; <?php echo ($vo["name"]); ?></a>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
	<div class="zhongdianzhanshig">
      <p class="yc_title">最新店铺</p>
      <div>
        <?php if(is_array($newStore)): $i = 0; $__LIST__ = $newStore;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="dongtainrdl">
          <div class="dongtainrdd"><a href="<?php echo U('Gallery/storeInfo',array('nid'=>$vo['id']));?>"><img src="<?php echo U('Thumb/index',array('thumb'=>$vo['cover_image'],'w'=>82,'h'=>62));?>" title="<?php echo ($vo["title"]); ?>" /></a></div>
          <div class="dongtainrdt"><a href="<?php echo U('Gallery/storeInfo',array('nid'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>"><?php echo (msubstr($vo["title"],0,10,'utf-8',true)); ?></a>
            <p class="p_2">发布日期:  <?php echo (date("Y-m-d",$vo["addtime"])); ?> </p>
          </div>
          <div class="clear"></div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
    <!-- news categary-->
   
    <div class="shiyonggju">
      <p class="yc_title">实用工具</p>
      <div class="shiyonggju_b">
        <ul>
			<?php if(is_array($tools)): $i = 0; $__LIST__ = $tools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["ispic"] == 1): ?><li><a href="<?php echo ($vo["url"]); ?>" <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>><img src="<?php echo ($vo["image"]); ?>"></a></li>
			<?php else: ?>
			<li><a href="<?php echo ($vo["url"]); ?>" <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="clear"></div>
    
</div>
<!----home_con_R---> 
<!----ewm--->
<div class="ewm">
  <div class="ewm_b">
	<ul>
		<?php if(is_array($botlist)): $i = 0; $__LIST__ = $botlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["ispic"] == 1): ?><li><a href="<?php echo ($vo["url"]); ?>" <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>><img src="<?php echo ($vo["image"]); ?>"></a></li>
		<?php else: ?>
		<li><a href="<?php echo ($vo["url"]); ?>" <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	</ul>
  </div>
</div>
<!----ewm--->
<div class="footer">
  <div class="footer_b">
    <div class="footer_c"> 
      <div class="banquanxx"><?php echo C('copyright');?><br />
        <?php echo C('ipc');?>
        
        <a href="javascript:;" class="ucUrl">CRM</a>
        <script type="text/javascript">	
			$(document).ready(function($){
				 $(".ucUrl").click(function(){
					 $.ajax({
						type: "POST",
						url: "/uclogin.php/index/uc_urlRed",
						cache:false,
						data:'',
						dataType:'json',
						success: function(msg){
							// alert(msg.ret_code);
							if(msg.ret_code == 0){
								var data = msg.data;
									var urlHref = "http://www.******.com?openid="+data.openid+"&token="+data.token; 
									alert(msg);//window.open(urlHref); 
								}else{
									 alert("系统暂时无法跨域验证用户！");
								}   
                   		} 
               		});
				});
			});
		</script>
        </div>
       
    </div>
    <div class="dibulogo"><img src="/Public/home/images/logo_03.png" width="237" height="46" /></div>
    <div class="clear"></div>
  </div>
  
</div>
<div class="clear"></div>
</div>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F1d1ef8057b9a94915f0083b267f4a404' type='text/javascript'%3E%3C/script%3E"));
</script>

</body>
</html>
<script>
$('.galleryNav ul li').wookmark({
    container: $('.galleryNav ul'),
    offset: 0,
    itemWidth: 250,
    autoResize: true
});
</script>