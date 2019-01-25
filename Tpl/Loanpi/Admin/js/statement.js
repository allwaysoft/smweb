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
						  "url": "/loanpiadmin.php/Index/statement_grid",
					  },
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "agent_code"},
							{"data": "pi_id"},
							{ "data": "agent_kpt" },
							{ "data": "date_from" },
							{ "data": "date_to" },
							{ "data": "date_run" },  
							{ "data": null}
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
						if(aData.status == 1){
						  st = "已浏览";
						}else if(aData.reg_status == 2){
							 st = "已打印";
						}else{
							st = "新";
						}
						$('td:eq(-1)',nRow).html(st + "  <a href='/loanpiadmin.php/Index/statement_view/p/"+aData.id+"'  target=\"_blank\"   class='btn btn-info btn-xs'  ><span class='fui-new'></span>浏览</a>");
						//return nRow;
					},
          		 "deferRender": true
			   });
			   
			   /////////////// 
	 /////////////////// load Repayment
	 
	 
});
 
 
 
 