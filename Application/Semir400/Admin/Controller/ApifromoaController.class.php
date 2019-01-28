<?php

namespace Admin\Controller;

use Think\Controller;

class ApifromoaController extends Controller {

    public function __construct() {
        parent::__construct();
        define('RES', '/Tpl/Semir400');
    }

    public function index() {
        
    }

    /**
      +----------------------------------------------------------
     *  WSDL  更新OA审批信息
      +----------------------------------------------------------
     */
    public function Up400Do() {
        ////   //  header("Content-Type:text/html;charset=utf-8"); 
        include("/Application/Semir400/Admin/Service/FromOA.class.php");
        ini_set("soap.wsdl_cache_enabled", "0"); ////测试时打开防止soap缓存
        $server = new \SoapServer('./WSDL/Up400FromOA.wsdl', array('soap_version' => SOAP_1_1)); ##此处的Service.wsdl文件是上面生成的, array('soap_version' => SOAP_1_2) , array('soap_version' => SOAP_1_2)
        $server->setClass('FromOA'); //注册Service类的所有方法   
        $server->handle(); //处理请求  
    }

    /**
      +----------------------------------------------------------
     *   更新OA审批结果 
     * 由 FromOA.class.php 远程调用
      +----------------------------------------------------------
     */
    public function Up400ToLocal() {
        $data = I('post.');
        if ($data['fd_ServiceResult'] && $data['fd_PhotoResult']) {

            $type = $data['type'];
            if ($type == '服务投诉') {
                $type = 'service';
            } elseif ($type == '质量投诉') {
                $type = 'quality';
                $udata['oa_express'] = $data['oa_express'];
                $udata['oa_express_number'] = $data['oa_express_number'];
            } else {
                $res['val'] = 0;
                $res['msg'] = "4002"; //:参数错误代理商编号或贷款编号不能为空";
                echo json_encode($res);
                exit;
            }

            $where = "com_code= '" . $data['com_code'] . "' and oa_number = '" . $data['oa_number'] . "'";
            $list = D('400_' . $type . '_track_oa')->where($where)->find();
            if ($list) {
                $udata = '';
                $udata['oa_type'] = $data['fd_ServiceResult'];
                $udata['oa_contents'] = $data['fd_PhotoResult'];
                $udata['view_status'] = 1;
                $udata['oa_time'] = time();
                // save
                M('400_' . $type . '_track_oa')->where($where)->save($udata);
                $res['val'] = 1;
                $res['msg'] = 'Update Success！！';
            } else {
                $res['val'] = 0;
                $res['msg'] = "4003"; //不存在此编号";
            }
        } else {
            $res['val'] = 0;
            $res['msg'] = "4001"; //:参数错误代理商编号或贷款编号不能为空";
        }
        echo json_encode($res);
    }

    /**
      +----------------------------------------------------------
     * 功能：  testing 
      +----------------------------------------------------------
     */
    function soaptest() {
        header("Content-Type:text/html;charset=utf-8");

        /////////////////////////////////////////////////////////
        //testing  soap
        /////////////////////
        $soapURL = "http://w.semir.cn/wsdl/Up400FromOA.wsdl"; //"http://localhost:8082/MI_OA2SAP_Psc_Send.wsdl"; //
        //  $soapParameters = Array('login' => "piappluser", 'password' => "vfr45tgb");
        // $soapParameters = Array('login' => "zhangtingt", 'password' => "900123456");
        //  vendor('nusoap.nusoap');
        // import('Vendor.nusoap.nusoap');
        $soap = new \SoapClient($soapURL); //nusoap_client
        // print_r($soap);
        //   print_r($soap->__getFunctions());
        echo $soap->debug_str;
        $params = array('fd_ServiceResult' => '11CP1', 'fd_PhotoResult' => '0000000065', 'type' => 'S', 'com_code' => 'S', 'oa_number' => '5', 'oa_time' => '20160505', 'oa_express' => '20160909', 'oa_express_number' => '30');
        //  print_r($soap->Up400Do($params));
        $array = $soap->__soapCall('Up400Do', $params);
//print_r(get_object_vars($array));
        var_dump($array);
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
