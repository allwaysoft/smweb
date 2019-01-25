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
<script type="text/javascript" src="<?php echo RES;?>/public/pie-chart/jsapi.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/pie-chart/corechart.js"></script>		
<script type="text/javascript" src="<?php echo RES;?>/public/pie-chart/jquery.gvChart-1.0.1.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/public/pie-chart/jquery.ba-resize.min.js"></script>
<script type="text/javascript">
gvChartInit();
$(document).ready(function(){
	$('#servtotal').gvChart({
		chartType: 'PieChart',
		gvSettings: {
			vAxis: {title: 'No '},
			hAxis: {title: 'Month'}, 
		}
	});
	$('#qualtotal').gvChart({
		chartType: 'PieChart',
		gvSettings: {
			vAxis: {title: 'No '},
			hAxis: {title: 'Month'}, 
		}
	});
	$('#terminaltotal').gvChart({
		chartType: 'PieChart',
		gvSettings: {
			vAxis: {title: 'No '},
			hAxis: {title: 'Month'}, 
		}
	});
});
</script>
<!--  container  -->
 
<div class="container"> 
<div id="msgShow"></div>
  <!-- top ----->
  <div class="row">
    <div class="col-xs-12">
   
      <h1>   <a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fa fa-sort-desc" aria-hidden="true"></i>
        </a> 
        管理首页 
      </h1>
    </div>
  </div>
  <!-- top -----> 
  
  <!-- main ----->
  <div   id="collapseOne" class="row  collapse in" role="tabpanel" aria-labelledby="headingOne">
  <!-- charts 1 -->
    <div class="col-xs-4">
    <h3 class="text-center"><i class="fa fa-eye" aria-hidden="true"></i> 服务投诉（<?php echo ($servtotal); ?>）</h3>
    <table id='servtotal'> 
			<thead>
				<tr>
					<th></th>
					<th>新投诉</th> 
                    <th>处理中</th> 
                     <th>处理完成</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th><?php echo ($servtotal); ?></th>
					<td><?php echo ($servtotal_1); ?></td> 
                    <td><?php echo ($servtotal_2); ?></td> 
                      <td><?php echo ($servtotal_3); ?></td> 
				</tr>
			</tbody>
		</table> 
        <p  class="text-center"> <a href="<?php echo U('service/index');?>"><i class="fa fa-ellipsis-h" aria-hidden="true"></i> 详细信息</a></p> 
    </div>
    <!-- charts 1 -->
    <!-- charts 2 -->
    <div class="col-xs-4">
    <h3 class="text-center"><i class="fa fa-bell-o" aria-hidden="true"></i> 质量投诉（<?php echo ($qualtotal); ?>）</h3>
    <table id='qualtotal'> 
			<thead>
				<tr>
					<th></th>
					<th>新投诉</th> 
                    <th>处理中</th> 
                     <th>处理完成</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th><?php echo ($qualtotal); ?></th>
					<td><?php echo ($qualtotal_1); ?></td> 
                    <td><?php echo ($qualtotal_2); ?></td> 
                      <td><?php echo ($qualtotal_3); ?></td> 
				</tr>
			</tbody>
		</table>  
          <p  class="text-center"> <a href="<?php echo U('service/quality');?>"><i class="fa fa-ellipsis-h" aria-hidden="true"></i> 详细信息</a></p> 
    </div>
    <!-- charts 2 -->
    <!-- charts 3 -->
    <div class="col-xs-4">
    <h3 class="text-center"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> 终端抽检（<?php echo ($terminaltotal); ?>）</h3>
    <table id='terminaltotal'> 
			<thead>
				<tr>
					<th></th>
					<th>新投诉</th> 
                    <th>处理中</th> 
                     <th>处理完成</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th><?php echo ($terminaltotal); ?></th>
					<td><?php echo ($terminaltotal_1); ?></td> 
                    <td><?php echo ($terminaltotal_2); ?></td> 
                      <td><?php echo ($terminaltotal_3); ?></td> 
				</tr>
			</tbody>
		</table>  
          <p  class="text-center"> <a href="<?php echo U('service/terminal');?>"><i class="fa fa-ellipsis-h" aria-hidden="true"></i> 详细信息</a></p> 
    </div>
    
    <div class="col-xs-12"> <hr /> </div>
    <!-- charts 3 -->
  </div>
  
  
  <div class="row">
    <div class="col-xs-12">
   <!--  
    <h3>服务投诉：
    <small>
    新投诉 <span class="text-success"><?php echo ($servtotal_1); ?></span> 条，
    处理中 <span class="text-warning"><?php echo ($servtotal_2); ?></span> 条，
    处理完成 <span class="text-danger"><?php echo ($servtotal_3); ?></span> 条，
    共 <span class="text-primary"><?php echo ($servtotal); ?></span> 条 <a href="<?php echo U('service/quality');?>"><i class="fa fa-ellipsis-h" aria-hidden="true"></i> 详细信息</a>
    </small>
    </h3>
    <h3>质量投诉：
        <small>
    新投诉 <span class="text-success"><?php echo ($qualtotal_1); ?></span> 条，
    处理中 <span class="text-warning"><?php echo ($qualtotal_2); ?></span> 条，
    处理完成 <span class="text-danger"><?php echo ($qualtotal_3); ?></span> 条，
    共 <span class="text-primary"><?php echo ($qualtotal); ?></span> 条  <a href="a"><i class="fa fa-ellipsis-h" aria-hidden="true"></i> 详细信息</a>
    </small>
    </h3>
    <h3>终端抽检：
      <small>
    新投诉 <span class="text-success"><?php echo ($terminaltotal_1); ?></span> 条，
    处理中 <span class="text-warning"><?php echo ($terminaltotal_2); ?></span> 条，
    处理完成 <span class="text-danger"><?php echo ($terminaltotal_3); ?></span> 条，
    共 <span class="text-primary"><?php echo ($terminaltotal); ?></span> 条  <a href="a"><i class="fa fa-ellipsis-h" aria-hidden="true"></i> 详细信息</a>
    </small>
    </h3>
     <h1>数据报表:</h1>-->
    </div>
  </div>
  <!-- main --> 
</div>
<!--  container  --> 
<script type="text/javascript">
 
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