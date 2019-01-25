<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<title>提示</title>
<style>
*{padding:0; margin:0}
body{
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.center{
	width:78%;
	height:auto;
	font-size:18px;
	margin:0 11%;
	text-align:center;
}
.icon{
	width:6rem;
	height:6rem;
	background:#00A040;
	color:#fff;
	line-height:6rem;
	font-size:4rem;
	border-radius:3rem;
	margin: 3rem calc(50% - 3rem) 2rem;
	margin: 3rem -moz-calc(50% - 3rem) 2rem;
	margin: 3rem -webkit-calc(50% - 3rem) 2rem;
	
}
.center p{
	color:#666;
}
</style>
</head>
<body>
<div class="center">
	<div class="icon">i</div>
	<p><?php echo ($msg); ?></p>
</div>
</body>
</html>