<?php

namespace Admin\Common;

use Think\Controller;

class CheckAdminController extends Controller {

    public function __construct() {
        parent::__construct();
        if (session('admininfo') == false) { 
            $this->redirect('Login/index');
            exit;
        } 
        if(session('admininfo')){ 
            $this->adminUser = session('admininfo'); 
        }
    }


}

?>