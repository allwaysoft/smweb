{%include file="../admin/header_top.tpl"%}
  
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
              <form id="form1" name="form1" class="backLogin"  method="post" action="{%site_url('admin/log/login')%}" role="form">
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
  
  <div style="  font-size:12px; padding-bottom:10px; text-align:center; " > &copy; {%date('Y')%} <a href="{%$web_copyrighturl%}" target="_blank">{%$web_copyright%}</a>, All Rights Reserved <br />
  </div>
  
  <!-- /footer -->
  
  </body>
  </html>