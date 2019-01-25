<?php

namespace Admin\Service;

use Think\Model;

class TooaService extends Model {

    protected function _initialize() {
        parent::_initialize();
        $this->soapURL = "http://10.90.18.32:8081/webservice/PscReviewWebService?wsdl"; //http://10.90.6.15:8081/webservice/PscReviewWebService?wsdl
        //$this->soapLogin = Array('login' => "piappluser", 'password' => "vfr45tgb");
    }

    /*
     *  webservic API 调用
     */

    public function soap_pi($parameters) {
        $soapURL = $this->soapURL; // 
        //  $soapParameters = $this->soapLogin; 
        $soapClient = new \soapClient($soapURL);
        ////// 
        $soapFunction = "start"; // "MI_SW2SAP_Crd_Send";
        $soapFunctionParameters = $parameters;
        ///
        return $soapClient->$soapFunction($soapFunctionParameters);
    }

    /*
     * 400 to OA
     * 
     */

    public function Sw400_toOA($data) {
        $data['add_time'] = date('Y-m-d H:i:s', $data['add_time']);
        if ($data['sale_time']) { 
        } else {
            $data['sale_time'] = '';
        }
         
        $toData['docSubject'] = $data['type']." - " . $data['agent_storename'] . ' ' . $data['style_id'] . ' ' . $data['com_type']; // 投诉类别+店名+
        $toData['code'] = 400; // OA 流程编号
        $toData['fdLoginName'] = $data['com_user']; //$data['com_user']; // OA账号=客服登陆名
        $toData['formJson'] = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // 投诉信息
        $soapFunctionParameters = $toData;
        $reData = $this->soap_pi($soapFunctionParameters);
        return $reData;
    }

}

?>