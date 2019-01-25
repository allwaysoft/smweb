<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telphone=no, email=no">
<meta http-equiv="Cache-Control" content="no-siteapp">
<title><?php echo ($info["Title"]); ?></title>
<link rel="stylesheet" type="text/css" href="/Public/home/newstaff/css/css.css?555" />
<script type="text/javascript" src="/Public/home/newstaff/js/jquery.1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/home/newstaff/css/global.css" />
<style>
article{width:100%;}
.contents{
	width:90%;
	background:#fff;
	margin:0.7rem 3% 1rem;
	
	word-wrap: break-word;
	border-radius:0.5rem;
	padding:.8rem 2%;
}
footer{width:100%;margin:2rem 0; text-align:center; color:#999}
</style>

</head>
<body style="margin:0 auto;">
<div class="section p1">
	<div class="layout topbg active">
			<div class="layout logo">
				<img src="/Public/home/newstaff/images/logo.png" style="width:11rem"/>
			</div>
	</div>
<article>
<?php if(!empty($info["Image"])): ?><img alt="" src="<?php echo ($info["Image"]); ?>"><?php endif; ?>
</article>
<article>
	<div class="contents">
		<div>
			<?php echo ($info["Contents"]); ?>
		</div>
	</div>
	
</article>
</div>
<footer>
© <?php echo date('Y');?> 浙江森马服饰股份有限公司
</footer>
</body>
</html>