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
          <li 
          <?php if((CONTROLLER_NAME == 'Staff') and (ACTION_NAME == 'quality')): ?>class='active'<?php endif; ?>
          ><a href="<?php echo U('staff/quality');?>" ><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉</a>
          </li>
          
          <li 
          <?php if((CONTROLLER_NAME == 'Staff') and (ACTION_NAME == 'service')): ?>class='active'<?php endif; ?>
          ><a href="<?php echo U('staff/service');?>" ><span class="glyphicon glyphicon-eye-open"></span> 服务投诉</a>
          </li>
          
          <li 
          <?php if((CONTROLLER_NAME == 'Staff') and (ACTION_NAME == 'terminal')): ?>class='active'<?php endif; ?>
          ><a href="<?php echo U('terminal');?>" ><i class="fa fa-lightbulb-o" aria-hidden="true"></i> 终端抽检</a>
          </li>
           <p class="navbar-text">|</p> 
           <li 
          <?php if(CONTROLLER_NAME == 'Staffser'): ?>class='active'<?php endif; ?>
          ><a href="<?php echo U('staffser/quality');?>" > <i class="fa fa-search" aria-hidden="true"></i> 数据查询</a>
          </li>
         
          <p class="navbar-text">|</p> 
          <li class="dropdown" >
         <a href="" class="dropdown-toggle" data-toggle="dropdown" > <i class="fa fa-user" aria-hidden="true"></i>  <?php echo ($_SESSION['staffinfo']['user_name']); ?> / <?php echo ($_SESSION['staffinfo']['c_name']); ?>   <span class="caret"></span></a>
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
            message: $('<div></div>').load("/semir400admin.php/Login/cg_spw") 
        }); 
	});
	////add end
	
/////////////////////////
});
</script>
 
<!--  container  -->

<div class="container"> 
<div id="msgShow"></div>
<div class="row">
    
  <!-- top ----->
    <div class="col-xs-12">
       <h1><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉记录</h1>
      <div class="h20"></div>
       <div class="col-xs-4">
      <ul class="nav nav-pills searchTop" role="tablist">
        <li 
        
        <?php if(ACTION_NAME == 'quality'): ?>class='active'<?php endif; ?>
        > <a href="<?php echo U('staffser/quality');?>"><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉</a>
        </li>
        <li 
        
        <?php if(ACTION_NAME == 'index'): ?>class='active'<?php endif; ?>
        ><a href="<?php echo U('staffser/index');?>"><span class="glyphicon glyphicon-eye-open"></span> 服务投诉</a>
        </li>
      
        <li 
        
        <?php if(ACTION_NAME == 'terminal'): ?>class='active'<?php endif; ?>
        > <a href="<?php echo U('staffser/terminal');?>"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> 终端抽检</a>
        </li>
      </ul>
     </div>
     <div class="col-xs-8">
      <form class="form-inline" role="form" name="searcForm" id="searcForm">
        
       
        <!-- item -->
      
        <!-- item -->
        
        <!-- item -->
        
        <!-- item --> 
        
         <!-- item -->
        <div class="form-group form-group-sm">
        <label for="keyword" class=" ">关键字：</label>
        <input type="text" class="form-control" size="50" name="keyword"  id="keyword" placeholder="如店面名称、联系人、投诉内容" value="如店面名称、联系人、投诉内容">
       
        </div>
        <!-- item -->
        
        <div class="form-group  form-group-sm">
           <button type="button" class="btn btn-info btn-sm" name="search"><i class="fa fa-search" aria-hidden="true"></i> 搜索</button> 
        </div>
        

      </form>
      </div>
    
      <!-- top ----->
      </div>
  <!-- main ----->
   <div class="col-xs-12">  <hr /></div>
    <div class="col-xs-12"> 
      <form action="" method=" ">
        <table  id="listTable" class="table table-striped table-bordered "  cellspacing="0" width="100%">
          <thead>
            <tr>
               <th>时间<span class="sr-only"></span></th>
               <th>投诉编号 <span class="sr-only"></span></th>
                <th>款号 <span class="sr-only"></span></th>
              <th>店铺名称 <span class="sr-only"></span></th>
              <th>问题类型 <span class="sr-only"></span></th>
			  <th>数量<span class="sr-only"></span></th>
			  <th>销售状态<span class="sr-only"></span></th>
              <th>投诉内容 <span class="sr-only"></span></th>
               <th>服务结果 <span class="sr-only"></span></th>
              <th>处理状态 <span class="sr-only"></span></th>
               
               <th>客服<span class="sr-only"></span></th>
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
   ////////////////////
	 
	 /////load 
 $('#listTable').dataTable().fnDestroy(); 
 var table = $('#listTable').dataTable( { 
				      "processing": true,
				 	  "serverSide": false,
					  "fixedHeader": true,
					   "responsive": true,
					 "ajax":{
						  "url": "/semir400admin.php/Staffser/quality_get_list/source/quality",
					  },
					"pageLength": 10, //首次加载的数据条数
					 // "lengthMenu": [[50, 100, -1],[50, 100, "All"]],
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{ "data": "add_time" },
							{"data": "com_code"},
							{ "data": "style_id" },
							{ "data": "agent_storename" },
							{ "data": "com_type" }, 
							{ "data": "number" },
							{ "data": "sale_type" },							
							{ "data": "com_contents" },
							{ "data": "tra_type" }, 
							{ "data": "com_status" }, 
							{ "data": "com_user" }, 
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
						 
						 html +="<a class='btn btn-success btn-xs'  onclick=_getinfo('"+aData.id+"')><i class='fa fa-flash' aria-hidden='true'></i> 详细</a>";
						 
							$('td:eq(-1)',nRow).html(html); 
						//return nRow;
					},
          		 "deferRender": true,
				  // reload 带搜索参数
				 "fnServerParams" : function (aoData) {
                    
					 aoData.push(
                        {  "name": "keyword", "value": $("#keyword").val()}
                    ); 
                },
			   });
			   
			   /////////////// 

  $("button[name='search']").click(function() { 
 	// table.fnDraw();
 	  table.api().ajax.reload();
 	 //table.fnReloadAjax();
   });
  
  $("#keyword").click(function(){
	  $(this).val('');
  });
	   /////////////// 
});
/////////////////////////
 
 //	
  /////edit  
	function _getinfo(id){  
		BootstrapDialog.show({
			size: BootstrapDialog.SIZE_WIDE,
            title: '投诉详情',
			closeByBackdrop: false,
			buttons: [  
					{
						label: '关闭',
						cssClass: ' btn-default btn-sm',
						action: function(dialogItself){
							dialogItself.close();
						}
					}],
            message: $('<div></div>').load("/semir400admin.php/Staffser/qualityinfo/id/"+id) 
        });
	};
 //	 
 
 
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