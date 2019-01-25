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
  
<!--banner -->
<style>
.subbanner{
	height: 60px;
	background: <?php echo ($sub["backgroundimg"]); ?>;
	width: 1024px;
	margin: 10px auto;
	position:relative;
}
</style>
<div class="banner_div">
  <div class="banner">
    <div class="adSlide" style="width:1024px">
      <div class="hd">
        <ul>
        </ul>
      </div>
      <div class="bd">
        <ul>
          <?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"> <img src="<?php echo ($vo["image"]); ?>" width="1024px" height="250px" style="width:1024px; height:250px;" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
    <script type="text/javascript">jQuery(".adSlide").slide({ titCell: ".hd ul", mainCell: ".bd ul", autoPlay: true, effect:"leftLoop",autoPage: "<li></li>" });</script> 
    <!-- <div  class="banner_R"> </div> --> 
  </div>
</div>
<?php if($sub["url"] != ''): ?><a href="<?php echo ($sub["url"]); ?>">
  <div class="subbanner">
	  <div style="position:absolute;">
	  	<?php if($sub["image"] != ''): ?><img src="<?php echo ($sub["image"]); ?>" style="width:1024px;height:60px;"/><?php endif; ?>
	  </div>
	  <div style="position:absolute;width:100%;height:100%;">
	  	   <?php echo ($sub["text"]); ?>
	  </div>
 </div>
 </a><?php endif; ?>
<!----banner---> 
<!----home_con--->
<div class="home_con"> 
  <!----home_con_L--->
  <div class="home_con_L"> 
    <!-- start -->
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div  class="home_con_1">
        <div class="slideTxtBox">
          <h2><a href="<?php echo U('Main/newcatgary',array('pid'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></h2>
          <div class="hd">
            <ul>
              <?php if(is_array($vo["new_c"])): $i = 0; $__LIST__ = $vo["new_c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Main/newslist',array('pid'=>$vo['id'],'tid'=>$v['id']));?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </div>
        </div>
        <div class="bd"> 
          <!-- model 1 -->
          <?php if($vo["model"] == 1): if(is_array($vo["new_c"])): $i = 0; $__LIST__ = $vo["new_c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div>
                <?php if(is_array($v["newlist"])): $i = 0; $__LIST__ = array_slice($v["newlist"],0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nv): $mod = ($i % 2 );++$i;?><div  class="zdyx_1_L f_l">
                    <?php if($nv["image"] != ''): ?><div  class="dyx_1_txt_1">
                        <div  class="zdyx_1_img"><a href="<?php echo U('Main/newsdetail',array('nid'=>$nv['id']));?>"><img src="<?php echo U('Thumb/index',array('thumb'=>$nv['image'],'w'=>160,'h'=>120));?>" title="<?php echo ($nv["title"]); ?>" width="160" height="120" /></a></div>
                        <div class="title"><a href="<?php echo U('Main/newsdetail',array('nid'=>$nv['id']));?>"  title="<?php echo ($nv["title"]); ?>" ><?php echo (msubstr($nv["title"],0,16,'utf-8',true)); ?></a></div>
                        <div class="info"><a href="<?php echo U('Main/newsdetail',array('nid'=>$nv['id']));?>" ><?php echo (msubstr($nv["description"],0,60,'utf-8',true)); ?></a></div>
                        <div class="time"><?php echo (date("Y-m-d H:i:s",$nv["time"])); ?></div>
                      </div>
                      <?php else: ?>
                      <div  class="dyx_1_txt_1">
                        <div class="title"><a href="<?php echo U('Main/newsdetail',array('nid'=>$nv['id']));?>"  title="<?php echo ($nv["title"]); ?>" ><?php echo (msubstr($nv["title"],0,32,'utf-8',true)); ?></a></div>
                        <div class="info"><a href="<?php echo U('Main/newsdetail',array('nid'=>$nv['id']));?>" ><?php echo (msubstr($nv["description"],0,100,'utf-8',true)); ?></a></div>
                        <div class="time"><?php echo (date("Y-m-d",$nv["time"])); ?></div>
                      </div><?php endif; ?>
                  </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <div  class="zdyx_1_R  f_r">
                  <ul>
                    <?php if(is_array($v["newlist"])): $i = 0; $__LIST__ = array_slice($v["newlist"],1,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nv): $mod = ($i % 2 );++$i;?><li>
                        <?php echo ($i); ?><p><a href="<?php echo U('Main/newsdetail',array('nid'=>$nv['id']));?>" title="<?php echo ($nv["title"]); ?>"> &#8250; <?php echo (msubstr($nv["title"],0,17,'utf-8',true)); ?></a></p>
                        <span>
                        <!-- <?php if($nv["isnew"] == 1 || $nv["istop"] == 1): if($nv["isnew"] == 1): ?><img src="/Public/home/images/new.jpg" width="15"  /><?php endif; ?>
                          <?php if($nv["istop"] == 1): ?><img src="/Public/home/images/top.jpg" width="15"   /><?php endif; ?>
                          <?php else: ?>
                          <?php echo (date("m-d",$nv["time"])); endif; ?>
                        -->
                        <?php if((($nowtime-$nv['time']) <= 259200)AND(($nowtime-$nv['time']) >= 0)): ?><img src="/Public/home/images/new.jpg" width="15"  />
                          <?php else: ?>
                          <?php echo (date("m-d",$nv["time"])); endif; ?>
                        </span> </li><?php endforeach; endif; else: echo "" ;endif; ?>
                  </ul>
                </div>
                <div class="clear"></div>
              </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
            <!-- model 2 --> 
            <?php if(is_array($vo["new_c"])): $i = 0; $__LIST__ = $vo["new_c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="dongtai_b">
                  <div class="dongtainr">
                    <ul>
                      
                      <?php if(is_array($v["newlist"])): $i = 0; $__LIST__ = array_slice($v["newlist"],0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nv): $mod = ($i % 2 );++$i; if(($mod) == "0"): ?><li class="liLeft" ><?php endif; ?>
                          <?php if(($mod) == "1"): ?><li class="liRight" ><?php endif; ?>
                          <p class="nr"><a href="<?php echo U('Main/newsdetail',array('nid'=>$nv['id']));?>" title="<?php echo ($nv["title"]); ?>">&#8250; <?php echo (msubstr($nv["title"],0,18,'utf-8',true)); ?></a></p>
                                                   
                          <span>                          
                          <?php if((($nowtime-$nv['time']) <= 259200)AND(($nowtime-$nv['time']) >= 0)): ?><img src="/Public/home/images/new.jpg" width="15"  /> <?php echo (date("m-d",$nv["time"])); ?> 
                          <?php else: ?>
                          <?php echo (date("m-d",$nv["time"])); endif; ?>
                          </span> </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <div class="clear"></div>
                  </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
             <!-- model 2 --><?php endif; ?>
          
          <!--  --> 
        </div>
      </div>
      <div class="h10"></div><?php endforeach; endif; else: echo "" ;endif; ?>
    <!-- end --> 
    
    <!-- <div class="xiao_banner"><img src="images/banneimwg.jpg" width="756" height="81" alt="0" /></div> --> 
   <script type="text/javascript">
	jQuery(".home_con_1").slide();
	<?php if($ggcenter != '' ): ?>$('.home_con_1').eq(1).after('<div class="xiao_banner"><a href="<?php echo ($ggcenter["url"]); ?>"><img src="<?php echo ($ggcenter["image"]); ?>" width="756"   /></a></div>')<?php endif; ?>
    </script>
    <div class="cuxiao"  style="display:block;">
      <div class="dianpufengcai" style="">
        <div class="title">
          <h2><a href="<?php echo U('Gallery/index');?>">店铺风采</a></h2>
          <p><a href="<?php echo U('Gallery/index');?>">更多店铺...</a></p>
        </div>
      </div>
      <div class="dianpfendl">
      <ul>
      <?php if(is_array($gallery)): $i = 0; $__LIST__ = $gallery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
          <div class="img"><a  target="_blank" href="<?php echo U('Gallery/storeInfo',array('nid'=>$vo['id']));?>"><img src="<?php echo U('Thumb/index',array('thumb'=>$vo['cover_image'],'w'=>160,'h'=>120));?>"   title="<?php echo ($vo["title"]); ?>"/></a></div>
          <div class="titlefont"><a  target="_blank" href="<?php echo U('Gallery/storeInfo',array('nid'=>$vo['id']));?>"><?php echo (msubstr($vo["title"],0,16,'utf-8',true)); ?></a></div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="clear"></div>
        </ul>
      </div>
    </div>
  </div>
  <div class="in_right">
  
  <?php if($area_check != '' ): ?><div class="zhongdianzhanshig">
      <p class="yc_title">最新款展示</p>
      <div>
        <div class="picScroll-top" >
          <div class="bd">
            <ul class="picList">
              <?php if(is_array($listProducts)): $i = 0; $__LIST__ = $listProducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                  <div class=" ">
                    <div class="proImg"><a target="_blank" href="<?php echo U('Product/info',array('pcID'=>$vo['pcID'],'id'=>$vo['id'],'styleID'=>$vo['styleID']));?>"><img src="/index.php/Thumb/pimg/p/<?php echo ($vo["catalog"]); ?>-<?php echo ($vo["styleID"]); ?>-<?php echo ($vo["colorname"]); ?>-40-50.html" width="40" height="50" onerror="this.src='/Public/home/images/nopic.jpg';this.onerror=null"/></a></div>
                    <div class="proInfo">
                      <div class="proInfoTitle"><a target="_blank" href="<?php echo U('Product/info',array('pcID'=>$vo['pcID'],'id'=>$vo['id'],'styleID'=>$vo['styleID']));?>"><?php echo ($vo["pname"]); ?></a></div>
                      <div class="pjg">价格：<span style=" color:#900;">￥<?php echo ($vo["price"]); ?></span> </div>
                    </div>
                    <div class="clear"></div>
                  </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </div>
        </div>
        <script type="text/jscript">
			jQuery(".picScroll-top").slide({mainCell:".bd ul",autoPlay:true,effect:"topMarquee",vis:5,interTime:50,trigger:"click"});
        </script> 
        <!-----滚动------->
        <div class="clear"></div>
      </div>
          <div class="clear"></div>
    </div>
     
    <div class="kuncueng">
     <div class="h10"></div>
      <p class="yc_title">最新产品批次</p>
      <ul >
         <!-- pici --> 
     <?php if(is_array($piciList)): $i = 0; $__LIST__ = $piciList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li >
        <a href="<?php echo U('Product/index',array('pcid'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>"><?php echo (msubstr($vo["title"],0,16,'utf-8',true)); ?></a> 
         
         </li><?php endforeach; endif; else: echo "" ;endif; ?>
    
    <!-- pici -->
      </ul>
     
      <div class="clear"></div>
    </div>
     <div class="h10"></div>
      <div class="h10"></div><?php endif; ?>
    <?php if($gg["image"] != '' ): ?><div class="in_yc_banner"><a href="<?php echo ($gg["url"]); ?>" 
                <?php if($gg["isin"] == 0): ?>target="_blank"<?php endif; ?>
                ><img src="<?php echo ($gg["image"]); ?>" width="220"  /></a>
                
                </div><?php endif; ?>
    <div class="shiyonggju"  >
      <p class="yc_title">实用工具</p>
      <div class="shiyonggju_b">
        <ul>
          <?php if(is_array($tools)): $i = 0; $__LIST__ = $tools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["ispic"] == 1): ?><li><a href="<?php echo ($vo["url"]); ?>" 
                <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>
                ><img src="<?php echo ($vo["image"]); ?>"></a></li>
              <?php else: ?>
              <li>
                <?php if($vo["image"] != ''): ?><div class="img" style="background: url(<?php echo ($vo["image"]); ?>)0 50% no-repeat;">
                <?php else: ?>
                <div style=""><?php endif; ?>
                <a href="<?php echo ($vo["url"]); ?>" 
                <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>
                ><?php echo ($vo["name"]); ?></a></li>
              </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
    <div>
	<style>
	.homeRightLinks img{width:200px}
	</style>
    <div class="homeRightLinks">
      <ul>
        <?php if(is_array($riglist)): $i = 0; $__LIST__ = $riglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["ispic"] == 1): ?><li>
            <div><a href="<?php echo ($vo["url"]); ?>" 
              <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>
              ><img src="<?php echo ($vo["image"]); ?>"></a></div>
              </li>
            <?php else: ?>
            <li>
            <div><a href="<?php echo ($vo["url"]); ?>" 
              <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>
              ><img src="<?php echo ($vo["image"]); ?>"></a></div>
                <span class="font">
              <a href="<?php echo ($vo["url"]); ?>" 
              <?php if($vo["isin"] == 0): ?>target="_blank"<?php endif; ?>
              ><?php echo ($vo["name"]); ?></a>
              </span>
              </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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