<?php if (!defined('THINK_PATH')) exit();?>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/jquery.form.js"></script><!-- up file blug --> 
<script type="text/javascript">
    $(document).ready(function(){
  ////////////// 
	 <?php if(($jsVail < 0) || ($jsVail == 0)): ?>$.each(BootstrapDialog.dialogs, function(id, dialog){
					 dialog.close();
				 });
	  BootstrapDialog.show({
								type:"type-danger",
								title: '错误',
								message: "余额不足，无法还款！",
								closable: false,
								buttons: [{
									label: 'Close',
									action: function(dialog) {
										dialog.close();
										// You can also use BootstrapDialog.closeAll() to close all dialogs.
										
									}
								}]
							});<?php endif; ?>
	////
     $('#subForm').bootstrapValidator({
       message: 'This value is not valid',
         feedbackIcons: {
           valid: 'glyphicon glyphicon-ok fui-check',
            invalid: 'glyphicon glyphicon-remove fui-cross',
            validating: 'glyphicon glyphicon-refresh'
        }, 
        fields: {
            rep_amount: {
                message: '金额不能为空',
                validators: {
                    notEmpty: {message:  '金额不能为空'},
					//Digits:{integer:1, fraction:2,message:"ssss"},
					digits:{message:' 只能输入正整数'}, //{integer:1, fraction:2,message:"ssss"},
                    greaterThan: {
                        value: 1, message:  ' 还款金额大于1万元'
                    },
                    lessThan: {
                        value: '<?php echo ($jsVail); ?>', message:  '还款金额不能大于余额 <?php echo ($jsVail); ?>'
                    } 
                }
            }
		}
    }).on('success.form.bv', function(e) {
		
		 var post_data = $("#subForm").serializeArray();
		 		var post_url;
				//alert($("input[name=id]").val());
                 post_url = "/loanpi.php/Repayment/repay_add_do"; 
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: post_data,
                    success: function(msg){
 					//	alert(msg);
                        if(msg == 101){
							$.each(BootstrapDialog.dialogs, function(id, dialog){
								 dialog.close();
							 });
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: '还款成功',
								message: '还款成功，正在刷新页面，请稍后。。。!!' 
							});     
                             
                             setTimeout(function(){
                               window.location.reload();
                            },1000);
                            //  Alert(msg);
                        }else{
							//$("#rep_amount").val('');
                            BootstrapDialog.show({
								type:"type-danger",
								title: '还款错误',
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
								title: '还款错误：',
								message: msg,
								buttons: [{
									label: 'Close',
									action: function(dialogRef) {
										dialogRef.close();
									}
								}]
							});     
						
                    }
                });
                return false;
	});
	  ////////////////////
	   
	 
	
	
});
</script>
 
  <div class="row">
    <div class="col-sm-12">
      <form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="" role="form">
       <input type="hidden" name="TOKEN" value="<?php echo session('TOKEN');?>"> 
        <div class="my-form form-horizontal"> 
          <!-- modal body start -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="">还款人</label>
            <div class="col-sm-8 ">
              <p  class="form-control-static"> <strong><?php echo ($thisUser['user_name']); ?> / <?php echo ($thisUser['name']); ?></strong> </p>
            </div>
          </div>
          <!--item -->
          <hr />
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="reg_start_time">贷款信息</label>
            <div class="col-sm-9">
            <p  class="form-control-static">
             贷款SAP编号： <?php echo ($loan['sap_code']); ?> 
               <input type="hidden" name="sap_code" id="sap_code" value="<?php echo ($loan['sap_code']); ?>" />
              , 贷款日期:<?php echo ($loan['sap_start_time']); ?> ~ <?php echo ($loan['sap_end_time']); ?>(<?php echo ($loan['sap_cycle']); ?>天)</p>
             <p  class="form-control-static">贷款金额: <?php echo ($loan['reg_amount']); ?> 万元, 已经还款: <?php echo ($repTotal); ?> 万元, 需还: <?php echo ($loan['reg_amount']-$repTotal); ?> 万元</p>
            </div>
          </div>
           <!--item -->
              <!--item -->
          <hr />
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="reg_start_time">账户余额</label>
            <div class="col-sm-9">
              <p  class="form-control-static"><?php echo ($sapBalance); ?> 万元</p> 
            </div>
             
          </div>
           <!--item -->
          <!--item -->
          <div class="form-group form-group-sm">
            <label class="col-sm-3 control-label" for="rep_amount">还款金额(万元)</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="rep_amount"  id="rep_amount" placeholder="请输入还款金额..." value="">
            </div>
             <div class="col-sm-5">
             <p  class="form-control-static"><span class="rightMsg">1 ~ <?php echo ($jsVail); ?></span></p>
            </div>
          </div>
           <!--item -->
           
           <!--item -->
        </div>
        
      </form>
    </div>
  </div>