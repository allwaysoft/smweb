{%include file="../admin/header_top.tpl"%}
<script type="text/javascript">
     $(document).ready(function(){ 
	 // add and edit  gallery start
         $(".changePw").click(function(){
			//alert("");
			// window.location = "{%site_url('admin/homepage/toform/add/')%}";
			BootstrapDialog.show({
				title: '修改密码',
				closeByBackdrop: false,
				message: $('<div></div>').load("{%site_url('admin/system/user_edit_pass')%}") 
       		});
        }); 
	 });
</script>
<!-- header --> 
<header class="navbar navbar-inverse navbar-static-top " role="navigation"><!--navbar-fixed-top-->
   <div class="container">
    <div class="navbar-header ">
    <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
    <span class="sr-only">Toggle navigation</span>
    </button>
          <a class="navbar-brand" href="{%site_url("admin/home")%}">{%$web_title%} Control</a>
   </div>
    <div class="collapse navbar-collapse ">
          <ul id="navbar-collapse-1"  class="nav navbar-nav navbar-right ">
        {%if ($smarty.session.admin=='admin')%} 
        <li {%if ($navAction=='homepage')%} class="active" {%/if%}><a href="{%site_url("admin/homepage")%}" >导航管理</a></li>
        <li  ><a href="/" target="_blank">DX首页</a></li>
        {%/if%}
        <li>
              <p class="navbar-text">|</p>
            </li>
        <li  {%if ($navAction=='system')%} class="dropdown active" {%else%}class="dropdown" {%/if%}> <a class="dropdown-toggle" data-toggle="dropdown" href="#" >{%$smarty.session.admin%}<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
          <!--  <li><a href="{%site_url("admin/system/userlist")%}" >Supervisor</a></li>
            <li><a href="{%site_url("admin/system/group")%}" >Supervisor Group</a></li>
            <li class="divider"></li>-->
            <li><a href="javascript:;" class="changePw" >Change Password</a></li>
            <li><a href="{%site_url('admin/log/logout')%}" id="logout">Logout</a></li>
          </ul>
            </li>
        <li></li>
      </ul>
        </div>
  </div> 
  
</header> 
<!-- header --> 
<div class="container"> 