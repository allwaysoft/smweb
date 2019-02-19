<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=zh-CN" />
<title>{%$web_title%}</title>
<meta name="Generator" content="PHP CI">
<meta name="KEYWords" content="{%$web_title%}">
<meta name="Description" content="{%$web_title%}">
<meta name="Author" content="{%$web_title%}">
<meta name="Robots" content= "all">
<link rel="icon" type="image/gif" href="/favicon.jpg">
<link href="/semirdx/templates/public/css/bootstrap.min.css" rel="stylesheet">
<link href="/semirdx/templates/Dxsemir/moban1211/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/semirdx/templates/public/jquery.min.js"></script>
<script type="text/javascript" src="/semirdx/templates/public/js/bootstrap.min.js"></script>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
    <script src="/semirdx/templates/public/respond-1.1.0.min.js"></script>
    <script src="/semirdx/templates/public/html5shiv.js"></script>
    <script src="/semirdx/templates/public/html5element.js"></script>
 <![endif]-->
<script type="text/javascript">
 $(document).ready(function(){
	 // load news
	 $.ajax({
						type: "POST",
						url: '/semirdx/index.php/index/get_sww_news',
						cache:false,
						data: "",
						success: function(msg){
					     $("#newlist").html(msg); 
						},
						error:function(){
							hiAlert("出错啦，刷新试试，如果一直出现，可以联系开发人员解决");
						}
					});
 });
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?2840c87a016f056d075fee306b860d76";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</head>
<body >
<!--Header_section--> 
<!--Header_top-->
<div  class="top_box">
  <div class="container">
    <div class="hottel  text-right">技术支持电话:  0577-85789999转1号键
      &nbsp;&nbsp;&nbsp;&nbsp;
      技术支持QQ：<img  style="CURSOR: pointer" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=800086115&o=技术支持&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:800086115:3 alt="点击这里给我发消息">
      </div>
    <div  class="logo"><img src="/semirdx/templates/{%$web_template%}/moban1211/images/log.png"></div>
  </div>
</div>
<!--Header_top--> 

<!--client_logos-->
<section class="page_section" id="clients">
  <div class="container">
    <div class="client_logos">
      <div class="list-list">
        <div class="list-left">
          <h2>应用入口<span class="lead"> / Links</span></h2>
          <ul class=" linkslist">
            {%foreach from=$data['bannerPics'] item=row key=key  name=foo%}
            <li class="link-li" >
            {%if $row->hType==1%}
            <a href="{%$row->hUrl%}" title="{%$row->hTitle%}">
            {%else%}
            <a href="{%$row->hUrl%}" title="{%$row->hTitle%}"  target="_blank" >
            {%/if%}
              <div class="linkNav"> 
                <div class="img"><img class="imgs" src="/semirdx/attachments/adpic/{%$row->hPic%}" alt="..."></div>
                <!--img-circle-->
                <div class="title"> {%$row->hTitle%} </div>
                 </div>
                 </a>
            </li>
            {%/foreach%}
          </ul>
        </div>
        <div class="list-right">
          <h2>新闻中心<span class="lead"> / News</span></h2>
          <div id="newlist"> <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i> <span class="sr-only">新闻加载中，请稍后...</span> </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</section>
<!--client_logos-->
</body>
</html>