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
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/js/bootstrap-datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link href="<?php echo RES;?>/public/js/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<!--  container  -->

<div class="container"> 
<div id="msgShow"></div>
<div class="row">
    
  <!-- top ----->
    <div class="col-xs-12">
       <h1><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉记录</h1>
      <div class="h20"></div>
      <ul class="nav nav-pills searchTop" role="tablist">
        <li 
        
        <?php if(ACTION_NAME == 'quality'): ?>class='active'<?php endif; ?>
        > <a href="<?php echo U('service/quality');?>"><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉</a>
        </li>
        <li 
        
        <?php if(ACTION_NAME == 'index'): ?>class='active'<?php endif; ?>
        ><a href="<?php echo U('service/index');?>"><span class="glyphicon glyphicon-eye-open"></span> 服务投诉</a>
        </li>
      
        <li 
        
        <?php if(ACTION_NAME == 'terminal'): ?>class='active'<?php endif; ?>
        > <a href="<?php echo U('service/terminal');?>"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> 终端抽检</a>
        </li>
      </ul>
      <hr />
      <form class="form-inline" role="form" name="searcForm" id="searcForm">
        <div class="form-group form-group-sm">
          <label for="agent_area">区域：</label>
          <select name="agent_area" id="agent_area" class="form-control">
            <option value="">全部区域</option>
            <?php if(is_array($arealist)): $i = 0; $__LIST__ = $arealist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["areaname"]); ?>"><?php echo ($vo["areaname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
       
        <div class="form-group form-group-sm">
          <label for="com_type" class=" ">&nbsp;&nbsp;&nbsp;&nbsp;投诉类型：</label>
          <select name="com_type" id="com_type" class="form-control">
            <option value="">全部</option>
            <option value="1">图片鉴定</option>
            <option value="2">实物鉴定</option>  
          </select>
          
        </div>
        <!-- item -->
         <div class="form-group form-group-sm">
          <label for="tra_type" class=" ">&nbsp;&nbsp;&nbsp;&nbsp;鉴定结果：</label>
          <select name="tra_type" id="tra_type" class="form-control">
            <option value="">全部</option>
            <option value="1">拒收/驳回</option>
            <option value="2">启动OA流程</option> 
            <option value="5">投诉处理结束</option>
          </select>
          
        </div>
        <!-- item -->
        <div class="form-group form-group-sm">
        <label for="inputEmail3" class=" ">&nbsp;&nbsp;&nbsp;&nbsp;投诉日期：</label>
          
          <div class="input-group">
               <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="reg_start_time" data-link-format="yyyy-mm-dd">
                 
                  <input type="text" class="form-control" size="12" name="start_time"  id="start_time" placeholder="" value="">
                     <span class="input-group-addon"><span class="glyphicon glyphicon-remove "></span></span> 
                   <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span> 
                  </div>
          </div>
        </div>
        <!-- item -->
         <!-- item -->
        <div class="form-group form-group-sm">
        <label for="inputEmail3" class=" ">~</label>
          
          <div class="input-group">
               <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="reg_start_time" data-link-format="yyyy-mm-dd">
                 
                  <input type="text" class="form-control" size="12" name="end_time"  id="end_time" placeholder="" value="">
                     <span class="input-group-addon"><span class="glyphicon glyphicon-remove "></span></span> 
                   <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span> 
                  </div>
          </div>
        </div>
        <!-- item -->
        <div class="clearfix h20"></div>
        
         <!-- item -->
        <div class="form-group form-group-sm">
        <label for="keyword" class=" ">关键字：</label>
        <input type="text" class="form-control" size="50" name="keyword"  id="keyword" placeholder="如店面名称、联系人、投诉内容" value="">
       
        </div>
        <!-- item -->
        
        <div class="form-group  form-group-sm">
           <button type="button" class="btn btn-info btn-sm" name="search"><i class="fa fa-search" aria-hidden="true"></i> 搜索</button>
          <div class="input-group" style="margin-left:30px;">
          <label >导出区间（默认当月）：</label>
               <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-format="yyyy-mm-dd">
                 
                  <input type="text" class="form-control" size="12" name="e_start_time"  id="e_start_time" placeholder="" value="" onchange="changeEndTime();">
                     <span class="input-group-addon"><span class="glyphicon glyphicon-remove "></span></span> 
                     <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span> 
                  </div>
          </div>
           <label for="inputEmail3" class=" ">~</label>
          <div class="input-group">
               <div class="input-group "" >
                 
                  <input type="text" class="form-control" size="12" name="e_end_time"  id="e_end_time" placeholder="" value=""  readonly="readonly">
                   <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar" ></span></span> 
                  </div>
          </div>
           <button  type="button" class="btn btn-success btn-sm" name="outExcel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> 导出</button>
        </div>
        

      </form>
      <hr />
      <!-- top ----->
      </div>
  <!-- main ----->
  
    <div class="col-xs-12"> 
      <form action="" method=" ">
        <table  id="listTable" class="table table-striped table-bordered "  cellspacing="0" width="100%">
          <thead>
            <tr>
               <th>投诉编号 <span class="sr-only"></span></th>
              <th>代理商账号 <span class="sr-only"></span></th>
              <th>区域 <span class="sr-only"></span></th>
              <th>联系人 <span class="sr-only"></span></th>
               <th>类型 <span class="sr-only"></span></th>
               <th>款号 <span class="sr-only"></span></th>
              <th>时间<span class="sr-only"></span></th>
              <th>状态<span class="sr-only"></span></th>
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
	  $('.form_date').datetimepicker({
        language: 'zh-CN',
		 pickerPosition: "bottom-left",
        weekStart: 1,
        todayBtn: 1,
		  autoclose: 1,
		  todayHighlight: 1,
		  startView: 2,
		  minView: 2,
		  forceParse: 0
    });
	 /////load 
			   
			   /////////////// 

  $("button[name='search']").click(function() { 
 $('#listTable').dataTable().fnDestroy(); 
 var table = $('#listTable').dataTable( { 
				      "processing": true,
				 	  "serverSide": false,
					  "fixedHeader": true,
					   "responsive": true,
					 "ajax":{
						  "url": "/semir400admin.php/Service/quality_get_list/source/quality",
					  },
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "com_code"},
							{ "data": "agent_code" },
							{ "data": "agent_area" },
							{ "data": "agent_person" },
							{ "data": "com_type" },
							{ "data": "style_id" },
							{ "data": "add_time" },
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
						//$('td:eq(0)',nRow).addClass("tableDate");
						var html = "";
						 
						 html +="<a class='btn btn-success btn-xs'  onclick=_getinfo('"+aData.id+"')><i class='fa fa-flash' aria-hidden='true'></i> 详情</a>";
						 
							$('td:eq(-1)',nRow).html(html); 
						//return nRow;
					},
          		 "deferRender": true,
				  // reload 带搜索参数
				 "fnServerParams" : function (aoData) {
                    aoData.push(
                        {  "name": "agent_area", "value": $("#agent_area").val()}
                    ); 
					 aoData.push(
                        {  "name": "tra_type", "value": $("#tra_type").val()}
                    );
					 aoData.push(
                        {  "name": "start_time", "value": $("#start_time").val()}
                    );
					 aoData.push(
                        {  "name": "end_time", "value": $("#end_time").val()}
                    ); 
					 aoData.push(
                        {  "name": "keyword", "value": $("#keyword").val()}
                    ); 
					 aoData.push(
                        {  "name": "com_type", "value": $("#com_type").val()}
                    ); 
                },
			   });
 	// table.fnDraw();
//  	  table.api().ajax.reload();
 	 //table.fnReloadAjax();
   });
	 /////////////// 
  $("button[name='outExcel']").click(function() { 
  		var post_data = $("#searcForm").serialize();  
 	    window.location.href = "<?php echo U('service/quality_excel');?>?"+post_data; //转到另一页面
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
            message: $('<div></div>').load("/semir400admin.php/Service/qualityinfo/id/"+id) 
        });
	};
 //	 
function changeEndTime(){
  var  e_stime = $('#e_start_time').val();
  var r = new RegExp('-','gi');
   if(e_stime=='' || e_stime.match(r).length != 2){
	   $('#e_end_time').val('');
	   alert("请输入正确的时间，否则只导出最近一个月的记录。");
   }
   else{
	  var date_str = e_stime.split('-');	 
       mon = 1  + parseInt(date_str[1]);
	  if(mon < 10){
	     $('#e_end_time').val(date_str[0] + '-0' + mon + '-' + date_str[2]);	 
	  }
	  else if(mon > 12){
		  mon = mon -12;
		  date_str[0] = parseInt(date_str[0])+1;
		  $('#e_end_time').val(date_str[0] + '-' + mon + '-' + date_str[2]);	 
	  }else		  
		  $('#e_end_time').val(date_str[0] + '-' + mon + '-' + date_str[2]);	 
		  
   }
 }
 
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