<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->sysconfig_model->sysInfo(); // set sysInfo
    }

    function menu_top() {
//        $records = array();
//        $menut = $this->menu_model->get_menu_by('parent_id = 0 and show_type =1');
//        foreach ($menut as $row) {
//            $row->menuTh = $this->menu_model->get_menu_by('parent_id =' . $row->id);
//            $records[] = $row;
//        }
//        return $records;
        $this->sysconfig_model->menu_all('show_type =1');
    }

    function index() {

        //echo "77";
        //print_r($data['menuTop']);
        $this->load->model('homepage_model');
        $t = FALSE;
        $data['bannerPics'] = $this->homepage_model->get_homePics($t);

        //$data['page_title'] = '';
        // print_r($data['menu']);
        // $this->cismarty->assign("menuTop", $data['menuTop']);
        $this->cismarty->assign("pageInfo", "");
        $this->cismarty->assign("data", $data);
        $this->cismarty->display($this->sysconfig_model->templates() . '/index.tpl');
         print_r($_SERVER['HTTP_USER_AGENT']);
        //echo $_SERVER["HTTP_REFERER"];
        // print_r($_GET);
         
    }
    
    function eindex() {
    	
    	//print_r($data['menuTop']);
    	$this->load->model('homepage_model');
    	$t = FALSE;
    	$data['bannerPics'] = $this->homepage_model->get_ehomePics($t);
    	
    	//$data['page_title'] = '';
    	// print_r($data['menu']);
    	// $this->cismarty->assign("menuTop", $data['menuTop']);
    	$this->cismarty->assign("pageInfo", "");
    	$this->cismarty->assign("data", $data);
    	$this->cismarty->display($this->sysconfig_model->templates() . '/eindex.tpl');
    	//print_r($_SERVER['HTTP_USER_AGENT']);
    	//echo $_SERVER["HTTP_REFERER"];
    	// print_r($_GET);
    }

    function get_sww_news() {
        $this->load->model('homepage_model');
        $data['news'] = $this->homepage_model->get_shangwu_news(5, 0, 'type_id = 39');
        $this->cismarty->assign("data", $data);
        $this->cismarty->display($this->sysconfig_model->templates() . '/sww_news.tpl');
    }

    function get_sww_newInfo() {
        $id = $this->uri->segment(3);
        $this->load->model('homepage_model');
        $data = $this->homepage_model->get_shangwu_newinfo('id = ' . $id);
        if ($data) {
            $data->contents = str_replace("/Public/admin/js/kindeditor/attached/image/", "http://w.semir.cn/Public/admin/js/kindeditor/attached/image/", $data->contents);
        }
        //  print_r($data);
        $this->cismarty->assign("data", $data);
        $this->cismarty->display($this->sysconfig_model->templates() . '/sww_news_info.tpl');
    }

}
