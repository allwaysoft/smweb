<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>森马--400客服平台</title>
<meta http-equiv="semir" content="Yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo RES;?>/public/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo RES;?>/public/js/bootstrap-dialog/css/bootstrap-dialog.css" rel="stylesheet">
 <!-- Loading Flat UI -->
   
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.min1.11.3.js"></script> 

<!-- Loading Bootstrap -->
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-dialog/bootstrap-dialog.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-validator/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.form.js"></script><!-- up file blug -->
<link href="<?php echo RES;?>/public/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/public/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/Index/css/layout.css"  />
</head>
<body>

<a name="top" id="top"></a> <header>
  <nav class="navbar navbar-inverse  navbar-fixed-top">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="#"><img src="/<?php echo c('VIEW_PATH');?>Semir400/Index/images/logow.png" width="120px"  alt="Semir400"/></a> </div>      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav pull-right">
            <li <?php if(ACTION_NAME == 'index'): ?>class='active'<?php endif; ?>><a href="<?php echo U('Index/index');?>"><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉</a></li>
              <li <?php if(ACTION_NAME == 'service'): ?>class='active'<?php endif; ?>><a href="<?php echo U('Index/service');?>" ><span class="glyphicon glyphicon-eye-open"></span> 服务投诉</a></li> 
              <li  <?php if(ACTION_NAME == 'sampling'): ?>class='active'<?php endif; ?> ><a href="<?php echo U('Index/sampling');?>"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> 终端抽检</a></li>
           
          </li>
          <p class="navbar-text">|</p>
           <p class="navbar-text"><i class="fa fa-user" aria-hidden="true"></i> <!-- {$thisUser['user_name']}--> <?php echo ($thisUser['name']); ?></p>
          <li >
          <a href="<?php echo U('Login/loginout');?>"><i class="fa fa-lock" aria-hidden="true"></i> 安全退出</a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container-fluid --> 
  </nav>
</header>

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
		    	agent_area: {
		               message: '请选择区域',
		               validators: {
							notEmpty: {
		                       message:  '请选择区域'
		                   }
		               }
		           },
				   agent_storename: {
		               message: '请输入店铺名称',
		               validators: {
							notEmpty: {
		                       message:  '请输入店铺名称'
		                   }
		               }
		           },
		           agent_tel: {
		               message: '请输入联系方式',
		               validators: {
							notEmpty: {
		                       message:  '请输入联系方式'
		                   },
		                  /* stringLength: {
		                        min: 11,
		                        max: 11,
		                        message: '请输入11位手机号码'
		                    },
		                    regexp: {
		                        regexp: /^1[[0-9]{1}[0-9]{9}$/,
		                        message: '请输入正确的手机号码'
		                    }*/
		               }
		           },
		           agent_person: {
		               message: '请输入联系人',
		               validators: {
							notEmpty: {
		                       message:  '请输入联系人'
		                   }
		               }
		           },
		           style_id: {
		               message: '请输入款号',
		               validators: {
							notEmpty: {
		                       message:  '请输入款号'
		                   },
		                   stringLength: {
		                        min: 11,
		                        max: 11,
		                        message: '请输入11位款号'
		                    }
							/*,
		                    regexp: {
		                        regexp: /^1[[0-9]{1}[0-9]{9}$/,
		                        message: '请输入正确的产品款号'
		                    }*/
		               }
		           },
		           'color_id[]': {
		               validators: {
				   		    choice: {//check控件选择的数量  
				                min: 1,  
				                max: 4,  
				                message: '请选择1-4个色号'  
				            }  
		               }
		           },
		           number: {
		               message: '请输入次品数量',
		               validators: {
							notEmpty: {
		                       message:  '请输入次品数量'
		                   },
		                   
		                   regexp:{
		                	   regexp:/^\+?[1-9][0-9]*$/ ,
		                	   message:'请输入数值'
		                   }
		               }
		           }, 
		    	/*sale_time: {
		            message: '正确的时间格式：YYYY-MM-DD',
		            validators: {
						notEmpty: {
		                    message:  '正确的时间格式：YYYY-MM-DD'
		                },
		                date: {
		                    format: 'YYYY-MM-DD'
		                }
		            }
		        },
*/		        sale_type: {
		               message: '请选择销售类型',
		               validators: {
							notEmpty: {
		                       message:  '请选择销售类型'
		                   }
		               }
		           },
		           com_type: {
		               message: '请选择投诉类别',
		               validators: {
							notEmpty: {
		                       message:  '请选择投诉类别'
		                   }
		               }
		           },
		           com_contents: {
		               message: '请输入问题描述',
		               validators: {
							notEmpty: {
		                       message:  '请输入问题描述'
		                   }
		               }
		           },
		           com_pic1: {
		               message: '请选择图片上传！',
		               validators: {
							notEmpty: {
		                       message:  '请选择图片上传！'
		                   }
		               }
		           },	
		           com_pic2: {
		               message: '请选择图片上传！',
		               validators: {
							notEmpty: {
		                       message:  '请选择图片上传！'
		                   }
		               }
		           },
		           com_pic3: {
		               message: '请选择图片上传！',
		               validators: {
							notEmpty: {
		                       message:  '请选择图片上传！'
		                   }
		               }
		           },	
		           com_pic4: {
		               message: '请选择图片上传！',
		               validators: {
							notEmpty: {
		                       message:  '请选择图片上传！'
		                   }
		               }
		           },
		           com_express: {
		               message: '请输入快递公司',
		               validators: {
							notEmpty: {
		                       message:  '请输入快递公司'
		                   }
		               }
		           },	
		           com_express_number: {
		               message: '请输入快递单号',
		               validators: {
							notEmpty: {
		                       message:  '请输入快递单号'
		                   }
		               }
		           },	
		           com_express_address: {
		               message: '请输入快递回寄地址',
		               validators: {
							notEmpty: {
		                       message:  '请输入快递回寄地址'
		                   }
		               }
		           },					   
			}
		}).on('success.form.bv', function(e) {
 
		});
	
	$('#style_id').change(function(){
		styleid = $(this).val();
        $.ajax({
            type: "POST",
            url: "fetch_colorcode",
		   data:'style_id='+styleid,
            success:function(msg){
            	$('#colorarea').html(msg);
            	 $("#subForm").bootstrapValidator('addField','color_id[]');
            },
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			}	   
        });
	})
	
	$('#sale_type').change(function(){
		var bootstrapValidator = $('#subForm').data('bootstrapValidator');
		if($(this).val()==1){
			 $("#salenote").show();
			 $("input").attr("disabled","disable");
			 $("textarea").attr("disabled","disable");
			 $("select").attr("disabled","disable");
			$('#sale_type').removeAttr("disabled");
			 $("button[type='submit']").attr("disabled","disable");  
		}else if($(this).val()==0){
			 $("#salenote").hide();
			 $("input").removeAttr("disabled");
			 $("textarea").removeAttr("disabled");
			 $("select").removeAttr("disabled");
			 $("button[type='submit']").removeAttr("disabled");
		}
	})
	
	$('#com_type').change(function(){
		var bootstrapValidator = $('#subForm').data('bootstrapValidator');
		if($(this).val()==2){
			$('#pic').hide();
			$('#expressinfo').show();

		}else if($(this).val()==1){
			$('#pic').show();
			$('#expressinfo').hide();
	 
		}else if($(this).val()==''){
			$('#pic').hide();
			$('#expressinfo').hide();
		}
	})
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
	///
	
	if($('#com_type').val() == 1 ){
		$("input[class='file']").val('');
		
		$('#pic').show();
		$('#expressinfo').hide();
	};
	if($('#com_type').val() == 2 ){ 
		$('#pic').hide();
		$('#expressinfo').show();
	};
	
	 $("input[class='file']").fileinput({
		  language: 'zh',
        //  uploadUrl: "./list.json", //上传的地址(访问接口地址)
         allowedFileTypes : [ 'image' ],
		 allowedFileExtensions: ['jpg', 'png', 'gif'],
		 uploadAsync: false, //默认异步上传
		 showUpload: false, //是否显示上传按钮
		 showRemove : true, //显示移除按钮
		 showPreview : true, //是否显示预览
		 showCaption: false,//是否显示标题
		 browseClass: "btn btn-xs btn-primary", //按钮样式  
		 dropZoneEnabled: false,//是否显示拖拽区域
		 /* minImageWidth: 50, //图片的最小宽度
		  minImageHeight: 50,//图片的最小高度
		  maxImageWidth: 1000,//图片的最大宽度
		  maxImageHeight: 1000,//图片的最大高度*/
		 //maxFileSize: 0,//单位为kb，如果为0表示不限制文件大小
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 0,
		enctype: 'multipart/form-data',
		 validateInitialCount:true,
		 previewFileIcon: "<i class='glyphicon glyphicon-king'></i>", 
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
})

</script>
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link href="<?php echo RES;?>/public/js/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="<?php echo RES;?>/public/fileinput-master/js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/public/fileinput-master/js/locales/zh.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/public/fileinput-master/css/fileinput.css?<?php echo time();?>" />
  <style> 
.text-danger{
	margin:0; 
	padding: 10px 10px 10px 20px;
	font-size:12px;
	border:1px solid #ECECEC;
}
.text-danger li{
	padding-bottom:10px; 
}
</style>
 
<div class="container">
  <div id="msgShow"></div>
  <!-- top ----->
  <div class="row">
    <div class="col-xs-12">
      <div class="topRightBut pull-right"> <a href="<?php echo U('Index/quality');?>" class=" "><i class="fa fa-mail-reply" aria-hidden="true"></i> 返回</a> </div>
      <h1><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉 <small> >> 质量投诉申请</small></h1>
    </div>
  </div>
  <!-- top ----->
  <div class="h20"></div>
  <!-- main ----->
  <div class="row">
    <div class="col-sm-12">
	
      <form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="<?php echo U('index/qualityrefer');?>" role="form">
        <div class="my-form form-horizontal"> 
          <!-- modal body start --> 
          <!--item -->
          <div class="form-group ">
            <label class="col-sm-1 control-label" for="com_code">投诉编号</label>
            <div class="col-sm-2 ">
              <p class="form-control-static rightFont"><?php echo ($ComplaintNo); ?></p>
              <input type="hidden"  name="com_code" value="<?php echo ($ComplaintNo); ?>"/>
            </div>
            <label class="col-sm-1 control-label" for="deptname">组织名称</label>
            <div class="col-sm-4">
              <p class="form-control-static rightFont"> <?php echo ($thisUser["province"]); ?>/<?php echo ($thisUser["deptname"]); ?> </p>
              <input type="hidden"  name="agent_province" value="<?php echo ($thisUser["province"]); ?>"/>
              <input type="hidden"  name="agent_name" value="<?php echo ($thisUser["deptname"]); ?>"/>
            </div>
          </div>
          <!--item -->
          <div class="form-group ">
            <label class="col-sm-1 control-label" for="agent_area">区域</label>
            <div class="col-sm-2">
<!--               <select name="agent_area" id="agent_area" class="form-control"> -->
<!--                 <option value="">请选择区域</option> -->
<!--                 <?php if(is_array($arealist)): $i = 0; $__LIST__ = $arealist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
<!--                   <option value="<?php echo ($vo["areaname"]); ?>"><?php echo ($vo["areaname"]); ?></option> -->
<!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
<!--               </select> -->
				      <input type="text" class="form-control" name="agent_area"  id="agent_area" placeholder="请输入区域" value="<?php echo ($thisUser["area2"]); ?>">
            </div>
            <label class="col-sm-1 control-label" for="agent_storename">店铺名称</label>
               <div class="col-sm-3">
                <select name="agent_storename" id="agent_storename" class="form-control">
                  <option value="">请选择</option>
                  <?php if(sizeof($storelist) == 1 ): if(is_array($storelist)): foreach($storelist as $key=>$vo): ?><option value="<?php echo ($key); ?>" selected><?php echo ($vo); ?></option><?php endforeach; endif; ?>
				    <?php else: ?> 
		                <?php if(is_array($storelist)): foreach($storelist as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; endif; ?>
	               </select>
              </div>
              </div>
<!--             <div class="col-sm-4"> -->
<!--               <input type="text" class="form-control" name="agent_storename"  id="agent_storename" placeholder="请输入店铺名称" value=""> -->
<!--               <input type="text" class="form-control" name="agent_storename"  id="agent_storename" placeholder="请输入店铺名称" value="<?php echo ($storename); ?>"> -->
<!--             </div> -->
<!--           </div> -->
          <!--item -->
          <div class="form-group ">
            <label class="col-sm-1 control-label" for="agent_tel">联系电话</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="agent_tel"  id="agent_tel" placeholder="请输入联系电话" value="">
            </div>
            <label class="col-sm-1 control-label" for="agent_person">联系人</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="agent_person"  id="agent_person" placeholder="请输入联系人" value="">
            </div>
          </div>
          <!--item -->
          <div id="inputVal"> 
            <!--item -->
            <div class="form-group ">
              <label class="col-sm-1 control-label" for="style_id">款号</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="style_id"  id="style_id" placeholder="请输入款号" value="">
              </div>
              <label class="col-sm-1 control-label" for="number">次品数量</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="number"  id="number" placeholder="请输入抽检数量" value="">
            </div>
            </div>
            <div class="form-group">
              <label class="col-sm-1 control-label" for="color_id">色号</label>
              <div id='colorarea' style="float:left;margin-left: 14px;padding-top:7px;">

              </div>   
            </div>
            <!--item -->
            <div class="form-group ">
              <label class="col-sm-1 control-label" for="sale_time">购买时间</label>
              <div class="col-sm-3">
                <div class="input-group date form_date"> <span class="input-group-addon"><a href="javascript:;" ><span class="glyphicon glyphicon-calendar"></span></a></span>
                  <input type="text" class="form-control" name="sale_time"  id="sale_time" placeholder="投诉日期" value="<?php echo (date("Y-m-d",$nowtime)); ?>
                  " readonly="readonly"> </div>
              </div>
              <label class="col-sm-1 control-label" for="sale_type">销售类型</label>
              <div class="col-sm-2">
                <select name="sale_type" id="sale_type" class="form-control">
                  <option value="">请选择</option>
                  <option value="0">未销售</option>
                  <option value="1">已销售</option>
                </select>
              </div>
			  <div class="col-sm-5"  id="salenote" style="display:none;">
                    <ul class="text-danger" >
                      <li>消费者购买的产品，没过季产品，在质保期内（服装三个月，鞋、配一个月）门店可直接退换货，无须反馈商务网。</li>
                      <li>店铺在退次时须填写次品回执单并附上购物小票，回执单填写要求：具体店铺名称、编号、货品款号、颜色、规格、次 品原因、标注疵点部位、缺一不可，不然次品仓会给予退回。</li>
                    </ul>
              </div>
            </div>
            <!--item -->
            <div class="form-group ">
              <label class="col-sm-1 control-label" for="com_type">投诉类别</label>
              <div class="col-sm-4">
                <select name="com_type" id="com_type" class="form-control">
                  <option value="">请选择</option>
                  <option value="1">照片鉴定</option>
                  <option value="2">实物鉴定</option>
                </select>
              </div>
            </div>
            <div class="form-group " id="pic" style="display:none">
             <div class="col-sm-11 col-sm-offset-1"> 
                  <ul class="text-danger" style="">
                    <li>褪色问题鉴定需要描述清楚是正常穿着褪色，还是洗涤后褪色。</li>
                    <li>未销售的货品要描述清楚是开包发现的，还是陈列过程中发现的。</li>
                    <li> 缩水的货品，要将同款同码的两个货品叠放一起拍对比图（全图、局部图、尺码等），描述清楚正常穿着缩水还是洗涤后缩水。</li>
                    <li>钻绒问题，如衣服钻出来的羽绒有粘到内搭衣服上，请将内搭衣服上羽绒的图片拍出来。</li>
                  </ul> 
              </div>
              <label class="col-sm-1 control-label" for="com_pic">上传照片</label>
              <div class="col-sm-11">
               <div class="row">
                  <div class="col-sm-3">
                   <label class="control-label" for="com_pic1">衣服整体图</label>
                  <input id="com_pic" name="com_pic1" class="file" type="file"   data-min-file-count="0">
                 </div>
                 <div class="col-sm-3">
                   <label class="control-label" for="com_pic2">衣服局部图</label>
                  <input id="com_pic2" name="com_pic2" class="file" type="file"   data-min-file-count="0">
                 </div>
                 <div class="col-sm-3">
                   <label class="control-label" for="com_pic3">洗水唛正面</label>
                  <input id="com_pic3" name="com_pic3" class="file" type="file"   data-min-file-count="0">
                 </div>
                 <div class="col-sm-3">
                   <label class="control-label" for="com_pic4">洗水唛反面</label>
                  <input id="com_pic4" name="com_pic4" class="file" type="file"   data-min-file-count="0">
                 </div>
                 </div>
              </div>
             
            </div>
            <!--item -->
            <div id="expressinfo" style="display:none;">
              <div class="form-group ">
                <label class="col-sm-1 control-label" for="com_express">快递公司</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="com_express"  id="com_express" placeholder="请输入快递公司" value="">
                </div>
                <div class="col-sm-5">
                  <div  style="position:absolute;">
                    <ul class="text-danger" style="">
                      <li>实物鉴定除通过照片无法鉴定的质量问题（如异味）或与售后客服沟通后需邮寄实物的质量投诉，其他情况一律不接受直接邮寄实物的质量投诉，如店铺未按要求直接邮寄实物鉴定，造成的一切后果将由店铺自行承担。如有疑问，请致电4008877588售后客服。</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="form-group ">
                <label class="col-sm-1 control-label" for="com_express_number">快递单号</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="com_express_number"  id="com_express_number" placeholder="请输入快递单号" value="">
                </div>
                <div class="col-sm-5"> <span class="rightMsg" id="color_id"></span> </div>
              </div>
              <div class="form-group ">
                <label class="col-sm-1 control-label" for="com_express_address">回寄地址</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="com_express_address"  id="com_express_address" placeholder="请输入快递回寄地址" value="">
                </div>
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-1 control-label" for="com_contents">问题描述</label>
              <div class="col-sm-4">
                <textarea class="form-control" name="com_contents"  id="com_contents" placeholder="请输入问题描述"></textarea>
              </div>
              <div class="col-sm-5"> <span class="rightMsg" id="com_contents"> </span> </div>
            </div>
          </div>
          
          <!--item -->
          <div class="form-group ">
            <label class="col-sm-1 control-label" for=""></label>
            <div class="col-sm-4">
              <button  class="btn btn-success btn-sm" type="submit"> <span class='glyphicon glyphicon-ok-circle'></span> 提交投诉申请 </button>
            </div>
          </div>
          <!--item --> 
        </div>
      </form>
    </div>
  </div>
</div>
 <!-- footer -->
   <div class="h20"></div>
<footer>
 <div class="container">
  <div class="row  footer" > 
    <!-- main  -->
    <div class="col-xs-12 "> 
     <p class="" >  
    
 	  商品售后服务热线：400-8877-588 ,  技术支持专线：0577-85789999<br />
      All Rights Reserved &copy;  <?php echo date('Y');?> 森马</p>
    </div>
     
    </div>
 </div>
</footer>
<!-- footer -->
<script src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/jquery.dataTables.js"></script> 
<script src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/dataTables.bootstrap.js"></script>  
</body>
</html>