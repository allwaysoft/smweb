<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>森马管理后台</title>
<!-- jQuery AND jQueryUI -->
<script type="text/javascript" src="/Public/admin/js/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/Public/admin/css/min.css" />
<!-- <script type="text/javascript" src="/Public/admin/js/min.js"></script> -->
<script type="text/javascript" src="/Public/admin/js/jquery.validate.js"></script>
<script  type="text/javascript" src="/Public/admin/js/validate_expand.js"></script>
<link rel='stylesheet' type='text/css' href='/Public/admin/treetable/admin_style.css' /> 
<script type="text/javascript" src="/Public/admin/treetable/jquery.treetable.js"></script>
<script type="text/javascript" src="/Public/admin/js/My97DatePicker/WdatePicker.js"></script>
<!-- <script type="text/javascript" src="/Public/admin/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/Public/admin/js/ckfinder/ckfinder.js"></script> -->
<!-- <script type="text/javascript" charset="utf-8" src="/Public/admin/js/ueditor1_4_3-utf8-php/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/admin/js/ueditor1_4_3-utf8-php/ueditor.all.min.js"> </script> -->
<link rel="stylesheet" href="/Public/admin/js/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/Public/admin/js/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/Public/admin/js/kindeditor/lang/zh_CN.js"></script>
<link rel='stylesheet' type='text/css' href='/Public/admin/treetable/css/jquery.treeTable.css' />
<script language="javascript" type="text/javascript" src="/Public/admin/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<link rel="stylesheet" href="/Public/admin/uploadify/uploadify.css" type="text/css" /> 
<script language="javascript" type="text/javascript" src="/Public/admin/uploadify/swfobject.js"></script>
<script language="javascript" type="text/javascript" src="/Public/admin/js/html.js"></script>
</head>
<style>
label{color:red; margin-left:4px;}
</style>
<body>
<style>
.designer li,.type li,.year li{padding:3px 4px; border:1px  dashed red;max-width:120px;float:left;min-width:50px; margin:4px;text-align: center;cursor:pointer;}
.checked{background:#ccc; color:#FFF;}
#option table th{width:100px;text-align: right;}
</style>
<!--  CONTEN  ---->
<!-- 1. Add these JavaScript inclusions in the head of your page -->
<script type="text/javascript" src="/Public/admin/js/tjjs/highcharts.js"></script>
		
<!-- 1a) Optional: the exporting module -->
<script type="text/javascript" src="/Public/admin/js/tjjs/modules/exporting.js"></script>
<div id="content" class="white">
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">商品管理</a>><a href="<?php echo U('Product/index');?>">商品列表</a>><a href="#">统计分析</a></div>
<div class="bloc">
  <div class="wrap ">
  </div>
</div>
<div class="wrap">
    <table class="add">
      <tbody>
        <tr>
          <th>产品总点击率：</th>
          <td><font style="color:red;"><?php echo ($sum); ?></font>次</td>
        </tr>
        <tr><th>点击率前十款：</th>
        <td>
		<?php if(is_array($maxlist)): $i = 0; $__LIST__ = $maxlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>TOP<?php echo ($i); ?>(<font style="color:red;"><?php echo ($vo["click"]); ?></font>次):<a href="<?php echo U('Product/index',array('keyword'=>$vo['styleID']));?>"><?php echo ($vo["styleID"]); ?></a> &nbsp;/&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
		</td></tr>
        <tr><th>点赞前十款：</th>
        <td>
		<?php if(is_array($zanlist)): $i = 0; $__LIST__ = $zanlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>TOP<?php echo ($i); ?>(<font style="color:red;"><?php echo ($vo["zan"]); ?></font>次):<a href="<?php echo U('Product/index',array('keyword'=>$vo['styleID']));?>"><?php echo ($vo["styleID"]); ?></a> &nbsp;/&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
		</td></tr>
      </tbody>
    </table>
</div>
<div id="option" style="width: 95%; height: auto; margin: 10px auto; border:1px solid #ccc;padding:10px;">
<p style="font-size:13px;">筛选条件</p>
<table>
<tr>
<th>设计师：</th>
<td>
<ul class="designer">
<?php if(is_array($designer)): $i = 0; $__LIST__ = $designer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($vo["designer"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</td>
</tr>
<tr>
<th>分类：</th>
<td>
<ul class="type">
<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($vo["typename"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</td>
</tr>
<tr>
<th>年份：</th>
<td>
<ul class="year">
<?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($vo["year"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</td>
</tr>
<tr>
<th></th><td><input type="button" id="shaixuan" value="筛选"/>&nbsp;<input type="button" id="exportData" value="导出数据"/><label id="export_notice"></label></td>
</tr>
</table>
</div>
<div id="container" style="width: 800px; height: auto; margin: 0 auto; "></div>
</div>
</body>
</html>
<script>
$('#option ul li').toggle(function(){
	$(this).addClass('checked');
},function(){
	$(this).removeClass('checked');
})
$('#shaixuan').click(function(){
	var designer='';
	$('.designer .checked').each(function(){
		designer+=$(this).html()+',';
	})
	designer=designer.substring(0,designer.length-1);
	var type='';
	$('.type .checked').each(function(){
		type+=$(this).html()+',';
	})
	type=type.substring(0,type.length-1);
	var year='';
	$('.year .checked').each(function(){
		year+=$(this).html()+',';
	})
	year=year.substring(0,year.length-1);
	
	var url="<?php echo U('Product/result');?>";
	var chart;
	$.post(url,{designer:designer,typename:type,year:year},function(msg){
		var styleID=new Array();
		var click=new Array();
		
		for(var i in msg.styleID){
			styleID.push(msg.styleID[i]);
			click.push(parseInt(msg.click[i]));
		}
		tuxing(styleID,click)
	})
})
function tuxing(x,y){

	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			defaultSeriesType: 'column',
			margin: [ 50, 50, 100, 80]
		},
		title: {
			text: '产品点击率统计示意'
		},
		xAxis: {
			categories: x,
			labels: {
				rotation: -45,
				align: 'right',
				style: {
					 font: 'normal 13px Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: '点击率(次)'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x +'</b><br/>'+
					 '点击率: '+ Highcharts.numberFormat(this.y, 1) +
					 ' 次';
			}
		},
	        series: [{
			name: 'Population',
			data: y,
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				x: -3,
				y: 10,
				formatter: function() {
					return this.y;
				},
				style: {
					font: 'normal 13px Verdana, sans-serif'
				}
			}			
		}]
	});
}
$('#exportData').click(function(){
	if(confirm("确定导出选中的数据吗？")){
		var designer='';
		$('.designer .checked').each(function(){
			designer+=$(this).html()+',';
		})
		designer=designer.substring(0,designer.length-1);
		var type='';
		$('.type .checked').each(function(){
			type+=$(this).html()+',';
		})
		type=type.substring(0,type.length-1);
		var year='';
		$('.year .checked').each(function(){
			year+=$(this).html()+',';
		})
		year=year.substring(0,year.length-1);
		window.location.href="/admin.php/Product/export_prod?designer="+designer+"&typename="+type+"&year="+year
	}
})
</script>