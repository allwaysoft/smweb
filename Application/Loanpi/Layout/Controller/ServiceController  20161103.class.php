<?php

namespace Layout\Controller;

use Think\Controller;

//use Service\Common\CheckUserController;
/*
 * web service  for PI
 * 
 */
class ServiceController extends Controller {

    public function index() {
        
    }

    /**
      +----------------------------------------------------------
     *  WSDL API 更新审批状态
      +----------------------------------------------------------
     */
    public function upstatusdo() {
        ////  
        //  header("Content-Type:text/html;charset=utf-8");
        //server.php文件
        include("/Application/Loanpi/Layout/Service/FromPI.class.php");
        ini_set("soap.wsdl_cache_enabled", "0"); ////测试时打开防止soap缓存
        $server = new \SoapServer('./UpStatusFromPi.wsdl'); ##此处的Service.wsdl文件是上面生成的, array('soap_version' => SOAP_1_2) 
		$server->setClass('FromPI'); //注册Service类的所有方法   
        $server->handle(); //处理请求   
       //  $logs['user'] = 'FromPI';
      //   $logs['title'] = 'API接口调用';
        // $logs['status'] = '调用成功';
       //  $logs['operating'] = 'TESTING';
       //   D('Weblog')->logAdd($logs);
    }

    /**
      +----------------------------------------------------------
     *   更新审批状态 
     * 由 FromPi.class.php 远程调用
      +----------------------------------------------------------
     */
    public function UpStatusToLocal() {
        $data = I('post.');
        if ($data['AGENT_CODE'] && $data['LOAN_NUM']) {
            $where = "dl_code= '" . $data['AGENT_CODE'] . "' and sap_code = '" . $data['LOAN_NUM'] . "'";
            $list = D('Register')->row($where);
            if ($list) {
                $udata = '';
                $udata['id'] = $list['id'];
                $udata['reg_status'] = $data['LOAN_STATUS'];
                $udata['sap_msg'] = $data['LOAN_REASON'];
                //   5 贷款已审批通过
                if ($data['LOAN_STATUS'] == 5) {
                    // sap 审核成功
                    $udata['sap_start_time'] = $data['LOAN_DATE_FROM'];
                    $udata['sap_end_time'] = $data['LOAN_DATE_TO'];
                    $udata['sap_cycle'] = $data['LOAN_CYCLE'];
					//换算为万元
                    $udata['reg_amount'] = round($data['LOAN_AMOUNT']/10000,2);
                }
                //   5 贷款审批未通过
                if ($data['LOAN_STATUS'] == 4) {
                    $udata['sap_msg'] = $data['LOAN_REASON'];
                }
                $regUp = D('Register')->regUpdate($udata);
                $res['val'] = 1;
                $res['msg'] = 'Update Successs!!';
                //    return  $data; //$data->AGENT_CODE,$data->LOAN_AMOUNT
                // $result = array('MESS_FLAG' => 'sdf', 'MESSAGE' => 'sdfsdfsdf');
                //  $result = json_encode($result);
            } else {
                $res['val'] = 0;
                $res['msg'] = "4002";//不存在此编号";
            }
        } else {
            $res['val'] = 0;
            $res['msg'] = "4001";//:参数错误代理商编号或贷款编号不能为空";
        }
        echo json_encode($res);
	//	return;
	   // exit;    // 如果开启调试模式,请注销下面代码.
        $logs['user'] = 'FromPI';
        $logs['title'] = '贷款状态更新';
        if ($res['val'] == 1) {
            $logs['status'] = '更新成功';
        } else {
            $logs['status'] = '更新失败';
            $data['error'] = $res['msg'];
        }
        $logs['operating'] = json_encode($data);
        D('Weblog')->logAdd($logs);
    }

    /**
      +----------------------------------------------------------
     * 功能：PI webservice testing 
      +----------------------------------------------------------
     */
    function soaptest() {
        header("Content-Type:text/html;charset=utf-8");
        /////////////////////////////////////////////////////////
        //testing  soap
        /////////////////////
        $soapURL = "http://10.192.1.11/UpStatusFromPi.wsdl"; //"http://localhost:8082/MI_OA2SAP_Psc_Send.wsdl"; //
        //  $soapParameters = Array('login' => "piappluser", 'password' => "vfr45tgb");
        // $soapParameters = Array('login' => "zhangtingt", 'password' => "900123456");
        //  vendor('nusoap.nusoap');
        // import('Vendor.nusoap.nusoap');
        $soap = new \SoapClient($soapURL); //nusoap_client
        // print_r($soap);
       // print_r($soap->__getFunctions());
        //  echo $soap->debug_str;
        $params = array('AGENT_CODE' => '22DG1', 'LOAN_NUM' => '0000000008', 'LOAN_TYPE' => 'S', 'LOAN_TYPE' => 'S', 'LOAN_STATUS' => '5', 'LOAN_REASON' => 'Ssss', 'LOAN_DATE_FROM' => '20160505', 'LOAN_DATE_TO' => '20160909', 'LOAN_CYCLE' => '30', 'LOAN_AMOUNT' => '10000', 'YL1' => '', 'YL2' => '', 'YL3' => '', 'YL4' => '', 'YL5' => '');
        print_r($soap->UpStatusDo($params));
        // $array = $soap->__soapCall('UpStatusDo', $params);
//print_r(get_object_vars($array));
        //var_dump($array); 
        exit;
        //print_r($soapClient);
        //////
        print_r($soapClient->__getFunctions());
        print_r($soapClient->__getTypes());
        $soapFunction = "MI_SW2SAP_Crd_Send"; // "MI_SW2SAP_Crd_Send";
        $soapFunctionParameters = Array('AGENT_CODE' => "11CP1", 'LOAN_DATE_FROM' => "20161020", 'LOAN_CYCLE' => '30', 'LOAN_AMOUNT' => '300', 'LOAN_TYPE' => 'N', 'type' => '2'); //贷款申请
        //$soapFunctionParameters = Array('AGENT_CODE' => "11CP1A003", 'LOAN_DATE_FROM' => "20160919", 'LOAN_CYCLE' => '41', 'LOAN_AMOUNT' => '10000', 'LOAN_TYPE' => 'S', 'type' => '2'); // 日常贷款期限及申请额度查询
        // $soapFunctionParameters = Array('AGENT_CODE' => "22DG1", 'LOAN_DATE_FROM' => "20160920", 'LOAN_TYPE' => 'N', 'type' => '1');  // 贷款期限及申请额度查询
        $soapFunctionParameters = Array('AGENT_CODE' => "22DG1", 'LOAN_NUM' => "0000000123", 'LOAN_TYPE' => 'N', 'type' => '3'); //贷款审核状态获取接口 
        //  $soapFunctionParameters = Array('AGENT_CODE' => "11CP1", 'LOAN_NUM' => "0000000031", 'REPAY_AMOUNT' => '300', 'LOAN_TYPE' => 'S', 'type' => '4'); // 还款申请
        $soapFunctionParameters = Array('type' => '5', 'AGENT_CODE' => "22DG1"); //银行余额获取
        $soapResult = $soapClient->$soapFunction($soapFunctionParameters);
        // $soapResult = $soapClient->__soapCall($soapFunction, $xml);

        echo "<br>";
        print_r($soapResult);
        echo "//////////////<br>";
        echo "Unexpected soapResult for {$soapFunction}: " . print_r($soapResult, TRUE);
        exit;
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
        echo '<pre>';
        print_r($soapClient->__getFunctions());
        // print_r($soapClient->__getTypes());  
        //  print_r($soapClient->__getFunctions()); // 获取webservice提供的函数
        echo '</pre>';   /* */

        exit;
        echo '</pre>';   /* */
        echo '<br><br><br><br><br><br><pre>';
        print_r($result);
        echo "end remote 。。。<br />";
        echo '<pre>';
        print_r($client->__getFunctions()); // 获取webservice提供的函数
        echo '</pre>';   /* */
    }

}
