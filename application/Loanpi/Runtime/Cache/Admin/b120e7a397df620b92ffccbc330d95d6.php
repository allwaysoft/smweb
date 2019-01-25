<?php if (!defined('THINK_PATH')) exit();?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>后台管理--代理商贷款</title>
<meta http-equiv="semir" content="Yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/<?php echo c('VIEW_PATH');?>Loanpi/public/css/bootstrap.css" rel="stylesheet">
<link href="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-dialog/css/bootstrap-dialog.css" rel="stylesheet">
 <!-- Loading Flat UI -->
   
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/jquery.min1.11.3.js"></script>
<!-- Loading Bootstrap -->
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-dialog/bootstrap-dialog.min.js"></script>

<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="/<?php echo c('VIEW_PATH');?>Loanpi/public/jquery.form.js"></script><!-- up file blug -->
<link href="/<?php echo c('VIEW_PATH');?>Loanpi/public/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" type="text/css" href="/<?php echo c('VIEW_PATH');?>Loanpi/Admin/css/layout.css"  />
</head>
<body>

<a name="top" id="top"></a> <header>
  <nav class="navbar navbar-inverse  navbar-fixed-top">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="#"><span style="color:#FFF">代理商贷款管理</span> <!--<img src="/<?php echo c('VIEW_PATH');?>Loanpi/Layout/images/logow.png" width="120px"  alt="森马"/>--></a> </div>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav ">
          
          <li 
          <?php if($url == 'register'): ?>class='active'<?php endif; ?>
          ><a href="<?php echo U('Index/register');?>" >贷款管理</a>
          </li>
          <li class="  <?php if($url == 'repayment'): ?>active<?php endif; ?>
            " > <a href="<?php echo U('Index/repayment');?>" >还款记录 </a>
          </li>
             <li class=" dropdown <?php if($url == 'statement'): ?>active<?php endif; ?>
            " > <a href="#" class="dropdown-toggle" data-toggle="dropdown" >对账函 <span class="caret"></span></a>
             <ul  class="dropdown-menu" role="menu">
              <li><a href="<?php echo U('Index/statement');?>">对账函列表</a></li>
              <li><a href="<?php echo U('Index/statement_log');?>">对账日志</a></li>
            </ul>
          </li>
          <li 
          <?php if($url == 'log'): ?>class='active'<?php endif; ?>
          ><a href="<?php echo U('Weblog/index');?>">日志管理</a>
          </li> 
           <li  <?php if($url == 'user'): ?>class='active'<?php endif; ?>
          ><a href="<?php echo U('User/index');?>"> 用户管理</a>
          </li> 
          <p class="navbar-text">|</p>
           <p class="navbar-text"><i class="fa fa-user" aria-hidden="true"></i> <!-- {$thisUser['user_name']}--> <?php echo ($adminUser['user_name']); ?> / <?php echo ($adminUser['c_name']); ?></p>
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

<!--  container  -->

<div class="container"> 
  <!-- top ----->
  <div class="row">
    <div class="col-xs-12">
       <h1><i class="fa fa-info-circle" aria-hidden="true"></i> 对账日志 <small>> 对账函详细</small></h1>
    </div>
  </div>
  <!-- top ----->
  <div class="h20"></div>
  <!-- main ----->
  <div class="row">
    <div class="col-xs-12">
      <form action="" method=" ">
        <table  id="listTable" class="table table-striped table-bordered "  cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>对账函编号 <span class="sr-only">对账函编号</span></th>
              <th>代理商编号<span class="sr-only">操作者</span></th>
              <th>开票方编号<span class="sr-only">操作</span></th>
              <th>开票主体名称<span class="sr-only">状态</span></th>  
              <th>开始日期</th>   
             <th>应收-应收</th>  
              <th>应收-预收</th> 
               <th>贷款-应收</th> 
                <th>贷款-预收</th> 
                 <th>其他-应收</th> 
                  <th>其他-预收</th> 
                  <th>--</th> 
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
						  "url": "/loanpiadmin.php/Index/statement_log_row_list/id/<?php echo ($id); ?>",
					  },
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "ID"},
							{"data": "AGENT_CODE"},
							{"data": "AGENT_KPF"},
							{"data": "NAME1"},
							{"data": "DATE_FROM"},
							{"data": "ARAR"},
							{"data": "ARCR"},
							{"data": "DKAR"},
							{"data": "DKCR"},
							{"data": "OTAP"},
							{"data": "OTCR"},
							{"data": null} 
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
						var aToStr=JSON.stringify(aData); 
						$('td:eq(0)',nRow).addClass("");
						if(aData.status ==1){
						    $('td:eq(-1)',nRow).html("推送成功");
						}else{
							$('td:eq(-1)',nRow).html("<button class='btn btn-info btn-xs'  onclick=_viewMapp('"+aToStr+"') type='button' name='viewMapp'><span class='fui-new'></span>推送</button>");
						}
						//return nRow;
					},
          		 "deferRender": true
			   });
			   
			   ///////////////
	  
	// add and edit gallery end
	 
	//  //////////////////////////////////
	 
});
/////////////////////////
 /////edit  
 function _viewMapp(val){  
	  var post_data = JSON.parse(val);  
		 		var post_url; 
                 post_url = "/loanpiadmin.php/index/UpStatementToLocalDo";  
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: post_data,
                    success: function(msg){ 
                        if(msg==0){
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: '操作成功 ',
								message: '正在刷新页面，请稍后!!' 
							});     
                             
                             setTimeout(function(){
                                 window.location.reload();
                            },1000);
                            //  Alert(msg);
                        }else{
                            BootstrapDialog.show({
								type:"type-danger",
								title: '操作错误',
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
								title: '操作错误',
								message: "请联系开发人员！！",
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
	};
 //	
/////////////////////////
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
<script src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/jquery.dataTables.js"></script> 
<script src="/<?php echo c('VIEW_PATH');?>Loanpi/public/js/dataTables/dataTables.bootstrap.js"></script>  
</body>
</html>