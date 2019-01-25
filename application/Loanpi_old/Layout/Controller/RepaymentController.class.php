<?php

namespace Layout\Controller;

//use Think\Controller;
use Layout\Common\CheckUserController;

class RepaymentController extends CheckUserController {

    protected function _initialize() {
        parent::_initialize();
        $this->PI = D('Pi', 'Service');
        $this->url = "Repayment";
        // 初始化数据& 更新审批状态
        //  $this->get_pi_reg();
    }

    public function index() {

        $this->display();
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Layout模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    /**
      +----------------------------------------------------------
     * 需还款List
      +----------------------------------------------------------
     */
    public function rep_list() {

        $where = " dl_code= '" . $this->thisUser['user_name'] . "' and (reg_status = 5 or reg_status = 6)";
        $list = D('Register')->result($where);
        if ($list) {
            for ($i = 0; $i < count($list); $i++) {
                //获取已经还款金额    
                $list[$i]['repTotal'] = $this->get_repay_total($list[$i]['sap_code']);
                //需要还款金额 
                $list[$i]['needTotal'] = $list[$i]['reg_amount'] - $list['repTotal'];
            }
        } else {
            $list = array();
        }
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
    }

    /**
      +----------------------------------------------------------
     * repayment history List
      +----------------------------------------------------------
     */
    public function history() {
        $this->display('Repayment_history');
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Layout模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    /**
      +----------------------------------------------------------
     * 需还款List
      +----------------------------------------------------------
     */
    public function history_list() {
        $where = " dl_code= '" . $this->thisUser['user_name'] . "' ";
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
     * 发起还款申请
      +----------------------------------------------------------
     */
    public function repay_add() {
        creatToken();
        $regId = I('get.reid');
        // load loan infor 
        $where = "id = " . $regId . " and dl_code= '" . $this->thisUser['user_name'] . "'";
        $regist = D('Register')->row($where);
		//print_r($regist);
        if ($regist) {
            //获取已经还款金额    
            $this->repTotal = $this->get_repay_total($regist['sap_code']);

            // 获取银行余额
            $data['dl_code'] = $this->thisUser['user_name'];
            $rePi = $this->PI->get_balance($data);
			//print_r($rePi);
            if ($rePi->MESS_FLAG == 'S') {
                $this->sapBalance = $rePi->LOAN_LIMIT;
            } else {
                $this->sapBalance = 0;
            }

            $need = $regist['reg_amount'] - $this->repTotal;
            if ($this->sapBalance > $need) {
                $this->jsVail = $need;
            } else {
                $this->jsVail = $this->sapBalance;
            }
            $this->loan = $regist;
			//echo '123132';
            $this->display('Repayment_add');
        } else {
            echo "2001: 请确认您的贷款信息！";
        }
    }

    public function repay_add_do() {
        $data = I('post.');
        if (!checkToken($data['TOKEN'])) {
            echo '1006: 请勿重复提交信息！！';
            return;
        }

        // 提交PI 
        $uData['dl_code'] = $this->thisUser['user_name'];
        $uData['sap_code'] = $data['sap_code'];
        $uData['rep_amount'] = $data['rep_amount'];
        $row = D('Register')->row("sap_code= '" . $data['sap_code'] . "'");
        $uData['rep_type'] = $data['rep_type'];
        $rePi = $this->PI->to_repayment($uData);
        //var_dump($rePi); 
        if ($rePi->MESS_FLAG == 'S') {
            // save to repayment 
            $data['sap_code'] = $rePi->LOAN_NUM;
            $data['sap_rep_code'] = $rePi->REPAY_NUM;
            $data['rep_status'] = 1;
            $data['dl_code'] = $this->thisUser['user_name'];

            $data['rep_amount'] = $data['rep_amount'];
            $data['rep_code'] = 'LH' . time();
            $data['rep_date'] = date("Y-m-d H:i:s");
            $reg = D('Repayment')->repAdd($data); // save ,return id,  
            echo 101;
        } else {
            $msg = $rePi->MESSAGE;
            echo $msg;
        }
        // log 记录
        $logs['user'] = $this->thisUser['user_name'];
        $logs['title'] = '还款申请';
        $logs['status'] = $rePi->MESS_FLAG;
        $logs['operating'] = json_encode($data);
        D('Weblog')->logAdd($logs);
    }

    /**
      +----------------------------------------------------------
     * 功能：获取已经还款总额
      +----------------------------------------------------------
     */
    public function get_repay_total($code) {
        if ($code) {
            $where = " dl_code= '" . $this->thisUser['user_name'] . "' and  sap_code = '" . $code . "' and rep_status = 1";
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

}
