{%include file="../admin/header.tpl"%} 
 
<script type="text/javascript">
     $(document).ready(function(){ 
	 // add and edit  gallery start
         $("#add").click(function(){
			//alert("");
			// window.location = "{%site_url('admin/homepage/toform/add/')%}";
			BootstrapDialog.show({
				title: 'Add AD banner ',
				closeByBackdrop: false,
				message: $('<div></div>').load("{%site_url('admin/homepage/homepage_add/')%}") 
       		});
        }); 
		 // upload start 
		  $("button[name='modify']").click(function(){
			 var hId= $(this).val();
			 	BootstrapDialog.show({
				title: 'Modify AD banner ',
				closeByBackdrop: false,
				message: $('<div></div>').load("{%site_url('admin/homepage/homepage_modify/')%}/"+$(this).val()) 
       		});
 			 
        }); 
	// add and edit gallery end
		 
	// Delete item
	$('button[name="del"]').click(function(){
                	$this = $(this).val();
			BootstrapDialog.confirm('Delete this Banner, are you sure?', function(result){
            if(result) {
							$.ajax({
							   type: "POST",
							   url: "{%site_url('admin/homepage/dodel')%}",
							   data: "hId="+$this,
							   success: function(msg){
								   //alert(msg);
								   if(msg==1){
									  // $("tr#"+n).remove();
									 BootstrapDialog.show({
									type:BootstrapDialog.TYPE_SUCCESS,
									title: 'deleted Banner Success! ',
									message: '<p>current page is being refreshed!!</p>' 
									 });
               							 setInterval(function(){window.location.reload();},1000);
										//window.location = "{%site_url('admin/article/') %}";
									
								   }else{
										//alert(msg);
								   }
							   }
							   
							}); 

							return false;
						
						 }
					 
					 });
            	});
	//  //////////////////////////////////
		
		/// sort function ///////////////
		 $(".inputSort").click(function() { // 给页面中有caname类的标签加上click函数
			var objTD = $(this);
			var oldText = $.trim(objTD.text()); // 保存老的类别名称
			 
			var input = $("<input type='text'  class='form-control input-sm' size='2' value='" + oldText + "' />"); // 文本框的HTML代码
			objTD.html(input); // 当前td的内容变为文本框
			// 设置文本框的点击事件失效
			input.click(function() {
				return false;
			});
			// 设置文本框的样式
		   /* input.css("border-width", "2px"); //边框为0
			input.height(objTD.height()); //文本框的高度为当前td单元格的高度
			input.width(objTD.width()); // 宽度为当前td单元格的宽度
			input.css("font-size", "12px"); // 文本框的内容文字大小为14px
			input.css("text-align", "center"); // 文本居中*/
			//input.trigger("focus").trigger("select"); // 全选
			// 文本框失去焦点时重新变为文本
			input.blur(function() {
				var newText = $(this).val(); // 修改后的名称
				var input_blur = $(this);
				// 当老的类别名称与修改后的名称不同的时候才进行数据的提交操作
				if (oldText != newText) {
					// 获取该类别名所对应的ID(序号)
					var caid = objTD.parents('tr').children('td').eq(0).find('input').val();//$.trim(objTD.first().text());
					// AJAX异步更改数据库
					var url = "{%site_url('admin/homepage/sort_save')%}/" + encodeURI(encodeURI(newText)) + "/" + caid;
					$.get(url, function(data) {
						if (data == "false") {
							//$("#test").text("类别修改失败,请检查是否类别名称重复!");
							input_blur.trigger("focus").trigger("select"); // 文本框全选
						} else {
							    BootstrapDialog.show({
									type:BootstrapDialog.TYPE_SUCCESS,
									title: 'Modify Banner Success! ',
									message: '<p>current page is being refreshed!!</p>' 
									 });
							  setInterval(function(){window.location.reload();},1000);
						//	objTD.html(newText);
						}
					});
				} else {
					// 前后文本一致,把文本框变成标签
					objTD.html(newText);
				}
			});
	 });
                                                 

	});

</script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<div class="container-full ">
  <button class="btn btn-sm btn-primary pull-right" type="button"  name="add" id="add"  >Add new Banner</button>
  <h5>Navigation Area Management</h5>
</div>
 <div role="form" class="row ">
 <div class="form-group col-sm-3 ">
      <select name="hType" id="hType" onchange="MM_jumpMenu('parent',this,0)" data-toggle="select" class="form-control select select-info select-sm">
        <option value="{%site_url('admin/homepage/index/1')%}" {%if ($data['hType']==1)%} selected="selected" {%/if%} >DX</option> 
        <option value="{%site_url('admin/homepage/index/2')%}" {%if ($data['hType']==2)%} selected="selected" {%/if%} >HTTP</option> 
      </select>
  </div>
 </div>
  <form action="" method=" ">
    <table id=" " class="table table-bordered table-hover Small Font">
      <thead>
        <tr>
          <th width="40"><input id="all_check" type="checkbox"/></th>
          <th>Photo</th>
         
          <th>Name</th>
          <th>Link url</th>
          <th>Type</th>
          <th>Sort</th>
          <th>Function</th>
        </tr>
      </thead>
      {%foreach from=$data['adPics'] item=row%}
      <tr id="{%$row->hId%}">
        <td><input class="all_check" type="checkbox" name="hId" value="{%$row->hId%}"/></td>
        <td valign="middle"  >
          
             <img  src="{%base_url()%}/attachments/adpic/{%$row->hPic%} " width="64"  alt="..."  />
           
        </td>
        
        <td valign="top">{%$row->hTitle%}<br />{%$row->hContents%}</td>
        <td valign="top">{%$row->hUrl%}</td>
        <td valign="top">
        {%if ($row->hType == 1)%}DX{%/if%}
         {%if ($row->hType == 2)%}HTTP{%/if%}
          {%if ($row->hType == 3)%}Classes right{%/if%}
        </td>
        <td valign="top">
           <span class="inputSort">{%if $row->hSort %}{%$row->hSort%}{%else%}0{%/if%}</span>
        </td>
        <td valign="middle">
        <button class="btn btn-primary btn-xs" name="modify" id="modify" type="button" value="{%$row->hId%}" title="Modify"  ><span class="fui-new"></span> M</button>
         <button class="btn btn-default btn-xs" name="del" id="del" type="button" value="{%$row->hId%}" title="Del"  ><span class="fui-cross"></span> D</button>
        </td>
      </tr>
      {%/foreach%}
      <tr>
        <td><input type="button" value=" " name="submit"  class="delete"/></td>
        <td>&nbsp;</td>
        <td colspan="6"><div align="center"></div></td>
      </tr>
    </table>
  </form>
  <!-- newProducts start -->
  <div style="padding:0px">&nbsp; </div>
</div>
<!-- newProducts end --> 
{%include file="../admin/foot.tpl"%} 