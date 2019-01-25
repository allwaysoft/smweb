<?php if (!defined('THINK_PATH')) exit();?> 
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/public/upload/css/css.css?<?php echo time();?>" /> 
<link rel="stylesheet"  href="<?php echo RES;?>/public/zoom/css/zoom.css" media="all" />
<style>
li{list-style-type:none;float:left;}
.zoomed > .container{-webkit-filter:blur(3px);filter:blur(3px);} 
.gallery{list-style-type:none;float:left;background:#ffffff;padding:20px 20px 10px 20px;margin:0;-webkit-box-shadow:0 1px 3px rgba(0,0,0,0.25);-moz-box-shadow:0 1px 3px rgba(0,0,0,0.25);box-shadow:0 1px 3px rgba(0,0,0,0.25);-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;}
.gallery li{float:left;padding:0 10px 10px 0;}
.gallery li:nth-child(6n){padding-right:0;}
.gallery li a,.gallery li img{float:left;}
</style>
<script type="text/javascript">
    $(document).ready(function(){
     $('#subForm').bootstrapValidator({
       message: 'This value is not valid',
         feedbackIcons: {
           valid: 'glyphicon glyphicon-ok fui-check',
            invalid: 'glyphicon glyphicon-remove fui-cross',
            validating: 'glyphicon glyphicon-refresh'
        }, 
        fields: {
        	 tra_type: {
                message: 'This is not valid',
                validators: {
                    notEmpty: {
                        message:  '请选择回复类别'
                    }
                }
            },
			tra_contents: {
                message: 'This is not valid',
                validators: {
                    notEmpty: {
                        message:  '请填写回复内容'
                    }
                }
            },
		}
    }).on('success.form.bv', function(e) {
		$.each(BootstrapDialog.dialogs, function(id, dialog){
					 dialog.close();
				 });
		 var post_data = $("#subForm").serializeArray();
		 		var post_url;
				//alert($("input[name=id]").val());
                 post_url = "/semir400admin.php/Staff/reply/type/quality"; 
                 //  post_url = "{%site_url('admin/homepage/edit')%}"; 
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: post_data,
                    success: function(msg){
                        if(msg.status==true){
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: '操作成功',
								message: '正在刷新页面，请稍后!!' 
							});     
                             
                             setTimeout(function(){
                                 window.location.reload();
                            },1000);
                            //  Alert(msg);
                        }else{
                            BootstrapDialog.show({
								type:"type-danger",
								title: '操作错误',
								message: msg.info,
								buttons: [{
									label: 'Close',
									action: function(dialogRef) {
										dialogRef.close();
									}
								}]
							});     
                        }
                    },
                    error:function(){
                        BootstrapDialog.show({
								type:"type-danger",
								title: '操作错误',
								message: "请联系开发人员！！",
								closable: false,
								buttons: [{
									label: 'Close',
									action: function(dialog) {
										dialog.close();
										// You can also use BootstrapDialog.closeAll() to close all dialogs.
										
									}
								}]
							});
						
                    }
                });
                return false;
	});
	 
	$('#dictionary').change(function(){
		var val=$(this).val();
		$('#tra_contents').html(val);
		var bootstrapValidator = $('#subForm').data('bootstrapValidator');
		bootstrapValidator.addField('tra_contents',{  
			  validators: {
						notEmpty: {
							message:  '请填写回复内容'
						}
					}
			 });  
	  bootstrapValidator.addField('com_title',{  
			  validators: {
						notEmpty: {
							  message:  '请选择投诉主题'
						}
					}
			 }); 
			 bootstrapValidator.addField('com_quarter',{  
			  validators: {
						notEmpty: {
							   message:  '请选择季度'
						}
					}
			 }); 
			 bootstrapValidator.addField('com_deadline',{  
			  validators: {
						notEmpty: {
							  message:  '请选择是否在保质期内'
						}
					}
			 });
			  bootstrapValidator.addField('com_dept',{  
			  validators: {
						notEmpty: {
							  message:  '请选择鉴定部门'
						}
					}
			 }); 
			 
	})
	
	//////////////
	$("input[name='tra_type'").click(function(){ 
		var val=$("input[name='tra_type']:checked").val();
		if(val == 2 || val == 1 || val == 5){
			if( val == 1 || val == 5){
				$('.jddept').hide();
			}else{
				$('.jddept').show();
			}
			$("#oaShow").show();
		}else{
			$("#oaShow").hide();
		}
	})//////////////
});
</script>

<div class="row">
<!-- modal body start -->
<div class="col-sm-12" id="info">
 <!-- base -->
  <div class="col-sm-2" >
    <p class="lead">基本信息</p>
  </div>
  <div class="col-sm-10" > 
    <!-- item -->
    <p class="pull-right small"><?php echo (date("Y-m-d H:i:s",$info["add_time"])); ?></p>
    <p >投诉编号：<?php echo ($info["com_code"]); ?> </p>
    <p >投 诉 人：<?php echo ($info["agent_code"]); ?>  / <?php echo ($info["agent_storename"]); ?>  /   <?php echo ($info["agent_name"]); ?>  / <?php echo ($info["agent_province"]); ?> / <?php echo ($info["agent_area"]); ?></p>
    <p >联 系 人：<?php echo ($info["agent_person"]); ?>  /  <?php echo ($info["agent_tel"]); ?></p>
    <hr>
    <div class="row"> 
      <!-- item -->
      <div class="col-sm-4" >
        <p >款 号：<?php echo ($info["style_id"]); ?></p>
        <p > 色号：<?php echo ($info["color_id"]); ?> </p>
        <p > 次品数量：<?php echo ($info["number"]); ?></p>
        <p > 购买时间：<?php echo ($info["sale_time"]); ?></p>
        <p > 销售类型：
          <?php if(($info["sale_type"]) == "0"): ?>未销售<?php endif; ?>
          <?php if(($info["sale_type"]) == "1"): ?>已销售<?php endif; ?>
        </p>
      </div>
      <!-- item --> 
      <!-- item -->
      <div class="col-sm-8" >
        <p class="text-danger">投诉类别：
          <?php if(($info["com_type"]) == "1"): ?>照片鉴定<?php endif; ?>
          <?php if(($info["com_type"]) == "2"): ?>实物鉴定<?php endif; ?>
        </p>
        <?php if(($info["com_type"]) == "1"): ?><div class="gallery" >
	      <ul>
          <?php if(is_array($info["com_pic"])): $i = 0; $__LIST__ = $info["com_pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="uploadResult"> 
            	<a href="<?php echo ($vo); ?>"><img src="<?php echo ($vo); ?>" class="previewImage"/> </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div><?php endif; ?>
        <?php if(($info["com_type"]) == "2"): ?><p > 快递公司：<?php echo ($info["com_express"]); ?></p>
          <p > 快递单号：<?php echo ($info["com_express_number"]); ?></p>
          <p > 回寄地址：<?php echo ($info["com_express_address"]); ?></p><?php endif; ?>
      </div>
      <!-- item --> 
    </div>
    <!-- item -->
    <hr />
    <!-- item -->
    <p >投诉描述：</p>
    <p class=""><?php echo ($info["com_contents"]); ?></p>
    <!-- item --> 
    
  </div>
 <!-- base -->

<?php if(!empty($follow)): ?><div class="col-sm-2" >
    <p class="lead">信息追加</p>
  </div>
  <div class="col-sm-10" > 
    <?php if(is_array($follow)): $i = 0; $__LIST__ = $follow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><hr/>
    <div class="row">
    <div class="col-sm-4" >
    <?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?>
    </div>
         <div class="col-sm-10" >
        <p class="text-danger">投诉类别：
          <?php if(($vo["com_type"]) == "1"): ?>照片鉴定<?php endif; ?>
          <?php if(($vo["com_type"]) == "2"): ?>实物鉴定<?php endif; ?>
        </p>
        <?php if(($vo["com_type"]) == "1"): ?><div class="gallery" >
	      <ul>
          <?php if(is_array($vo["fol_pic"])): $i = 0; $__LIST__ = $vo["fol_pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="uploadResult"> 
            	<a href="<?php echo ($v); ?>"><img src="<?php echo ($v); ?>" class="previewImage"/> </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div><?php endif; ?>
        <?php if(($vo["com_type"]) == "2"): ?><p > 快递公司：<?php echo ($vo["fol_express"]); ?></p>
          <p > 快递单号：<?php echo ($vo["fol_express_number"]); ?></p>
          <p > 回寄地址：<?php echo ($vo["fol_express_address"]); ?></p><?php endif; ?>
      </div>
      </div>
      <hr />
    <!-- item -->
    <p >投诉描述：</p>
    <p class=""><?php echo ($vo["fol_contents"]); ?></p>
    <!-- item --><?php endforeach; endif; else: echo "" ;endif; ?>
      </div><?php endif; ?>

 <!--tracklist --> 
<?php if(!empty($tracklist)): ?><div class="col-sm-12" id="track" >
    <hr>
    <div class="col-sm-2" >
       <h4>客服回复 <i class="fa fa-comments-o" aria-hidden="true"></i></h4>
    </div>
    <div class="col-sm-10" >
      <?php if(is_array($tracklist)): $i = 0; $__LIST__ = $tracklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><blockquote>
           <div class="row">
            <div class="col-sm-2">
               <span class="text-danger">
                 <?php if(($vo["tra_type"]) == "1"): ?>不接收<?php endif; ?>
                <?php if(($vo["tra_type"]) == "2"): ?>启动OA<?php endif; ?>
                <?php if(($vo["tra_type"]) == "3"): ?>图片鉴定<?php endif; ?>
                <?php if(($vo["tra_type"]) == "4"): ?>实物鉴定<?php endif; ?>
                <?php if(($vo["tra_type"]) == "5"): ?>接收<?php endif; ?>
                <?php if(($vo["tra_type"]) == "99"): ?>废弃<?php endif; ?>
                </span>
            </div>
            <div class="col-sm-10">
              <!-- 启动OA-->
                
             <p><?php echo ($vo["tra_contents"]); ?> </p>
             <footer><?php echo ($vo["com_user"]); ?> / <?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></footer>
             <!-- oa -->
             <?php if(($vo["tra_type"]) == "2"): ?><hr> 
              <p class="blockquote_title text-primary">
         投诉主题：<?php echo ($vo["com_title"]); ?>  
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;季度：<?php echo ($vo["com_quarter"]); ?>   
         
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;保质期内： <?php if(($vo["com_deadline"]) == "1"): ?>是<?php endif; ?>
                 <?php if(($vo["com_deadline"]) == "2"): ?>否<?php endif; ?>
         
         </p>
         
         
             <p class="blockquote_title text-primary"> 
             
             
               	<?php if(($vo["tra_oa"]["oa_status"]) == "2"): ?>启动OA失败 / 发起OA<?php endif; ?>
                <?php if(($vo["tra_oa"]["oa_status"]) == "1"): ?>OA编号： <?php echo ($vo["tra_oa"]["oa_number"]); ?><br>
                  
         			OA说明：<?php echo ($vo["tra_oa"]["oa_remark"]); endif; ?>
                 <?php if(($vo["tra_oa"]["oa_type"]) == "1"): ?><br> OA审批结果：同意接受；相关意见：<?php echo ($vo["tra_oa"]["oa_contents"]); ?>    <?php echo (date("Y-m-d H:i:s",$vo["tra_oa"]["oa_time"])); endif; ?> 
               	  <?php if(($vo["tra_oa"]["oa_type"]) == "2"): ?><br> OA审批结果：不同意接受；相关意见：<?php echo ($vo["tra_oa"]["oa_contents"]); ?> <?php echo (date("Y-m-d H:i:s",$vo["tra_oa"]["oa_time"])); endif; ?> 
                  <?php if(($vo["tra_oa"]["oa_express"]) != ""): ?><br> 快递信息：<?php echo ($vo["tra_oa"]["oa_express_number"]); ?> / <?php echo ($vo["tra_oa"]["oa_express"]); endif; ?> 
         
             </p><?php endif; ?>
            <!-- oa end -->
            
            </div>
       </div>
      
        </blockquote><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div><?php endif; ?>
  <!--tracklist --> 
 <!--eq --> 
<?php if(($info["com_status"]) == "2"): ?><div class="col-sm-12" id="track" >
  <hr>
  <div class="col-sm-2" >
    <h4>客服提交 <i class="fa fa-commenting" aria-hidden="true"></i> </h4>
  </div>
  <div class="col-sm-10" >
    <form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="" role="form">
        <div class="row"> 
          <!-- modal body start -->
          <div class="form-group form-group-sm">
            <input type="hidden" name="com_code" value="<?php echo ($info["com_code"]); ?>"/>
            <label class="col-sm-2 control-label" for="tra_type">回复类别</label>
            <div class="col-sm-10 ">
             <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="3">
              图片鉴定 </label>
               <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="4">
              实物鉴定 </label>
              <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="2">
              启动OA </label>
                <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="5">
              接收 </label>
            <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="1">
              不接收 </label>
            
               <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="99">
              废弃 </label>
             
            </div>
          </div>
          <div id="oaShow" style="display:none">
          <div class="form-group form-group-sm">
            <label class="col-sm-2 control-label" for="com_title">投诉主题</label>
            <div class="col-sm-3 ">
              <select name="com_title" id="com_title" class="form-control">
                <option value="">请选择</option>
                <?php if(is_array($titles)): $i = 0; $__LIST__ = $titles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["title"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
            </div>
			<div class="jddept">
             <label class="col-sm-2 control-label" for="com_deadline">鉴定部门</label>
            <div class="col-sm-3 ">
              <select name="com_dept" id="com_dept" class="form-control">
                <option value="">请选择</option>
                <option value="生产一系统">生产一系统</option>
                <option value="生产二系统">生产二系统</option>
                <option value="鞋配">鞋配</option>
              </select>
            </div>
			</div>
          </div>
          <div class="form-group form-group-sm">
            <label class="col-sm-2 control-label" for="com_quarter">季度</label>
            <div class="col-sm-3 ">
             <input name="com_quarter" id="com_quarter" class="form-control">
            
            </div>
         
            <label class="col-sm-2 control-label" for="com_deadline">保质期内</label>
            <div class="col-sm-3 ">
              <select name="com_deadline" id="com_deadline" class="form-control">
                <option value="">请选择</option>
                <option value="1">是</option>
                <option value="2">否</option>
              </select>
            </div>
          </div>
           <!--item -->
          <div class="form-group form-group-sm jddept">
            <label class="col-sm-2 control-label" for="oa_remark">启动OA</label>
            <div class="col-sm-8">
            
            
              <textarea class="form-control" name="oa_remark"  id="oa_remark" placeholder="请输入启动OA理由或相关说明"></textarea>
            </div>
          </div>
          <!--item --> 
         </div>
          <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-2 control-label" for="tra_contents">回复客服</label>
            <div class="col-sm-8">
            
             <select id="dictionary" class="form-control">
                <option value="">回复字典</option>
                <?php if(is_array($dictionary)): $i = 0; $__LIST__ = $dictionary;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["content"]); ?>"><?php echo ($vo["content"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <div class="h10"></div>
              <textarea class="form-control" name="tra_contents"  id="tra_contents" placeholder="回复内容"></textarea>
            </div>
          </div>
          <!--item --> 
          
        </div>
      </form>
  </div><?php endif; ?>
    <!--eq -->  
  <!-- modal body start -->
   
  
</div>
  <script type="text/javascript" src="<?php echo RES;?>/public/zoom/js/zoom.min.js"></script>
  <script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.form.js"></script>