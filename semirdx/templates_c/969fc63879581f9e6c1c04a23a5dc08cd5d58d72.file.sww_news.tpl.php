<?php /* Smarty version Smarty-3.1.11, created on 2016-07-12 11:17:23
         compiled from "templates\Dxsemir\sww_news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103495760bc28eeca87-24469442%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '969fc63879581f9e6c1c04a23a5dc08cd5d58d72' => 
    array (
      0 => 'templates\\Dxsemir\\sww_news.tpl',
      1 => 1468315040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103495760bc28eeca87-24469442',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5760bc29056132_37291736',
  'variables' => 
  array (
    'data' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5760bc29056132_37291736')) {function content_5760bc29056132_37291736($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wwwroot\\httpdocs20160331\\httpdocs\\semirdx\\application\\libraries\\Smarty\\plugins\\modifier.date_format.php';
?> 
<ul class="fadeInRight top_left_cont animated wow newslist">
            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['row']->key;
?>
            <li  > <a href="/semirdx/index.php/index/get_sww_newInfo/<?php echo $_smarty_tpl->tpl_vars['row']->value->id;?>
" target="_blank"  class="newsLink"> 
              <div class="title" title="<?php echo $_smarty_tpl->tpl_vars['row']->value->title;?>
"><i class="fa fa-angle-right"></i> <?php echo mb_substr($_smarty_tpl->tpl_vars['row']->value->title,0,22,'UTF-8');?>
</div>
               </a>
              <div class="time"><i class="fa fa-clock-o"></i> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value->time,'%Y-%m-%d %H:%M:%S');?>
 </div>
  </li>
    <?php } ?>
    <li><a href="http://w.semir.cn/index.php/Main/newsindex.html" target="_blank" class="read_more"><span class="glyphicon glyphicon-option-horizontal"></span> 更多信息</a></li>
</ul>
  <?php }} ?>