<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-validator/bootstrapValidator.js"></script>
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
            upwd: {
                message: 'This is not valid',
                validators: {
                    notEmpty: {
                        message:  '密码不能为空'
                    }
                }
            }
		}
    }).on('success.form.bv', function(e) {
		$.each(BootstrapDialog.dialogs, function(id, dialog){
					 dialog.close();
				 });
		 var post_data = $("#subForm").serializeArray();
		 		var post_url;
				//alert($("input[name=id]").val());
                 post_url = "/semir400admin.php/User/user_pass_do"; 
                 //  post_url = "{%site_url('admin/homepage/edit')%}"; 
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: post_data,
                    success: function(msg){ 
                        if(msg==0){
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: '修改密码成功 ',
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
								message: msg,
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
	  
	  //////////////
});
</script>
 
  <div class="row">
    <div class="col-sm-12">
      <form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="" role="form">
        <div class="my-form form-horizontal"> 
          <!-- modal body start -->
             <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="user_number">客服编号</label>
            <div class="col-sm-6 ">
              <h6><strong><?php echo ($user["user_number"]); ?></strong></h6>
            </div>
          </div>
          <!--item --> 
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="user_name">登陆名</label>
            <div class="col-sm-5 ">
              <h6><strong><?php echo ($user["user_name"]); ?></strong></h6>
               <input type="hidden"   name="id" id="id" placeholder="id" value="<?php echo ($user["id"]); ?>">
            </div>
          </div>
          <!--item --> 
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="c_name">中文名</label>
            <div class="col-sm-5">
            <h6><strong><?php echo ($user["c_name"]); ?></strong></h6>
            
            </div>
          </div>          
            <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="mobile">手机</label>
            <div class="col-sm-5">
             <h6><strong><?php echo ($user["mobile"]); ?></strong></h6>
            </div> 
          </div>
           <!--item -->
             <!--item --> 
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="upwd">新密码</label>
            <div class="col-sm-4">
             <input type="text" class="form-control" name="upwd"  id="upwd" placeholder="输入新密码" value=""> 
            </div> 
          </div>
           <!--item -->
           <!--item -->
        </div>
        
      </form>
    </div>
  </div>