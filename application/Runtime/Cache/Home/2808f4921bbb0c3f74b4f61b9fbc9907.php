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
<link rel="stylesheet" type="text/css" href="/Public/home/css/piccontext.css"  />
<script type="text/javascript" src="/Public/home/js/piccontent.min.js"></script>
<!--banner -->

<div class="banner_div_send">
  <div class="banner_send">
    <?php if($tinfo["image"] != ''): ?><img src="<?php echo ($tinfo["image"]); ?>" /><?php endif; ?>
  </div>
</div>
<!----banner---> 


<div class="main"> 
<!-- page link -->
<div class="page_link"> 
	<a href="<?php echo U('Main/index');?>">首页</a> &raquo; 
    <a href="<?php echo U('Gallery/index');?>">店铺风采</a>   &raquo; 
   详细信息 
  </div>
<!-- page link end --> 
  <!--弹出层开始-->
  <div class="bodymodal"></div>
  <!--播放到第一张图的提示-->
  <div class="firsttop lightTop">
    <div class="close2"> <a class="closebtn1" title="关闭" href="javascript:void(0)"></a> </div>
    <div class="firsttop_main">
      <div class="replay">
        <h2 id="div-end-h2"> 已到第一张图片了。 </h2>
        
      </div>
      <div class="replaybtnStlye"><a class="replaybtn1 " href="javascript:;">重新播放</a></div>
      <div class="pictwo">
        <ul>
        <?php if($storeprev != null): ?><li><a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storeprev['id']));?>" title="<?php echo ($storeprev["title"]); ?>" ><img src="<?php echo U('Thumb/index',array('thumb'=>$storeprev['cover_image'],'w'=>120,'h'=>90));?>" alt="<?php echo ($storeprev["title"]); ?>" /></a>
            <div class="imgdivtext"> <a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storeprev['id']));?>" title="<?php echo ($storeprev["title"]); ?>" >上一图集</a> </div>
          </li>
         <?php else: ?>
	         <li>
             <span class="nullFont">没有了</span>
	         	<div class="imgdivtext">上一图集</div> 
	         </li><?php endif; ?>
         <?php if($storenext != null): ?><li><a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storenext['id']));?>" title="<?php echo ($storenext["title"]); ?>" ><img src="<?php echo U('Thumb/index',array('thumb'=>$storenext['cover_image'],'w'=>120,'h'=>90));?>" alt="<?php echo ($storenext["title"]); ?>" /></a>
            <div class="imgdivtext"> <a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storenext['id']));?>" title="<?php echo ($storenext["title"]); ?>" >下一图集</a> </div>
          </li>
          <?php else: ?>
	          <li>  <span class="nullFont">没有了</span>
	         	<div class="imgdivtext">下一图集</div> 
	         </li><?php endif; ?> 
        </ul>
      </div>
      <div class="returnbtn"> <a href="<?php echo U('Gallery/index');?>">返回店铺风采首页</a></div>
    </div>
  </div>
  <!--播放到最后一张图的提示-->
  <div class="endtop lightTop">
   <div class="close2"> <a class="closebtn2" title="关闭" href="javascript:void(0)"></a> </div>
    <div class="firsttop_main">
      
      <div class="replay">
        <h2 id="H1"> 已到最后一张图片了。 </h2>
        
      </div>
      <div  class="replaybtnStlye"> <a class="replaybtn2 " href="javascript:;">重新播放</a> </div>
      <div class="pictwo">
        <ul>
        <?php if($storeprev != null): ?><li><a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storeprev['id']));?>" title="<?php echo ($storeprev["title"]); ?>" ><img src="<?php echo U('Thumb/index',array('thumb'=>$storeprev['cover_image'],'w'=>120,'h'=>90));?>" alt="<?php echo ($storeprev["title"]); ?>" /></a>
            <div class="imgdivtext"> <a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storeprev['id']));?>" title="<?php echo ($storeprev["title"]); ?>" >上一图集</a> </div>
          </li>
         <?php else: ?>
	         <li><span class="nullFont">没有了</span>
	         	<div class="imgdivtext">上一图集</div> 
	         </li><?php endif; ?>
         <?php if($storenext != null): ?><li><a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storenext['id']));?>" title="<?php echo ($storenext["title"]); ?>" ><img src="<?php echo U('Thumb/index',array('thumb'=>$storenext['cover_image'],'w'=>120,'h'=>90));?>" alt="<?php echo ($storenext["title"]); ?>" /></a>
            <div class="imgdivtext"> <a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storenext['id']));?>" title="<?php echo ($storenext["title"]); ?>" >下一图集</a> </div>
          </li>
          <?php else: ?>
	          <li><span class="nullFont">没有了</span>
	         	<div class="imgdivtext">下一图集</div> 
	         </li><?php endif; ?> 
        </ul>
      </div>
      <div class="returnbtn"> <a href="<?php echo U('Gallery/index');?>">返回店铺风采首页</a> </div>
    </div>
  </div>
  <!--弹出层结束--> 
  <!--图片特效内容开始-->
  <div class="piccontext">
  <h2> 
   <div class="source_right"><a href="javascript:;" class="list">列表查看</a> </div>
      <div class="source_right1"> <a href="javascript:;" class="gaoqing">高清查看</a> </div>
    <?php echo ($storeinfo["title"]); ?> - <span class="h2font">发布人：<?php echo ($storeinfo["author"]); ?><span><?php echo (date("Y/m/d H:i:s",$storeinfo["addtime"])); ?></span></span>
    </h2>
    <div class="galleryNav"  >
    <div class="picDes" >
    <div style="padding:5px;">
     <?php echo ($storeinfo["contents"]); ?>
    </div>
    </div>
    <!--大图展示-->
    <div class="picshow">
      <div class="picshowtop">
          <a href="#"><img src="" alt="" id="pic1" curindex="0" /></a>
          <a id="preArrow" href="javascript:void(0)" class="contextDiv" title="上一张"><span id="preArrow_A"></span></a>
          <a id="nextArrow" href="javascript:void(0)" class="contextDiv" title="下一张"><span id="nextArrow_A"></span></a>
      </div>
      <div class="picshowtxt">
        <div class="picshowtxt_left"><span>1</span>/<i><?php echo ($count_i); ?></i></div>
        <div class="picshowtxt_right"></div>
      </div>
      <div class="picshowlist"> 
        <!--上一条图库-->
        <?php if($storeprev != null): ?><div class="picshowlist_left">
	          <div class="picleftimg"> <a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storeprev['id']));?>" title="<?php echo ($storeprev["title"]); ?>" ><img src="<?php echo U('Thumb/index',array('thumb'=>$storeprev['cover_image'],'w'=>80,'h'=>60));?>" alt="<?php echo ($storeprev["title"]); ?>" /></a> </div>
	          <div class="piclefttxt"> <a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storeprev['id']));?>" title="<?php echo ($storeprev["title"]); ?>"><?php echo ($storeprev["title"]); ?></a> </div>
        	</div>
        <?php else: ?>
        	<div class="picshowlist_left">
        	<div class="wufont">没有了</div>
        	</div><?php endif; ?>
        
        <div class="picshowlist_mid">
          <div class="picmidleft"> <a href="javascript:void(0)" id="preArrow_B"><img src="/Public/home/images/left1.jpg" alt="上一个" /></a> </div>
          <div class="picmidmid">
            <ul>
            <?php if(is_array($detail)): $i = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a href="javascript:void(0);"><img src="<?php echo U('Thumb/index',array('thumb'=>$vo['simage'],'w'=>80,'h'=>60));?>" alt="" bigimg="<?php echo ($vo["image"]); ?>" text="<?php echo ($vo["description"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>  
            </ul>
          </div>
          <div class="picmidright"> <a href="javascript:void(0)" id="nextArrow_B"><img src="/Public/home/images/right1.jpg" alt="下一个" /></a> </div>
        </div>
        <!--下一张图库新闻-->
        <?php if($storenext != null): ?><div class="picshowlist_right">
	          <div class="picleftimg"> <a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storenext['id']));?>" title="<?php echo ($storenext["title"]); ?>"><img src="<?php echo U('Thumb/index',array('thumb'=>$storenext['cover_image'],'w'=>80,'h'=>60));?>" alt="<?php echo ($storenext["title"]); ?>" /></a> </div>
	          <div class="piclefttxt"> <a href="<?php echo U('Gallery/storeInfo',array('nid'=>$storenext['id']));?>" title="<?php echo ($storenext["title"]); ?>"><?php echo ($storenext["title"]); ?></a> </div>
	        </div>
        <?php else: ?>
        	<div class="picshowlist_right">
	          <div class="wufont">没有了</div>
	        </div><?php endif; ?>
        
      </div>
    </div>
     <!--大图展示-->
     <div class="clear"></div>
     </div>
    
    <!--列表展示-->
    <div class="piclistshow">
      <ul>
      <?php if(is_array($detail)): $i = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
          <div class="picimg"><img src="<?php echo U('Thumb/index',array('thumb'=>$vo['simage'],'w'=>220,'h'=>160));?>" alt="<?php echo ($vo["description"]); ?>" /></div>
          <div class="pictxt">
            <h3><?php echo ($vo["description"]); ?><span>(<?php echo ($i); ?>/<?php echo ($count_i); ?>)</span></h3>
          </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
  </div>
</div>
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