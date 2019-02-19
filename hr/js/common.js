// JavaScript Document
$('#checked').click(function(){
	var sMobile=$('.tel').val();
	if(checkmobile(sMobile)==false){
		_alert('请输入正确的手机号码');
		return ;
	}
	var checkcode=$('.checkcode').val();
	if(checkcode==''){
		_alert('请输入验证码');
		return ;
	}
	var che=$('#che').is(':checked');
	if(che!=true){
		_alert('请确定已阅读应聘者申明');
		return ;
	}
	
	window.location.href='list.html';
})
$('#sendcode').click(function(){
	var sMobile=$('.tel').val();
	if(checkmobile(sMobile)==false){
		_alert('请输入正确的手机号码');
		return ;
	}else{
		sendcode(sMobile);
	}
})
function checkmobile(mobile){
	return !!mobile.match(/^(0|86|17951)?(1[0-9][0-9])[0-9]{8}$/);
}
var t=60;
function sendcode(tel){
	var sc=$('#sendcode');
	if(t<=0){
		sc.attr('disabled',false);
		sc.css('background','#48b536');
		sc.val('获取验证码');
		t=60;
	}else{
		sc.attr('disabled',true);
		sc.css('background','#ccc');
		sc.val('等待'+t+'秒');
		t--;
		setTimeout(function(){
			sendcode(tel)
		},1000)
	}
}

function _alert(str){
//提示
  layer.open({
    content: str
    ,skin: 'msg'
    ,time: 2 //2秒后自动关闭
  });	
}
$('#a_notice').click(function(){
	$('.mask,.notice').show();
})
$('.mask').click(function(){
	$('.mask,.notice').hide();
})