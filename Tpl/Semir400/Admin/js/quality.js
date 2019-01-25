// JavaScript Document 
$(document).ready(function(){ 
	 /////load 
 $('#listTable').dataTable().fnDestroy(); 
 var table = $('#listTable').dataTable( { 
				      "processing": true,
				 	  "serverSide": false,
					  "fixedHeader": true,
					   "responsive": true,
					 "ajax":{
						  "url": "/semir400admin.php/Staff/get_list/source/quality",
					  },
					   "pageLength": 10, //首次加载的数据条数
					//  "lengthMenu": [[10, 100, -1],[10, 100, "All"]],
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "com_code"},
							{ "data": "agent_code" },
							{ "data": "agent_area" },
							{ "data": "agent_person" },
							{ "data": "number" },
							{ "data": "style_id" },
							{ "data": "sale_type" },
							{ "data": "add_time" },
							{ "data": "com_status" },
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
					//	$('td:eq(0)',nRow).addClass("tableDate");
					var show = "";
						if(aData.view_status ==1){
						   show = "<span class='view-show'><i class='fa fa-commenting' aria-hidden='true'></i></span>";
						}
						 
						var html = "";
						if(aData.com_status == '新投诉'){
							 html += "<a class='btn btn-info btn-xs'  onclick=_attend('"+aData.id+"',this)><i class='fa fa-gavel' aria-hidden='true'></i>受理</a>";
						}else{
						 html +="<a class='btn btn-success btn-xs'  onclick=_getinfo('"+aData.id+"')><i class='fa fa-flash' aria-hidden='true'></i> 管理"+show+"</a>";
						} 
							$('td:eq(-1)',nRow).html(html); 
						//return nRow;
					},
          		 "deferRender": true
			   });
			   
			   /////////////// 
              //** 3分钟刷新//
			//   setInterval(function(){
            //        table.api().ajax.reload();
            //    },1000*180);
			  
			   
	 
});
/////////////////////////
/////////////////////////
 	
 /////edit  
 function _attend(id,obj){
	 
	 $.post('/semir400admin.php/Staff/attend',{id:id,source:'quality'},function(msg){
		 if(msg.status==false){
			 BootstrapDialog.show({
					type:"type-danger",
					title: '受理失败! ',
					message: '<h5>'+ msg.info +'</5>' 
				});
			 setTimeout(function(){
				 location.reload(true)
			 },2000)
			 
		 }else{
			 $(obj).removeClass('btn-info').addClass('btn-success');
			 $(obj).html("<i class='fa fa-flash' aria-hidden='true'></i> 管理");
			 $(obj).parent().prev().html('处理中')
			 $(obj).attr('onclick','_getinfo('+id+')');
		 }
	 }) 
		
	};
 //	
  /////edit  
	function _getinfo(id){  
		BootstrapDialog.show({
			size: BootstrapDialog.SIZE_WIDE,
            title: '投诉详情',
			closeByBackdrop: false,
			buttons: [ {
						label: '<span class="glyphicon glyphicon-ok"></span> 确定',
						cssClass: 'btn-primary btn-sm',
						action: function(dialogItself){
							if($('#subForm').length==1){
								$('#subForm').submit(); 
							}else{
								dialogItself.close();
							}
							
							
						}
					},
					{
						label: '关闭',
						cssClass: ' btn-default btn-sm',
						action: function(dialogItself){
							dialogItself.close();
						}
					}],
            message: $('<div></div>').load("/semir400admin.php/Staff/qualityinfo/id/"+id) 
        });
	};
 //	 
 
 