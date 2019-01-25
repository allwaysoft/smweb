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
  <div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">大爆款模块</a>> HANA 数据列表</div>
  <div class="bloc"> 
    <div class="wrap ">
    <div class="content" style="padding:10px; margin-top:10px; border:1px solid #CCC;">
      <form method="post" action="hnImport" id="formh">
         <div style="font-size:14px; padding-bottom:5px;">获取HANA数据：</div>
          <div style=" padding-bottom:10px;"><font class="red">*</font>开始日期：
         <input name="time" id="time" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"  class="input" value="<?php echo (date("Y-m-d",$time)); ?>">
          ~ 截止日期：
          <input name="endtime" id="endtime" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"  class="input" value="<?php echo (date("Y-m-d",$endtime)); ?>"> <font class="red">*</font>
          </div>
           <div style=" padding-bottom:5px;">&nbsp;&nbsp;&nbsp;<font class="red">*</font>产品季：
           	<?php if(is_array($pq)): $i = 0; $__LIST__ = $pq;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input name="pq[]" id="<?php echo ($vo["name"]); ?>" type="checkbox" value="<?php echo ($vo["name"]); ?>" /> <?php echo ($vo["name"]); endforeach; endif; else: echo "" ;endif; ?>        
         	 
          </div>
            <div style=" padding:5px 0 0 60px;">
          <input type="submit" value="导入HANA数据" />     
          <a href="http://w.semir.cn/index.php/HotSales/index_hana"  style="width:120px;" target="_blank">前台浏览</a>
          </div>
       
          </form>
     </div>    
       
       
    <form action="" method="get" id="searchForm">
      <dl class="dl_line">
        <dd style="margin-top:10px;  ">
        共 <?php echo ($total); ?> 条记录
          <select id="type_id" name="type_id" style="display:inline-block;">
            <option value="">﹄ 请选择...</option>
             <?php if(is_array($kind)): foreach($kind as $key=>$kd): ?><option value="<?php echo ($kd["kind"]); ?>"><?php echo ($kd["kind"]); ?></option><?php endforeach; endif; ?>
          </select>
          <input type="submit" name="button" id="btnSearch" value=" 搜 索 " />
        </dd>
      </dl>
      </form>
      <form method="post" action="<?php echo U('News/del');?>" id="form1">
      
      <div class="content">
      	<table width="100%" cellpadding="0" cellspacing="0" class="list">
        <thead>
          <tr>
            <th style="width:50px;"><input type="checkbox" id="all" /></th>
            <th>款号</th>
            <th class="text-left">区域</th>
            <th>性别</th>
            <th>类别</th>
            <th>排名</th>
            <th>库存</th>
            <th>颜色</th>
            <th>导入日期</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><input type="checkbox" name="styleID[]" value="<?php echo ($vo["styleID"]); ?>" /></td>
             <td><?php echo ($vo["styleID"]); ?></td>
            <td style="text-align:left;"><?php echo ($vo["areaname"]); ?></td>
            <td><?php echo ($vo["gender"]); ?></td>
            <td><?php echo ($vo["kind"]); ?></td>
            <td><?php echo ($vo["rank"]); ?></td>
            <td><?php echo ($vo["stock"]); ?></td>
            <td><?php echo ($vo["bestcolor"]); ?></td>
            <td><?php echo (date("Y-m-d H:i:s",$vo["createtime"])); ?></td> 
            <td><a href="<?php echo U('1/1',array('id'=>$vo['id']));?>" class="edit">修改</a><a href="<?php echo U('1/1',array('id'=>$vo['id']));?>" class="edit">删除</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
      </div>
      </form>
    </div>
    <div class="page">
        <div class="pagination"><?php echo ($page); ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"> 
$(document).ready(function() {
	$("#formh").validate({
		rules: { 
			'pq[]':{ required: true},
			time:{required:true},
			endtime:{required:true}
		},
    errorPlacement: function (error, element) { //指定错误信息位置
      if (element.is(':radio') || element.is(':checkbox')) { //如果是radio或checkbox
       var eid = element.attr('name'); //获取元素的name属性
       error.appendTo(element.parent()); //将错误信息添加当前元素的父结点后面
     } else {
       error.insertAfter(element);
     }
   },
		submitHandler:function(form){
			var mymessage=confirm("你确定要导入HANA数据并更新本地数据？");  
			if(mymessage==true)  
			{  
				form.submit();
			}  
			else 
			{  
			  return false;
			}  
			 
			
		} 
	});
})
</script>
</body>
</html>