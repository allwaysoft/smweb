$(function() {
   $('#loginform').bootstrapValidator({
	     message: 'This value is not valid',
         live: 'disabled',
         feedbackIcons: {
            valid: 'glyphicon glyphicon-ok fui-check',
            invalid: 'glyphicon glyphicon-remove fui-cross',
            validating: 'glyphicon glyphicon-refresh'
        }, 
        fields: {
			///
             sendname: {
                validators: {
                    notEmpty: {
                        message: '请输入登录账号！'
                    },
                    stringLength: {
                        min: 2,
                        max: 20,
                        message: '请输入合法的登录账号！'
                    }
                }
            },
			///
			///
             pword: {
                validators: {
                    notEmpty: {
                        message: '请输入登录密码！'
                    },
                    stringLength: {
                        min: 2,
                        max: 20,
                        message: '请输入正确的登录密码！'
                    }
                }
            }
			///
		}
    }).on('success.form.bv', function(e) {
		 var post_data = $("#loginform").serializeArray();
                var post_url = "/wxqyh.php/Index/checklogin.html";
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: post_data,
                    success: function(msg){
 						var showInfo;
                        if(msg=="0"){
							
                             document.location.href= "/wxqyh.php/Main/index.html";
                            //  Alert(msg);
                        }else if(msg=='1'){
							  showInfo = "验证码输入不正确";
							}else if(msg=='2'){
								showInfo = "账号被锁定";
							}else if(msg=='3'){
								showInfo = "账号被禁用";
							}else if(msg=='4'){
								showInfo = "密码错误！";
							}else if(msg=='6'){
								showInfo = "该账号已登陆！";
							}else{
								showInfo = "不存在此用户名";
							};
							if(msg=="0"){
							}else{
                            BootstrapDialog.show({
								type:"type-danger",
								title: '提交失败!',
								message: showInfo,
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
								title: '提交错误!',
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
	////
   
}); 