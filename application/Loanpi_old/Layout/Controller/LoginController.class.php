<?php

namespace Layout\Controller;

use Think\Controller;

class LoginController extends Controller {

//    protected function _initialize() {
//        parent::_initialize();
//    }

    public function index() {
       // $_SESSION['userid'] = '91082'; // '19837'; //33612=11CP1,19837=22DG1 
      
        if (session('userid') == false) {
            redirect('/');
        } else {
            $this->redirect('Register/index');
			$user = M('Localuser')->where(array('id' => $_SESSION['userid']))->find(); 
			$this->thisUser = $user;
        }
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Layout模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

// 登出
    public function loginout() {
        $_SESSION = array(); 
        if (empty($_SESSION)) {  
            $this->success('退出成功', U('/')); //$this->redirect('Admin/Main/index');
        }
    }

}
