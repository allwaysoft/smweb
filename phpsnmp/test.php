<?php

//61.175.163.196 windows
//61.175.132.172 windows
//110.76.43.117 linux
$ip = '122.144.142.194'; //122.144.142.194
//$ip2 = '61.175.132.172';
$ip2 = '139.196.43.50';
 
$info = '1.3.6.1.2.1.25.3.3.1.2';
//$info = '1.3.6.1.4.1.2021.11';
//$info = '1.3.6.1.4.1.2021.4.6.0';

//$info = 'HOST-RESOURCES-MIB::hrSystemDate.0';

//$a = snmprealwalk($ip, "public", $info); 
//$a = snmpget($ip, 'public', '1.3.6.1.2.1.1.1.0');
//$b = snmprealwalk($ip2, "public", $info);



require('snmp-moniter.php');
$snmp = new snmp_moniter;
$snmp->ip = $ip;
//$snmp->info = $info;
$a = $snmp->cpu();
$b = $snmp->memory();
$c = $snmp->disk();

var_dump($a);
echo '<br/><br/>';
var_dump($b);
echo '<br/><br/>';
var_dump($c);
?>
