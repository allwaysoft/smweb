 
<?php
header("Content-type:text/html;charset=utf-8");
// 本例使用到 connect, bind, search, interpret search
// result, close connection 等等 LDAP 的功能。
echo "<h3>LDAP 搜寻测试</h3>";
echo "连接中 ...";
$ds=ldap_connect("10.90.18.1");  // 先连上有效的 LDAP 服务器
echo "连上 ".$ds."<p>";
$ldapconn = ldap_connect("10.90.18.1") or die("Could not connect to AD server.");        //连接ad服务
    $set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);    //设置参数，这个目前还不了解。
        ldap_set_option ( $ldapconn, LDAP_OPT_REFERRALS, 0 ); 
    $ldap_bd = ldap_bind($ldapconn,"AppSystem","Semir@app");      
if ($ldap_bd) { 
    echo "Binding ..."; 
    
    $r=ldap_bind($ldapconn,"AppSystem","Semir@app");         // 匿名的 bind，为只读属性
    echo "Bind 返回 ".$r."<p>";
 $justthese = array("displayname","dn");
    $sr=ldap_search($ldapconn,"OU=森马集团,OU=Semir,dc=semir,dc=cn", "(&(objectClass=user)(!(UserPrincipalName= 'DC=Semir,DC=cn')))",$justthese,null, $sizelimit = 10);  
    echo "Search 返回 ".$sr."<p>";
    echo "S 开头的姓氏有 ".ldap_count_entries($ldapconn,$sr)." 个<p>";
    echo "取回姓氏资料 ...<p>";
    $info = ldap_get_entries($ldapconn, $sr);
    echo "资料返回 ".$info["count"]." 笔:<p>";
     print_r($info);
    for ($i=0; $i<$info["count"]; $i++) {
       
        echo $i;
        echo "dn 为: ". $info[$i]["dn"] ."<br>";
        echo "cn 为: ". $info[$i]["cn"][0] ."<br>";
        echo "email 为: ". $info[$i]["mail"][0] ."<p>";
    }
    echo "关闭链接";
    ldap_close($ldapconn);
} else {
    echo "<h4>无法连接到 LDAP 服务器</h4>";
}
?>
<h1>LDAP验证测试</h1>
<?php

header("Content-type:text/html;charset=utf-8");
error_reporting(0);




   $ldapconn = ldap_connect("10.90.18.1") or die("Could not connect to AD server.");        //连接ad服务
    $set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);    //设置参数，这个目前还不了解。
        ldap_set_option ( $ldapconn, LDAP_OPT_REFERRALS, 0 ); 
    $ldap_bd = ldap_bind($ldapconn,"AppSystem","Semir@app");                    //打开ldap，正确则返回true。登陆
     var_dump($ldap_bd);
    
      /////
 
        //echo "OK";
        $result = ldap_search($ldapconn,"OU=Semir,DC=Semir,DC=cn","(!(distinguishedname='dc=semir,dc=cn')))") or die ("Error in query");    //根据条件搜索，我这边搜索的是要查看ad域中是否有改字段。这是一个相当于or的搜索
        $info = ldap_get_entries($ldapconn, $result); //获取认证用户的信息
        var_dump($info);
        echo "您的相关信息：".$info[0]["distinguishedname"][0];
    
///////////////////////////
    
    
    
    
if(!$_POST){
?>
<form action="" method="post">
    name：<input name='name' type='text' /><br />
    password：<input name='password' type='password' type='text' /><br />
    <input type='submit' value='submit'/>
</form>
<?php
} else {
    // connect to AD server
    $ldapconn = ldap_connect("10.90.18.1") or die("Could not connect to AD server.");        //连接ad服务
    $set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);    //设置参数，这个目前还不了解。
        ldap_set_option ( $ldapconn, LDAP_OPT_REFERRALS, 0 ); 
    $ldap_bd = ldap_bind($ldapconn,"AppSystem","Semir@app");                    //打开ldap，正确则返回true。登陆
    var_dump($ldap_bd);
    $name = $_POST["name"] ? $_POST["name"]: "";                       //接受需要认证的用户名和密码
    $password = $_POST["password"] ? $_POST["password"]: "";
      echo $name."/".$password; 
    $bd = ldap_bind($ldapconn, $name.'@semir.cn', $password)  or die ('Username or password error! 123123123');            //验证用户名和密码。
  
 
 
    if($bd){
        //echo "OK";
        $result = ldap_search($ldapconn,"OU=Semir,DC=Semir,DC=cn","(|(CN=$name)(UserPrincipalName=$name))") or die ("Error in query");    //根据条件搜索，我这边搜索的是要查看ad域中是否有改字段。这是一个相当于or的搜索
        $info = ldap_get_entries($ldapconn, $result); //获取认证用户的信息
        echo "您的相关信息：".$info[0]["distinguishedname"][0];
    } else {
        echo "Username or password error!";
    }
    ldap_close($ldapconn);//关闭
}
?>