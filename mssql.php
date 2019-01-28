 
<?php
header("Content-type:text/html;charset=utf-8");
echo "1111";
$conn=mssql_connect("10.90.18.137","sm_web","sm_web");
echo "sdf";
//测试连接
if($conn)
{
   echo "连接成功";
}  else {
    echo "连接失败";
}
?>