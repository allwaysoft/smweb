$(function(){
	$("#form1").validate({
		rules:{
			userid:{required:true},
			password:{required:true},
			validCode:{required:true}
		},
		messages: {
			userid: {required: "*"},
			password: {required: "*"},
			validCode: {required:"*"}
        },
        submitHandler:function(form){
        	$.ajax({
        		type:"post",
        		url:"/admin.php/Index/checklogin.html",
        		data:{userid:$("#userid").val(),password:$("#password").val(),validCode:$("#validCode").val()},
        		beforeSend :function(){
			        $("#btnSubmit").attr("value","登录中...");
		        },
		        success: function(msg){
		        	if(msg=='0'){
		        		window.location.href='/admin.php/Main/index.html';
		        	}else if(msg=='1'){
				    	$("#btnSubmit").attr("value","登录");
				    	$("#errorInfo").attr("style","display:block");
					    $("#errorInfo").text("验证码输入不正确");
				    }else if(msg=='2'){
				    	$("#btnSubmit").attr("value","登录");
				    	$("#errorInfo").attr("style","display:block");
					    $("#errorInfo").text("账号被锁定");
				    }else{
				    	$("#btnSubmit").attr("value","登录");
				    	$("#errorInfo").attr("style","display:block");
					    $("#errorInfo").text("用户名或密码错误");
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
    $("#imgCheckB").attr("src", "/admin.php/Index/verify/rz/"+randomRZ);
}
