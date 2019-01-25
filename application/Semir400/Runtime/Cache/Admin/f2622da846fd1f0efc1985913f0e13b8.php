<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>400客服管理平台</title>
<meta http-equiv="semir" content="Yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo RES;?>/public/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo RES;?>/public/js/bootstrap-dialog/css/bootstrap-dialog.css" rel="stylesheet">
 <!-- Loading Flat UI -->
   
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.min1.11.3.js"></script>
<!-- Loading Bootstrap -->
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-dialog/bootstrap-dialog.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/jquery.form.js"></script><!-- up file blug -->
<link href="<?php echo RES;?>/public/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo RES;?>/public/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/Admin/css/layout.css"  />
</head>
<body>

<a name="top" id="top"></a> <header>
  <nav class="navbar navbar-inverse  navbar-fixed-top">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <h4><span style="color:#FFF"> <img src="<?php echo RES;?>/admin/images/logow.png" width="120px"  alt="森马"/> 400客服系统</span></h4>  </div>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right"> 
        <li <?php if(CONTROLLER_NAME == 'index'): ?>class='active'<?php endif; ?> ><a href="<?php echo U('index/index');?>">首页</a></li>
         <li class='dropdown <?php if(CONTROLLER_NAME == 'Service'): ?>active<?php endif; ?>' >
         <a href="" class="dropdown-toggle" data-toggle="dropdown">投诉管理 <span class="caret"></span></a>
          <ul class="dropdown-menu">
         		 <li <?php if(ACTION_NAME == 'quality'): ?>class='active'<?php endif; ?>><a href="<?php echo U('service/quality');?>">质量投诉</a></li>
                 <li <?php if(ACTION_NAME == 'index'): ?>class='active'<?php endif; ?>><a href="<?php echo U('service/index');?>">服务投诉</a></li> 
                  <li <?php if(ACTION_NAME == 'terminal'): ?>class='active'<?php endif; ?>><a href="<?php echo U('service/terminal');?>">终端质检</a></li> 
              </ul>
         
         </li>
              <li <?php if(CONTROLLER_NAME == 'User'): ?>class='active'<?php endif; ?>><a href="<?php echo U('user/index');?>">客服管理</a></li>
              <li class="dropdown <?php if(CONTROLLER_NAME == 'System'): ?>active<?php endif; ?>" >
              <a href=""  class="dropdown-toggle" data-toggle="dropdown" >系统设置 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                 <li <?php if(ACTION_NAME == 'subject'): ?>class='active'<?php endif; ?>><a href="<?php echo U('system/subject');?>">投诉主题</a></li>
                  <li <?php if(ACTION_NAME == 'track'): ?>class='active'<?php endif; ?>><a href="<?php echo U('system/track');?>">常用回复</a></li>
                  <li <?php if(ACTION_NAME == 'area'): ?>class='active'<?php endif; ?>><a href="<?php echo U('system/area');?>" >地区管理</a></li> 
              </ul>
              
              </li>
           
         
          <p class="navbar-text">|</p> 
          <li class="dropdown" >
         <a href="" class="dropdown-toggle" data-toggle="dropdown" > <i class="fa fa-user" aria-hidden="true"></i>  <?php echo ($_SESSION['admininfo']['user_name']); ?> / <?php echo ($_SESSION['admininfo']['c_name']); ?>   <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="#" class="cgpw"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 修改密码</a></li>
          	<li><a href="<?php echo U('Login/loginout');?>"><i class="fa fa-lock" aria-hidden="true"></i> 安全退出</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container-fluid --> 
  </nav>
</header>
<script type="text/javascript">
 // JavaScript Document 
$(document).ready(function(){ 
///////////////////////// 
// add and edit gallery end 
	$(".cgpw").click(function() { 
		BootstrapDialog.show({
            title: '修改密码',
			closeByBackdrop: false,
			buttons: [ {
						label: '<span class="glyphicon glyphicon-ok"></span> 提交',
						cssClass: 'btn-primary btn-sm',
						action: function(){
							$('#subForm').submit(); 
						}
					},
					{
						label: 'Close',
						cssClass: ' btn-default btn-sm',
						action: function(dialogItself){
							dialogItself.close();
						}
					}],
            message: $('<div></div>').load("/semir400admin.php/Login/cg_pw") 
        }); 
	});
	////add end
	
/////////////////////////
});
</script>
<!--  container  -->

<div class="container"> 
<div id="msgShow"></div> 
  <!-- main ----->
  <div class="row">
   <!-- left ----->
   <div class="col-xs-2">
   
     <h1>系统设置</h1> 
      <div class="h20"></div>
   <ul class="nav nav-pills nav-stacked" role="tablist"> 
        <li <?php if(ACTION_NAME == 'subject'): ?>class='active'<?php endif; ?>><a href="<?php echo U('system/subject');?>">投诉主题</a></li>
                  <li <?php if(ACTION_NAME == 'track'): ?>class='active'<?php endif; ?>><a href="<?php echo U('system/track');?>">常用回复</a></li>
                  <li <?php if(ACTION_NAME == 'area'): ?>class='active'<?php endif; ?>><a href="<?php echo U('system/area');?>">地区管理</a></li> 
</ul>
   </div>
    <!-- left ----->
    <div class="col-xs-10">
     <div class="topRightBut pull-right">
        <button type="button" name="addBut" class="btn btn-success  btn-sm"><i class="fa fa-commenting-o" aria-hidden="true"></i> 添加常用回复</button>
      </div>
     <h1><i class="fa fa-commenting-o" aria-hidden="true"></i> 常用回复管理</h1>
     <div class="h20"></div>
      <form action="" method=" ">
        <table  id="listTable" class="table table-striped table-bordered "  cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>编号 <span class="sr-only"></span></th>
               <th>类别 <span class="sr-only"></span></th> 
              <th>主题 <span class="sr-only"></span></th> 
              <th>操作<span class="sr-only"></span></th> 
            </tr>
          </thead>
        </table>
      </form>
    </div>
  </div>
  <!-- main --> 
</div>
<!--  container  --> 
<script type="text/javascript">
 // JavaScript Document 
$(document).ready(function(){ 
	 /////load 
 $('#listTable').dataTable().fnDestroy(); 
  $('#listTable').dataTable( { 
				      "processing": true,
				 	  "serverSide": false,
					  "fixedHeader": true,
					   "responsive": true,
					 "ajax":{
						  "url": "/semir400admin.php/System/track_list",
					  },
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "id"},
							{ "data": "type" },
							{ "data": "content" },
							{ "data": null, "order":false}
						],
						"language": {
						 "lengthMenu": "每页 _MENU_ 条记录",
						 "zeroRecords": "没有找到记录",
						 "info": " 记录_MAX_ 条,  第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
						 "infoEmpty": "无记录",
						 "infoFiltered": "(从 _MAX_ 条记录过滤)",
						 "sSearch": "搜索:", 
						 "sEmptyTable": "表中数据为空",
						 "sLoadingRecords": "载入中...",
						 "sInfoThousands": ",",
						 "oPaginate": {
							   "sFirst": "首页",
							   "sPrevious": "上页",
							   "sNext": "下页",
							   "sLast": "末页"
						   }
						},  
					"fnRowCallback":function(nRow,aData,iDataIndex){
						$('td:eq(0)',nRow).addClass("tableDate");
						var html = ""; 
						 html += "<div class='btn-group'><button class='btn btn-info btn-xs'  onclick=_funEdit('"+aData.id+"') type='button' name='_edit'><i class='fa fa-edit' aria-hidden='true'></i> 编辑</button>";
						  $('td:eq(-1)',nRow).html(html); 
						//return nRow;
					},
          		 "deferRender": true
			   });
			   
			   /////////////// 
 
	 
});
///////////////////////// 
// add and edit gallery end 
	$("button[name=addBut]").click(function() { 
		BootstrapDialog.show({
            title: '常用回复管理',
			closeByBackdrop: false,
			buttons: [ {
						label: '<span class="glyphicon glyphicon-ok"></span> 提交',
						cssClass: 'btn-primary btn-sm',
						action: function(){
							$('#subForm').submit(); 
						}
					},
					{
						label: 'Close',
						cssClass: ' btn-default btn-sm',
						action: function(dialogItself){
							dialogItself.close();
						}
					}],
            message: $('<div></div>').load("/semir400admin.php/System/track_add") 
        }); 
	});
	////add end
	
/////////////////////////
// edit
function _funEdit(val) { 
		BootstrapDialog.show({
            title: '常用回复管理',
			closeByBackdrop: false,
			buttons: [ {
						label: '<span class="glyphicon glyphicon-ok"></span> Submit',
						cssClass: 'btn-primary btn-sm',
						action: function(){
							$('#subForm').submit(); 
						}
					},
					{
						label: 'Close',
						cssClass: ' btn-default btn-sm',
						action: function(dialogItself){
							dialogItself.close();
						}
					},
					{
						label: '<i class="fa fa-times" aria-hidden="true"></i> Del',
						cssClass: 'pull-left btn-danger btn-sm',
						action: function(dialogItself){
							_funDel(dialogItself); 
						}
					}],
            message: $('<div></div>').load("/semir400admin.php/System/track_edit/id/"+val) 
        }); 
	};
	////edit end
 // function del
    function _funDel(dialogItself) { 
			BootstrapDialog.confirm('Delect this, are you sure?', function(result){
            if(result) {
				dialogItself.close();
				var id = $('#id').val();
		 		 post_url = "/semir400admin.php/System/track_del_do"; 
                 //  post_url = "{%site_url('admin/homepage/edit')%}"; 
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: 'id='+id,
                    success: function(msg){ 
                        if(msg==0){
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: '操作成功! ',
								message: '稍后正在刷新页面!!' 
							});     
                             
                             setTimeout(function(){
                                 window.location.reload();
                            },1000);
                            //  Alert(msg);
                        }else{
                            BootstrapDialog.show({
								type:"type-danger",
								title: '操作失败!',
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
								title: '操作失败!',
								message: "Please contact us!!",
								closable: false,
								buttons: [{
									label: 'Close',
									action: function(dialog) {
										dialog.close();
										// You can also use BootstrapDialog.closeAll() to close all dialogs.
										
									}
								}]
							});
						
                    }
                });
                return false;
			 } 
			});
		 
	};
	////del end
 
</script>

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
<script src="<?php echo RES;?>/public/js/dataTables/jquery.dataTables.js"></script> 
<script src="<?php echo RES;?>/public/js/dataTables/dataTables.bootstrap.js"></script>  
</body>
</html>