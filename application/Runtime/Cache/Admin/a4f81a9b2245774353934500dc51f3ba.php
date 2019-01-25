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
<script type="text/javascript" src="/Public/admin/js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="/Public/admin/js/jquery.imagePreview.1.0.js"></script>
<script type="text/javascript">
$(function(){
	$("a.preview").preview();	  
});
</script>
<style>
.photo_list li{list-style:none; float:left;}
</style>
<!--   CONTENT  ---->
<div id="content" class="white">
<div class="mbxie"><a href="" class="first_a" ><img src="/Public/admin/images/back.jpg" width="25" height="12" />返回上一页</a><img src="/Public/admin/images/home1.jpg" width="20" height="12" /><a href="<?php echo U('Admin/Main/main');?>"  style=" padding-left:3px;">首页</a>><a href="javascript:void(0)">商品管理</a>><a href="<?php echo U('Product/index');?>">商品列表</a>><a href="<?php echo U('Product/edit',array('id'=>$thisInfo['id']));?>">修改商品</a></div>
<div class="bloc">
  <div class="wrap ">
  </div>
</div>
<div class="wrap">
  <form id="form1" name="form1" method="post" action="">
    <input type="hidden" name="id" value="<?php echo ($thisInfo["id"]); ?>">
    <table class="add">
      <tbody>
        <tr>
          <th>款号：<font class="red">*</font></th>
          <td><input name="styleID" maxlength="100" type="text" class="input" id="styleID" style="width:400px;" value="<?php echo ($thisInfo["styleID"]); ?>"></td>
        </tr>
        <tr>
          <th>产品名称：<font class="red">*</font></th>
          <td><input name="pname" maxlength="100" type="text" class="input" id="pname" style="width:400px;" value="<?php echo ($thisInfo["pname"]); ?>"></td>
        </tr>
        <tr>
          <th>风格：<font class="red">*</font></th>
          <td>
          <input name="typecode" maxlength="100" type="text" class="input" id="typecode" style="width:400px;" value="<?php echo ($thisInfo["typecode"]); ?>">
		</td>
        </tr>
        <tr>
          <th>产品颜色：<font class="red">*</font></th>
          <td>
          	<!-- <?php if(is_array($pcolor)): $i = 0; $__LIST__ = $pcolor;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="checkbox" name="colorcode[]" value="<?php echo ($vo["codename"]); ?>" id="colorcode"/><?php echo ($vo["name"]); ?>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?> -->
			<input name="colorcode" maxlength="100" type="text" class="input" id="colorcode" style="width:400px;" value="<?php echo ($thisInfo["colorcode"]); ?>">
			<span>请填写颜色代号以“-”隔开</span>
		  </td>
        </tr>
        <tr>
          <th>产品尺码：<font class="red">*</font></th>
          <td>
          	<!-- <?php if(is_array($prule)): $i = 0; $__LIST__ = $prule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="checkbox" name="rule[]" value="<?php echo ($vo["name"]); ?>"/><?php echo ($vo["name"]); ?>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?> -->
			<input name="rule" maxlength="100" type="text" class="input" id="rule" style="width:400px;" value="<?php echo ($thisInfo["rule"]); ?>">
			<span>请填写尺码以“-”隔开</span>
		  </td>
        </tr>
        <tr>
          <th>价格：<font class="red">*</font></th>
          	<td><input name="price" type="text" class="input" value="<?php echo ($thisInfo["price"]); ?>" id="price"  style="width:50px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"></td>
		  
        </tr>
        <tr>
          <th>库存：<font class="red">*</font></th>
          	<td><input name="stock" type="text" class="input" value="<?php echo ($thisInfo["stock"]); ?>" id="stock"  style="width:50px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"></td>
		  
        </tr>
        <tr>
          <th>设计师：<font class="red">*</font></th>
          	<td><input name="designer" type="text" class="input"  id="designer" style="width:100px;" value="<?php echo ($thisInfo["designer"]); ?>"/></td>
        </tr>
        <tr>
          <th>年份：<font class="red">*</font></th>
          	<td><input name="year" type="text" class="input" value="<?php echo ($thisInfo["year"]); ?>" id="year"  style="width:50px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"></td>
        </tr>
         <tr>
          <th>季节：<font class="red">*</font></th>
          	<td>
          		<select name="season">
          			<option value="">请选择</option>
          			<option <?php if($thisInfo["season"] == '春季'): ?>selected="selected"<?php endif; ?> value="春季">春季</option>
          			<option <?php if($thisInfo["season"] == '夏季'): ?>selected="selected"<?php endif; ?> value="夏季">夏季</option>
          			<option <?php if($thisInfo["season"] == '秋季'): ?>selected="selected"<?php endif; ?> value="秋季">秋季</option>
          			<option <?php if($thisInfo["season"] == '冬季'): ?>selected="selected"<?php endif; ?> value="冬季">冬季</option>
          		</select>
			</td>
        </tr>
         <tr>
          <th>定位：<font class="red">*</font></th>
          	<td>
          		<select name="position">
          			<option value="">请选择</option>
          			<option <?php if($thisInfo["position"] == '主款'): ?>selected="selected"<?php endif; ?> value="主款">主款</option>
          			<option <?php if($thisInfo["position"] == '次主款'): ?>selected="selected"<?php endif; ?> value="次主款">次主款</option>
          			<option <?php if($thisInfo["position"] == '陪衬款'): ?>selected="selected"<?php endif; ?> value="陪衬款">陪衬款</option>
          			<option <?php if($thisInfo["position"] == '配件'): ?>selected="selected"<?php endif; ?> value="配件">配件</option>
          		</select>
          	</td>
        </tr>
        <tr>
          <th>排序：<font class="red">*</font></th>
          <td><input name="sort" type="text" class="input" value="<?php echo ($thisInfo["sort"]); ?>" id="sort" maxlength="5" style="width:50px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"></td>
        </tr>
        <tr>
          <th>产品描述：</th>
          <td><textarea style=" width:79%; height:80px;" name="contents" class="input" id="description"><?php echo ($thisInfo["contents"]); ?></textarea></td>
        </tr>
        <tr>
        	<th>图片预览：</th>
        	<td>
	        	<table cellpadding="0" cellspacing="0" style="width:80%;border:1px solid #CCC">
	        	<?php if(is_array($colorname)): $i = 0; $__LIST__ = $colorname;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	        			<th width="100" style="text-align:center"><?php echo ($vo); ?></th>
	        			<td>
	        				<ul class="photo_list">
	        					<li>
	        					<a class="preview" href="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>.jpg" title="<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>">
	        					<img src="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>.jpg" width="80" height="100"/>
	        					</a>
	        					</li>
	        					<li>
	        					<a class="preview" href="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-01.jpg" title="<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-01">
	        					<img src="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-01.jpg" width="80" height="100"/>
	        					</a>
	        					</li>
	        					<li>
	        					<a class="preview" href="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-02.jpg" title="<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-02">
	        					<img src="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-02.jpg" width="80" height="100"/>
	        					</a>
	        					</li>
	        					<li>
	        					<a class="preview" href="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-03.jpg" title="<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-03">
	        					<img src="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-03.jpg" width="80" height="100"/>
	        					</a>
	        					</li>
	        					<li>
	        					<a class="preview" href="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-04.jpg" title="<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-04">
	        					<img src="/Upload/<?php echo ($thisInfo["catalog"]); ?>/<?php echo ($thisInfo["styleID"]); ?>-<?php echo ($vo); ?>-04.jpg" width="80" height="100"/>
	        					</a>
	        					</li>
	        				</ul>
	        			</td>
	        		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	        	</table>
        	</td>
        </tr>
        <tr>
      <th></th>
        <td><input name="btnSubmit" type="submit" id="btnSubmit" value="确定">
          <input name="btnReset" type="reset" id="btnReset" value="清除">
          <input name="btnBack" type="button" id="btnBack" value="返回"></td>
      </tr>
        </tbody>
      
    </table>
  </form>
</div>
</body>
</html>
<script type="text/javascript"> 
$(document).ready(function() {
	$("#form1").validate({
		rules: {
			styleID: { required: true},
			pname:{ required: true},
			typecode:{ required: true},
			colorcode:{ required: true},
			rule:{required:true}
		}/* ,
		submitHandler:function(form){
			$("#btnSubmit").attr("disabled",true);
			form.submit();
		} */
	});
})
</script>