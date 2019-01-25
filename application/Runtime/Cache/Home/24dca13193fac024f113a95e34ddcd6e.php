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
  
<script src="/Public/home/js/jquery.lazyload.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
	      $("img.lazy").lazyload({placeholder : "<{/Public}>/home/images/nopic.jpg",effect: "fadeIn"});
  });
</script>
<style>
.subbanner{
	height: 60px;
	background: <?php echo ($sub["backgroundimg"]); ?>;
	width: 1000px;
	margin: 10px auto;
	position:relative;
}
</style>
<style>
.proBanner{
	 
	padding-top:15px;
	padding-bottom:10px;
	margin-left:16%;
}

body{
    font-size: 14px;
    box-sizing: border-box;
    margin: 0;
}

.container{
    width: 100%;
    margin-top:10px;
    background-color: #b6b4b44d;
}

.clothes-one{
	float:left;
    width: 20%;
    text-align: left;
    padding:0 1rem;
    box-sizing: border-box;
    margin-bottom: 1.5rem;
}
.searchColumn{
    float: left;
    margin: 0 1rem;
    color:green;
    background:white;
}
.content-header{
	width: 1011px;
	margin: 0 auto;
    height: 2.5rem;
    padding: .5rem;
    box-sizing: border-box;
    color: #000;
    line-height: 25px;
}
.clothes-one img{
    width: 100%;
    box-shadow: 0px 0px 5px #ccc;


}
.clothes-one span{
    width: 100%;
    display: block;


}
.clothes-one p{
     font-size: .8rem;
}
.stock_style{
    border-bottom: 1px solid #EEE;
    text-align: left;
    line-height: 18px;
    padding-bottom: 4px;
    font-size:14px;
    font-weight:bold;
    color:black;
}
.row{
    width: 100%;
    margin-bottom: 1.5rem;
}

.price-style{
   font-size: 12px;
   color: #249843;
   float:right;
}

.imglist ul li{
	float: left;
	width: 160px;
	height: 300px;
	margin-right: 22px;
	padding: 5px 8px;
	margin-left: 10px;
	margin-bottom: 10px;
	border: 1px solid #FFF
}
li{
	list-style:none;
}
.imglist{
	width: 1011px;
    font-size: 12px;
	margin: 0 auto;
	padding: 5px 0 10px 0;
}
.bcolor{
    width: 100%;
    text-align: left;
    line-height: 18px;
    color:black;
}
.number a{
	width: 100%;
	text-align: left;
	font-size: 12px;
	line-height: 18px;
	color:black;
}

.rank{
	text-align: center;
	color: green;
	font-size: 22px;
	line-height:1.5em;
}
.salesArea{
	left:10%;
	position:absolute;
	background:#b6b4b44d;
	width:32px;
	color:#1C2920;
	font-size:18px;
	padding:1px;
}
td{padding:25px 30px 12px 3px;}
</style>
<style>
.wrapper-dropdown-2 {
    /* Size and position */
    position: relative; /* Enable absolute positionning for children and pseudo elements */
    width: auto;
    padding-right:30px;

    /* Styles */
    background: #fff;
    cursor: pointer;
    outline: none;
}

.wrapper-dropdown-2:after {
    content: "";
    width: 0;
    height: 0;
    position: absolute;
    right: 5px;
    top: 50%;
    margin-top: -3px;
    border-width: 6px 6px 0 6px;
    border-style: solid;
    border-color: grey transparent;
}

.wrapper-dropdown-2 .dropdown {
  /* Size & position */
    position: absolute;
    top: 100%;
    left: 0px;
    right: 0px;

    /* Styles */
    background: white;
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
    list-style: none;

    /* Hiding */
    opacity: 0;
    pointer-events: none;
}

.wrapper-dropdown-2 .dropdown li {
    display: block;
    text-decoration: none;
    color: #333;
    border-left: 5px solid green;
    padding: 0px 0px 0px 6px;
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
}

.wrapper-dropdown-2 .dropdown li i {
    margin-right: 5px;
    color: inherit;
    vertical-align: middle;
}

/* Hover state */

.wrapper-dropdown-2 .dropdown li:hover {
    background: #258c4399;
}

/* Active state */

.wrapper-dropdown-2.active:after {
    border-width: 0 6px 6px 6px;
}

.wrapper-dropdown-2.active .dropdown {
    opacity: 1;
    pointer-events: auto;
}

/* No CSS3 support */

.no-opacity       .wrapper-dropdown-2 .dropdown,
.no-pointerevents .wrapper-dropdown-2 .dropdown {
    display: none;
    opacity: 1; /* If opacity support but no pointer-events support */
    pointer-events: auto; /* If pointer-events support but no pointer-events support */
}

.no-opacity       .wrapper-dropdown-2.active .dropdown,
.no-pointerevents .wrapper-dropdown-2.active .dropdown {
    display: block;
}


</style>
<script>
function DropDown(el) {
	this.dd = el;
	this.initEvents();
}
DropDown.prototype = {
	initEvents : function() {
		var obj = this;

		obj.dd.on('click', function(event){
			$(this).toggleClass('active');
			event.stopPropagation();
		});	
	}
}

$(function() {

	var dd = new DropDown( $('#dd') );
	var dd = new DropDown( $('#dd1') );
	var dd = new DropDown( $('#dd2') );

	$(document).click(function() {
		// all dropdowns
		$('.wrapper-dropdown-2').removeClass('active');
	});

});
</script>
<script>
function searchData(col,val){
	var gender_text = $('#gender_text').html().replace(/(^\s*)|(\s*$)/g, "");
	var kind_text = $('#kind_text').html().replace(/(^\s*)|(\s*$)/g, "");;
	if(col == "gender"){
		var gender_text = val;
	}
	if(col == "kind"){
		var kind_text = val;
	}
	if(col == "period"){
		var period_text = val;
	}
	if(kind_text == "全部"){
		kind_text = "无";
	}
	if(gender_text == "全部"){
		gender_text = "无";
	}
	window.location.href="/index.php/HotSales/search/gender/"+gender_text+"/kind_text/"+kind_text;
}
</script>
<?php if($sub["url"] != ''): ?><a href="<?php echo ($sub["url"]); ?>">
  <div class="subbanner">
	  <div style="position:absolute;">
	  	<?php if($sub["image"] != ''): ?><img src="<?php echo ($sub["image"]); ?>" style="width:1000px;height:60px;"/><?php endif; ?>
	  </div>
	  <div style="position:absolute;width:100%;height:100%;">
	  	   <?php echo ($sub["text"]); ?>
	  </div>
 </div>
 </a><?php endif; ?>
<div class="content">

    <div class="container">
        <div class="content-header">
        	<?php if($nodata == 'y'): ?><div style="float:left;">暂无数据！</div>
            <?php else: ?>
            <div style="float:left;">性别:</div>
            <div class="searchColumn"  style="width:88px;">
					<div id="dd" class="wrapper-dropdown-2" tabindex="1">
					<span style="margin-left:4px; width:80px;" id="gender_text">
						<?php if($gender): echo ($gender); ?>
						<?php else: ?>
						男<?php endif; ?>
					</span>
						<ul class="dropdown">
							<li onclick="searchData('gender','男');">男</li>
							<li onclick="searchData('gender','女');">女</li>
						</ul>
					</div>
		    </div>
            <div style="float:left;">中类:</div>
            <div class="searchColumn" style="width:150px;">
					<div id="dd1" class="wrapper-dropdown-2" tabindex="1">
					<span style="margin-left:4px;" id="kind_text">
						<?php if($kind_text): echo ($kind_text); endif; ?>
					</span>
						<ul class="dropdown">
						<?php if(is_array($kind)): foreach($kind as $key=>$kd): ?><li onclick="searchData('kind','<?php echo ($kd["kind"]); ?>');"><?php echo ($kd["kind"]); ?></li><?php endforeach; endif; ?>
						</ul>
					</div>
		    </div>
            <div style="float:left;">数据更新时间:&nbsp;<span style="color:red;"><?php echo (date('Y年m月d日',$updateDate)); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;注:<span style="color:#330000">此数据为数据更新时间前一周</span></div><?php endif; ?>
        </div>
    </div>

    <div class="imglist">
		 <table>
		   <tr>
		   <?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td>
		   	     <?php if($vo["showarea"] == 'y'): ?><div style="border-top: 2px solid #999999;position: absolute;left: 10%;  height:10px;width: 77%;"></div>
	           	    <div class="rank"> <span class="salesArea"><?php echo ($vo["areaname"]); ?></span><?php echo ($vo["rank"]); ?></div>
	         	<?php else: ?>
		            <div class="rank"><?php echo ($vo["rank"]); ?></div><?php endif; ?>
		     <a href="<?php echo U('HotSales/info',array('colorcode'=>$vo['colorcode'],'styleID'=>$vo['styleID']));?>" target="_blank">
	            <img class="lazy" data-original="<?php echo ($vo["pimg"]); ?>" width="160" height="200" onerror="this.src='/Public/home/images/nopic.jpg';this.onerror=null"/></a>  
	          	<div class="number"><a href="<?php echo U('HotSales/info',array('colorcode'=>$vo['colorcode'],'styleID'=>$vo['styleID']));?>" target="_blank">款号:&nbsp;<?php echo ($vo["styleID"]); ?></a></div>
	            <div class="bcolor">最好色:&nbsp;<?php echo ($vo["bestcolor"]); ?></div>
				<div class="stock_style">
				<?php if($vo["stock"] == '大'): ?><span style="color:#990099;">库存:&nbsp;<?php echo ($vo["stock"]); ?></span> 
				<?php elseif($vo["stock"] == '中'): ?>
				<span style="color:#0000cc;">库存:&nbsp;<?php echo ($vo["stock"]); ?></span> 
				<?php elseif($vo["stock"] == '少'): ?>
				<span style="color:#ff6600;">库存:&nbsp;<?php echo ($vo["stock"]); ?></span> 
				<?php elseif($vo["stock"] == '极少'): ?>
				<span style="color:red;">库存:&nbsp;<?php echo ($vo["stock"]); ?></span> 
				<?php else: ?>
				<span>库存:&nbsp;<?php echo ($vo["stock"]); ?></span><?php endif; ?>
				<span class="price-style"> ￥<?php echo ($vo["price"]); ?></span></div>
		   <?php if($vo["turn"] == 'y'): ?></tr><tr><?php endif; ?>
		   </td><?php endforeach; endif; else: echo "" ;endif; ?>
		   </tr>
		 </table>
    </div>
    <div class="clear"></div>
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