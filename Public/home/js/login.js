$(function(){
	$("#form1").validate({
		rules:{
			uname:{required:true},
			password:{required:true},
			validCode:{required:true}
		},
		messages: {
			uname: {required: "*"},
			password: {required: "*"},
			validCode: {required:"*"}
        },
        submitHandler:function(form){
        	$.ajax({
        		type:"post",
        		url:"/index.php/Index/checklogin.html",
        		data:{uname:$("#uname").val(),password:$("#password").val(),validCode:$("#validCode").val(),check:$("#check:checked").val()},
        		beforeSend :function(){
			        $("#btnSubmit").attr("value","登录中...");
		        },
		        success: function(msg){
		        	//alert(msg);
		        	if(msg=='0'){
						//
		        		 document.location.href= "/index.php/Main/index.html";
		        	}else if(msg=='1'){
				    	$("#btnSubmit").attr("value","登录");
				    	$("#errorInfo").attr("style","display:block");
					    $("#errorInfo").text("验证码输入不正确");
				    }else if(msg=='2'){
				    	$("#btnSubmit").attr("value","登录");
				    	$("#errorInfo").attr("style","display:block");
					    $("#errorInfo").text("账号被锁定");
				    }else if(msg=='3'){
				    	$("#btnSubmit").attr("value","登录");
				    	$("#errorInfo").attr("style","display:block");
					    $("#errorInfo").text("账号被禁用");
					}else if(msg=='4'){
				    	$("#btnSubmit").attr("value","登录");
				    	$("#errorInfo").attr("style","display:block");
					    $("#errorInfo").text("密码错误！");
				    }else if(msg=='6'){
				    	$("#btnSubmit").attr("value","登录");
				    	$("#errorInfo").attr("style","display:block");
					    $("#errorInfo").text("该账号已登陆！");
				    }else{
				    	$("#btnSubmit").attr("value","登录");
				    	$("#errorInfo").attr("style","display:block");
					    $("#errorInfo").text("不存在此用户名");
				    }
		        	refresh();
		        },
		        error:function(){
		        	$("#btnSubmit").attr("value","登录");
			    	$("#errorInfo").attr("style","display:block");
				    $("#errorInfo").text("登录失败，请稍候再试！");
		        }
		        
        	})
        }
	})
})
function refresh() {
    var randomRZ = Math.random();
    $("#imgCheckB").attr("src", "/index.php/Index/verify/rz/"+randomRZ);
}
