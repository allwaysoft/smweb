<?php /* Smarty version Smarty-3.1.11, created on 2016-06-15 04:23:41
         compiled from "D:\wwwroot\httpdocs20160331\httpdocs\semirdx\templates\Dxsemir\foot.tpl" */ ?>
<?php /*%%SmartyHeaderCode:186725760bc2dafa794-77833739%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80d033f43bd205adda72115aeef7487be7ebfd03' => 
    array (
      0 => 'D:\\wwwroot\\httpdocs20160331\\httpdocs\\semirdx\\templates\\Dxsemir\\foot.tpl',
      1 => 1465370477,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186725760bc2dafa794-77833739',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web_copyrighturl' => 0,
    'web_copyright' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5760bc2db28401_03976409',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5760bc2db28401_03976409')) {function content_5760bc2db28401_03976409($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wwwroot\\httpdocs20160331\\httpdocs\\semirdx\\application\\libraries\\Smarty\\plugins\\modifier.date_format.php';
?><!-- footer -->
<footer class="footer_wrapper">
 <div class="container">
  <div class="row"> 
    <!-- main  -->
    <div class="col-xs-12 col-sm-8"> 
     <p  >  

    All Rights Reserved &copy; <?php echo smarty_modifier_date_format(time(),'%Y');?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['web_copyrighturl']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['web_copyright']->value;?>
</a>  <br />
 	</p>
   
    
    </div>
    <div class="col-xs-12 col-sm-4   hidden-sm"> 
  		<p  >
  	 
    </p>
    </div>
    </div>
 </div>
</footer>
<!-- footer -->
</div>
 
</body></html><?php }} ?>