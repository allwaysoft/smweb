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
  <div class="mbxie">
  	<a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a>
  	<img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>>
  	<a href="javascript:void(0)">商品管理</a>>
  	<a href="<?php echo U('Quota/index');?>">配额管理</a>
  </div>
  <div class="bloc">
  <form action="<?php echo U('Quota/addarea');?>" method="post" id="searchForm">
    <div class="wrap " style="display:none;">
      <dl class="dl_line">
        <dd style="width:500px; float:left; margin-top:10px;  ">
          手动添加区域：<input type="text" name="areaname" id="areaname"  style="width:150px; "  />
          <input type="submit" id="areaadd" style="width:50px; background:#16c9cf; border:0px; height:25px; color:#fff;cursor: pointer;"  id="qwe" value="添加 " />
        </dd>
      </dl>
      <script>
      $('#areaadd').click(function(){
    	  if($('#areaname').val()==''){
    		  return false;
    	  }
      })
      </script>
    </div>
    </form>
  <form action="" method="get" id="searchForm">
    <div class="wrap ">
      <dl class="dl_line">
        <dd style="width:500px; float:right; margin-top:10px;  ">
          <input type="text" name="keyword" id="keyword" value="<?php echo ($keyword); ?>" title="" onfocus="this.value='';" style="width:150px; display:inline-block;"  />
          <input type="submit" name="button" id="btnSearch" value=" 搜 索 " />
        </dd>
      </dl>
    </div>
    </form>
  </div>
  <div class="wrap" style="width:40%; float:left;">
    <form method="get" action="<?php echo U('Quota/import');?>" id="form1">
    <table>
    <tr>
    <td>
	    <dl class="dl_line" style="width:50%">
	        <dt><input type="submit" class="save" value="批量导入" onclick="return listImport(this.form.name);" id="btnDelete" style="width:110px" /></dt>
	    </dl>
    </td>
    </tr>
    </table>
    	
      <table width="50%" cellpadding="0" cellspacing="0" class="list">
        <thead>
          <tr>
            <th style="width:50px;"><input type="checkbox" id="all" /></th>
            <th width="50">序号</th>
            <th width="150" class="text-left">区域名称</th>
            <th width="80">操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><input type="checkbox" name="areaname[]" value="<?php echo ($vo["areaname"]); ?>" /></td>
             <td><?php echo ($i); ?></td>
            <td><?php echo ($vo["areaname"]); ?></td>
            <td>
            	<a href="<?php echo U('Quota/delarea',array('areaname'=>$vo['areaname']));?>" onclick="return confirm('确定删除吗？删除后不可恢复')">删除</a>
            	<a href="<?php echo U('Quota/import',array('areaname'=>$vo['areaname']));?>">导入</a>
            	<a href="javascript:void(0)" onclick="piciInfos('<?php echo ($vo["areaname"]); ?>');">查看</a>
            </td>
          	
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
     <div class="page">
        <div class="pagination"><?php echo ($page); ?></div>
    </div>
    </form>
  </div>
  <div class="wrap" style="width:50%; float:left; height:350px; margin-left:30px; overflow:auto; background:#ddd;">
  	<table id="piciInfos" width="100%" cellpadding="0" cellspacing="0" class="list">
  	<thead>
		<tr>
			<th width="100">日期</th><th width="150">标题</th><th width="80">上传人</th><th width="150">上传时间</th><th>操作</th>
		</tr>
	</thead>
		<tbody>
		</tbody>
	</table>
  </div>
</div>
</body>
</html>
<script>
function piciInfos(obj){
	var url="<?php echo U('Quota/piciInfos');?>";
	$.post(url,{areaname:obj},function(data){
		var str="<tbody>";
		if(data!=null){
			$.each(data,function(idx,item){
				str+="<tr id='tr"+item.id+"'><td>"+item.quotatime+"</td><td id='"+item.id+"' ondblclick='updatetitle(this);'>"+item.title+"</td><td>"+item.author+"</td><td>"+item.time+"</td><td><a href='<?php echo U('Quota/listinfo/id/"+item.id+"');?>'>查看</a> <a href='javascript:void(0)' onclick=\"infodel("+item.id+")\">删除<a/></td></tr>"
				//str+="<tr><td>"+item.quotatime+"</td><td>"+item.title+"</td><td>"+item.author+"</td><td>"+item.time+"</td><td><a href='<?php echo U('Quota/listinfo/id/"+item.id+"');?>'>查看</a> <a href='<?php echo U('Quota/infodel/id/"+item.id+"');?>' onclick=\"return confirm('确定删除吗？')\">删除<a/></td></tr>"
			})
		}
		
		str+="</tbody>";
		$('#piciInfos tbody').remove();
		$('#piciInfos thead').after(str)
	})
}
function infodel(obj){
	if(confirm('确定删除吗？')){
		var url="<?php echo U('Quota/infodel');?>"
		$.post(url,{id:obj},function(msg){
			if(msg=='1'){
				$('#tr'+obj).remove();
			}else{
				alert('删除失败')
			}
		})
	}
}
function updatetitle(obj){
	var td_val=$(obj).html();
	var id=$(obj).attr('id');
	var new_val="<input onblur='changeval(this)' type='text' value='"+td_val+"' />"
	$(obj).html(new_val)
	//alert($(obj).attr('id'));
}
function changeval(obj){
	var tx_val=$(obj).val();
	var id=$(obj).parent().attr('id');
	var url="<?php echo U('Quota/edititle');?>";
	$.post(url,{title:tx_val,id:id},function(msg){
		$(obj).parent().html(msg);
	})
	//alert($(obj).parent().attr('id'))
}

</script>