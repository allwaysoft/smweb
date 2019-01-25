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
						  "url": "/semir400.php/Index/sampling_list",
					  },
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "add_time"},
							{ "data": "com_code" },
							{ "data": "agent_name" },
							{ "data": "style_id" }, 
							{ "data": "agent_person"},
							{ "data": "com_status"},
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
						//$('td:eq(0)',nRow).addClass("tableDate"); 
						var show = "";
						if(aData.view_status ==1){
						   show = "<span class='view-show'><i class='fa fa-commenting' aria-hidden='true'></i></span>";
						}
							$('td:eq(-1)',nRow).html("<button class='btn btn-info btn-xs'  onclick=_viewMapp('"+aData.id+"') type='button' name='viewMapp'>详细 <i class='fa fa-ellipsis-h' aria-hidden='true'></i>"+show+"</button>");
						 
						//return nRow;
					},
          		 "deferRender": true
			   });
			   
			   /////////////// 
	 
	 
	 
});
/////////////////////////
 /////edit  
 function _viewMapp(id){   
	 window.location.href='/semir400.php/index/samplinginfo/id/'+id;
		
	};
 //	
  
 ///

 
 
 