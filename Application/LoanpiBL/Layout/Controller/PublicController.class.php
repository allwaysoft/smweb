<?php

namespace Layout\Controller;

//use Think\Controller;
use Layout\Common\CheckUserController;

class PublicController extends CheckUserController {

    protected function _initialize() {
        parent::_initialize();
        $this->PI = D('Pi', 'Service');
        $this->url = "Register";
        // 初始化数据&更新PI数据 
        
    }

            

    public function msg_repayment() {  
        $day = date('Y-m-d', strtotime('10 day')); 
        $where = "sap_end_time < '" . $day . "' and  dl_code= '" . $this->thisUser['user_name'] . "' and (reg_status = 5 or reg_status = 6)";  //  还款完成
        $list = D('Register')->result($where);
        if ($list) {
            for ($i = 0; $i < count($list); $i++) {
                // 获取状态描述
                $list[$i]['reg_status_msg'] = $this->get_status_msg($list[$i]['reg_status'],$list[$i]['sap_msg']);
            }
             //print($row);
        $this->list = $list;
        $this->display();
        } else {
           echo 0;
        }
       
    }

    /**
      +----------------------------------------------------------
     * 发起申请
      +----------------------------------------------------------
     */
    public function reg_add() {
        $this->sapLimit = $this->PI->get_limit($this->thisUser['user_name']); //获取额度
        $this->sapCycle = $this->PI->get_date($this->thisUser['user_name']); // 获取贷款天数
        $this->display('Register_add');
    }

    public function reg_add_do() {
        $data = I('post.');
        $D = D('Register');   
        $data['reg_code'] = $this->thisUser['user_name'] . '-' . time();
        $data['dl_code'] = $this->thisUser['user_name']; 
        $reg = $D->regAdd($data); // save ,return id,  
        if ($reg) {
            // 提交PI
            $uData['id'] = $reg;
            $retPi = $this->PI->to_register($data);
            if ($retPi['code'] == 0) {
                $uData['sap_code'] = $retPi['sap_code'];
                $regUp = $D->regUpdate($uData); // save ,return id, 
                echo 0;
            } else {
                echo 101;
            }
        } else {
            echo 101;
        }
    }

    /**
      +----------------------------------------------------------
     * 功能：获取状态描述
      +----------------------------------------------------------
     */
     public function get_status_msg($v,$m) {
        switch ($v) {
            case 1:
                return '申请中';
            case 2:
                return '审批中';
            case 4:
                 return '拒绝:' . $m;
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

}
