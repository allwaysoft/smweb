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
<!--   CONTENT  ---->
<div id="content" class="white">
  <div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">系统设置</a>><a href="set">区域设置</a></div>
  <div class="bloc">
    <div class="wrap ">
      <dl class="dl_line">
        <dt>区域设置：<input <?php if($areaset["checkname"] == 'province'): ?>checked="checked"<?php endif; ?> type="radio" name="areaset" class="areaset" value="province"/>省&nbsp;&nbsp;
        <input <?php if($areaset["checkname"] == 'area1'): ?>checked="checked"<?php endif; ?> type="radio" class="areaset" name="areaset" value="area1"/>大区&nbsp;&nbsp;
        <input <?php if($areaset["checkname"] == 'area2'): ?>checked="checked"<?php endif; ?> type="radio" class="areaset" name="areaset" value="area2"/>小区&nbsp;&nbsp;
        </dt>
      </dl>
    </div>
  </div>
   <div class="bloc">
   <div style="font-size:16px; color:#F00; padding:10px 0 0 0;">
   地区设置为系统底层级别设置，请谨慎操作！！！ <br />重新筛选地区，将会清空现在所有区域的产品配额及栏目显示信息，请谨慎操作！！！
   </div>
    <div class="wrap ">
      <dl class="dl_line">
        <dt>
        <a href="javascript:void(0)" onclick="filter(0);" class="xz">筛选</a>
        <!--<a href="javascript:void(0)" onclick="savearea();" class="save">保存</a>-->
        <a href="javascript:void(0)" onclick="filter(1);" class="xz" style="width:90px;">未有区域筛选</a>
        <a href="javascript:void(0)" onclick="saveNoarea();" class="save" id="othersave" style="width:90px;display:none;">未有区域保存</a>
        </dt>       
      </dl>
    </div>
  </div>
  <div class="wrap">
  <input type="hidden" value="" id="typeno"/>
    <form method="post" action="" id="form1">
      <table width="100%" cellpadding="0" cellspacing="0" class="list">
        <thead>
          <tr>
            <th width="50">序号</th>
            <th class="text-left">区域名称</th>
            <th class="text-left">操作</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </form>
  </div>
</div>
</body>
<script>
$('.areaset').change(function(){
	var checkname=$(this).val();
	var url="<?php echo U('Area/areacheck');?>";
	$.post(url,{checkname:checkname},function(msg){
		alert(msg);
	})
})
function filter(obj){
	var style=obj;
	var val=$('.areaset:checked').val();
	var url="<?php echo U('Area/arealist');?>";
	$.post(url,{val:val,style:style},function(data){
		var str='<tbody>';
		$.each(data,function(idx,item){
			if(item.state==0){
				var operation='<a href="javascript:voil(0)" onclick="Addarea(this)"><img src="/Public/admin/images/success.gif" />可添加</a>'
			}else if(item.state==1){
				var operation='<a href="javascript:voil(1)">已添加</a>'
			}
			if(val=='province'){
				if(item.province!=null){
					str+='<tr><td>'+idx+'</td>'
					str+='<td>'+item.province+'</td>'
					str+='<td>'+operation+'</td>'
				}
			}else if(val=='area1'){
				if(item.area1!=null){
					str+='<tr><td>'+idx+'</td>'
					str+='<td>'+item.area1+'</td>'
					str+='<td>'+operation+'</td>'
				}
			}else if(val=='area2'){
				if(item.area2!=null){
					str+='<tr><td>'+idx+'</td>'
					str+='<td>'+item.area2+'</td>'
					str+='<td>'+operation+'</td>'
				}
			}
			str+='</tr>'
		})
		str+='</tbody>'
		$('.list tbody').replaceWith(str)
	})
	if(style==1){
		$('#othersave').css('display','inline-block')
	}else{
		$('#othersave').css('display','none')
	}
	$('#typeno').val(obj);
}
function savearea(){
	if(confirm("保存后将清空所有数据，确定保存吗？")){
		var val=$('.areaset:checked').val();
		var url="<?php echo U('Area/savearea');?>";
		$.post(url,{val:val},function(msg){
			alert(msg);
			
		})
	}
	
}
function saveNoarea(){
	if(confirm("确定保存这些区域吗？")){
		var val=$('.areaset:checked').val();
		var url="<?php echo U('Area/saveNoarea');?>";
		$.post(url,{val:val},function(msg){
			alert(msg);
			filter(1);
		})
	}
}
function Addarea(obj){
	var typeno=$('#typeno').val();
	var areaname=$(obj).parent().parent().children().eq(1).html();
	var url="<?php echo U('Area/addarea');?>";
	
	$.post(url,{areaname:areaname},function(msg){
		alert(msg)
		if(msg=='添加成功'){
			filter(typeno);
		}
	})
}
</script>
</html>