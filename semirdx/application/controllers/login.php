<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->sysconfig_model->sysInfo();
    }

    function index() {
        
    }

    function login_set() {
		//echo "sdfsdf";
        $email = trim($this->input->post('login_email'));
        $pw = md5($this->input->post('login_password'));
		if (!$email || !$pw){
			echo "请输入登录帐号信息";
			exit();
		}
		//echo "sdfsdf";
        $where = "email = '".$email."' and password = '".$pw."'";
        $logType = $this->login_model->login($where);
        if ($logType) {
              //  redirect(site_url('register/account'));
                // $this->cismarty->display( $this->sysconfig_model->templates().'/admin/index.tpl');
            echo 1;
            } else {
             echo 0;
            }
        //echo "//";
    }
function login_zj() {
        $name = trim($this->input->post('zj_name'));
        $pw = trim($this->input->post('zj_pw'));
		if (!$name || !$pw){
			echo "请输入登录帐号信息";
			exit();
		}
        $where = "zj_name = '".$name."' and zj_pw = '".$pw."'";
        $logType = $this->login_model->login_set_zj($where);
        if ($logType) {
              //  redirect(site_url('register/account'));
                // $this->cismarty->display( $this->sysconfig_model->templates().'/admin/index.tpl');
            echo 1;
			
			// redirect(site_url('info/index/zjshengao'));
            } else {
             echo 0;
            }
        //echo "//";
    }
    function logout() {
        $this->session->sess_destroy();

        redirect(site_url('/'));
    }

}