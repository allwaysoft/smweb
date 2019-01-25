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
  
<link rel="stylesheet" type="text/css" href="/Public/home/css/product.css"  />
<link rel="stylesheet" type="text/css" href="/Public/home/css/manhuaDialog.1.0.css">
<script type="text/javascript" src="/Public/home/js/manhuaDialog.1.0.js"></script>
<script type="text/javascript">
$(function (){
	$(".more a").manhuaDialog({					       
		Event : "click",								//触发响应事件
		title : "更多批次",					            //弹出层的标题
		type : "id",									//弹出层类型(text、容器ID、URL、Iframe)
		content : "detail",								//弹出层的内容获取(text文本、容器ID名称、URL地址、Iframe的地址)
		width : 500,									//弹出层的宽度
		height : 300,									//弹出层的高度	
		scrollTop : 200,								//层滑动的高度也就是弹出层时离顶部滑动的距离
		isAuto : false,									//是否自动弹出
		time : 2000,									//设置弹出层时间，前提是isAuto=true
		isClose : false,  								//是否自动关闭		
		timeOut : 5000									//设置自动关闭时间，前提是isClose=true	
	});
});	
 $(document).ready(function($){
	$(window).scroll(function(){
	var sTop=$(document).scrollTop();
	//console.log(sTop);
		if(sTop>=180){
		   $('#nav2013').css("display","block"); 
		   $('#nav2013').addClass('scrollTop_fix');
		  $('.proPagelink').css("display","none"); 
		  
		}else{
			$('#nav2013').css("display","none");
			$('#nav2013').removeClass('scrollTop_fix'); 
			$('.proPagelink').css("display","block");
			 
		}
	});
});	
 
</script>
<style>
.aside_left .check .more{text-align:center; color:#999; background:#ccc;}
</style>
<div class="main center">
<div class="banner_div_send">
<div class="banner_send"> </div>
</div>
<!-- <div style=" padding:10px 0; " ><span><a href="<?php echo U('Main/index');?>">首页</a></span> &raquo; <span><a href="<?php echo U('Product/index');?>">产品中心</a></span> &raquo; <span><a href="<?php echo U('Product/index',array('pcid'=>$pc['id']));?>"><?php echo ($pc["title"]); ?></a></span> &raquo; <span><?php echo ($info["pname"]); ?></span></div>-->

</div>
<div class="productMain">

<!-- scrollTop  start -->
  <div id="nav2013" class="scrollTop" >
    <div class="main center" style="padding:2px 0 2px 0;">
      <div class="scrollTopPro" title="<?php echo ($piciInfo["title"]); ?>"> 
       <?php if($piciInfo): echo (msubstr($piciInfo["title"],0,9,'utf-8',true)); ?>   <?php else: ?>
          产品中心<?php endif; ?>
       </div>
     <div class="scrollTopLink">
      <div class="paginationPro" style="float:right;"><?php echo ($page); ?></div>
      <div class="liebie">排序:
      	<span><a order="time desc" href="javascript:void(0);">默认</a></span>
        <span>按款:<a order="styleId asc" href="javascript:void(0);"><strong>↑</strong></a><a order='styleId desc' href="javascript:void(0);"><strong>↓</strong></a></span>
        &nbsp;&nbsp;
       <span>价格:<a order="price asc" href="javascript:void(0);"><strong>↑</strong></a><a order='price desc' href="javascript:void(0);"><strong>↓</strong></a></span>
       
       </div>
      <div class="clear"></div>
    </div>
      <div class="clear"></div> 
    </div>
  </div>
  <!-- scrollTop  start --> 
  <!-- main  start -->
  <div class="main center">
    <div class="aside_left">
      <!-- pici -->
      <div  id="detail" style="display:none">
    <ul class='check'>
     <?php if(is_array($pici)): $i = 0; $__LIST__ = $pici;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li  
        <?php if($_GET['pcid']== $vo['id']): ?>class="checked"<?php endif; ?>
        > <a href="<?php echo U('Product/index',array('pcid'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>">&raquo; <!--<?php echo (date("Y年m月d日",$vo["quotatime"])); ?>--><?php echo ($vo["title"]); ?></a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    </div>
    <ul class='check'>
    <div class="cate">批次选择</div>
     <?php if(is_array($pici)): $i = 0; $__LIST__ = array_slice($pici,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li  
        <?php if($_GET['pcid']== $vo['id']): ?>class="checked"<?php endif; ?>
        ><a href="<?php echo U('Product/index',array('pcid'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>"><!--<?php echo (date("Y年m月d日",$vo["quotatime"])); ?>--><?php echo ($vo["title"]); ?></a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
      <div class="more"><a href="javascript:;">&#8226;&#8226;&#8226;更多</a></div>
    </ul>
    <!-- pici -->
    <!-- 分类 -->
    <ul class='check'>
      <div class="cate">分类选择</div>
      <?php if(is_array($typenamelist)): $i = 0; $__LIST__ = $typenamelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li 
          
        
        
        <?php if(in_array($vo['typename'],$typename)): ?>class="checked"<?php endif; ?>
        ><a id="typename_<?php echo ($vo["typename"]); ?>" href="javascript:;" ><?php echo ($vo["typename"]); ?></a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <!--!分类  -->
      <!-- 风格 -->
    <ul class='check'>
      <div class="cate">风格选择</div>
      <?php if(is_array($typecodelist)): $i = 0; $__LIST__ = $typecodelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li 
          
        
        
        <?php if(in_array($vo['typecode'],$typecode)): ?>class="checked"<?php endif; ?>
        ><a id="typecode_<?php echo ($vo["typecode"]); ?>" href="javascript:;" ><?php echo ($vo["typecode"]); ?></a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
     <!-- 风格 -->
      <!-- 定位选择 -->
    <ul class='check'>
      <div class="cate">定位选择</div>
      <?php if(is_array($positionlist)): $i = 0; $__LIST__ = $positionlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li 
          
        
        
        <?php if(in_array($vo['position'],$position)): ?>class="checked"<?php endif; ?>
        ><a id="position_<?php echo ($vo["position"]); ?>" href="javascript:;" ><?php echo ($vo["position"]); ?></a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
      <!-- 定位选择 -->
    <!-- 尺码 -->
    <ul class='check' style="display:none;">
      <div class="cate">尺码选择</div>
      <li 
        
      
      
      <?php if(in_array('XS',$rule)): ?>class="checked"<?php endif; ?>
      ><a id="rule_XS" href="javascript:;">XS</a>
      </li>
      <li 
        
      
      
      <?php if(in_array('S',$rule)): ?>class="checked"<?php endif; ?>
      ><a id="rule_S" href="javascript:;" >S</a>
      </li>
      <li 
        
      
      
      <?php if(in_array('M',$rule)): ?>class="checked"<?php endif; ?>
      ><a id="rule_M" href="javascript:;" >M</a>
      </li>
      <li 
        
      
      
      <?php if(in_array('L',$rule)): ?>class="checked"<?php endif; ?>
      ><a id="rule_L" href="javascript:;" >L</a>
      </li>
      <li 
        
      
      
      <?php if(in_array('XL',$rule)): ?>class="checked"<?php endif; ?>
      ><a id="rule_XL" href="javascript:;" >XL</a>
      </li>
      <li 
        
      
      
      <?php if(in_array('XXL',$rule)): ?>class="checked"<?php endif; ?>
      ><a id="rule_XXL" href="javascript:;" >XXL</a>
      </li>
    </ul>
  
  </div>
  <!-- right ------->
  <div class="list_main"> 
    <!--banner lizd11-->
    <!----banner---> 
    <div class="page_link"> 
	<a href="<?php echo U('Main/index');?>">首页</a> &raquo;<a href="<?php echo U('Product/index');?>">产品中心</a>&raquo;
	搜索结果
    </div>
    <!-- sort -->
    <div style="height:35px;">
    <div  class="proPagelink" > 
      <div class="paginationPro" style="float:right;"><?php echo ($page); ?></div>
      <div class="liebie">排序:<span><a order="time desc" href="javascript:void(0);">默认</a></span>
      
        <span>按款:<a order="styleId asc" href="javascript:void(0);"><strong>↑</strong></a><a order='styleId desc' href="javascript:void(0);"><strong>↓</strong></a></span>
        &nbsp;&nbsp;
       <span>价格:<a order="price asc" href="javascript:void(0);"><strong>↑</strong></a><a order='price desc' href="javascript:void(0);"><strong>↓</strong></a></span></div>
      <div class="clear"></div>
    </div>
    </div>
    <div style="border-bottom:1px solid #999"></div>
    <!-- sort -->
    <div class="img_list">
      <ul>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li> <a href="<?php echo U('Product/info',array('pcID'=>$vo['pcID'],'id'=>$vo['id'],'styleID'=>$vo['styleID']));?>"><img src="/Upload/<?php echo ($vo["catalog"]); ?>/M_<?php echo ($vo["styleID"]); ?>-<?php echo ($vo["colorname"]); ?>.jpg" width="160" height="200" onerror="this.src='/Public/home/images/nopic.jpg';this.onerror=null"/></a>
          	<div class="number"><a href="<?php echo U('Product/info',array('pcID'=>$vo['pcID'],'id'=>$vo['id'],'styleID'=>$vo['styleID']));?>"><?php echo ($vo["styleID"]); ?></a></div>
            <div class="title"><a href="<?php echo U('Product/info',array('pcID'=>$vo['pcID'],'id'=>$vo['id'],'styleID'=>$vo['styleID']));?>"><?php echo ($vo["pname"]); ?></a></div>
           <!-- <?php if($vo["stock"] <= 300): ?><span class="kzinfo2">库存:少量</span><?php endif; ?>
            <?php if($vo["stock"] > 300 && $vo["stock"] <= 1000): ?><span class="kzinfo1">库存:中量</span><?php endif; ?>
            <?php if($vo["stock"] > 1000): ?><span class="kzinfo">库存:大量</span><?php endif; ?>-->
            <span class="jginfo"> ￥<?php echo ($vo["price"]); ?></span> </li><?php endforeach; endif; else: echo "$empty" ;endif; ?>
        <div style="clear:both;"></div>
      </ul>
    </div>
    <div class="clear"></div>
    <div style="border-bottom:2px solid #999"></div>
    <div class="paginationPro"><?php echo ($page); ?></div>
    <div class="clear"></div>
  </div>
  <!-- right ------->
  <div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<!-- main  end --> 
<!----ewm---> 
<script>
$('.check li a').click(function(){
	$(this).parent().toggleClass("checked");
	var rule='';
	var typecode='';
	var position='';
	var typename='';
	$('.check:gt(1) .checked').each(function(){
		var id=$(this).children().attr('id');
		id=id.split('_');
		switch(id[0]){
			case 'rule':
			rule+=','+id[1]
			break;
			case 'typecode':
			typecode+=','+id[1]
			break;
			case 'position':
			position+=','+id[1]
			break;
			case 'typename':
			typename+=','+id[1]
		}
	})
	rule=rule.substr(1)!=''?rule.substr(1):0;
	typecode=typecode.substr(1)!=''?typecode.substr(1):0;
	position=position.substr(1)!=''?position.substr(1):0;
	typename=typename.substr(1)!=''?typename.substr(1):0;
	var condition='0-'+rule+'-'+typecode+'-'+position+'-'+typename;
	var pcid="<?php echo ($pcid); ?>";
	var url='/index.php/Search/results/pcid/'+pcid+'/condition/'+condition+'/model/product/keyword/<?php echo ($keyword); ?>.html';
	window.location.href=url;
	
})
$('.liebie span a').click(function(){
	var order=$(this).attr('order');
	var condition1='<?php echo ($_GET['condition']); ?>';
	if(condition1){
		var arr=condition1.split('-');
		var condition='';
		arr[0]=order;
		for(var i=0;i<arr.length;i++ ){
			condition+='-'+arr[i];
		}
		
		condition=condition.substr(1);
	}else{
		condition=order+'-0-0-0-0';
	}
	var pcid="<?php echo ($pcid); ?>";
	var url='/index.php/Search/results/pcid/'+pcid+'/condition/'+condition+'/model/product/keyword/<?php echo ($keyword); ?>.html';
	window.location.href=url;
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