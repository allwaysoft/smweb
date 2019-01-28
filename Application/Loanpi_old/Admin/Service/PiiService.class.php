<?php

namespace Admin\Service;

use Think\Model;

class PiiService extends Model {

    protected function _initialize() {
        parent::_initialize();
    }

    /*
     * 获取贷款审批状态
      AGENT_CODE	代理商编号
      LOAN_NUM	贷款编号
     */

    public function get_loanstatus($data) {
        $reData = array('LOAN_STATUS' => 0, 'LOAN_REASON' => '审批通过', 'LOAN_DATE_FROM' => '2016-09-01', 'LOAN_DATE_TO' => '2016-09-11', 'LOAN_CYCLE' => 10, 'LOAN_AMOUNT' => 20);
        return $reData;
    }

    /*
     * 获取可贷款天数
     * AGENT_CODE	代理商编号
      LOAN_DATE_FROM	贷款起始日期
     */

    public function get_date($data) {
        return 55;
    }

    /*
     * 获取可贷款金额
      AGENT_CODE	代理商编号
      LOAN_DATE_FROM	贷款起始日期
     */

    public function get_limit($data) {
        return 77;
    }

    /*
     * 获取银行余额金额
     * AGENT_CODE	代理商编号
      LOAN_DATE_FROM	贷款起始日期
     */

    public function get_balance($data) {
        return 10;
    }

    /*
     * 贷款申请
      AGENT_CODE	代理商编号
      LOAN_DATE_FROM	贷款起始日期
      LOAN_CYCLE	贷款天数
      LOAN_AMOUNT	贷款金额
     */

    public function to_register($data) {
        $reData = array('code' => 0, 'sap_code' => 'SAP-' . time());
        return $reData;
    }

    /*
     * 还款申请
      AGENT_CODE	代理商编号
      LOAN_NUM	        贷款编号
      REPAY_AMOUNT	还款金额
     */

    public function to_repayment($data) {
        $reData = array('code' => 0, 'sap_rep_code' => 'H' . time(), 'rep_status' => 1);
        return $reData;
    }

}

?>