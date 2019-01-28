<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;

class EmailController extends UserController {

    public $area;
    var $auth_key = "api@semir.com";
    var $auth_secret = 'd919eaa118634ff9ecdcca8f34dadba5';
    var $host_name = 'http://10.90.18.21'; //http://10.90.18.21
    var $domain = 'semir.com';

    public function _initialize() {
        parent::_initialize();
        $this->_auth_timestamp = time();
        $this->_auth_signature = md5($this->auth_secret . $this->auth_key . time());
    }

    public function login() {
        //  echo $_SESSION['user_name'];
        if ($_SESSION['user_name']) {
            $userTemp = M('Localuser')->where(array('user_name' => $_SESSION['user_name']))->find();
            // print_r($userTemp);
            //  echo $userTemp['user_type'];
            // exit();
            if ($userTemp['user_type'] == 1) {
                $email = $_SESSION['user_name'] . "@semir.com";
            } elseif ($userTemp['user_type'] == 2) {
                header("Content-type: text/html; charset=utf-8");
                echo "此用户名无企业邮箱<br> 企业邮箱只有代理商 或 公司员工可以登录！";
                exit();
            } else {
                $email = $userTemp['email'];
            }
            $token = $this->get_token($email);
            $loginSignature = md5($this->auth_secret . $this->auth_key . time() . $email . $token);
            //echo $loginSignature;
            $data = "auth_type=auth&auth_key=" . rawurlencode($this->auth_key) . "&auth_timestamp=" . rawurlencode($this->_auth_timestamp) . "&auth_token=" . rawurlencode($token) . "&email=" . rawurlencode($email) . "&auth_signature=" . $loginSignature;
            //data = "auth_type=simple&auth_key=" . rawurlencode($this->auth_key) . "&auth_timestamp=" . rawurlencode($this->_auth_timestamp) . "&email=" . rawurlencode($email) . "&auth_signature=" . $this->_auth_signature;        
            // echo $data;
            redirect($this->host_name . '/api/sso/login?' . $data);
            exit();
        } else {
            echo "请重新登陆系统！！！";
        }
    }

    //  
    function get_token($email) {
        //$email = "lizhendong@semir.com";
        $data = "auth_key=" . $this->auth_key . "&auth_timestamp=" . $this->_auth_timestamp . "&auth_signature=" . $this->_auth_signature . "&email=" . $email;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $this->host_name . '/api/service/auth/get_token');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}

?>