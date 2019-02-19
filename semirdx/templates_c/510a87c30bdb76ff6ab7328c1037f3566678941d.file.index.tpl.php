<?php /* Smarty version Smarty-3.1.11, created on 2018-06-04 08:16:34
         compiled from "templates\admin\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:211725b14d9420b13f7-39825753%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '510a87c30bdb76ff6ab7328c1037f3566678941d' => 
    array (
      0 => 'templates\\admin\\index.tpl',
      1 => 1464250179,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '211725b14d9420b13f7-39825753',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'phpInfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5b14d942186de9_35828361',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d942186de9_35828361')) {function content_5b14d942186de9_35828361($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../admin/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<table class="table table-bordered table-hover" width="60%">
<thead><tr>
  <th>Service Info</th>
<th>Val</th></tr></thead>
<tr>
  <td>PHP vesion：</td><td><?php echo @PHP_VERSION;?>
</td></tr>
<tr>
  <td>ZEND vesion：</td><td> <?php echo $_smarty_tpl->tpl_vars['phpInfo']->value['z_v'];?>
</td></tr>
<tr><td>MYSQL：</td><td><?php echo $_smarty_tpl->tpl_vars['phpInfo']->value['mysqlC'];?>
</td></tr>
<tr>
  <td>MySQL contact：</td><td><?php echo $_smarty_tpl->tpl_vars['phpInfo']->value['mysqlG'];?>
</td></tr>
<tr>
  <td>MySQLMax：</td><td><?php echo $_smarty_tpl->tpl_vars['phpInfo']->value['mysqlB'];?>
</td></tr>
<tr>
  <td>OS：</td><td><?php echo @PHP_OS;?>
</td></tr>
<tr>
  <td>OS information：</td><td><?php echo $_SERVER['SERVER_SOFTWARE'];?>
</td></tr>
<tr>
  <td>Max upload：</td><td><?php echo $_smarty_tpl->tpl_vars['phpInfo']->value['uploadB'];?>
</td></tr>
<tr>
  <td>Max time： </td><td><?php echo $_smarty_tpl->tpl_vars['phpInfo']->value['exTime'];?>
</td></tr>
<tr>
  <td>Memer：</td> <td><?php echo $_smarty_tpl->tpl_vars['phpInfo']->value['memoryLi'];?>
</td></tr>
</table>
<?php echo $_smarty_tpl->getSubTemplate ("../admin/foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>