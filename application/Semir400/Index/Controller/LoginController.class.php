<?php
namespace Index\Controller;

use Think\Controller;
class LoginController extends Controller
{
    // 登出
    public function loginout() {
        $_SESSION = array();
        if (empty($_SESSION)) {
            $this->success('退出成功', U('/')); //$this->redirect('Admin/Main/index');
        }
    }
}

?>