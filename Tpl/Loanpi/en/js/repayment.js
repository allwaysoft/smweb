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
						  "url": "/loanpi.php/Repayment/rep_list",
					  },
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "reg_date"}, 
							{"data": "reg_amount"},
							{"data": "sap_code"},
							{"data": "reg_cycle"},
							{ "data": "sap_start_time"},
							{ "data": "sap_end_time"},
							{ "data": "repTotal"},
							{ "data": "needTotal"},
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
						if(aData.regpayment_status == 2){
						  $('td:eq(-1)',nRow).html("<button class='btn btn-danger btn-xs' value='"+aData.article_id+"' onclick=_Repayment('"+aData.id+"') type='button' name='modifyMapp'><span class='fui-new'></span> Repay</button>");
						}else if(aData.regpayment_status == 3){
							 $('td:eq(-1)',nRow).html("RepEnd");
						}else{
							$('td:eq(-1)',nRow).html("--");
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
 
	////add end
 /////edit  
	function _Repayment(id){  
		   BootstrapDialog.show({
            title: 'Repayment',
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
					}],
            message: $('<div></div>').load("/loanpi.php/Repayment/repay_add/reid/"+id) 
        }); 
	};
 