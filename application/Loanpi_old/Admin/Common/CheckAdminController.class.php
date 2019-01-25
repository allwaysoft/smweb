<?php

namespace Admin\Common;

use Think\Controller;

class CheckAdminController extends Controller {

    public function __construct() {
        parent::__construct();
        if (session('mid') == false) { 
            $this->redirect('Login/index');
        } else {
            $user = M('Loan_admin')->where(array('id' => $_SESSION['mid']))->find();
            $this->adminUser = $user; 
        }
    }

//    protected function _initialize() {
//        parent::_initialize();
//        
//    }
}

?>