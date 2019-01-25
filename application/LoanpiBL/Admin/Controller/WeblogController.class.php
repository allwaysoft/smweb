<?php

namespace Admin\Controller;

//use Think\Controller;
use Admin\Common\CheckAdminController;

class WeblogController extends CheckAdminController {

    public function index() {
        $this->display();
    }

    /*
     *  item list
     */

    public function weblog_list() {
        $where = "";
        $list = D('Weblog')->result();
        if ($list) {
        } else {
            $list = array();
        }
        //  print_r($list);
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
        $this->display();
    }

    /*
     *  
     */

    public function view_log() {
        $id = I('get.id');
        $where = "id = ".$id;
        $list = D('Weblog')->row($where); 
        if($list){
            $op = json_decode($list['operating']);
           // print_r($op);
        }
        //  print_r($list);
        $this->data = $list;
        $this->display();
    }

    /*
     *  
     */

    /**
      +----------------------------------------------------------
     * 功能：获取状态描述
      +----------------------------------------------------------
     */
    public function get_status_msg($v, $m) {
        switch ($v) {
            case 1:
                return '申请中';
            case 2:
                return '审批中';
            case 4:
                return '拒绝:' . $m;
            case 5:
                return ' 已审批'; // . $row->sap_msg;
            case 6:
                return ' 部分还款';
            case 8:
                return ' 全部还款 ';
            default:
                return '审批中';
        }
    }

}
