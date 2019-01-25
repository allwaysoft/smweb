<?php if (!defined('THINK_PATH')) exit();?><style></style>
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.form.js"></script>
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
                 post_url = "/semir400admin.php/Staff/reply/type/service"; 
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
	/* $('#tra_type').change(function(){
		var bootstrapValidator = $('#subForm').data('bootstrapValidator');
		if($(this).val()==2||$(this).val()==''){
			bootstrapValidator.enableFieldValidators('tra_contents', true);
		}else{
			bootstrapValidator.addField('tra_contents',{  
				  validators: {
							notEmpty: {
								message:  '请输入回复内容'
							}
						}
				 }); 
		}
	})  */ 
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
	})
	  //////////////
	  //////////////
	$("input[name='tra_type'").click(function(){ 
		var val=$("input[name='tra_type']:checked").val();
		if(val == 2){
			$("#oaShow").show();
		}else{
			$("#oaShow").hide();
		}
	})//////////////s
});
</script>

<div class="row margin-null" >
<div class="col-sm-12" id="info"> 
    <!-- modal body start -->
    <div class="col-sm-2" >
      <p class="lead">基本信息</p>
    </div>
    <div class="col-sm-10" >
      <p class="pull-right small"><?php echo (date("Y-m-d H:i:s",$info["add_time"])); ?></p>
      <p >投诉编号：<?php echo ($info["com_code"]); ?> </p>
      <p >投 诉 人：<?php echo ($info["agent_code"]); ?>  / <?php echo ($info["agent_storename"]); ?>  /   <?php echo ($info["agent_name"]); ?>  / <?php echo ($info["agent_province"]); ?> / <?php echo ($info["agent_area"]); ?></p>
      <p >联 系 人：<?php echo ($info["agent_person"]); ?>  /  <?php echo ($info["agent_tel"]); ?></p>
      <hr>
      <div class="row" >
       <div class="col-sm-2" >投诉描述：</div>
      <div class="col-sm-10" ><?php echo ($info["com_contents"]); ?></div>
      </div>
    </div> 
</div>
  <!--item --> 
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
                <?php if(($vo["tra_type"]) == "1"): ?>拒收/驳回<?php endif; ?>
                <?php if(($vo["tra_type"]) == "2"): ?>启动OA<?php endif; ?>
                <?php if(($vo["tra_type"]) == "3"): ?>接收回复<?php endif; ?>
                <?php if(($vo["tra_type"]) == "99"): ?>废弃<?php endif; ?>
                </span>
            </div>
            <div class="col-sm-10">
             <p><?php echo ($vo["tra_contents"]); ?> </p>
             <footer><?php echo ($vo["com_user"]); ?> / <?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></footer>
               <hr>
             <p class="blockquote_title text-primary"> 
             <!-- oa -->
             <?php if(($vo["tra_type"]) == "2"): if(($vo["tra_oa"]["oa_status"]) == "2"): ?>启动OA失败 / 发起OA<?php endif; ?>
                <?php if(($vo["tra_oa"]["oa_status"]) == "1"): ?>OA编号： <?php echo ($vo["tra_oa"]["oa_number"]); ?><br>
                   OA说明： <?php echo ($vo["tra_oa"]["oa_remark"]); endif; ?>
                 <?php if(($vo["tra_oa"]["oa_type"]) == "1"): ?><br> OA审批结果：同意接受；相关意见：<?php echo ($vo["tra_oa"]["oa_contents"]); ?>    <?php echo (date("Y-m-d H:i:s",$vo["tra_oa"]["oa_time"])); endif; ?> 
               	  <?php if(($vo["tra_oa"]["oa_type"]) == "2"): ?><br> OA审批结果：不同意接受；相关意见：<?php echo ($vo["tra_oa"]["oa_contents"]); ?> <?php echo (date("Y-m-d H:i:s",$vo["tra_oa"]["oa_time"])); endif; endif; ?>
            <!-- oa end -->
             </p>
           
            
            </div>
       </div>
        
           
            
        </blockquote><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div><?php endif; ?>
  <!--item --> 
<?php if(($info["com_status"]) == "2"): ?><div class="col-sm-12" id="track" >
  <hr>
  <div class="col-sm-2" >
     <h4>客服提交 <i class="fa fa-commenting" aria-hidden="true"></i> </h4>
  </div>
  <div class="col-sm-10" >
    <form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="" role="form">
      <div class="my-form form-horizontal"> 
        <!-- modal body start -->
        <div class="form-group form-group-sm">
          <input type="hidden" name="com_code" value="<?php echo ($info["com_code"]); ?>"/>
          <label class="col-sm-2 control-label" for="tra_type">回复类别</label>
          <div class="col-sm-10 ">
            <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="3">
              接收回复 </label>
            <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="1">
              拒收/驳回 </label>
            <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="2">
              启动OA </label>
              <label class="radio-inline">
              <input type="radio" name="tra_type" id="tra_type" value="99">
              废弃 </label>
          </div>
        </div>
        <!--item -->
        <div id="oaShow" style="display:none">
          <div class="form-group form-group-sm">
            <label class="col-sm-2 control-label" for="oa_remark">启动OA</label>
            <div class="col-sm-8">
            
            
              <textarea class="form-control" name="oa_remark"  id="oa_remark" placeholder="请输入启动OA理由或相关说明"></textarea>
            </div>
          </div>
           </div>
          <!--item --> 
         
        <div class="form-group form-group-sm">
          <label class="col-sm-2 control-label">回复内容</label>
          <div class="col-sm-8 ">
            <select id="dictionary" class="form-control">
              <option value="">字典回复</option>
              <?php if(is_array($dictionary)): $i = 0; $__LIST__ = $dictionary;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["content"]); ?>"><?php echo ($vo["content"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <div class="h10"></div>
            <textarea class="form-control" name="tra_contents"  id="tra_contents" placeholder="回复内容"></textarea>
          </div>
        </div>
       
        <!--item --> 
        
        <!--item --> 
        
      </div>
    </form>
  </div><?php endif; ?>
    <!--item --> 
</div>