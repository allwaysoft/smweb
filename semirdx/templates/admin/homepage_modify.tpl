<script type="text/javascript" src="/semirdx/templates/public/js/bootstrap-validator/bootstrapValidator.js"></script>
<script type="text/javascript" src="/semirdx/templates/public/js/jquery.form.js"></script><!-- up file blug -->
<script type="text/javascript">
    $(document).ready(function(){
     $('#subForm').bootstrapValidator({
        message: 'This value is not valid',
       live: 'disabled',
         feedbackIcons: {
           valid: 'glyphicon glyphicon-ok fui-check',
            invalid: 'glyphicon glyphicon-remove fui-cross',
            validating: 'glyphicon glyphicon-refresh'
        }, 
        fields: {
            hTitle: {
                message: 'The AD banner  name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The AD banner  name is required and can\'t be empty'
                    },
					stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The AD banner  name must be more than 2 and less than 30 characters long'
                    }
                }
            }/*,
			 hUrl: {
                message: 'The AD banner  URL is not valid',
                validators: {
                    notEmpty: {
                        message: 'The  AD banner  URL  is required and can\'t be empty'
                    }
                }
            } */
		}
    }).on('success.form.bv', function(e) {
		 var post_data = $("#subForm").serializeArray();
		 		var post_url;
				//alert($("input[name=id]").val());
                 
                    post_url = "{%site_url('admin/homepage/edit')%}";//"{%site_url('admin/homepage/add')%}";                 
                $.ajax({
                    type: "POST",
                    url: post_url,
                    cache:false,
                    data: post_data,
                    success: function(msg){
 
                        if(msg=="ok"){
                            // $("#editbox").html("");
							BootstrapDialog.show({
								type:BootstrapDialog.TYPE_SUCCESS,
								title: 'Modify AD banner Success! ',
								message: 'current page is being refreshed!!' 
							});     
                             
                            setInterval(function(){
                               window.location.reload();
                            },1000);
                            //  Alert(msg);
                        }else{
                            BootstrapDialog.show({
								type:"type-danger",
								title: 'Modify AD banner  Error!',
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
								title: 'Add nav Error!',
								message: "Please contact us!!",
								closable: false,
								buttons: [{
									label: 'Close',
									action: function() {
										// You can also use BootstrapDialog.closeAll() to close all dialogs.
										$.each(BootstrapDialog.dialogs, function(id, dialog){
											dialog.close();
										});
									}
								}]
							});
						
                    }
                });
                return false;
	});
	//  upload Fle 
	var bar = $('.progress-bar');
	var percent = $('.percent');
	var showimg = $('#showimg');
	var progress = $(".progress");
	var files = $(".files");
	var btn = $(".selectPic");
	//$("#upPic").wrap("<form id='myupload' action='{%site_url('admin/menu/upPic')%}' method='post' enctype='multipart/form-data'></form>");
    $("#upPic").change(function(){
		$("#subForm").ajaxSubmit({
			dataType:  'json',
			 url: "{%site_url('admin/homepage/upPic')%}",
			beforeSend: function() {
        		showimg.empty();
				progress.show();
        		var percentVal = '0%';
        		bar.width(percentVal);
        		percent.html(percentVal);
				btn.html("Uploading...");
    		},
    		uploadProgress: function(event, position, total, percentComplete) {
        		var percentVal = percentComplete + '%';
        		bar.width(percentVal);
        		percent.html(percentVal);
				
    		},
			success: function(data) {
				files.html("<b>"+data.name+"("+data.size+"k)</b> <span class='delimg btn btn-xs btn-danger' rel='"+data.pic+"'>Del</span>");
				var img = "{%base_url()%}attachments/adpic/"+data.pic;
				showimg.html("<img src='"+img+"' class='img-responsive' alt='Responsive image'>");
				$("#hPic").val(data.pic);
				btn.html("Select Pic");
				$(".btnUpload").hide();
			},
			error:function(xhr){
				btn.html("Upload Error!!");
				bar.width('0')
				files.html(xhr.responseText);
			}
		});
	});
	
	 $(".files").on('click',".delimg",function(){
		var pic = $(this).attr("rel");
		$.post("{%site_url('admin/homepage/delPic')%}",{imagename:pic},function(msg){ //delPic
			if(msg==1){
				files.html("Del Success!");
				showimg.empty();
				progress.hide();
				$("#hPic").val('');
				$(".btnUpload").show();
			}else{
				alert(msg);
			}
		});
	}); 
	
	//  upload Fle end //////////////////////////////////
});
</script>
<form name="subForm" id="subForm"  class="form-horizontal"  method="post"   enctype='multipart/form-data' action="" role="form">
  <div class="my-form form-horizontal">
<!-- modal body start -->
        <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="hTitle">Title</label>
                 <div class="col-sm-8">
                   <input type="text" class="form-control" name="hTitle"  id="hTitle" placeholder="banner title" value="{%$data->hTitle%}">
                   <input type="hidden"  name="hId"  id="hId"   value="{%$data->hId%}">
                </div>  
         	</div>
          
        <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="hTitle">Type</label>
                 <div class="col-sm-8">
                  
                   <select name="hType" id="hType" data-toggle="select" class="form-control ">
            <option value="1" {%if ($data->hType==1)%} selected="selected" {%/if%} >DX</option>
             <option value="2" {%if ($data->hType==2)%} selected="selected" {%/if%} >HTTP</option> 
          </select>
                </div>  
         </div>
          <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="hUrl">URL</label>
                 <div class="col-sm-8">
                   <input type="text" class="form-control" name="hUrl"  id="hUrl" placeholder="banner title" value="{%$data->hUrl%}">
                 
                </div>  
         	</div>
         <!-- pic --> 
           <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="menuSort">Pic:</label>
                <!-- uploac pic -->
                 <div class="col-sm-5">
                 		
                        <div class="btn btn-info btn-xs btnUpload">
                            <span class="selectPic">Select Pic</span>
                            <input id="upPic" type="file" name="upPic" class="btnUpload-intput" >
                        </div>
                         <div class="files">
                         {%if $data->hPic != ''%}
                          <script>
						$(function() {
							$(".btnUpload").hide();
						});
						</script>
                          <b>{%$data->hPic%}</b><span class="delimg btn btn-xs btn-danger" rel="{%$data->hPic%}">删除</span>
                          {%/if%}
                         </div>
                       <input type="hidden" class="form-control" name="hPic"  id="hPic" placeholder="0" value="{%$data->hPic%}">
                   </div>
                    <div class="col-sm-3">
                     
                     <div class="progress">
                            <div class="progress-bar progress-bar-warning" ></div>
                        </div>
                    </div>  
                
          </div> 
             <div class="form-group form-group-sm">
           		<div class="col-sm-2"></div>             
               <div class="col-sm-8">    
        				 <div id="showimg">
                           {%if $data->hPic != ''%}
                          <img src='{%base_url()%}attachments/adpic/{%$data->hPic%}' class='img-responsive' alt='Responsive image'>
                          {%/if%}
                         </div>
                 </div>
             </div>
              <!--uploac pic -->  
              
              <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="hSort">Sort</label>
                 <div class="col-sm-8">
                   <input type="text" class="form-control" name="hSort"  id="hSort" placeholder="banner sort" value="{%$data->hSort%}">
                 
                </div>  
         	</div>
            
             <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="hContents">Remark</label>
                 <div class="col-sm-8"> 
                 <textarea id="hContents" class="form-control" placeholder="AD Remark" name="hContents" rows="3">{%$data->hContents%}</textarea>
                </div>  
         	</div>
       
      
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
  </form>