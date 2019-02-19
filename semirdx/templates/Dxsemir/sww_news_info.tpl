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
<!--Header_top-->
<div  class="top_box">
  <div class="container">
    <div class="hottel  text-right">技术支持电话: 0577-85789999转1号键
      &nbsp;&nbsp;&nbsp;&nbsp;
       技术支持QQ: <img  style="CURSOR: pointer" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=800086115&o=技术支持&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:800086115:3 alt="点击这里给我发消息">
      </div>
    <div  class="logo"><img src="/semirdx/templates/{%$web_template%}/moban1211/images/log.png"></div>
  </div>
</div>
<!--Header_top--> 
<div class="container">
<div class="newsShow">
{%if ($data)%}
<h3>{%$data->title%}</h3>
<div class="timeShow"><i class="fa fa-clock-o"></i> {%$data->time|date_format:'%Y-%m-%d %H:%M:%S'%}</div>
<div class="newscontent">{%$data->contents%}</div>
{%else%}
信息已经过时或不存在，请确认！！
{%/if%}
</div>
</div>
</body>
</html>