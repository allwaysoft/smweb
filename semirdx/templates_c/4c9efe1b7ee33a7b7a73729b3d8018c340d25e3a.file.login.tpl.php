<?php /* Smarty version Smarty-3.1.11, created on 2016-06-15 04:23:58
         compiled from "templates\admin\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90655760bc3e429d34-16348247%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c9efe1b7ee33a7b7a73729b3d8018c340d25e3a' => 
    array (
      0 => 'templates\\admin\\login.tpl',
      1 => 1465957121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90655760bc3e429d34-16348247',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web_copyrighturl' => 0,
    'web_copyright' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5760bc3e48d037_62379914',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5760bc3e48d037_62379914')) {function content_5760bc3e48d037_62379914($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../admin/header_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  
  <!-- GRAPHIC THEME -->
  <script type="text/javascript" src="/semirdx/templates/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="/semirdx/templates/public/js/jquery.form.js"></script><!-- up file blug -->
<script type="text/javascript">
$(document).ready(function() {
	//
   $('#form1').bootstrapValidator({
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
                        message: 'The login name can\'t be empty'
                    },
					stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The login name can\'t be empty'
                    }
                }
            },
			 userpass: {
                message: 'The Pass word is not valid',
                validators: {
                    notEmpty: {
                        message: 'The  Pass word    can\'t be empty'
                    }
                }
            } 
		}
    }).on('success.form.bv', function(e) {
		  
	});

    
	
});
</script>
 
  
  <div class="container">
    <div class="row" >
      <div  class=" ">
        <div class="col-xs-12 col-sm-8" >
        	<p>
            	<h3>Website administrator</h3>
                <small>Please Login</small>
            </p>
        </div>
        <div class="col-xs-12 col-sm-4">
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h4 class="panel-title">Admin Login</h4>
            </div>
            <div class="panel-body">
              <form id="form1" name="form1" class="backLogin"  method="post" action="<?php echo site_url('admin/log/login');?>
" role="form">
                <div class="form-group  form-group-sm">
                  <label for="username">Username</label>
                  <input name="username" type="text" class="form-control" id="username"  maxlength="10"  />
                </div>
                <div class="form-group form-group-sm">
                  <label for="userpass">Password:</label>
                  <input type="password" name="userpass" id="userpass" class="form-control"   />
                </div>
                
                <div class="form-group form-group-sm">
                  <input type="submit" name="button" id="button" value="Login &gt;&gt;" class="btn btn-block btn-sm btn-inverse" />
                </div>
             
              </form>
            </div>
            <div class="panel-footer"><a href="mailto:lizd11@163.com">lizd11@163.com</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- --> 
  
  <!-- Footer -->
  
  <div style="  font-size:12px; padding-bottom:10px; text-align:center; " > &copy; <?php echo date('Y');?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['web_copyrighturl']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['web_copyright']->value;?>
</a>, All Rights Reserved <br />
  </div>
  
  <!-- /footer -->
  
  </body>
  </html><?php }} ?>