<?php

namespace Admin\Service;

use Think\Model;

class PiiService extends Model {

    protected function _initialize() {
        parent::_initialize();
        $this->soapURL = "http://w.semir.cn/MI_SW2SAP_Crd_Send.wsdl"; //"http://localhost:8082/MI_OA2SAP_Psc_Send.wsdl"; //
        $this->soapLogin = Array('login' => "piappluser", 'password' => "vfr45tgb");
    }

    /*
     *  webservic API 调用
     */

    public function soap_pi($parameters) {
        $soapURL = $this->soapURL; //"http://localhost:8082/MI_OA2SAP_Psc_Send.wsdl"; //
        $soapParameters = $this->soapLogin;
        // $soapParameters = Array('login' => "zhangtingt", 'password' => "900123456"); 
        $soapClient = new \soapClient($soapURL, $soapParameters);
        //////
        $soapFunction = "MI_SW2SAP_Crd_Send"; // "MI_SW2SAP_Crd_Send";
        $soapFunctionParameters = $parameters;
        ///
        return $soapClient->$soapFunction($soapFunctionParameters);
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

}

?>