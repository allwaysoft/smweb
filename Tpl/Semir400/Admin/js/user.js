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
						  "url": "/semir400admin.php/User/user_list",
					  },
					 "order": [[ 0, "desc" ]],
					 "columns": [
							{"data": "user_number"},
							{"data": "user_name"},
							{"data": "c_name"},
							{"data": "email"},
							{"data": "mobile"},
							{"data": "status"},
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
						//$('td:eq(0)',nRow).addClass("tableDate");
						 	var html = ""; 
							 html += "<div class='btn-group'><button class='btn btn-info btn-xs'  onclick=_funEdit('"+aData.id+"') type='button' name='_edit'>编辑</button>";
							 html += " <button class='btn btn-warning btn-xs'  onclick=_funRepass('"+aData.id+"') type='button' name='_edit'>修改密码</button></div>"; 
							$('td:eq(-1)',nRow).html(html); 
						//return nRow;
					},
          		 "deferRender": true
			   });
			   
			   ///////////////
	  
	// add and edit gallery end 
	$("button[name=addBut]").click(function() { 
		BootstrapDialog.show({
            title: '添加客服',
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
            message: $('<div></div>').load("/semir400admin.php/User/user_add") 
        }); 
	});
	////add end
	
	//  //////////////////////////////////
	 
});
/////////////////////////
// edit
function _funEdit(val) { 
		BootstrapDialog.show({
            title: '修改客服',
			closeByBackdrop: false,
			buttons: [ {
						label: '<span class="glyphicon glyphicon-ok"></span> 提交',
						cssClass: 'btn-primary btn-sm',
						action: function(){
							$('#subForm').submit(); 
						}
					},
					{
						label: '关闭',
						cssClass: ' btn-default btn-sm',
						action: function(dialogItself){
							dialogItself.close();
						}
					},
					{
						label: '<i class="fa fa-times" aria-hidden="true"></i> 删除',
						cssClass: 'pull-left btn-danger btn-sm',
						action: function(dialogItself){
							_funDel(dialogItself); 
						}
					}],
            message: $('<div></div>').load("/semir400admin.php/User/user_edit/id/"+val) 
        }); 
	};
	////edit end
	// edit
function _funRepass(val) { 
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
						label: '关闭',
						cssClass: ' btn-default btn-sm',
						action: function(dialogItself){
							dialogItself.close();
						}
					}],
            message: $('<div></div>').load("/semir400admin.php/User/user_pass/id/"+val) 
        }); 
	};
	////add end
	// function del
    function _funDel(dialogItself) { 
			BootstrapDialog.confirm('Delect this, are you sure?', function(result){
            if(result) {
				dialogItself.close();
				var id = $('#id').val();
		 		 post_url = "/semir400admin.php/User/user_del_do"; 
                 //  post_url = "{%site_url('admin/homepage/edit')%}"; 
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: 'id='+id,
                    success: function(msg){ 
                        if(msg==0){
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: 'edit  Success! ',
								message: 'current page is being refreshed!!' 
							});     
                             
                             setTimeout(function(){
                                 window.location.reload();
                            },1000);
                            //  Alert(msg);
                        }else{
                            BootstrapDialog.show({
								type:"type-danger",
								title: 'Return Error!',
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
								title: 'edit Error!',
								message: "Please contact us!!",
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
			 } 
			});
		 
	};
	////add end