<?php

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {

//    protected function _initialize() {
//        parent::_initialize();
//    }

    public function index() {
        if (session('mid') == false) {
            $this->display();
        } else {
            $this->redirect('Index/index');
        }
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Layout模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    // login
    public function checklogin() {
        $userid = $_POST['uname'];
        $password = $_POST['password']; 
        //$ip = get_client_ip(); // thinkphp 获取ip地址
        $ip = $_SERVER["HTTP_CDN_SRC_IP"]; // cdn加速后获取的真实IP地址
        $time = time();
        $admin = M('Loan_admin')->where(array('user_name' => $userid))->find();
        // 验证码不正确
        $logs = M('Loan_dmin_loginlogs');
        $logs->user_id = $admin['user_name'];
        $logs->time = $time;
        $logs->ip = $ip;
        $verify = new \Think\Verify();
      
        if (!$admin) {
            $logs->contents = '账号' . $userid . '不存在！';
            $logs->add();
            die('账号' . $userid . '不存在！');
        } elseif ($admin['state_id'] != 1) {
            $logs->contents = '账号' . $userid . '被锁定！';
            $logs->add();
            die('账号' . $userid . '被锁定！');
        } elseif ($admin['upwd'] != md5($password)) {
            $logs->contents = '账号' . $userid . '密码不正确！';
            $logs->add();
            die('账号' . $userid . '密码不正确！');
        } else {
            $logs->contents = '账号' . $userid . '登录成功！';
            $logs->add();
            M('Admin')->where(array('user_id' => $userid))->save(array('last_time' => $time));
            session('mid', $admin['id']);
            session('musername', $admin['user_name']);  
            session('cname', $admin['c_name']); 
            die('0');
        }
    }

// 登出
    public function loginout() {
        $_SESSION = array();
        if (empty($_SESSION)) {
            $this->success('退出成功', U('/')); //$this->redirect('Admin/Main/index');
        }
    }

}
