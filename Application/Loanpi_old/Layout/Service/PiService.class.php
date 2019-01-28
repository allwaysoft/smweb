<?php

namespace Layout\Service;

use Think\Model;

class PiService extends Model {

    protected function _initialize() {
        parent::_initialize();
        $this->soapURL = "./MI_SW2SAP_Crd_Send.wsdl"; //"http://localhost:8082/MI_SW2SAP_Crd_Send.wsdl"; //
        $this->soapLogin = Array('login' => "piappluser", 'password' => "vfr45tgb");
    }

    /*
     *  webservic API 调用
     */

    public function soap_pi($parameters) {
        $soapURL = $this->soapURL; // 
        $soapParameters = $this->soapLogin;
        // $soapParameters = Array('login' => "zhangtingt", 'password' => "900123456"); 
        $soapClient = new \soapClient($soapURL, $soapParameters);
        //////
       //  print_r($soapClient);
     ///    print_r(function_exists("debug_message"));
        $soapFunction = "MI_SW2SAP_Crd_Send"; // "MI_SW2SAP_Crd_Send";
        $soapFunctionParameters = $parameters;
        ///
        $reData =  $soapClient->$soapFunction($soapFunctionParameters);
		//pirnt_r($reData);
		return $reData;
    }

    /*
     * 获取贷款审批状态
      AGENT_CODE	代理商编号
      LOAN_NUM	贷款编号
      LOAN_TYPE 贷款类别：N=日常，S=特殊
     * type     接口类别  1 = 贷款额度获取接口 2 = 贷款申请提交接口 3 = 贷款审核状态获取接口 4 = 还款提交接口 
     * 
     */

    public function get_loanstatus($data) {
        //$soapFunctionParameters = Array('AGENT_CODE' => "1UHB1", 'LOAN_NUM' => "20161020", 'LOAN_TYPE' => 'N', 'type' => '3');
        $soapFunctionParameters = Array('AGENT_CODE' => $data['dl_code'], 'LOAN_NUM' => $data['sap_code'], 'LOAN_TYPE' => $data['reg_type'], 'type' => '3');
        $reData = $this->soap_pi($soapFunctionParameters);
        return $reData;
    }

    /*
     * 贷款期限及申请额度查询
     * AGENT_CODE	代理商编号
      LOAN_DATE_FROM	贷款起始日期
      LOAN_TYPE         贷款类别：N=日常，S=特殊
     * type     接口类别  1 = 贷款额度获取接口 2 = 贷款申请提交接口 3 = 贷款审核状态获取接口 4 = 还款提交接口 
     */

    public function get_limit($data) {
        // $soapFunctionParameters = Array('AGENT_CODE' => "11PG1", 'LOAN_DATE_FROM' => "20161020", 'LOAN_TYPE' => 'N', 'type' => '1');
        $soapFunctionParameters = Array('AGENT_CODE' => $data['dl_code'], 'LOAN_DATE_FROM' => date('Ymd', strtotime($data['reg_date'])), 'LOAN_TYPE' => $data['reg_type'], 'type' => '1');
        $reData = $this->soap_pi($soapFunctionParameters);
        return $reData;
    }

    /*
     * 获取银行余额金额
      AGENT_CODE	代理商编号
     */

    public function get_balance($data) {
        $soapFunctionParameters = Array('AGENT_CODE' => $data['dl_code'], 'type' => '5');
        $reData = $this->soap_pi($soapFunctionParameters);
        return $reData;
    }

    /*
     * 贷款申请
      AGENT_CODE	代理商编号
      LOAN_DATE_FROM	贷款起始日期
      LOAN_CYCLE	贷款天数
      LOAN_AMOUNT	贷款金额
      LOAN_TYPE         贷款类别：N=日常，S=特殊
      type     接口类别  1 = 贷款额度获取接口 2 = 贷款申请提交接口 3 = 贷款审核状态获取接口 4 = 还款提交接口
     */

    public function to_register($data) {
        $soapFunctionParameters = Array('AGENT_CODE' => $data['dl_code'], 'LOAN_DATE_FROM' => date('Ymd', strtotime($data['reg_start_time'])), 'LOAN_CYCLE' => $data['reg_cycle'], 'LOAN_AMOUNT' => $data['reg_amount'], 'LOAN_TYPE' => $data['type'], 'type' => '2');
        $reData = $this->soap_pi($soapFunctionParameters);
        return $reData;
    }

    /*
     * 还款申请
      AGENT_CODE	代理商编号
      LOAN_NUM	        贷款编号
      REPAY_AMOUNT	还款金额
      LOAN_TYPE         贷款类别：N=日常，S=特殊
      type     接口类别  1 = 贷款额度获取接口 2 = 贷款申请提交接口 3 = 贷款审核状态获取接口 4 = 还款提交接口
     */

    public function to_repayment($data) {
        $soapFunctionParameters = Array('AGENT_CODE' =>  $data['dl_code'], 'LOAN_NUM' => $data['sap_code'],  'REPAY_AMOUNT' => $data['rep_amount'], 'LOAN_TYPE' => $data['rep_type'], 'type' => '4'); // 还款申请
        $reData = $this->soap_pi($soapFunctionParameters);
        return $reData;
    }

    /**
      +----------------------------------------------------------
     * 功能：PI webservice testing 
      +----------------------------------------------------------
     */
    function soaptest() {
        //testing  soap
        /////////////////////
        return $this->soapURL;
        exit;
        $soapURL = "http://localhost:8082/MI_SW2SAP_Crd_Send.wsdl";
        // $soapParameters = Array('login' => "piappluser", 'password' => "vfr45tgb");
        $soapParameters = Array('login' => "zhangtingting", 'password' => "900123456");
        $soapFunction = "MI_SW2SAP_Crd_Send";
        $soapFunctionParameters = Array('AGENT_CODE' => "1UHB1", 'LOAN_DATE_FROM' => "20161020", 'LOAN_TYPE' => 'N', 'type' => '1');

        $soapClient = new \soapClient($soapURL, $soapParameters);
        print_r($soapClient);
        $soapResult = $soapClient->__soapCall($soapFunction, $soapFunctionParameters);
        print_r($soapResult);
        if (is_array($soapResult) && isset($soapResult['MI_SW2SAP_Crd_Send'])) {
            // Process result.
            print_r($soapResult);
        } else {
            // Unexpected result
            if (function_exists("debug_message")) {
                debug_message("Unexpected soapResult for {$soapFunction}: " . print_r($soapResult, TRUE));
            }
        }
        ////////////////////////


        echo '</pre>';   /* */
        exit;
        echo '<br><br><br><br><br><br><pre>';
        print_r($result);
        echo "end remote 。。。<br />";
        echo '<pre>';
        print_r($client->__getFunctions()); // 获取webservice提供的函数
        echo '</pre>';   /* */
    }

}

?>