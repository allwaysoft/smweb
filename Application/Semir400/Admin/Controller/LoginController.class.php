<?php

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
        define('RES', '/Tpl/Semir400');
    }

//    public function _initialize() {
//        parent::_initialize();
//        define('RES', '/Tpl/Semir400');
//    }

    public function index() {
        if (session('mid') == false) {
            $this->display();
        } else {
            $this->redirect('Index/quality');
        }
    }

    // login
    public function checklogin() {
        $user_type = $_POST['user_type'];
        $userid = $_POST['uname'];
        $password = $_POST['password'];
        $ip = $_SERVER["HTTP_CDN_SRC_IP"]; // cdn加速后获取的真实IP地址
        $time = time();
        if ($user_type == 1) {
            //客服
            $staff = M('400_user_staff')->where(array('user_name' => $userid))->find();
            if (!$staff) {
                $data['info'] = '账号' . $userid . '不存在！';
                $data['status'] = false;
            } elseif ($staff['status'] == 2) {
                $data['info'] = '账号' . $userid . '被锁定';
                $data['status'] = false;
            } elseif ($staff['upwd'] != md5($password)) {
                $data['info'] = '账号' . $userid . '密码不正确！';
                $data['status'] = false;
            } else {
                M('400_user_staff')->where(array('user_name' => $userid))->save(array('last_time' => time()));
                session('staffinfo', $staff);
                $data['info'] = '登录成功';
                $data['status'] = true;
                $data['url'] = U('Staff/quality');
            }
            $this->ajaxReturn($data, 'json');
        } elseif ($user_type == 2) {
            //管理员
            //客服
            $admin = M('400_admin')->where(array('user_name' => $userid))->find();
            if (!$admin) {
                $data['info'] = '账号' . $userid . '不存在！';
                $data['status'] = false;
            } elseif ($admin['status'] == 2) {
                $data['info'] = '账号' . $userid . '被锁定';
                $data['status'] = false;
            } elseif ($admin['upwd'] != md5($password)) {
                $data['info'] = '账号' . $userid . '密码不正确！';
                $data['status'] = false;
            } else {
                session('admininfo', $admin);
                $data['info'] = '登录成功';
                $data['status'] = true;
                $data['url'] = U('Index/index');
            }
            $this->ajaxReturn($data, 'json');
        }
    }

    public function cg_pw() {
        if (session('admininfo') == false) {
            echo "3003：无权修改！";
        } else {
            $this->user = $_SESSION['admininfo'];
            $this->display();
        }
    }

    public function cg_pw_do() {
        if (session('admininfo') == false) {
            echo "3003：无权修改！";
        } else {
            $db = M('400_admin');
            $pwd = $db->where(array('id' => $_POST['id']))->find();
            $pass = $_POST['old_password'];
            if ($pwd['upwd'] != md5($pass)) {
                echo '3005:原密码不正确，请重新输入';
            } else {
                $data = array(
                    'upwd' => md5($_POST['password']),
                );
                $id = $db->where(array('id' => $_POST['id']))->save($data);
                if ($id) {
                    echo 0;
                } else {
                    echo '3004:原密码不正确，请重新输入';
                }
            }
        }
    }

    // staff change password
    public function cg_spw() {
        if (session('staffinfo') == false) {
            echo "3003：无权修改！";
        } else {
            $this->user = $_SESSION['staffinfo'];
            $this->display();
        }
    }

    public function cg_spw_do() {
        if (session('staffinfo') == false) {
            echo "3003：无权修改！";
        } else {
            $db = M('400_user_staff');
            $pwd = $db->where(array('id' => $_POST['id']))->find();
            $pass = $_POST['old_password'];
            if ($pwd['upwd'] != md5($pass)) {
                echo '3005:原密码不正确，请重新输入';
            } else {
                $data = array(
                    'upwd' => md5($_POST['password']),
                );
                $id = $db->where(array('id' => $_POST['id']))->save($data);
                if ($id) {
                  //  echo $db->getError();
                    echo 0;
                } else {
                    echo '3004:原密码不正确，请重新输入';
                }
            }
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
