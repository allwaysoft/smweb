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
  
 
<link href="/Public/home/css/product.css" rel="stylesheet" type="text/css" />
<link href="/Public/home/css/fdj.css" rel="stylesheet" type="text/css" />
<script src="/Public/home/js/fdj.js" type="text/javascript"></script>
<script src="/Public/home/js/slider.js" type="text/javascript"></script>
<div class="banner_div_send">
  <div class="banner_send"> </div>
</div>
<!-- main  start -->
<div class="main center">
  <div style=" padding:10px 0; " ><span><a href="<?php echo U('Main/index');?>">首页</a></span> &raquo; <span><a href="<?php echo U('HotSales/index');?>">大爆款</a></span> &raquo; <span><?php echo ($info["pname"]); ?></span></div>
  <div class="pro_js">
    <div class="preview" > 
      <!--smallImg  -->
      <div class="smallImg">
        <div class="scrollbutton smallImgUp disabled"></div>
        <div id="imageMenu">
          <ul>
            <li id="onlickImg"><img src="/Upload/<?php echo ($info["catalog"]); ?>/S_<?php echo ($info["styleID"]); ?>-<?php echo ($info['colorname'][0]['codename']); ?>.jpg" width="68" height="85" alt="" onerror="this.src='/Public/home/images/nopic.jpg';this.onerror=null"/></li>
            <li><img src="/Upload/<?php echo ($info["catalog"]); ?>/S_<?php echo ($info["styleID"]); ?>-<?php echo ($info['colorname'][0]['codename']); ?>-01.jpg" width="68" height="85" alt="" onerror="this.style.display='none';this.onerror=null"/></li>
            <li><img src="/Upload/<?php echo ($info["catalog"]); ?>/S_<?php echo ($info["styleID"]); ?>-<?php echo ($info['colorname'][0]['codename']); ?>-02.jpg" width="68" height="85" alt="" onerror="this.style.display='none';this.onerror=null"/></li>
            <li><img src="/Upload/<?php echo ($info["catalog"]); ?>/S_<?php echo ($info["styleID"]); ?>-<?php echo ($info['colorname'][0]['codename']); ?>-03.jpg" width="68" height="85" alt="" onerror="this.style.display='none';this.onerror=null"/></li>
            <li><img src="/Upload/<?php echo ($info["catalog"]); ?>/S_<?php echo ($info["styleID"]); ?>-<?php echo ($info['colorname'][0]['codename']); ?>-04.jpg" width="68" height="85" alt="" onerror="this.style.display='none';this.onerror=null"/></li>
          </ul>
        </div>
        <div class="scrollbutton smallImgDown"></div>
      </div>
      <!--smallImg end--> 
      <!--bigImg end-->
      <div id="vertical" class="bigImg"> <img src="/Upload/<?php echo ($info["catalog"]); ?>/B_<?php echo ($info["styleID"]); ?>-<?php echo ($info['colorname'][0]['codename']); ?>.jpg" width="400" height="500" alt="" id="midimg" onerror="this.src='/Public/home/images/nopic.jpg';this.onerror=null"/>
        <div style="display:none;" id="winSelector"></div>
      </div>
      <div id="bigView" style="display:none;"><img width="800" height="800" alt="" src="" /></div>
      <!--bigImg end-->
      <div class="clear"></div>
    </div>
    <!--cpxx start-->
    <div class="cpxx"  >
      <div class="nk_t"><?php echo ($info["pname"]); ?> <span class="styleId"><?php echo ($info["styleID"]); ?></span></div>
      <div style="padding:1px 0 5px 0"><span  class="priceLine" >&yen;<?php echo ($info["price"]); ?></span> <span class="kcfont">
         <?php if($vo["stock"] == 0): endif; ?>
        <?php if($vo["stock"] > 0 && $vo["stock"] <= 10000): ?><span class="kzinfo2">库存:少量</span><?php endif; ?>
        <?php if($info["stock"] > 300 && $info["stock"] <= 1000): ?><span class="kcfont2">库存:中量</span><?php endif; ?>
        <?php if($info["stock"] > 1000): ?><span class="kcfont3">库存:大量</span><?php endif; ?>
        </span> <span class="djfont"> 人气(<?php echo ($info["click"]); ?>)&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:;" class="dzFunction "> 赞<span>(<?php echo ($info["zan"]); ?>)</span></a> </span> </div>
        
       <div class="change_color">
    	<ul>
        <li>颜色:&nbsp;</li>
        <?php if(is_array($info["colorname"])): $i = 0; $__LIST__ = $info["colorname"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="javascript:;" title="<?php echo ($vo["codename"]); ?>" alt="<?php echo ($vo["name"]); ?>"><?php echo ($vo["codename"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="clear"></div>
     	</ul>
      </div>
     <div class="size">
    	<ul>
        <li>尺码:&nbsp;&nbsp;&nbsp;</li>
       <?php if(is_array($info["rule"])): $i = 0; $__LIST__ = $info["rule"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="sizeList"><?php echo ($vo); ?>
       </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="clear"></div>
     	</ul>
      </div>
       <!--- --->
       <div class="shejishi">
    	<ul>
        <li>设计师:</li>
        
       <li class="shejishiList"><?php echo ($info["designer"]); ?>
       </li>
        
        <div class="clear"></div>
     	</ul>
      </div>
       <!--- --->
       <div  class="pingfeng">
       	<div class="biaoti">评分：</div>
        <div class="pingfengAction">
       		<div id="xzw_starSys">
              <div id="xzw_starBox">
                <ul class="star" id="star">
                  <li><a href="javascript:void(0)" title="1" class="one-star">1</a></li>
                  <li><a href="javascript:void(0)" title="2" class="two-stars">2</a></li>
                  <li><a href="javascript:void(0)" title="3" class="three-stars">3</a></li>
                  <li><a href="javascript:void(0)" title="4" class="four-stars">4</a></li>
                  <li><a href="javascript:void(0)" title="5" class="five-stars">5</a></li>
                </ul>
                <div class="current-rating" id="showb"></div>
              </div>
            </div>
           </div>
           <div class="clear"></div>
        </div>
         <!--- --->
         <div class="clear">&nbsp;</div>
        <div class="productDefail"> 产品描述： </div>
        <div class="huodongqijianv" style="overflow-x:hidden;"> <?php echo ($info["contents"]); ?> </div>
       <!--  /////////////////// -->
    </div>
     
    <!--cpxx end-->
    <div class="clear"></div>
  </div>
  <!--  /////////////////// -->
   <div class="serch_pro center" style="margin-top:10px;">
    <div class="serch_pro_t">同批次产品：</div>
    <div class="scrolllist" id="s1"> <a class="abtn aleft" href="#left" title="左移"></a>
      <div class="imglist_w">
        <ul class="imglist">
          <?php if(is_array($tklist)): $i = 0; $__LIST__ = $tklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a href="<?php echo U('Product/info',array('pcID'=>$vo['pcID'],'id'=>$vo['id'],'styleID'=>$vo['styleID']));?>" title=""><img width="120" height="150" alt="" src="/Upload/<?php echo ($vo["catalog"]); ?>/M_<?php echo ($vo["styleID"]); ?>-<?php echo ($vo['colorname']); ?>.jpg" onerror="this.src='/Public/home/images/nopic.jpg';this.onerror=null"/></a>
              <p><a href="<?php echo U('Product/info',array('pcID'=>$vo['pcID'],'id'=>$vo['id'],'styleID'=>$vo['styleID']));?>"><?php echo ($vo["pname"]); ?></a></p>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!--imglist end--> 
        
      </div>
      <a class="abtn aright" href="#right" title="右移"></a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
   <!--  /////////////////// -->
   <div class="serch_pro center" style="margin-top:10px;">
    <div class="serch_pro_t">最近浏览记录：</div>
    <div class="scrolllist" id="s1"> <a class="abtn aleft" href="#left" title="左移"></a>
      <div class="imglist_w">
        <ul class="imglist">
          <?php if(is_array($record)): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a href="<?php echo U('Product/info',array('pcID'=>$vo['pcID'],'id'=>$vo['id'],'styleID'=>$vo['styleID']));?>" title=""><img width="120" height="150" alt="" src="/Upload/<?php echo ($vo["catalog"]); ?>/M_<?php echo ($vo["styleID"]); ?>-<?php echo ($vo['colorname']); ?>.jpg" onerror="this.src='/Public/home/images/nopic.jpg';this.onerror=null"/></a>
              <p><a href="<?php echo U('Product/info',array('pcID'=>$vo['pcID'],'id'=>$vo['id'],'styleID'=>$vo['styleID']));?>"><?php echo ($vo["pname"]); ?></a></p>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!--imglist end--> 
      </div>
      <a class="abtn aright" href="#right" title="右移"></a>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!---浏览记录----> 
</div>
<!---浏览记录----> 

<!----ewm--->
<div class="clear"></div>
<script>
$("#s1").xslider({
	unitdisplayed:4,
	movelength:1,
	unitlen:176,
	autoscroll:3000
});
$('.change_color a').click(function(){
	//alert($(this).attr('title'))
	$('.change_color a').removeClass('colorcheck');
	$(this).addClass('colorcheck');
	var colorcode=$(this).attr('title');
	$("#imageMenu li").removeAttr("id");
	$("#imageMenu li:first").attr("id", "onlickImg");
	$('#imageMenu ul li').each(function(i,val){
		var src=$(this).children().eq(0).attr('src');
		var src_arr=new Array();
		src_arr=src.split('-');
		if(i==0){
			if('<?php echo ($info["catalog"]); ?>'==''){
				var newsrc='/Public/home/images/nopic.jpg';
				
			}else{
				src_arr[1]=colorcode+'.jpg';
				var newsrc='/Upload/<?php echo ($info["catalog"]); ?>/S_<?php echo ($info["styleID"]); ?>-'+src_arr[1];
			}
			$(this).children().eq(0).attr("onerror","this.src='/Public/home/images/nopic.jpg'")
			
		}else{
			src_arr[1]=colorcode;
			var newsrc=src_arr[0]+'-'+src_arr[1]+'-'+src_arr[2];
		}
		$(this).children().eq(0).attr('src',newsrc);
	})
	if('<?php echo ($info["catalog"]); ?>'==''){
		$('#vertical').children().eq(0).attr('src','/Public/home/images/nopic.jpg');
	}else{
		$('#vertical').children().eq(0).attr('src','/Upload/<?php echo ($info["catalog"]); ?>/B_<?php echo ($info["styleID"]); ?>-'+colorcode+'.jpg');
		$('#vertical').children().eq(0).attr("onerror","this.src='/Public/home/images/nopic.jpg'")
	}
	
});

/* 评分 */
$(document).ready(function(){
    var stepW = 24;
    var stars = $("#star > li");
    var descriptionTemp;
    $("#showb").css("width",stepW*<?php echo ($score); ?>);
    stars.each(function(i){
        $(stars[i]).click(function(e){
            var n = i+1;
       		var w=$("#showb").css('width');
       		if(w=='0px'){
       			var url="<?php echo U('Product/p_score');?>";
       			$.post(url,{styleID:<?php echo ($info["styleID"]); ?>,score:n});
       			$("#showb").css({"width":stepW*n});
                descriptionTemp = description[i];
                $(this).find('a').blur();
       		}

        });
    });
});

/* 赞 */

$(document).ready(function(){
	var zan=<?php echo ($zan); ?>;
	if(zan==0){
		$('.dzFunction').addClass('dzEnzan');
		 
		$('.dzFunction').one('click',function(){
			var url="<?php echo U('Product/p_zan');?>";
			$.post(url,{styleID:<?php echo ($info["styleID"]); ?>},function(msg){
				if(msg!='失败'){
					$('.dzFunction').removeClass('dzEnzan');
					$('.dzFunction').addClass('dzZan');
					$('.dzFunction span').html('('+msg+')');
					
				} 
			})
		})
	}else{
		$('.dzFunction').addClass('dzZan');
	}
})
</script> 
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