<?php /* Smarty version Smarty-3.1.11, created on 2016-07-13 08:55:50
         compiled from "templates\admin\user_edit_pass.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198665785e3b85ab3c9-18895652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20fb81aad75e3ed42b7628c0e4054c1e9bc60892' => 
    array (
      0 => 'templates\\admin\\user_edit_pass.tpl',
      1 => 1468392932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198665785e3b85ab3c9-18895652',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5785e3b862cf08_67010733',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5785e3b862cf08_67010733')) {function content_5785e3b862cf08_67010733($_smarty_tpl) {?><script type="text/javascript" src="/semirdx/templates/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="/semirdx/templates/public/js/jquery.form.js"></script><!-- up file blug -->
<script type="text/javascript">
    $(document).ready(function(){
     $('#subForm').bootstrapValidator({
        message: 'This value is not valid',
       live: 'disabled',
         feedbackIcons: {
           valid: 'glyphicon glyphicon-ok fui-check',
            invalid: 'glyphicon glyphicon-remove fui-cross',
            validating: 'glyphicon glyphicon-refresh'
        }, 
        fields: {
            username: {
                message: 'The login name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The login name is required and can\'t be empty'
                    },
					stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The login name must be more than 2 and less than 30 characters long'
                    }
                }
            }, 
            password: {
                validators: {
                    notEmpty: {},
                    identical: {
                        field: 'confirm_userpass',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            },
            confirm_userpass: {
                validators: {
                    notEmpty: {},
                    identical: {
                        field: 'password'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            }
		}
    }).on('success.form.bv', function(e) {
		 var post_data = $("#subForm").serializeArray();
		 		var post_url;
				//alert($("input[name=id]").val());
                 
                    post_url = "<?php echo site_url('admin/system/user_edit_pass_do');?>
";//"<?php echo site_url('admin/homepage/add');?>
";
                
                  //  post_url = "<?php echo site_url('admin/homepage/edit');?>
";
				 
                 
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: post_data,
                    success: function(msg){
 
                        if(msg=="ok"){
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: '修改密码成功！ ',
								message: 'current page is being refreshed!!' 
							});     
                             
                            setInterval(function(){
                                window.location.reload();
                            },1000);
                            //  Alert(msg);
                        }else{
                            BootstrapDialog.show({
								type:"type-danger",
								title: '修改密码错误',
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
								title: 'Add nav Error!',
								message: "Please contact us!!",
								closable: false,
								buttons: [{
									label: 'Close',
									action: function() {
										// You can also use BootstrapDialog.closeAll() to close all dialogs.
										$.each(BootstrapDialog.dialogs, function(id, dialog){
											dialog.close();
										});
									}
								}]
							});
						
                    }
                });
                return false;
	});
	  //////////////////////////////////
});
</script>
<form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="" role="form">
  <div class="my-form form-horizontal">
<!-- modal body start -->
        <div class="form-group form-group-sm">
                <label class="col-sm-3 control-label" for="username">Login Name</label>
                 <div class="col-sm-8">
                   <input disabled="disabled" type="text" class="form-control" name="username"  id="username" placeholder="Login name" value="<?php echo $_SESSION['admin'];?>
">
                 
                </div>  
         	</div>
          
        <div class="form-group form-group-sm">
          <label class="col-sm-3 control-label" for="password">Pass word</label>
                 <div class="col-sm-8">
                 <input type="password" class="form-control" name="password"  id="password" placeholder="Pass word" value="">
                </div>  
    </div>
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="confirm_userpass">Confirm PW </label>
                 <div class="col-sm-8">
                    <input type="password" class="form-control" name="confirm_userpass"  id="confirm_userpass" placeholder="Confirm pass word" value="">
                 
                </div>  
   	</div>
         
         
              
      
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
  </form><?php }} ?>