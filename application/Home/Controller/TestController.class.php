<?php

namespace Home\Controller;

use Think\Controller;
class TestController extends Controller{
	public function index(){
		header("Content-type: text/html; charset=utf-8");
		$url='http://w.semir.cn/index.php/Api/userinfo.html';
		$data=array(
			'key'=>'75a9fa05c26ec5fdf80d6b1ee555789f',
			'user_name'=>'11BJ1201',
			'password'=>'1238685'
		);
		$json=json_decode($this->api_notice_increment($url, $data));
		dump($json);
	}
	
function api_notice_increment($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$tmpInfo = curl_exec($ch);
		curl_close ( $ch );
		if (curl_errno($ch)) {
			return false;
		}else{

			return $tmpInfo;
		}
	} 
}

?>