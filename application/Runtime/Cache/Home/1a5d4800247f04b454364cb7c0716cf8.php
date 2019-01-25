<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telphone=no, email=no">
<meta http-equiv="Cache-Control" content="no-siteapp">
<title>森马举报平台</title>
<link  rel="stylesheet" href="<?php echo RES;?>/css/css.css?<?php echo time();?>"/>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.1.7.2.min.js"></script>
</head>

<body>
<header>
	<img src="<?php echo RES;?>/images/header1.jpg" />
</header>
<section class="content">
	<div class="article">
    	<h2>举报须知</h2>
		<ol style="font-size: 14px;">
            <li><span>1.本平台受理森马服饰及旗下品牌的各种腐败及严重违纪违规行为的举报或投诉。</span></li>
            <li><span>2.举报对象包括森马集团、森马股份及各分子公司、办事处的员工，以及与森马所有品牌合作或有业务关联的所有供应商、代理商及其他合作伙伴。</span></li>
            <li><span>3.森马服饰提倡实名举报，请确保您留下联系方式是有效的。</span></li>
            <li><span>4.您也可以通过邮箱 lianjiesm@vip.semir.com 或电话 021-6728 8433 与我们取得联系。</span></li>
		</ol>
    </div>
    <div style="text-align: center; padding-top: 0.9rem;">
		<label style="color: #2a2a2a; font-size: 0.8rem;">
			<input class="check" id="qIssue" name="ty" type="checkbox" value="1">
				我已经阅读以上条款
		</label>
		<a href="javascript:;" class="btn-f" id="wyjb">10秒</a>
	</div>
</section>
<script type="text/javascript">
var i=9;
setInterval(function(){
	if(i<=0){
		$("#wyjb").html('我要举报');
		
	}else{
		$("#wyjb").html(i+'秒');
		i--;
	}
	
},1000);
$('#wyjb').click(function(){
	var check=$('#qIssue:checked').val();
	
	if(check==1&&i<=1){
		window.location.href="<?php echo U('form');?>"
	}
})
</script>
</body>
</html>