<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.form.js"></script> 
<!--   CONTENT  ---->
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
            old_password: {
                message: 'This is not valid',
                validators: {
                    notEmpty: {
                        message:  '原密码必填'
                    }
                }
            },
			password: {
                message: 'This is not valid',
                validators: {
                    notEmpty: {
                        message:  '密码必填'
                    },
					stringLength: {
                         min: 6,
                         max: 12,
                         message: '密码长度必须在6到12之间'
                     },
					identical: {
                        field: 'confirmPassword',
                        message: '新密码与确认密码必须一致'
                    },
					different: {
                        field: 'old_password',
                        message: '新密码不能和旧密码相同'
                    }
                }
            },
			confirmpassword: {
                message: 'This is not valid',
                validators: {
                    notEmpty: {
                        message:  '确认密码必填'
                    },
					identical: {
                        field: 'password',
                        message: '新密码与确认密码必须一致'
                    }
                }
            }
		}
    }).on('success.form.bv', function(e) {
		
		 var post_data = $("#subForm").serializeArray();
		 		var post_url;
				//alert($("input[name=id]").val());
                 post_url = "/semir400admin.php/Login/cg_spw_do"; 
                 //  post_url = "{%site_url('admin/homepage/edit')%}"; 
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: post_data,
                    success: function(msg){ 
					
                        if(msg==0){
							$.each(BootstrapDialog.dialogs, function(id, dialog){
					 dialog.close();
				 });
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: '操作成功 ',
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
						$.each(BootstrapDialog.dialogs, function(id, dialog){
					 dialog.close();
				 });
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
           
          <!--item --> 
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="user_name">用户名</label>
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
            <label class="col-sm-3 control-label" for="old_password">原密码</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" name="old_password"  id="old_password" placeholder="请输入原密码" value=""> 
            </div> 
          </div>
           <!--item -->
            <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="password">新密码</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" name="password"  id="password" placeholder="请输入新密码" value="">
            </div> 
          </div>
           <!--item -->
            <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="confirmpassword">确认密码</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" name="confirmpassword"  id="confirmpassword" placeholder="确认密码" value="">
            </div> 
          </div>
           <!--item -->
        </div>
        
      </form>
    </div>
  </div> 
  
  <!-- ----->