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
                    $udata['reg_amount'] = round($data['LOAN_AMOUNT'] / 10000, 2);
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
                $res['msg'] = "4002"; //不存在此编号";
            }
        } else {
            $res['val'] = 0;
            $res['msg'] = "4001"; //:参数错误代理商编号或贷款编号不能为空";
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
     *  WSDL API 更新审批状态
      +----------------------------------------------------------
     */
    public function upstatementdo() {
        ////  
        //  header("Content-Type:text/html;charset=utf-8");
        //server.php文件
        include("/Application/Loanpi/Layout/Service/FromPI.class.php");
        ini_set("soap.wsdl_cache_enabled", "0"); ////测试时打开防止soap缓存
        $server = new \SoapServer('./UpStatementFromPi.wsdl'); ##此处的Service.wsdl文件是上面生成的, array('soap_version' => SOAP_1_2) 
        $server->setClass('FromPI'); //注册Service类的所有方法   
        $server->handle(); //处理请求   
        //web log
        $logs['user'] = 'FromPI';
        $logs['title'] = '对账函API接口';
        $logs['status'] = '调用成功';
        $logs['operating'] = 'PItoSWW';
        D('Weblog')->logAdd($logs);
    }

    /**
      +----------------------------------------------------------
     *   更新审批状态 
     * 由 FromPi.class.php 远程调用
      +----------------------------------------------------------
     */
    public function UpStatementToLocal() {
        $data = I('post.');
        $item = $data['item'];
        // statement log
        $st_logs['user'] = 'FromPI';
        $st_logs['title'] = '对账函API接口';
        $st_logs['status'] = '调用成功';
        $st_logs['operating'] = json_encode($item);
        D('Statement')->log_stAdd($st_logs);
       
        //*
        $ar = 1;
        foreach ($item as $row) {
            /// 在这里判断value是不是数组，是的话，说明是2维
            if (is_array($row)) {
                $ar = 2;
            }
        }
        $reDate = '';
        if ($ar == 2) {
            foreach ($item as $row) {
                /// 在这里判断value是不是数组，是的话，说明是2维
                $reDate[] = $this->UpStatementToLocalDo($row);
            }
        } else {
            $reDate = $this->UpStatementToLocalDo($item);
        }
        //*/
        $res['val'] = 1;
        $res['msg'] = json_encode($reDate); //;
        // print_r($res);
        echo json_encode($res);
    }

    /**
      +----------------------------------------------------------
     *   更新审批状态 保存数据
     *   由 FromPi.class.php 远程调用
      +----------------------------------------------------------
     */
    function UpStatementToLocalDo($row) {

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
            $upData['id'] = $list['id'];

            $reDate = D('Statement')->stUpdate($upData);
            $logs['user'] = 'FromPI';
            $logs['title'] = '对账函-Update';
            $logs['status'] = '更新成功';
            $logs['operating'] = json_encode($upData);
            D('Weblog')->logAdd($logs);
        } else {
            $reDate = D('Statement')->stAdd($upData);
            if ($reDate) {
                $logs['user'] = 'FromPI';
                $logs['title'] = '对账函-Add';
                $logs['status'] = '推送成功';
                $logs['operating'] = json_encode($upData);
                D('Weblog')->logAdd($logs);
            } else {
                $logs['user'] = 'FromPI';
                $logs['title'] = '对账函-Add';
                $logs['status'] = '推送失败';
                $logs['operating'] = json_encode($reDate) . json_encode($upData);
                D('Weblog')->logAdd($logs);
            }
        }
        return $reDate;
    }

    /**
      +----------------------------------------------------------
     * 功能：PI webservice testing 
      +----------------------------------------------------------
     */
    function soaptest() {

        //exit;
        header("Content-Type:text/html;charset=utf-8");


        /////////////////////////////////////////////////////////
        //testing  soap
        /////////////////////
        $soapURL = "./MI_OA2SAP_Psc_Send.wsdl"; //"http://localhost:8082/MI_OA2SAP_Psc_Send.wsdl"; //
        //  $soapParameters = Array('login' => "piappluser", 'password' => "vfr45tgb");
        // $soapParameters = Array('login' => "zhangtingt", 'password' => "900123456");
        //  vendor('nusoap.nusoap');
        // import('Vendor.nusoap.nusoap');
        $soap = new \SoapClient($soapURL); //nusoap_client
        // print_r($soap);
        print_r($soap->__getFunctions());
        echo $soap->debug_str;
        // $params['in'] = 1;
        // $params['item'][] = array('ID' => '22224', 'AGENT_CODE' => '22DG1', 'AGENT_KPF' => '0000000008', 'NAME1' => 'S', 'LOAN_TYPE' => 'S', 'DKCR' => '5', 'OTAP' => 'Ssss', 'OTCR' => '20160505', 'LOAN_DATE_TO' => '20160909', 'LOAN_CYCLE' => '30', 'LOAN_AMOUNT' => '10000', 'YL1' => '', 'YL2' => '', 'YL3' => '', 'YL4' => '', 'YL5' => '');
        // $params['item'][] = array('ID' => '22225', 'AGENT_CODE' => '22DG1', 'AGENT_KPF' => '0000000008', 'NAME1' => 'S', 'LOAN_TYPE' => 'S', 'DKCR' => '5', 'OTAP' => 'Ssss', 'OTCR' => '20160505', 'LOAN_DATE_TO' => '20160909', 'LOAN_CYCLE' => '30', 'LOAN_AMOUNT' => '10000', 'YL1' => '', 'YL2' => '', 'YL3' => '', 'YL4' => '', 'YL5' => '');
        $params[] = array('ID' => '1', 'AGENT_CODE' => '22DG1', 'AGENT_KPF' => '0000000008', 'NAME1' => 'S', 'LOAN_TYPE' => 'S', 'DKCR' => '5', 'OTAP' => 'Ssss', 'OTCR' => '20160505', 'LOAN_DATE_TO' => '20160909', 'LOAN_CYCLE' => '30', 'LOAN_AMOUNT' => '10000', 'YL1' => '', 'YL2' => '', 'YL3' => '', 'YL4' => '', 'YL5' => '');

        print_r($soap->UpStatementDo($params));
        // $array = $soap->__soapCall('UpStatusDo', $params);
//print_r(get_object_vars($array));
        //var_dump($array); 
        exit;
    }

    public function UpStatementTestaaaaaaa() {
       // exit;
        //这里可以加些验证规则，实现一些特殊目的。如安全方面的。
        //  $result = array('MESS_FLAG' => 'T', 'MESSAGE' => json_encode($data));
        // return $result;
        //  exit;
       // $data['item'][] = array('ID' => '1', 'AGENT_CODE' => '22DG1', 'AGENT_KPF' => '0000000008', 'NAME1' => 'S', 'LOAN_TYPE' => 'S', 'DKCR' => '5', 'OTAP' => 'Ssss', 'OTCR' => '20160505', 'LOAN_DATE_TO' => '20160909', 'LOAN_CYCLE' => '30', 'LOAN_AMOUNT' => '10000', 'YL1' => '', 'YL2' => '', 'YL3' => '', 'YL4' => '', 'YL5' => '');
        $data['item'] = array('ID' => '28458', 'AGENT_CODE' => '22DG1', 'AGENT_KPF' => '8000000008', 'NAME1' => '大港代理商-转为天津加盟2级', 'DATE_FROM' => '20161005', 'ARAR' => '5', 'ARCR' => '2', 'DKAR' => '1', 'DKCR' => '2', 'OTAP' => '30', 'OTCR' => '10000', 'YL1' => '', 'YL2' => '', 'YL3' => '', 'YL4' => '', 'YL5' => '');

        $ch = curl_init();
        $timeout = 5000;
        $header = array(
            'Content-Type: application/json',
        );
        //  $data = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8083/loanpi.php/Service/UpStatementToLocal"); //http://10.192.1.11/loanpi.php/Service/UpStatementToLocal
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); ////所需传的数组用http_bulid_query()函数处理一下，就ok了
        $output = curl_exec($ch);
        var_dump($output);
        if ($output === FALSE) {
            $MESS_FLAG = 'FS1';
            $MESSAGE = "API Error: " . curl_error($ch); // . curl_error($ch);
        } else {
            $reVal = json_decode($output);
            if ($reVal->val == 1) {
                $MESS_FLAG = 'T';
                //$MESSAGE = $reVal->msg;
            } else {
                $MESS_FLAG = 'FS2' . $reVal->val;
                // $MESSAGE = json_decode($output);
            }
            $MESSAGE = $reVal->msg;
        }
        curl_close($ch);
        //   return  $data; //$data->AGENT_CODE,$data->LOAN_AMOUNT
        $result = array('MESS_FLAG' => $MESS_FLAG, 'MESSAGE' => $MESSAGE);
        //  $result = json_encode($result);

        return $result;
    }

}
