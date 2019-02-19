<?php /* Smarty version Smarty-3.1.11, created on 2016-07-13 08:46:13
         compiled from "D:\wwwroot\httpdocs20160331\httpdocs\semirdx\templates\admin\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:230115760bd191c7ef9-72310311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99db6b314d0ee7250a30523939d0d2bd506e99bc' => 
    array (
      0 => 'D:\\wwwroot\\httpdocs20160331\\httpdocs\\semirdx\\templates\\admin\\header.tpl',
      1 => 1468392353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '230115760bd191c7ef9-72310311',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5760bd19282d76_98105074',
  'variables' => 
  array (
    'web_title' => 0,
    'navAction' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5760bd19282d76_98105074')) {function content_5760bd19282d76_98105074($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../admin/header_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript">
     $(document).ready(function(){ 
	 // add and edit  gallery start
         $(".changePw").click(function(){
			//alert("");
			// window.location = "<?php echo site_url('admin/homepage/toform/add/');?>
";
			BootstrapDialog.show({
				title: '修改密码',
				closeByBackdrop: false,
				message: $('<div></div>').load("<?php echo site_url('admin/system/user_edit_pass');?>
") 
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
          <a class="navbar-brand" href="<?php echo site_url("admin/home");?>
"><?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
 Control</a>
   </div>
    <div class="collapse navbar-collapse ">
          <ul id="navbar-collapse-1"  class="nav navbar-nav navbar-right ">
        <?php if (($_SESSION['admin']=='admin')){?> 
        <li <?php if (($_smarty_tpl->tpl_vars['navAction']->value=='homepage')){?> class="active" <?php }?>><a href="<?php echo site_url("admin/homepage");?>
" >导航管理</a></li>
        <li  ><a href="/" target="_blank">DX首页</a></li>
        <?php }?>
        <li>
              <p class="navbar-text">|</p>
            </li>
        <li  <?php if (($_smarty_tpl->tpl_vars['navAction']->value=='system')){?> class="dropdown active" <?php }else{ ?>class="dropdown" <?php }?>> <a class="dropdown-toggle" data-toggle="dropdown" href="#" ><?php echo $_SESSION['admin'];?>
<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
          <!--  <li><a href="<?php echo site_url("admin/system/userlist");?>
" >Supervisor</a></li>
            <li><a href="<?php echo site_url("admin/system/group");?>
" >Supervisor Group</a></li>
            <li class="divider"></li>-->
            <li><a href="javascript:;" class="changePw" >Change Password</a></li>
            <li><a href="<?php echo site_url('admin/log/logout');?>
" id="logout">Logout</a></li>
          </ul>
            </li>
        <li></li>
      </ul>
        </div>
  </div> 
  
</header> 
<!-- header --> 
<div class="container"> <?php }} ?>