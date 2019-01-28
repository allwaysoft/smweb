 
<?php

echo"sdfdf";
$code = @$_GET['code'];
echo $code;
$url = 'user/getuserinfo';
curl_get("code=$code", $url);

//if ($reQyh->errcode > 0) {
//    
//} else {
//    
//}

function qyh_gettoken() {
    $ch = curl_init();
    $timeout = 5;
    $corpid = "wx72c5185598d4f485";
    $corpsecret = "i0wNMv4524nLQecw7miMAb-7agXU2rFrNuhDQcBa6xgjHC6QwF97bCX_XigiTFom";
    curl_setopt($ch, CURLOPT_URL, 'https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=' . $corpid . '&corpsecret=' . $corpsecret);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    // curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
    $output = curl_exec($ch);
    curl_close($ch);
    // print_r($output);
    $return = json_decode($output);
    if ($return->access_token) {
        return $return->access_token;
    } else {
        echo "1";
        exit();
    }
}

function curl_post($data, $url) {
    $ch = curl_init();
    $timeout = 5;
    //  $code = json_encode($data);
    $code = json_encode($data, JSON_UNESCAPED_UNICODE);
    // $code = preg_replace("#\\\u([a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code);
    // print_r($code);
    // $aToken = qyh_gettoken();
    curl_setopt($ch, CURLOPT_URL, "https://qyapi.weixin.qq.com/cgi-bin/" . $url . "?access_token=" . qyh_gettoken());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $code);
    $file_contents = curl_exec($ch);
    curl_close($ch);
    //   print_r($file_contents);
    return $file_contents;
}

function curl_get($data, $url) {
    $ch = curl_init();

    //qyh_gettoken();
   // print_r("https://qyapi.weixin.qq.com/cgi-bin/" . $url . "?access_token=" . qyh_gettoken() . "&" . $data);
    curl_setopt($ch, CURLOPT_URL, "https://qyapi.weixin.qq.com/cgi-bin/" . $url . "?access_token=" . qyh_gettoken() . "&" . $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $file_contents = curl_exec($ch);
    var_dump($file_contents);
    curl_close($ch);
    var_dump($file_contents);
    $reQyh = json_decode($file_contents);
    var_dump($reQyh);
}
