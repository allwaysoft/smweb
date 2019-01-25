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
						  "url": "/loanpiadmin.php/Index/register_list",
					  },
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "reg_date"},
							{ "data": "dl_code" },
							{ "data": "reg_cycle" },
							{ "data": "reg_amount" },
							{ "data": "reg_start_time" },
							{ "data": "reg_status_msg" }, 
							{ "data": "sap_code"},
							{ "data": "sap_cycle"},
							{ "data": "sap_start_time"},
							{ "data": "sap_end_time"},
							{ "data": "repTotal"},
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
						if(aData.repTotal >= 5){
							 html += "<button class='btn btn-info btn-xs'  onclick=_viewMapp('"+aData.id+"') type='button' name='viewMapp'><span class='fui-new'></span>还款详细</button>";
						}
						if(aData.reg_status < 8){
						 html +="<button class='btn btn-success btn-xs'  onclick=_getPi('"+aData.id+"') type='button' name='getPi'><span class='fui-new'></span> 更新状态(SAP)</button>";
						} 
							$('td:eq(-1)',nRow).html(html); 
						//return nRow;
					},
          		 "deferRender": true
			   });
			   
			   /////////////// 
 
	 
});
/////////////////////////
/////////////////////////
 	
 /////edit  
 function _viewMapp(id){   
	  BootstrapDialog.show({
            title: '<i class="fa fa-history" aria-hidden="true"></i> 还款历史',
			closeByBackdrop: false,
			buttons: [{ label: 'Close',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }],
            message: $('<div></div>').load("/loanpiadmin.php/Index/view_repay/id/"+id) 
        });  
		
	};
 //	
  /////edit  
	function _getPi(id){  
		   BootstrapDialog.show({
            title: '获取远程信息(PI)',
			closeByBackdrop: false,
			buttons: [{ label: 'Close',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }],
            message: $('<div></div>').load("/loanpiadmin.php/Index/get_pi/id/"+id) 
        });  
	};
 //	 
 
 