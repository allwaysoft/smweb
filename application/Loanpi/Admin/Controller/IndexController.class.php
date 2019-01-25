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
                $list[$i]['reg_status_msg'] = $this->get_status_msg($list[$i]['reg_status'], $list[$i]['sap_msg']);
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
     * 获取所以对账函
     */

    public function statement() {
        $this->url = "statement";
        $this->display();
    }

    public function statement_grid() {
        $time = time() - 15552000;
        $yb = date('Y-m-d', $time);
        $where = "";
        $list = D('Statement')->result($where);
        //print_r($list);
        if ($list) {
            
        } else {
            $list = array();
        }
        // print($list);
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
    }

    public function statement_view() {
        $id = I('get.p');
        $where = "id = " . $id . "  ";
        $list = D('Statement')->row($where);
        if ($list) {
            $list['agent_arar'] = number_format($list['agent_arar'], 2, '.', ',');
            $list['agent_arcr'] = number_format($list['agent_arcr'], 2, '.', ',');
            $list['agent_dkar'] = number_format($list['agent_dkar'], 2, '.', ',');
            $list['agent_dkcr'] = number_format($list['agent_dkcr'], 2, '.', ',');
            $list['agent_otap'] = number_format($list['agent_otap'], 2, '.', ',');
            $list['agent_otcr'] = number_format($list['agent_otcr'], 2, '.', ',');
            $this->data = $list;
            $this->display();
        } else {
            echo "暂无信息！";
        }
    }

    public function statement_log() {
        $this->url = "statement";
        $this->display();
    }

    /*
     *  item list
     */

    public function statement_log_list() {
        $where = "";
        $list = D('Statement')->log_result();
        if ($list) {
            
        } else {
            $list = array();
        }
        //  print_r($list);
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
        $this->display();
    }

    public function statement_log_row() {
        $this->url = "statement";
        $this->id = I('get.id');
        $this->display();
    }

    /*
     * 解析对账函的数组信息并判断是否导入
     */

    public function statement_log_row_list() {
        $id = I('get.id');
        $where = "id = " . $id . "  ";
        $list = '';
        $rowLog = D('Statement')->log_row($where);
        if ($rowLog) {
            $item = json_decode($rowLog['operating']);
            $ar = 1;

            /// 在这里判断value是不是数组，是的话，说明是2维
            foreach ($item as $row) {
                if (is_object($row)) {
                    $ar = 2;
                }
            }
            if ($ar == 1) {
                $list[] = $item;
            } else {
                $list = $item;
            }
            // 判断对账函是否导入成功
            foreach ($list as $rowd) {
                $where = "pi_id = " . $rowd->ID . " and agent_kpt = '" . $rowd->AGENT_KPF . "'";
                $stRow = D('Statement')->row($where);
                if ($stRow) {
                    $rowd->status = 1;
                } else {
                    $rowd->status = 0;
                }
            }
        }

     //   print_r($list);
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
    }
 /**
      +----------------------------------------------------------
     *   推送对账函
     *   由 FromPi.class.php 远程调用
      +----------------------------------------------------------
     */
    function UpStatementToLocalDo() {
        $row = I('post.');
        $upData['pi_id'] = $row['ID'];
        $upData['agent_code'] = $row['AGENT_CODE'];
        $upData['agent_kpt'] = $row['AGENT_KPF'];
        $upData['agent_name'] = $row['NAME1'];
        $upData['date_from'] = $row['DATE_FROM'];
        $upData['date_to'] = $row['DATE_TO'];
        $upData['date_run'] = $row['DATE_RUN'];
        $upData['agent_arar'] = $row['ARAR'];
        $upData['agent_arcr'] = $row['ARCR'];
        $upData['agent_dkar'] = $row['DKAR'];
        $upData['agent_dkcr'] = $row['DKCR'];
        $upData['agent_otap'] = $row['OTAP'];
        $upData['agent_otcr'] = $row['OTCR']; 
        $where = "pi_id = '" . $upData['pi_id'] . "'  ";
        $list = D('Statement')->row($where);

        if ($list) {
           echo 0; 
        } else {
            $reDate = D('Statement')->stAdd($upData);
            if ($reDate) {
                echo 0; 
            } else {
                echo '4002：推送失败，请确认推送的信息！'; 
            }
        } 
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
