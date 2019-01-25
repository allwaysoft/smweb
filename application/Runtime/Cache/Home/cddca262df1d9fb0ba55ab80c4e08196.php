<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telphone=no, email=no">
<meta http-equiv="Cache-Control" content="no-siteapp">
<title>森马举报平台</title>
<link  rel="stylesheet" href="<?php echo RES;?>/css/css.css?<?php echo time();?>"/>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/layer/layer.js"  ></script>
<script src="<?php echo RES;?>/js/LocalResizeIMG.js"></script>
<script src="<?php echo RES;?>/js/mobileBUGFix.mini.js"></script>
</head>

<body>
<header>
	<img src="<?php echo RES;?>/images/header1.jpg" />
</header>
<div style="position: relative; top: 0px; left: 0px; right: 0px; bottom: 22px; width: 100%;">
	<section class="content" style="position: relative; top: .75rem; width: 100%;padding-top:0;" id="mm1">
    	<form id="form">
        	<ol class="issueForm" style="list-style-type:decimal ">
            	<li class="issueForm-item">
                	<span class="v" style="width:31%">*您是谁？</span>
                    <div class="k">
						<select id="reportObjectId" name="reportObjectId">
							<option value="">
								--请选择--
							</option>
							<option value="1">
								员工
							</option>
							<option value="2">
								供应商
							</option>
							<option value="3">
								代理商
							</option>
							<option value="4">
								合作伙伴/其他
							</option>
						</select>
					</div>
                </li>
                <li class="issueForm-item">
                	<span class="v" style="width:31%">*您的姓名</span>
                    <div class="k">
						<input class="input" name="reportName" id="reportName" maxlength="50" placeholder="请输入您的姓名" type="text">
					</div>
                </li>
                <li class="issueForm-item">
                	<span class="v" style="width:31%">*联系电话</span>
                    <div class="k">
						<input class="input" name="mobile" id="mobile" maxlength="50" placeholder="请留下电话，便于沟通举报内容" type="tel">
					</div>
                </li>
                <li class="issueForm-item">
                	<span class="v" style="width:31%">联系邮箱</span>
                    <div class="k">
						<input class="input" name="email" id="email" maxlength="100" placeholder="请留下邮箱地址，便于沟通举报内容" type="tel">
					</div>
                </li>
                <span class="v" style="width:31%;font-size:14;">请准确填写以下被举报人的信息</span>
                <li class="issueForm-item">
					<span class="v" style="width:31%">*姓名：</span>
					<div class="k">
						<input class="input" name="name" id="name" maxlength="50" placeholder="请输入姓名" type="text">
					</div>
				</li>
                <li class="issueForm-item">
					<span class="v" style="width:31%">*所在部门：</span>
					<div class="k">
						<input class="input" name="department" id="department" maxlength="50" placeholder="请输入部门/店铺" type="text">
					</div>
				</li>
                <li class="issueForm-item">
					<span class="v" style="width:31%">*职务：</span>
					<div class="k">
						<input class="input" name="position" id="position" maxlength="50" placeholder="请输入职务" type="text">
					</div>
				</li>
                <li class="issueForm-item">
					<span class="v" style="width:31%">*所在城市：</span>
					<div class="k">
						<input class="input" name="city" id="city" maxlength="50" placeholder="请输入被举报人所在城市" type="text">
					</div>
				</li>
                <li class="issueForm-item">
					<span class="v" style="width:31%">*举报内容：<br>
					<font style="font-size: .75rem;" id="tip">(剩余500字)</font>
					</span>
					<div class="k">
						<textarea rows="4" cols="22" id="content" name="content" style="width: 98%; overflow-x: hidden; overflow-y: hidden; overflow: auto; background-attachment: fixed; background-repeat: no-repeat; border-style: solid; border-color: #FFFFFF; font-size: .91rem; margin-top: .4rem;" placeholder="请具体描述举报内容，包含人物、时间、地点、事件。(20字以上，500字以内)"></textarea>
					</div>
				</li>
                <li class="issueForm-item">
					<span class="v">证据上传：</span>
					<div class="k">
						<div style="width: 90%; height: auto;" id="fileUp">
							<div style="margin-top:0.5rem; position: relative;" id="upload-container">
                            	<div class="upload" style="">+</div>
							  	<input accept="image/*" id="post-pictures-file" type="file" style=" width:3rem;height:3rem;display:block;opacity:0; position:absolute; top:0;z-index:99;">
						  	</div>
						</div>
                        <div class="imglist">
                        
                        </div>
					</div>
					<div class="sc">
						<p style="margin-top: 1rem;font-size:0.85rem;">
							<span style="color: #f71010;">温馨提醒：</span>最多上传9个附件,仅限图片，每个附件大小不超过5M。
						</p>
					</div>
				</li>
            </ol>
            
        </form>
        <button class="btn-f" style="width: 93%; margin: 0 auto; margin-top: 1.5rem;" id="submitBtn">提交</button>
    </section>
</div>
<script type="text/javascript">
	var max_len = 500;
	var min_len = 20;
	//内容文字个数提示
	$("#tip").text("(剩余" + max_len + "字)");
	var $content=$('#content');
	var obj = document.getElementById('content');
	$("#content").change(function() {
		if (obj.value.length > max_len) {
			$content.focus();
			$("#tip").text("(超出" + (obj.value.length - max_len) + "字)");
			
		} else {
			$("#tip").text("(剩余" + (max_len - obj.value.length) + "字)");

		}
	});
	$("#content").keyup(function() {
		if (obj.value.length > max_len) {
			$content.focus();
			$("#tip").text("(超出" + (obj.value.length - max_len) + "字)");
		} else if (obj.value.length < min_len) {
			$content.focus();
			$("#tip").text("少于(" + min_len + "字)");
		} else {
			$("#tip").text("(剩余" + (max_len - obj.value.length) + "字)");
		}
	});
$('#post-pictures-file').click(function(){
	if($('.uploadResult').length>=9){
		_alert('您只能上传9张图片');return false;
	}
    $(this).localResizeIMG({
        width: 1000,
        quality: 0.9,
        before: function() {
            if (checkHtml5Support() == false) {
                _alert("你的老掉牙浏览器不支持HTML5，请使用先进浏览器");
                return false;
            }
        },
        success: function(result) {
            var img = new Image();
            img.src = result.base64;
            var rand = new Date().getTime();
            var newDiv = '<div id=\"uploadFile' + rand + '\" class=\"uploadResult\"><div class=\"info\">压缩上传中...</div><img class=\"previewImage\"></div>';
            $('.imglist').before(newDiv);
            $.ajax({
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            // 获取进度百分比
                            var percentComplete = parseInt((evt.loaded / evt.total)*100);
                            $(".info:last").html("已上传："+percentComplete + "%");
                        }
                    });
                    return xhr;
                },
                url: '<?php echo U("upload");?>',
                type: 'POST',
                data: {
                    'base64': result.base64
                },
                timeout: 45000,
                error: function() {
                    _alert('上传发生错误或超时，请重试');
                    $('#uploadFile' + rand).hide();
                },
                success: function(data) {
                	var newDiv2 = $('<div class=\"delPic\" onclick=\"javascript:delUploadImage(\'uploadFile' + rand + '\');\" title=\"删除\" style=\"display: block;\">删除<input type="hidden" name="imgpath[]" value="'+data+'"/></div>');
                    $('#uploadFile' + rand + ' img').after(newDiv2);
                    $('#uploadFile' + rand + ' img').attr("src", result.base64);
                    $('#uploadFile' + rand + ' .info').html('上传完成');
                }
            });
        }
    });
});

function delUploadImage(Id){
	$('#'+Id).remove();
}
function checkHtml5Support() {
    if (window.applicationCache) {
        return true;
    } else {
        return false;
    }
}

$('#submitBtn').click(function(){
	var reportObjectId=$('#reportObjectId').val();
	if(reportObjectId==''){
		$('#reportObjectId').focus();
		_alert('请选择你是谁');return ;
	}
	var reportName=$.trim($('#reportName').val());
	if(reportName==''){
		$('#reportName').focus();
		_alert($('#reportName').attr('placeholder'));return ;
	}
	var mobile=$.trim($('#mobile').val());
	if(mobile==''){
		$('#mobile').focus();
		_alert($('#mobile').attr('placeholder'));return ;
	}else{
		if(!!mobile.match(/^(0|86|17951)?(1[0-9][0-9])[0-9]{8}$/)==false){
			$('#mobile').focus();
			_alert('请输入正确的手机号码');return ;
		}
	}
	var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	var email=$.trim($('#email').val());
	if(email!=''&&!myreg.test(email)){
		$('#email').focus();
		_alert('请输入正确的邮箱格式');return ;
	}
	var name=$.trim($('#name').val());
	if(name==''){
		$('#name').focus();
		_alert($('#name').attr('placeholder'));return ;
	}
	var department=$.trim($('#department').val());
	if(department==''){
		$('#department').focus();
		_alert($('#department').attr('placeholder'));return ;
	}
	var position=$.trim($('#position').val());
	if(position==''){
		$('#position').focus();
		_alert($('#position').attr('placeholder'));return ;
	}
	var city=$.trim($('#city').val());
	if(city==''){
		$('#city').focus();
		_alert($('#city').attr('placeholder'));return ;
	}
	var city=$.trim($('#city').val());
	if(city==''){
		$('#city').focus();
		_alert($('#city').attr('placeholder'));return ;
	}
	var content=$.trim($('#content').val());
	if(content==''){
		$('#content').focus();
		_alert($('#content').attr('placeholder'));return ;
	}else{
		if(content.length>max_len){
			_alert('举报内容不能超过500字');return ;
		}else if(content.length<min_len){
			_alert('举报内容不能少于20字');return ;
		}
	}
	var _this=$(this);
	_this.attr('disabled',true);
	var data=$('#form').serialize();
	var url="<?php echo U('ajaxdata');?>"
	$.post(url,data,function(res){
		_alert(res.msg);
		if(res.status==true){
			setTimeout(function(){
				location.href="<?php echo U('result');?>";
			},2000)
		}else{
			_this.attr('disabled',false);
		}
	},'json')
})

function _alert(msg){
	layer.open({
	    content: msg
	    ,skin: 'msg'
	    ,time: 2 //2秒后自动关闭
	  });
}
</script>
</body>
</html>