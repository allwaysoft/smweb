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
						  "url": "/loanpi.php/History/reg_list",
					  },
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "reg_date"},
							{ "data": "reg_cycle" },
							{ "data": "reg_amount" },
							{ "data": "reg_start_time" },
							{ "data": "reg_status_msg" }, 
							{ "data": "sap_code"},
							{ "data": "sap_cycle"},
							{ "data": "sap_start_time"},
							{ "data": "sap_end_time"},
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
						if(aData.reg_status == 6){
						  $('td:eq(-1)',nRow).html("部分还款");
						}else if(aData.reg_status == 8){
							 $('td:eq(-1)',nRow).html("还款完成");
						}else{
							$('td:eq(-1)',nRow).html("--");
						}
						//return nRow;
					},
          		 "deferRender": true
			   });
			   
			   /////////////// 
	 /////////////////// load Repayment
	 
	 
});
 
 
 
 