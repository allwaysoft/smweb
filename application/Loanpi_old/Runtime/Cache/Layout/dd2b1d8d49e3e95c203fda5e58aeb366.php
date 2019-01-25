<?php if (!defined('THINK_PATH')) exit();?>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/jquery.form.js"></script><!-- up file blug -->
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link href="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">  
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
            reg_amount: {
                message: 'The AD banner  name is not valid',
                validators: {
                    notEmpty: {
                        message:  ' be empty'
                    },
					digits: { message:  ' digits'},
                    greaterThan: {
                        value: 1, message:  ' >1'
                    },
                    lessThan: {
                        value: '<?php echo ($sapLimit); ?>', message:  '<  <?php echo ($sapLimit); ?>'
                    }
                }
            },
			 reg_cycle: {
                message: 'The AD banner  URL is not valid',
                validators: {
                    notEmpty: {
                        message: 'The  AD banner  URL  is required and can\'t be empty'
                    },
					digits: { message:  ' digits'},
                    greaterThan: {
                        value: 1, message:  ' >1'
                    },
                    lessThan: {
                        value: '<?php echo ($sapCycle); ?>', message:  '<  <?php echo ($sapCycle); ?>'
                    }
                }
            } 
		}
    }).on('success.form.bv', function(e) {
		 var post_data = $("#subForm").serializeArray();
		 		var post_url;
				//alert($("input[name=id]").val());
                 
                    post_url = "/loanpi.php/Register/reg_add_do"; 
                
                  //  post_url = "{%site_url('admin/homepage/edit')%}"; 
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: post_data,
                    success: function(msg){
 					alert(msg);
                        if(msg==0){
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: 'Add  Success! ',
								message: 'current page is being refreshed!!' 
							});     
                             
                            setInterval(function(){
                               // window.location.reload();
                            },1000);
                            //  Alert(msg);
                        }else{
                            BootstrapDialog.show({
								type:"type-danger",
								title: 'Add AD banner  Error!',
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
	  ////////////////////
	  $('.form_date').datetimepicker({
        language: 'zh-CN',
        weekStart: 1,
        todayBtn: 1,
		  autoclose: 1,
		  todayHighlight: 1,
		  startView: 2,
		  minView: 2,
		  forceParse: 0
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
            <label class="col-sm-3 control-label" for="">Name</label>
            <div class="col-sm-8 ">
              <span class="rightFont"> <?php echo ($thisUser['user_name']); ?> / <?php echo ($thisUser['name']); ?> </span>
            </div>
          </div>
          <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="reg_start_time">statar date</label>
            <div class="col-sm-5">
              
              <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="reg_start_time" data-link-format="yyyy-mm-dd">
                   <input type="text" class="form-control" name="reg_start_time"  id="reg_start_time" placeholder="reg_start_time" value="">
                    <span class="input-group-addon"><a href="javascript:;" ><span class="glyphicon glyphicon-remove  "></span></a></span>
					<span class="input-group-addon"><a href="javascript:;" ><span class="glyphicon glyphicon-calendar"></span></a></span>
                 
        </div>
            </div>
             <div class="col-sm-4">
            <span class="rightMsg">1 ~ <?php echo ($sapLimit); ?></span>
            </div>
          </div>
           <!--item -->
          <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="reg_amount">RegAmount</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="reg_amount"  id="reg_amount" placeholder="reg_amount" value="">
            </div>
             <div class="col-sm-5">
            <span class="rightMsg">1 ~ <?php echo ($sapLimit); ?></span>
            </div>
          </div>
           <!--item -->
           <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="reg_cycle">RegCycle</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="reg_cycle"  id="reg_cycle" placeholder="reg_cycle" value="">
            </div>
            <div class="col-sm-5">
            <span class="rightMsg">1 ~ <?php echo ($sapCycle); ?></span>
            </div>
          </div>
           <!--item -->
        </div>
        <div class="modal-footer"> 
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>