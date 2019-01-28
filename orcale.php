PRSNL_NUM--FULL_NAME--STATUS--UNIT_NUM--UNIT_NAME--UNIT_STATUS--SHENGFEN--QUYU,Result:<br>

<?php

 $conn = oci_connect('sm_web', 'sm_web', '10.91.5.93/smgerp'); // conn orcel service
 //$conn = oci_connect('bl_web','bl_web',"(DEscriptION=(ADDRESS=(PROTOCOL =TCP)(HOST=10.91.110.31)(PORT = 1521))(CONNECT_DATA =(SID=blgerp)))");
if ($conn) {
    echo "success";
} else {
    echo "Error!!";
}
 
//print_r($res);
exit();
 //phpinfo();
//header("Content-type:text/html;charset=utf-8");
// send sms stat
             include "Lib/nusoap/nusoap.php";
             //vendor('PHPExcel.PHPExcel');
             // vendor('nusoap.nusoap');
            // 要访问的webservice路径
           // $NusoapWSDL = "http://ums.zj165.com:8888/sms_hb/services/Sms?wsdl";
            $NusoapWSDL = "http://10.90.104.110:8080/axis2/services/UserSvc?wsdl";
            
            // 生成客户端对象
            $client = new SoapClient($NusoapWSDL);
            if ($client) {
                print_r($client);
                echo "Su";
            }else{
                echo "Error!";
            }
 //phpinfo();
 exit();
$conn = oci_connect('sm_web', 'sm_web', '10.90.18.137/SMTST2');
//$conn = oci_connect('sm_web','sm_web',"(DEscriptION=(ADDRESS=(PROTOCOL =TCP)(HOST=10.90.18.137)(PORT = 1521))(CONNECT_DATA =(SID=SMTST2)))");
if ($conn) {
    echo "success";
} else {
    echo "Error!!";
}
$sql = "select  * from zv_cust_smweb";
$ora_test = oci_parse($conn, $sql); //编译sql语句
//oci_execute($ora_test,OCI_DEFAULT);  //执行
oci_set_prefetch($ora_test, 300);
oci_execute($ora_test);
$nrows = oci_fetch_all($ora_test, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
echo $nrows;
echo "$nrows rows fetched<br>\n";
//print_r($res);
  $i =0;
    foreach ($res as $data) {
        //print_r($data);
         echo $data['PRSNL_NUM'];
         echo "-"; 
         echo $data['FULL_NAME'];
           echo "-"; 
         echo $data['UNIT_NAME'];
           echo "-"; 
         echo $data['SHENGFEN'];
         echo "-"; 
         echo $data['QUYU'];
         echo "<BR>"; 
         $i++;
         if ($i >4){
              break; 
         }
    }
 
//foreach ($results as $key => $val) {
//      echo "-$key-";
//   }
//   echo "<BR>"; 
//   for ($i = 0; $i < 10; $i++) {
//     // print_r($results);
//      foreach ($results as $data) {
//        // echo " $data[$i] ";
//      }
//      echo "<BR>"; 
//   }
echo "<BR>";
$result = oci_fetch_assoc($ora_test);
print_r($result);
//exit();
while ($r = oci_fetch_row($result)) {  //取回结果
    echo $result[0];
    echo "<BR>";
}
//$oci_error(); 
var_dump($conn);
echo "222";
exit();
//里面的几个参数分别是用户名、密码、oracle服务地址，其中test是服务名。
$dbhost = "10.90.18.137";
$dbuser = "sm_web";
$dbpasswd = "sm_web ";
$dbname = "SMTST2";
if (@$conn = oci_connect($dbuser, $dbpasswd, $dbhost . '/' . $dbname)): echo "连接成功！";
else: echo "连接失败!";
endif;
?> 