<?php

namespace Admin\Common;

use Think\Controller;

class CheckStaffController extends Controller {

    public function __construct() {
        parent::__construct();
        if (session('staffinfo') == false ) { 
            $this->redirect('Login/index'); 
        } else { 
            $this->staffinfo = session('staffinfo'); 
        }
    }


}

?>