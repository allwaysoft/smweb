<?php

namespace Admin\Controller;

//use Think\Controller;
use Admin\Common\CheckAdminController;

class IndexController extends CheckAdminController {

    public function index() {
        $this->redirect('Index/register');
    }

    /*
     * 获取贷款记录
     */

    public function register() {
        $this->url = "register";
        $this->display();
    }

    /*
     * 获取贷款记录
     */

    public function register_list() {

        $where = "";
        $list = D('Register')->result($where);
        if ($list) {
            for ($i = 0; $i < count($list); $i++) {
                // 获取状态描述
                $list[$i]['reg_status_msg'] = $this->get_status_msg($list[$i]['reg_status'],$list[$i]['sap_msg']);
                //获取已经还款金额    
                $list[$i]['repTotal'] = $this->get_repay_total($list[$i]['sap_code']);
            }
        } else {
            $list = array();
        }
        //print($row);
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
    }

    /*
     * 获取还款记录
     */

    public function view_repay() {
        $id = I('get.id');
        $regRow = D('Register')->row('id =' . $id);
        //  print_r($regRow); 
        if ($regRow) {
            $where = "sap_code = '" . $regRow['sap_code'] . "'";
            $result = D('Repayment')->result($where);
        } else {
            echo "2003：请确认请求的信息！";
        }
        $this->reginfo = $regRow;
        $this->list = $result;
        $this->display();
    }

    /*
     * 获取贷款审批状态
     */

    public function get_pi() {
        $id = I('get.id');
        $regRow = D('Register')->row('id =' . $id);
       // print_r($regRow);
        if ($regRow) {
            $data['dl_code'] = $regRow['dl_code'];
            $data['sap_code'] = $regRow['sap_code'];
            $data['reg_type'] = $regRow['reg_type'];
            //获取审批状态
            $this->Pii = D('Pii', 'Service');
            $revale = $this->Pii->get_loanstatus($data);
            
            if ($revale->MESS_FLAG == 'S') {

                $udata['id'] = $regRow['id'];
                $udata['reg_status'] = $revale->LOAN_STATUS;
                //   5 贷款已审批通过
                if ($revale->LOAN_STATUS == 5) {
                    // sap 审核成功
                    $udata['sap_start_time'] = $revale->LOAN_DATE_FROM;
                    $udata['sap_end_time'] = $revale->LOAN_DATE_TO;
                    $udata['sap_cycle'] = $revale->LOAN_CYCLE;
                    $udata['reg_amount'] = $revale->LOAN_AMOUNT;
                    $udata['sap_msg'] = $revale->LOAN_REASON;
                }
                //   5 贷款审批未通过
                if ($revale->LOAN_STATUS == 4) {
                    $udata['sap_msg'] = $revale->LOAN_REASON;
                }
                D('Register')->regUpdate($udata);
                $this->reginfo = $regRow;
                $this->data = $revale;
                $this->display();
            } else {
                echo "<p class='text-danger'>2004：获取PI信息错误：</p>";
                echo $revale->MESSAGE;
            }
        } else {
            echo "<p class='text-danger'>2003：请确认请求的信息！</p>";
        }
        // print_r($udata);
    }

    /**
      +----------------------------------------------------------
     * 功能：获取已经还款总额
      +----------------------------------------------------------
     */
    public function get_repay_total($code) {
        if ($code) {
            $where = "sap_code = '" . $code . "' and rep_status = 1";
            $result = D('Repayment')->total($where);
            if ($result) {
                return $result;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    /**
      +----------------------------------------------------------
     * repayment history List
      +----------------------------------------------------------
     */
    public function repayment() {
        $this->url = "repayment";
        $this->display('');
    }

    /**
      +----------------------------------------------------------
     * 需还款List
      +----------------------------------------------------------
     */
    public function repayment_list() {

        $where = "";
        $list = D('Repayment')->result($where);
        if ($list) {
            
        } else {
            $list = array();
        }
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
    }

    /**
      +----------------------------------------------------------
     * 功能：获取状态描述
      +----------------------------------------------------------
     */
    public function get_status_msg($v,$m) {
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
