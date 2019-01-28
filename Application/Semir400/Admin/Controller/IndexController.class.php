<?php

namespace Admin\Controller;

//use Think\Controller;
use Admin\Common\CheckAdminController;

class IndexController extends CheckAdminController {

    public function __construct() {
        parent::__construct();
        define('RES', '/Tpl/Semir400');
    }

    public function index() {
        // service tatol 
        $this->servtotal = M('400_service')->count();
        $this->servtotal_1 = M('400_service')->where('com_status = 1')->count();
        $this->servtotal_2 = M('400_service')->where('com_status = 2')->count();
        $this->servtotal_3 = M('400_service')->where('com_status = 3')->count();
         // quality tatol 
        $this->qualtotal = M('400_quality')->count();
        $this->qualtotal_1 = M('400_quality')->where('com_status = 1')->count();
        $this->qualtotal_2 = M('400_quality')->where('com_status = 2')->count();
        $this->qualtotal_3 = M('400_quality')->where('com_status = 3')->count();
         // service tatol 
        $this->terminaltotal = M('400_terminal')->count();
        $this->terminaltotal_1 = M('400_terminal')->where('com_status = 1')->count();
        $this->terminaltotal_2 = M('400_terminal')->where('com_status = 2')->count();
        $this->terminaltotal_3 = M('400_terminal')->where('com_status = 3')->count();
        $this->display();
    }

    /*
     * 获取贷款记录
     */
}
