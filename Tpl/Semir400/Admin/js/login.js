// JavaScript Document 
$(document).ready(function(){ 
	 /////load  
   $('#form1').bootstrapValidator({
        message: 'This value is not valid',
       live: 'disabled',
         feedbackIcons: {
           valid: 'glyphicon glyphicon-ok fui-check',
            invalid: 'glyphicon glyphicon-remove fui-cross',
            validating: 'glyphicon glyphicon-refresh'
        }, 
        fields: {
            uname: {
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
			 password: {
                message: 'The Pass word is not valid',
                validators: {
                    notEmpty: {
                        message: 'The  Pass word    can\'t be empty'
                    }
                }
            } 
		}
    }).on('success.form.bv', function(e) {
		var post_data = $("#form1").serializeArray();
		  $.ajax({
        		type:"post",
        		url:"/semir400admin.php/Login/checklogin.html",  
				data: post_data,
		        success: function(msg){
		        	if(msg.status==true){
		        		window.location.href=msg.url;
		        	}else{
				    	BootstrapDialog.show({
								type:"type-danger",
								title: '登陆失败! ',
								message: '<h5>'+ msg.info +'</5>' 
							});       
				    } 
		        },
		        error:function(){
		        	 BootstrapDialog.show({
								type:"type-danger",
								title: '登陆失败! ',
								message: '请确认你的登陆信息!!' 
							});       
		        }
        	})
		 return false;
	});
	//////////////////////////////////
	 
});
/////////////////////////
	 
 
 