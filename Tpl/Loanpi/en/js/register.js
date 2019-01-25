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
						  "url": "/loanpi.php/Register/reg_list",
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
	 /////////////////// load Repayment
	  $.ajax({
                    type: "POST",
                    url: "/loanpi.php/Public/msg_repayment",
                    cache:false,
                    data: '',
                    success: function(msg){ 
                        if(msg != 0 ){
							$("#msgShow").html(msg); 
                        } 
                    } 
                });
	//  //////////////////////////////////
	 
});
/////////////////////////
	/////add dept
	$("button[name=addBut]").click(function() { 
		BootstrapDialog.show({
            title: 'Register',
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
            message: $('<div></div>').load("/loanpi.php/Register/reg_add") 
        }); 
	});
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
 //
 
 
 