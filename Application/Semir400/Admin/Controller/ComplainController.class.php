<?php

namespace Admin\Controller;

//use Think\Controller;
use Admin\Common\CheckAdminController;

class ComplainController extends CheckAdminController {

    public function __construct() {
        parent::__construct();
        define('RES', '/Tpl/Semir400');
    }

    protected function _initialize() {
        $this->url = "user";
    }

    public function index() {

        $this->display();
    }

    

}
