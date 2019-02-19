{%include file="../admin/header.tpl"%}
<table class="table table-bordered table-hover" width="60%">
<thead><tr>
  <th>Service Info</th>
<th>Val</th></tr></thead>
<tr>
  <td>PHP vesion：</td><td>{%*print_r($phpInfo)*%}{%$smarty.const.PHP_VERSION%}</td></tr>
<tr>
  <td>ZEND vesion：</td><td> {%$phpInfo['z_v']%}</td></tr>
<tr><td>MYSQL：</td><td>{%$phpInfo['mysqlC']%}</td></tr>
<tr>
  <td>MySQL contact：</td><td>{%$phpInfo['mysqlG']%}</td></tr>
<tr>
  <td>MySQLMax：</td><td>{%$phpInfo['mysqlB']%}</td></tr>
<tr>
  <td>OS：</td><td>{%$smarty.const.PHP_OS%}</td></tr>
<tr>
  <td>OS information：</td><td>{%$smarty.server.SERVER_SOFTWARE%}</td></tr>
<tr>
  <td>Max upload：</td><td>{%$phpInfo['uploadB']%}</td></tr>
<tr>
  <td>Max time： </td><td>{%$phpInfo['exTime']%}</td></tr>
<tr>
  <td>Memer：</td> <td>{%$phpInfo['memoryLi']%}</td></tr>
</table>
{%include file="../admin/foot.tpl"%}