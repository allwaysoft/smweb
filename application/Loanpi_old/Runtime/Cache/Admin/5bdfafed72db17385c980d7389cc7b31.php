<?php if (!defined('THINK_PATH')) exit();?>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/jquery.form.js"></script>
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
            user_name: {
                message: 'This is not valid',
                validators: {
                    notEmpty: {
                        message:  ' be empty'
                    }
                }
            },
			email: {
                message: 'This is not valid',
                validators: {
                    notEmpty: {
                        message:  ' be empty'
                    }
                }
            },
			mobile: {
                message: 'This is not valid',
                validators: {
                    notEmpty: {
                        message:  ' be empty'
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
                 post_url = "/loanpiadmin.php/User/user_edit_do"; 
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
								title: 'edit  Success! ',
								message: 'current page is being refreshed!!' 
							});     
                             
                             setTimeout(function(){
                                 window.location.reload();
                            },1000);
                            //  Alert(msg);
                        }else{
                            BootstrapDialog.show({
								type:"type-danger",
								title: 'Return Error!',
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
								title: 'edit Error!',
								message: "Please contact us!!",
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
            <label class="col-sm-3 control-label" for="user_name">user_name</label>
            <div class="col-sm-5 ">
              <input type="text" class="form-control" name="user_name" disabled="disabled"  id="user_name" placeholder="user_name" value="<?php echo ($user["user_name"]); ?>">
               <input type="hidden"   name="id" id="id" placeholder="id" value="<?php echo ($user["id"]); ?>">
            </div>
          </div>
          <!--item --> 
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="c_name">c_name</label>
            <div class="col-sm-5">
             <input type="text" class="form-control" name="c_name"  id="c_name" placeholder="c_name" value="<?php echo ($user["c_name"]); ?>">
            </div>
          </div>
           
          <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="email">Email</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="email"  id="email" placeholder="email" value="<?php echo ($user["email"]); ?>">
            </div> 
          </div>
           <!--item -->
            <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="mobile">Mobile</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="mobile"  id="mobile" placeholder="mobile" value="<?php echo ($user["mobile"]); ?>">
            </div> 
          </div>
           <!--item -->
           <!--item -->
        </div>
        
      </form>
    </div>
  </div>