<?php

namespace Layout\Controller;

//use Think\Controller;
use Layout\Common\CheckUserController;

class RegisterController extends CheckUserController {

    protected function _initialize() {
        parent::_initialize();
        $this->PI = D('Pi', 'Service');
        $this->url = "Register";
        // 初始化数据& 更新审批状态
        // $this->get_pi_reg();  // 测试期间访问PI太频繁，暂时拿掉
    }

    /**
      +----------------------------------------------------------
     *  初始化数据& 更新审批状态
      +----------------------------------------------------------
     */
    public function get_pi_reg() {
        //  更新所有贷款单状态
        $where = "reg_status < 8 and  dl_code= '" . $this->thisUser['user_name'] . "'";
        $list = D('Register')->result($where);
        for ($i = 0; $i < count($list); $i++) {
            $data['dl_code'] = $this->thisUser['user_name'];
            $data['sap_code'] = $list[$i]['sap_code'];
            $data['sap_type'] = $list[$i]['sap_type'];
            //获取审批状态
            $revale = $this->PI->get_loanstatus($data);
            if ($revale->MESS_FLAG == $list[$i]['reg_status']) {
                continue; // 下一个循环
            }
            //   print_r($revale);
            $udata = '';
            if ($revale->MESS_FLAG == 'S') {

                $udata['id'] = $list[$i]['id'];
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
                //  print_r($udata);
                D('Register')->regUpdate($udata);
            }
        }
        /// log 记录
        $logs['user'] = $this->thisUser['user_name'];
        $logs['title'] = '状态更新';
        $logs['status'] =  '更新成功';
        $logs['operating'] = json_encode($list); 
        D('Weblog')->logAdd($logs);
    }

    public function index() {
        //  $this->PI = D('Pi', 'Service');
        //  $revale = $this->PI->get_loanstatus($data);
        // 初始化数据& 更新审批状态
        //$this->get_pi_reg();
        $this->display();
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Layout模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function reg_list() {
        $time = time() - 15552000;
        $yb = date('Y-m-d', $time);
        $where = "(reg_date > '" . $yb . "'or  reg_status <= 6) and  dl_code= '" . $this->thisUser['user_name'] . "'and reg_type = 'N' ";
        $list = D('Register')->result($where);
        if ($list) {
            for ($i = 0; $i < count($list); $i++) {
                // 获取状态描述
                // echo $list[$i]['sap_msg'];
                $list[$i]['reg_status_msg'] = $this->get_status_msg($list[$i]);
            }
        } else {
            $list = array();
        }
        //print_r($list);
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
    }

    /**
      +----------------------------------------------------------
     * 特殊申请
      +----------------------------------------------------------
     */
    public function special() {
        //  $this->PI = D('Pi', 'Service');
        //  $revale = $this->PI->get_loanstatus($data);
        $this->display();
        // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Layout模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function special_list() {
        $time = time() - 15552000;
        $yb = date('Y-m-d', $time);
        $where = "(reg_date > '" . $yb . "'or  reg_status  <= 6 ) and  dl_code= '" . $this->thisUser['user_name'] . "'and reg_type = 'S' ";
        $list = D('Register')->result($where);
        if ($list) {
            for ($i = 0; $i < count($list); $i++) {
                // 获取状态描述 
                $list[$i]['reg_status_msg'] = $this->get_status_msg($list[$i]);
            }
        } else {
            $list = array();
        }
        $data['data'] = $list;
        $this->ajaxReturn($data, 'JSON');
    }

    /**
      +----------------------------------------------------------
     * 发起日常贷款申请
      +----------------------------------------------------------
     */
    public function reg_start() {
        creatToken();
        $this->type = I('get.t');
        $this->display('Register_start');
    }

    /**
      +----------------------------------------------------------
     * 发起特殊贷款申请
      +----------------------------------------------------------
     */
    public function reg_special_start() {
        creatToken();
        $this->type = I('get.t');
        $this->display('Register_special_start');
    }

    /**
      +----------------------------------------------------------
     * 发起日常贷款申请填写信息
      +----------------------------------------------------------
     */
    public function reg_add() {
        creatToken();
        $this->type = I('post.type');
        $this->reg_start_time = I('post.reg_start_time');
        $data['dl_code'] = $this->thisUser['user_name'];
        $data['reg_type'] = I('post.type');
        $data['reg_date'] = I('post.reg_start_time');
        $this->reData = $this->sapLimit = $this->PI->get_limit($data); //获取额度  
        $this->display('Register_add');
    }

    /**
      +----------------------------------------------------------
     * 贷款贷款期限及申请额度查询
      +----------------------------------------------------------
     */
    public function reg_get_limit() {
        $data['dl_code'] = $this->thisUser['user_name'];
        $data['reg_type'] = I('post.type');
        $data['reg_date'] = I('post.date');
        $reData = $this->getLimit = $this->PI->get_limit($data); //获取额度  
        $this->ajaxReturn($reData, 'JSON');
    }

    public function reg_add_do() {
        $data = I('post.');
        if (!checkToken($data['TOKEN'])) {
            $this->error('1006: 请勿重复提交信息！！', U('Register/index'));
            return;
        }
        $D = D('Register');
        if ($data) {
            $data['dl_code'] = $this->thisUser['user_name'];
            $data['reg_code'] = $this->thisUser['user_name'] . '-' . time();
            $data['reg_type'] = $data['type'];
            ///////***/ 
            $rePi = $this->reData = $this->PI->to_register($data);  // 提交申请
            if ($rePi->MESS_FLAG == 'S') {
                $data['sap_code'] = $rePi->LOAN_NUM;
                //print_r($data);
                $reg = $D->regAdd($data);
            }
            $reData['MESS_FLAG'] = $rePi->MESS_FLAG;
            $reData['MESSAGE'] = $rePi->MESSAGE;
            $this->reData = $reData;
            $this->data = $data;
            $this->display('Register_add_do');
  // log 记录
            $logs['user'] = $this->thisUser['user_name'];
            $logs['title'] = '贷款申请';
            $logs['status'] = $rePi->MESS_FLAG;
            $logs['operating'] = json_encode($data);
            D('Weblog')->logAdd($logs);
        } else {
            echo "1002: 请勿外部提交！！";
        }
    }

    /**
      +----------------------------------------------------------
     * 功能：获取状态描述
      +----------------------------------------------------------
     */
    public function get_status_msg($data) {
        //  return $v; 
        switch ($data['reg_status']) {
            case 1:
                return '申请中';
            case 2:
                return '审批中';
            case 4:
                return '拒绝:' . $data['sap_msg'];
            case 5:
                return '已审批'; // . $row->sap_msg;
            case 6:
                return '部分还款';
            case 8:
                return '全部还款 ';
            default:
                return '审批中';
        }
    }

    /**
      +----------------------------------------------------------
     * 功能：计算两个日期相差 年 月 日 
      +----------------------------------------------------------
     * @param date   $date1 起始日期 
     * @param date   $date2 截止日期日期 
      +----------------------------------------------------------
     * @return array     
     *  demo :  $this->DiffDate($list[$i]['sap_start_time'], $list[$i]['sap_end_time'], 'd');   
      +----------------------------------------------------------
     */
    function DiffDate($date1, $date2, $t) {
        // 导入日期类
        $Date = new \Org\Util\Date($date1);
        return $Date->dateDiff($date2, $t);  // 比较日期差
    }

    /**
     * 求两个日期之间相差的天数
     * (针对1970年1月1日之后，求之前可以采用泰勒公式)
     * @param string $day1
     * @param string $day2
     * @return number
     */
    function diffBetweenTwoDays($day1, $day2) {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);

        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return ($second1 - $second2) / 86400;
    }

    /**
      +----------------------------------------------------------
     * 功能：PI webservice testing 
      +----------------------------------------------------------
     */
    function soaptest() {
        //testing  soap
        /////////////////////
        $soapURL = "http://localhost:8082/MI_SW2SAP_Crd_Send.wsdl"; //"http://localhost:8082/MI_OA2SAP_Psc_Send.wsdl"; //
        $soapParameters = Array('login' => "piappluser", 'password' => "vfr45tgb");
        // $soapParameters = Array('login' => "zhangtingt", 'password' => "900123456");


        $soapClient = new \soapClient($soapURL, $soapParameters);
        print_r($soapClient);
        //////
        $soapFunction = "MI_SW2SAP_Crd_Send"; // "MI_SW2SAP_Crd_Send";
        $soapFunctionParameters = Array('AGENT_CODE' => "11CP1", 'LOAN_DATE_FROM' => "20161020", 'LOAN_CYCLE' => '30', 'LOAN_AMOUNT' => '300', 'LOAN_TYPE' => 'N', 'type' => '2'); //贷款申请
        //$soapFunctionParameters = Array('AGENT_CODE' => "11CP1A003", 'LOAN_DATE_FROM' => "20160919", 'LOAN_CYCLE' => '41', 'LOAN_AMOUNT' => '10000', 'LOAN_TYPE' => 'S', 'type' => '2'); // 日常贷款期限及申请额度查询
        // $soapFunctionParameters = Array('AGENT_CODE' => "22DG1", 'LOAN_DATE_FROM' => "20160920", 'LOAN_TYPE' => 'N', 'type' => '1');  // 贷款期限及申请额度查询
        $soapFunctionParameters = Array('AGENT_CODE' => "22DG1", 'LOAN_NUM' => "0000000123", 'LOAN_TYPE' => 'N', 'type' => '3'); //贷款审核状态获取接口 
        //  $soapFunctionParameters = Array('AGENT_CODE' => "11CP1", 'LOAN_NUM' => "0000000031", 'REPAY_AMOUNT' => '300', 'LOAN_TYPE' => 'S', 'type' => '4'); // 还款申请
        //  $soapFunctionParameters = Array('AGENT_CODE' => "11CP1", 'type' => '5'); //银行余额获取
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

    function soaptest1() {
        //testing  soap
        /////////////////////
        $soapURL = "http://localhost:8082/MI_OA2SAP_Psc_Send.wsdl"; // "http://localhost:8082/MI_SW2SAP_Crd_Send.wsdl";
        $soapParameters = Array('login' => "piappluser", 'password' => "vfr45tgb");
        // $soapParameters = Array('login' => "zhangtingt", 'password' => "900123456");
        $soapFunction = "MI_OA2SAP_Psc_Send"; // "MI_SW2SAP_Crd_Send";
        $soapFunctionParameters = Array('fd_hzsxe' => "1UHB1", 'fd_sqsj' => "2016-10-20", 'fd_zzbh' => 'N0001', 'fd_sxqx1' => '江苏区', 'fd_sxqx2' => "江苏区2", 'fd_sxms' => 'sdsdf', 'fd_sxqx1' => 'sdfsdfsdf');

        $soapClient = new \soapClient($soapURL, $soapParameters);
        // print_r($soapClient->sdl);
        //$soapResult = $soapClient->MI_OA2SAP_Psc_Send($soapFunctionParameters);
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
        echo '<pre>';
        // print_r($soapClient->__getFunctions()); // 获取webservice提供的函数
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
